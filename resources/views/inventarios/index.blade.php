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
  <table class="table">
    <thead class="black white-text">
      <tr>
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
          <th scope="row">{{$inventario->tipo_equipamento}}</th>
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
