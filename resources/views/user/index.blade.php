@extends('layouts.app')

@section('content')
<div class="col-12 d-flex justify-content-end">
    <a href="{{ url('user/create') }}" class="btn btn-primary ">Agregar Nuevo Usuario</a>
</div>
<div class="container row ml-5"> 
    
    
    @foreach($users as $user)

        <div class="card bg-light  col-3 mx-2" >
            <div class="card-header">{{$user -> name}}</div>
            <div class="card-body">
                <h5 class="card-title">Cargo:  {{ implode(', ', $user -> roles() -> get() -> pluck('name')->toArray()) }}</h5>
                <p class="card-text">{{$user -> email}}</p>
                <div class="row ">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a class="btn btn-warning fas fa-edit" style="background: rgb(241,163,19);  width: 40px;" href="{{  url('user/'.$user -> id.'/edit')  }}"></a> 
                        </div>
                        <div>   
                            <form action="{{ route('user.destroy', $user) }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}   

                                <button type="submit" class="btn btn-danger fas fa-trash-alt"  style="" onclick="return confirm('¿Eliminar Usuario?');" ></button>
                            </form>                
                        </div> 
                    </div>                                                                   
                    
                </div>
            </div>
        </div>
    @endforeach

    @if(Session::has('MsjUserCreate'))
        <div class="alert alert-success alert-dismissible fade show mb-5 mx-5" id="MessageAlert" role="alert">
            <strong>{{Session::get('MsjUserCreate')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endif
    @if(Session::has('MsjUserUpdate'))
        <div class="alert alert-success alert-dismissible fade show mb-5 mx-5" id="MessageAlert" role="alert">
            <strong>{{Session::get('MsjUserUpdate')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endif
    @if(Session::has('MsjUserDelete'))
        <div class="alert alert-success alert-dismissible fade show mb-5 mx-5" id="MessageAlert" role="alert">
            <strong>{{Session::get('MsjUserDelete')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endif    
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