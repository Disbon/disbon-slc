<!DOCTYPE html>
<html>
<head>
<title>DISBON SLC</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{url('css/login.css')}}">

</head>
<body class="text-center">

    <form action="{{url('post-login')}}" method="POST" id="logForm" class="form-signin">
      <img src={{url('/imagens/disbonslc-logo.png')}} width="144px" height="44px"  alt="SerdManage Logo"/>
      <h1 class="h3 mb-3 font-weight-normal">Login de Usuário</h1>
      {{ csrf_field() }}

      <div class="form-label-group">
        <label for="inputUsuario">Usuário</label>
        <input type="text" name="usuariobd" id="inputUsuario" class="form-control" placeholder="Usuário" >
        @if ($errors->has('usuariobd'))
        <span class="error">{{ $errors->first('usuariobd') }}</span>
        @endif    
      </div> 

      <div class="form-label-group">
        <label for="inputPassword">Senha</label>
        <input type="password" name="senhabd" id="inputSenha" class="form-control" placeholder="Senha">
        @if ($errors->has('senha'))
        <span class="error">{{ $errors->first('senha') }}</span>
        @endif  
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>

</body>
</html>