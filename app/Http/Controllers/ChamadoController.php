<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chamados;
use Illuminate\Support\Facades\Auth;

class ChamadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $prioridades = ['Alta', 'Media', 'Baixa'];
    private $ambientes = ['Winthor', 'Rede', 'RM', 'Email', 'Telefonia-Celular', 'Alterdata', 'Maxima', 'ION', 'Computadores'];

    public function index()
    {
        $chamados = $this->getChamados(Auth::id());
        foreach($chamados as $chamado){
            $chamado->ambiente = $this->ambientes[$chamado->ambiente];
            $chamado->prioridade = $this->prioridades[$chamado->prioridade];
        }
        return view('chamados.index', compact('chamados'));
    }

    public function getChamados($matricula){
        if (empty($matricula))
            return Chamados::all();
        else
           return Chamados::where('matricula', $matricula)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prioridades = $this->prioridades;
        $ambientes = $this->ambientes;
        return view('chamados.create', compact('prioridades', 'ambientes' ));
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
            'assunto'=>'required',
            'descricao'=>'required',
        ]);
        
        $chamado = new Chamados([
            'numero' => strval(count($this->getChamados(""))+1).'-'.$request->get('ambiente'),
            'assunto' => $request->get('assunto'),
            'ambiente' => $request->get('ambiente'),
            'descricao' => $request->get('descricao'),
            'prioridade' => $request->get('prioridade'),
            'telefone' => $request->get('telefone'),
            'status' => '01',
            'matricula' => '281',
        ]);
        $chamado->save();
        return redirect('/chamados')->with('success', 'Chamado Enviado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
