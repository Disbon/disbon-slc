<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
Use App\Permissoes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
 
class AuthController extends Controller
{
 
    public function index()
    {
        if(Auth::check()){
            return redirect()->intended('');
        }
        return view('login.Login');
    }  
     
    public function postLogin(Request $request)
    {
        request()->validate([
        'usuariobd' => 'required',
        'senhabd' => 'required',
        ]);


        $usuario = DB::table('DISBON.PCEMPR')->where('usuariobd', strtoupper(trim($request->input('usuariobd'))))
                   ->first();

        $pass = DB::table('DUAL')
                     ->select(DB::raw("DISBON.CRYPT('".strtoupper($request->input('senhabd'))."','".strtoupper($request->input('usuariobd'))."') AS senha"))
                     ->get()[0]->senha;
 
        if ($pass===$usuario->senhabd) {
            // Authentication passed...
            $permissoes = Permissoes::where('usuario', $usuario->matricula)->get();
            $menus = [];
            foreach ($permissoes as $p){
                $menus[] = $p->menu;
            }
            $request->session()->put('menus', $menus);
            Auth::loginUsingId($usuario->matricula);
            return redirect()->intended('');
        }
        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
     
    public function dashboard()
    {
 
      if(Auth::check()){
        #$usuario = DB::table('DISBON.PCEMPR')->where('matricula', Auth::id())->first();
        $usuario = "USUARIO.LOGADO";
        return view('welcome', compact('usuario'));
      }
       return Redirect::to("login")->withSuccess('Opps! You do not have access');
    }
     
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}