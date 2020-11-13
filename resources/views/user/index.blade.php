@extends('layouts.app')

@section('content')
   
<div class="container"> 

    @foreach($users as $user)
        <div class="card col-3">
            <div class="card-header">
                {{ implode(', ', $user -> roles() -> get() -> pluck('name')->toArray()) }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$user -> name}}</h5>
                <p class="card-text">{{$user -> email}}</p>
                <a class="btn btn-warning" href="{{  url('user/'.$user -> id.'/edit')  }}">Edit</a>
                            | 
                <form action="{{ route('user.destroy', $user) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE')}}   

                <button type="submit" class="btn btn-danger" onclick="return confirm('borar??');" >Borrar</button>
                </form>
            </div>
        </div>
    @endforeach
    
</div>
@endsection      