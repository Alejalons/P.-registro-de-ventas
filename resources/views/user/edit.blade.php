Editar Usuarios
<form action="" method="post" enctype="multipart/form-data">
   
    

    <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}">
    <input id="email" type="email" class="form-control " name="email" value="" >
    <input id="password" type="password" class="form-control"  name="password" >
    <input id="password-confirm" type="password" class="form-control " name="password_confirmation" >

    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="role" id="option1" value="1" autocomplete="off" checked> Administrador
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="role" id="option2" value="2" autocomplete="off"> Ventas
        </label>
    </div>
    <input type="submit" value="Crear">

</form>