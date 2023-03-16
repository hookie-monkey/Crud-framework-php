@extends('layouts.app')
@section('content')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet"> 
<div class="container">


    @if(Session::has('mensaje'))<div class="alert alert-success alert-dismissible fade show" role="alert">
{{Session::get('mensaje')}}
<button type="button" style="float:right;" class="btn-close" data-bs-dismiss="alert"  aria-label="Close">

</button>
</div>
@endif

<a href="{{url ('empleados/create')}}" class="btn btn-custom-primary" >Crear nuevo empleado</a>
<br/><br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cargo</th>
            <th>Correo</th>
            <th>Foto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($empleados as $empleado)

        <tr>
            <td>{{ $empleado->id }}</td>
            <td>{{ $empleado->Nombre }}</td>
            <td>{{ $empleado->Apellido }}</td>
            <td>{{ $empleado->Cargo }}</td>
            <td>{{ $empleado->Correo }}</td>

            <td>
            <img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$empleado->Foto }}"  width="70" alt="">  
       
            </td>
            <td> 
            <a href="{{ url ('/empleados/'.$empleado->id.'/edit') }}" class="btn btn-primary">   
            Editar 
            </a> 

            |
            <form action="{{ url('/empleados/'.$empleado->id) }}" method="post" class="d-inline">
            @csrf

            {{method_field('DELETE') }}
            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres realmente borrar?')" value="Borrar">
            </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links() !!}
</div>
@endsection