<h1> {{ $modo }} empleado </h1>

@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
		   <li> {{$error}}</li>
	    @endforeach
    </ul>
</div>
	


@endif


<div class="form-group">
<label for="Nombre">Nombre</label><br>
<input type="text" class="form-control" name="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre') }}" id="Nombre"><br>
</div>

<div class="form-group">
<label for="Apellido">Apellido</label><br>
<input type="text" class="form-control" name="Apellido" value="{{ isset($empleado->Apellido)?$empleado->Apellido:old('Apellido') }}" id="Apellido"><br>
</div>


<div class="form-group">
<label for="Cargo">Cargo</label><br>
<input type="text"class="form-control" name="Cargo" value="{{ isset($empleado->Cargo)?$empleado->Cargo:old('Cargo') }}" id="Cargo"><br>
</div>

<div class="form-group">
<label for="Correo">Correo</label><br>
<input type="text" class="form-control" name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo') }}" id="Correo"><br>
</div>

<div class="form-group">
<label for="Foto"></label><br>
@if(isset($empleado->Foto))
<img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$empleado->Foto }}" width="70" alt="">  
@endif
<input type="file"class="form-control" name="Foto" value="" id="Foto"><br>
</div>
<br><br>
<input class="btn btn-success d-inline" type="submit" value="{{$modo}} datos">
|
<a class="btn btn-info d-inline" href="{{url ('empleados')}}">Regresar</a>
