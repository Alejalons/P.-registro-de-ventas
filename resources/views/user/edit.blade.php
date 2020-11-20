@extends('layouts.app')

@section('content')

<div class="col-12 d-flex justify-content-start">
    <a href="{{ url('user/') }}" class="btn btn-success">Usuarios</a>
</div>   
<div id="content" class="container">   
    <div id="registro" class="registro w-100">
        <div class="row  justify-content-between" >
            <div class="col-11 col-md-6  my-lg-5 ml-lg-5 ml-3 mb-5">
                <div class="card rounded-0">
                    <div class="card-header bg-grey">
                        <h6 class="font-weight-bold mb-0">Modificación de Usuarios</h6>
                    </div>
                    <div class="card-body">
                    {{$user}}
                            <form action="{{ route('user.update', $user) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PATCH')}}                                  

                                @include('user.form', ['FORM' => 'edit'])

                                    <!-- @foreach($role as $rol)

                                        <label class="btn btn-secondary">
                                            <input type="radio" name="role" id="option1" value="{{$rol -> id}}" @if ( $rol -> description == $nameRole )  checked  @endif />{{$rol -> description}}
                                        </label> 
                                        
                                    @endforeach -->
                            </form>
                    </div>
                </div>
            </div>
        </div>            
    </div>

</div>
@endsection   