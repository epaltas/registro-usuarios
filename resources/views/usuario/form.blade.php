<h3 style="text-align: center">{{ $modo }} Usuario</h3>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<a href="{{ url('usuario')}}" style="text-align: start"> Regresar</a>  

<div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ isset($usuario -> nombre)? $usuario -> nombre:old('nombre') }}" id="nombre">
</div>

<div class="form-group">
    <label>Cédula</label>
    <input type="text" class="form-control" name="cedula" value="{{ isset($usuario -> cedula)? $usuario -> cedula :old('cedula') }}" id="cedula">
</div>

<div class="form-group">
    <label>Celular</label>
    <input type="text" class="form-control" name="celular" value="{{ isset($usuario -> celular)? $usuario -> celular :old('celular') }}" id="celular">
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" name="email" value="{{ isset($usuario -> email)? $usuario -> email:old('email') }}" id="email">
</div>

<div class="form-group">
    <label>Fecha de nacimiento</label>
    <input class="form-control" type="date" name="date_of_birth" value="{{ isset($usuario -> date_of_birth)? $usuario -> date_of_birth:old('date_of_birth') }}" id="date_of_birth">
</div>

<div class="form-group">
    <label>Contraseña</label>
    <input type="password" class="form-control" name="password" value="{{ isset($usuario -> password)? $usuario -> password :old('password') }}" id="password">
</div>
<div class="form-group">
    <label>Repetir Contraseña</label>
    <input type="password" class="form-control" name="password_confirmation" value="{{ isset($usuario -> password_confirmation)? $usuario -> password_confirmation :old('password_confirmation') }}" id="password_confirmation">
</div>

<input type="submit" value="{{$modo}}" class="btn btn-dark btn-block">
<br/>