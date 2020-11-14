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
                <div class="row d-flex justify-content-between">
                    <a class="btn btn-warning" style="background: rgb(241,163,19);" href="{{  url('user/'.$user -> id.'/edit')  }}">Modificar</a> 
                                |                     
                    <form action="{{ route('user.destroy', $user) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}   

                        <button type="submit" class="btn btn-danger"  onclick="return confirm('borar??');" >Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    
    
</div>
@endsection      