
            
        <div class="row form-group">
            <div class="col-12 col-md-6 mb-3">
                <label for="name">Nombre del Usuario:</label>
                <input type="text" class="form-control {{ $errors -> has('name') ? 'is-invalid' : '' }} " placeholder="Nombre del Usuario" name="name" id="name" value="{{ isset($user -> name) ?  $user -> name : old('name') }}">
                {!! $errors -> first('name', 
                '<div class="invalid-feedback">
                    :message
                </div>')!!}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="email">Correo:</label>
                <input type="email" class="form-control {{ $errors -> has('email') ? 'is-invalid' : '' }}" placeholder="Correo Electrónico" name="email" id="email" value="{{ isset($user -> email) ?  $user -> email : old('name') }}" >
                {!! $errors -> first('email', 
                '<div class="invalid-feedback">
                    :message
                </div>')!!}
            </div>
        </div>

        <div class="row form-group">
            <div class="col-12 col-md-6 mb-3">
                <label for="password">{{$FORM == 'edit' ? 'Nueva Contraseña' : 'Contraseña'}} </label>
                <input type="password" class="form-control {{ $errors -> has('password') ? 'is-invalid' : '' }}" placeholder="Contraseña " name="password" id="password">
                {!! $errors -> first('password', 
                '<div class="invalid-feedback">
                    :message
                </div>')!!}
            </div>
            <div class="col-12 col-md-6 mb-3">
                <label for="password_confirmation">Repita la Contraseña:</label>
                <input type="password" class="form-control {{ $errors -> has('password') ? 'is-invalid' : '' }}" placeholder="Repita la Contraseña" name="password_confirmation" id="password_confirmation">
                
            </div>
        </div>
        
        
        <div class="row form-group">
            <div class="col-12 col-md-6 mb-3">
                <label for="cargo">Cargo Del Usuario: </label>

                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                    @foreach($role as $rol)
                    
                        <label class="btn btn-info">
                            <input type="radio" name="role" id="option1" value="{{$rol -> id}}"  if(
                                @if($FORM == 'edit')
                                    @if ( $rol -> description == $nameRole )
                                      checked
                                    @endif
                                @else
                                    @if ($loop->last) 
                                        checked 
                                    @endif
                                @endif />{{$rol -> description}}
                        </label> 
                        
                    @endforeach
                </div>
            </div>
        </div>     
        <input class="btn btn-primary w-100" type="submit" value="{{$FORM == 'edit' ? 'Modificar' : 'Guardar'}}"/>

                 
