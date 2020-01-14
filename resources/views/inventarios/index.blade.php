@extends('master')
 
@section('content')
  <div class="col-sm-12">

    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div>
    @endif
  </div>
  <div class="col-sm-12">

    @if(session()->get('error'))
      <div class="alert alert-error">
        {{ session()->get('error') }}  
      </div>
    @endif
    </div>
  <h1 class="h3 mb-3 font-weight-normal">Consultar Inventário</h1>
  <form action="{{route('inventarios.filtro')}}" method="POST" id="logForm" class="form-signin">
  @csrf
  <div class="form-label-group row">
    <div class="col-sm">
      <label for="filial">Filial</label>
      <select name="filial" class="form-control col-sm">
        <option value="0">Todas as Filiais</option>
        @foreach( $filiais as $k => $f )
          <option value="{{$k}}">{{ $f }} </option>
        @endforeach
      </select>
    </div>
    <div class="col-sm">
      <label for="tipo_equipamento">Tipo de Equipamento</label>
      <select name="tipo_equipamento" class="form-control col-sm">
        <option value="0">Todos os Tipos</option>
        @foreach( $tipo_equipamentos as $te )
          <option value="{{$te->id}}" >{{ $te->descricao }} </option>
        @endforeach
      </select>
    </div>
    <div class="col-sm">
      <label for="setor">Setor</label>
      <select name="setor" class="form-control ">
        <option value="0">Todos os Setores</option>
        @foreach( $setores as $s )
          <option value="{{$s->id}}" >{{ $s->descricao }} </option>
        @endforeach
      </select>
    </div>
  </div> 
  <button type="submit" class="btn btn-primary">Filtrar</button>
  <br />

  </form>
  <table class="table">
    <thead class="black white-text">
      <tr>
        <th scope="col">Filial</th>
        <th scope="col">Tipo</th>
        <th scope="col">Descrição</th>
        <th scope="col">Setor</th>
        <th scope="col">Usuário</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($inventarios as $inventario)
        <tr>
          <td scope="row">{{$inventario->codfilial}}</td>
          <td>{{$inventario->tipo_equipamento}}</td>
          <td>{{$inventario->descricao}}</td>
          <td>{{$inventario->setor}}</td>
          <td>{{$inventario->usuario}}</td>
          <td><a href="{{ route('inventarios.edit',$inventario->id)}}" class="btn btn-primary">Editar</a></td>
          <td>
                <form onsubmit="return confirm('Deseja Remover Item do Inventário?')" action="{{ route('inventarios.destroy', $inventario->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Remover</button>
                </form>
            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
