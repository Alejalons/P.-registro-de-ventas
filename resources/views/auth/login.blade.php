
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name= "viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" >
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    

    <div class="row" id="panel">
        <div class="col-12 d-flex justify-content-center align-items-center formulario">
            <div class="ingreso-login ">
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                        <div class="contact-form row d-flex justify-content-center">
                        <div class="form-field col-10  col-lg-7 my-3">
                            <label for="email" class="label">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-field col-10  col-lg-7 my-3 mt-5">
                            <label for="password" class="label">{{ __('Contraseña') }}</label>

                            <input  id="password"  class="input-text form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class=" form-field form-group  col-10  col-lg-7 mt-2">
                            <div class="form-field col-lg-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember" style="color: antiquewhite;">
                                        Recuerdame
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 d-flex  justify-content-center ">
                            <div class="form-field  ">
                                <button type="submit" class="btn btn-primary submit-btn">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                        </div>    
                    
                  </form>
            </div>

    </div>


</body>
</html>
