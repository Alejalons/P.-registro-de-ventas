@extends('layouts.app')

@section('content')

<div class="col-12 d-flex justify-content-start">
    <a href="{{ url('user/') }}"  class="btn btn-primary">Usuarios</a>
</div>   
<div class="container">   
    <div id="registro" class="registro w-100">
        <div class="row  justify-content-between" >
            <div class="col-11 col-md-6  my-lg-5 ml-lg-5 ml-3 mb-5">
                <div class="card rounded-0">
                    <div class="card-header bg-grey">
                        <h6 class="font-weight-bold mb-0">Registrar de Usuarios</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('user') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            
                            @include('user.form', ['FORM' => 'create'])
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>            
    </div>
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-5 mx-5" id="MessageAlert" role="alert">
            <strong>{{ session('error') }}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endif

</div>
@endsection       