@extends('master')
 
@section('content')
<h1 class="h3 mb-3 font-weight-normal">Abertura de Chamado</h1>
<form action="{{route('chamados.store')}}" method="POST" id="logForm" class="form-signin">
  {{ csrf_field() }}

  <div class="form-label-group">
    <label for="inputAssunto">Assunto</label>
    <input type="text" name="assunto" id="inputAssunto" class="form-control" placeholder="Assunto" >
    @if ($errors->has('assunto'))
    <span class="error">{{ $errors->first('assunto') }}</span>
    @endif    
  </div> 
  <div class="form-label-group">
    <label for="inputAmbiente">Ambiente</label>
    <select name="ambiente" class="form-control">
      @foreach( $ambientes as $k => $v )
        <option value="{{$k}}">{{ $v }} </option>
      @endforeach
    </select>
    @if ($errors->has('ambiente'))
    <span class="error">{{ $errors->first('ambiente') }}</span>
    @endif    
  </div> 
  <div class="form-label-group">
    <label for="inputDescrição">Descrição</label>
    <textarea name="descricao" id="inputDescricao" class="form-control"></textarea>
    @if ($errors->has('descricao'))
    <span class="error">{{ $errors->first('descricao') }}</span>
    @endif    
  </div> 
  <div class="form-label-group">
    <label for="inputAssunto">Prioridade</label>
    <select name="prioridade" class="form-control">
      @foreach( $prioridades as $k => $v )
        <option value="{{$k}}">{{ $v }} </option>
      @endforeach
    </select>
    @if ($errors->has('prioridade'))
    <span class="error">{{ $errors->first('prioridade') }}</span>
    @endif    
  </div> 
  <div class="form-label-group">
    <label for="inputTelefone">Telefone</label>
    <input type="text" name="telefone" id="inputTelefone" class="form-control" placeholder="(99) 9 9999-9999" >
    @if ($errors->has('telefone'))
    <span class="error">{{ $errors->first('telefone') }}</span>
    @endif    
  </div>   
   <button type="submit" class="btn btn-primary">Enviar</button>
</form>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function($){
        $('#inputTelefone').mask('(99) 9 9999-9999');
    });
  </script>
@endsection
