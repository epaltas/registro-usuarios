@extends('layouts.app')
@section('content')
<div class="container">

  @if(Session::has('mensaje'))
  <div class="alert alert-success" role="alert">
  {{Session::get('mensaje')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
@endif



   <a href="{{ url('usuario/create')}}" class="btn-success btn-lg "> Registrar nuevo usuario</a>    
        <br/>
        <br/>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cédula</th>
                <th scope="col">Celular</th>
                <th scope="col">Email</th>
                <th scope="col">Fecha de nacimiento</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  
            @foreach( $usuarios as $usuario )
              <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->cedula }}</td>
                <td>{{ $usuario->celular }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->date_of_birth }}</td>
                <td>
                    
                    <a href="{{'usuario/'.$usuario->id.'/edit'}}" class="btn btn-warning">
                        Editar
                    </a>

                    <form action="{{ url('/usuario/'.$usuario->id) }}" method="POST" class="d-inline">
                        @csrf
                        {{ method_field('DELETE')}}
                        <input type="submit" onclick="return confirm('Está seguro de borrar el registro?')" value="Borrar" class="btn btn-danger">
    
                    </form>

                </td>

                

              </tr>
            @endforeach  
            </tbody>
          </table>

          {!! $usuarios->links()!!}
          
</div>
@endsection