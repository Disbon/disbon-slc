<?php

namespace App\Http\Controllers;

use Redirect, Route;
use App\Inventario;
use App\Permissoes;
use App\Setor;
use App\TipoEquipamento;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filiais = $this->getFiliais(Auth::id());
        $tipo_equipamentos = TipoEquipamento::all();
        $setores = Setor::all();
        $inventarios = $this->getInventarios(Auth::id());
        foreach($inventarios as $inventario){
            $inventario->tipo_equipamento = TipoEquipamento::find($inventario->tipo_equipamento)->descricao;
            $inventario->setor = Setor::find($inventario->setor)->descricao;
        }
        return view('inventarios.index', compact('inventarios', 'filiais', 'tipo_equipamentos', 'setores'));
    }

    public function filtro(Request $request){
        $filiais = $this->getFiliais(Auth::id());
        $tipo_equipamentos = TipoEquipamento::all();
        $setores = Setor::all();
        $inventarios = $this->getInventarioFiltro(Auth::id(), $request);
        foreach($inventarios as $inventario){
            $inventario->tipo_equipamento = TipoEquipamento::find($inventario->tipo_equipamento)->descricao;
            $inventario->setor = Setor::find($inventario->setor)->descricao;
        }
        return view('inventarios.index', compact('inventarios', 'filiais', 'tipo_equipamentos', 'setores'));
    }

    private function getFiliais($matricula){
        $_filiais = [
            1 => 'Filial 1 - ITZ', 
            2 => 'Filial 2 - MAR', 
            3 => 'Filial 3 - SLZ', 
            4 => 'Filial 4 - THE', 
            5 => 'Filial 5 - PLZ', 
            6 => 'Filial 6 - FSA', 
            7 => 'Filial 7 - ITB'
        ];
        $filiais = [];
        if (empty(Permissoes::where('USUARIO', $matricula)->first()->acesso)){
            $filial = DB::table('DISBON.PCEMPR')->where('matricula', $matricula)->first()->codfilial;
            $filiais[$filial] = $_filiais[$filial];
        }else
            if (Permissoes::where('USUARIO', $matricula)->first()->acesso != 'ADMIN'){
                $filial = DB::table('DISBON.PCEMPR')->where('matricula', $matricula)->first()->codfilial;
                $filiais[$filial] = $_filiais[$filial];
            }else{
                $filiais = $_filiais;
            }
        return $filiais;
    }

    private function getInventarios($matricula){
        if (empty($matricula))
            return Inventario::all();
        else{
            foreach ($this->getFiliais($matricula) as $k => $v){
                $filiais[] = $k;
            }
            if (empty($filiais))
                return Inventario::all();
            else
                //return Inventario::where('codfilial', 7)->get();
                return Inventario::whereIn('codfilial', $filiais)->get();
        }
    }
    private function getInventarioFiltro($matricula, Request $request){
        if (empty($matricula))
            return Inventario::all();
        else{
            foreach ($this->getFiliais($matricula) as $k => $v){
                $filiais[] = $k;
            }
            if (empty($filiais))
                return Inventario::all();
            else{
                error_log($request);
                if ($request->get('filial') == '0')
                    $inventario = Inventario::whereIn('codfilial', $filiais);
                else
                    $inventario = Inventario::where('codfilial', $request->get('filial'));
                if ($request->get('setor') != '0')
                    $inventario = $inventario->where('setor', $request->get('setor'));
                if ($request->get('tipo_equipamento') != '0')
                    $inventario = $inventario->where('tipo_equipamento',  $request->get('tipo_equipamento'));
                
                return $inventario->get();
            }
                //return Inventario::where('codfilial', 7)->get();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $filiais = $this->getFiliais(Auth::id());
        $tipo_equipamentos = TipoEquipamento::all();
        $setores = Setor::all();
        $inventario = new Inventario([
            'id' => '',
            'filial' => '',
            'tipo_equipamento' => '',
            'descricao' => '',
            'setor' => '',
            'usuario' => '',
            'documento' => '',
            'valor' => '',
        ]);
        return view('inventarios.create', compact('tipo_equipamentos', 'setores', 'filiais', 'inventario' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'filial'=>'required',
            'tipo_equipamento'=>'required',
            'setor'=>'required',
            'descricao'=>'required',
            'usuario'=>'required',
        ]);
        if (empty($request->get('id'))) {
            $inventario = new Inventario([
                'codfilial' => $request->get('filial'),
                'tipo_equipamento' => $request->get('tipo_equipamento'),
                'descricao' => $request->get('descricao'),
                'setor' => $request->get('setor'),
                'usuario' => $request->get('usuario'),
                'documento' => $request->get('documento'),
                'valor' => str_replace(',','.',str_replace('.','',$request->get('valor'))),
                'user_add' => Auth::id(),
            ]);
            $inventario->save();
            return redirect()->route('inventarios')->with('success', 'Inventario Atualizado!');
        } else {
            $this->update($request, $request->get('id'));
            return redirect()->route('inventarios')->with('success', 'Inventario Atualizado!');

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (empty($id))
            return;
        $inventario = Inventario::find($id);
        error_log($inventario->valor);
        if (strpos($inventario->valor, '.') === false){
            $inventario->valor = $inventario->valor.'.00';
        }

        $filiais = $this->getFiliais(Auth::id());
        $tipo_equipamentos = TipoEquipamento::all();
        $setores = Setor::all();
        return view('inventarios.create', compact('tipo_equipamentos', 'setores', 'filiais', 'inventario' ));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inventario = Inventario::find($id);
        $inventario->codfilial = $request->get('filial');
        $inventario->tipo_equipamento = $request->get('tipo_equipamento');
        $inventario->descricao = $request->get('descricao');
        $inventario->setor = $request->get('setor');
        $inventario->usuario = $request->get('usuario');
        $inventario->documento = $request->get('documento');
        $inventario->valor = str_replace(',','.',str_replace('.','',$request->get('valor')));
        $inventario->user_up = Auth::id();
        $inventario->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventario = Inventario::find($id);
        $inventario->delete();
        return redirect()->route('inventarios')->with('success', 'Inventário Atualizado!');
    }
}
