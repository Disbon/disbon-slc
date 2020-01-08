@extends('master')
 
@section('content')
  <h1 class="h3 mb-3 font-weight-normal">Consultar Chamados</h1>
  <table class="table">
    <thead class="black white-text">
      <tr>
        <th scope="col">Núm</th>
        <th scope="col">Assunto</th>
        <th scope="col">Ambiente</th>
        <th scope="col">Data</th>
        <th scope="col">Situação</th>
      </tr>
    </thead>
    <tbody>
      @foreach($chamados as $chamado)
        <tr>
          <th scope="row">{{$chamado->numero}}</th>
          <td>{{$chamado->assunto}}</td>
          <td>{{$chamado->ambiente}}</td>
          <td>{{$chamado->created_at}}</td>
          <td>{{$chamado->status}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
