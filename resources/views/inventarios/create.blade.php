@extends('master')
 
@section('content')
<!-- @if (isset($errors) && count($errors))
     
            There were {{count($errors->all())}} Error(s)
                        <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }} </li>
                    @endforeach
                </ul>
                
        @endif -->
<h1 class="h3 mb-3 font-weight-normal">Atualização de Inventário</h1>
<form action="{{route('inventarios.store')}}" method="POST" id="logForm" class="form-signin">
  @csrf
  <input type="hidden" name="id" class="form-control" value="{{ $inventario->id }}"/>
  <div class="form-label-group">
    <label for="filial">Filial</label>
    <select name="filial" class="form-control">
      @foreach( $filiais as $k => $f )
        <option value="{{$k}}" {{ ($k == $inventario->codfilial) ? 'selected' : '' }}>{{ $f }} </option>
      @endforeach
    </select>
    @if ($errors->has('filial'))
    <span class="error">{{ $errors->first('filial') }}</span>
    @endif    
  </div> 
  <div class="form-label-group">
    <label for="tipo_equipamento">Tipo de Equipamento</label>
    <select name="tipo_equipamento" class="form-control">
      @foreach( $tipo_equipamentos as $te )
        <option value="{{$te->id}}" {{ ($te->id == $inventario->tipo_equipamento) ? 'selected' : '' }}>{{ $te->descricao }} </option>
      @endforeach
    </select>
    @if ($errors->has('tipo_equipamento'))
    <span class="error">{{ $errors->first('tipo_equipamento') }}</span>
    @endif    
  </div>
  <div class="form-label-group">
    <label for="setor">Setor</label>
    <select name="setor" class="form-control">
      @foreach( $setores as $s )
        <option value="{{$s->id}}" {{ ($s->id == $inventario->setor) ? 'selected' : '' }}>{{ $s->descricao }} </option>
      @endforeach
    </select>
    @if ($errors->has('setor'))
    <span class="error">{{ $errors->first('setor') }}</span>
    @endif    
  </div>
  <div class="form-label-group">
    <label for="descricao">Descrição</label>
    <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Descrição" value="{{ $inventario->descricao }}">
    @if ($errors->has('descricao'))
    <span class="error">{{ $errors->first('descricao') }}</span>
    @endif    
  </div> 
  <div class="form-label-group">
    <label for="usuario">Usuário</label>
    <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuário" value="{{ $inventario->usuario }}">
    @if ($errors->has('usuario'))
    <span class="error">{{ $errors->first('usuario') }}</span>
    @endif    
  </div>
  <div class="form-label-group">
    <label for="documento">Documento(NF/Patrimonio/Etc)</label>
    <input type="text" name="documento" id="documento" class="form-control" placeholder="Documento" value="{{ $inventario->documento }}">
    @if ($errors->has('documento'))
    <span class="error">{{ $errors->first('documento') }}</span>
    @endif    
  </div>
  <div class="form-label-group">
    <label for="valor">Valor</label>
    <input type="text" name="valor" id="valor" class="form-control" placeholder="Valor" value="{{ $inventario->valor }}">
    @if ($errors->has('valor'))
    <span class="error">{{ $errors->first('valor') }}</span>
    @endif    
  </div>
   <button type="submit" class="btn btn-primary">Enviar</button>
</form>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function($){
        $('#valor').mask('#.##0,00', {reverse: true});
    });
  </script>
@endsection
