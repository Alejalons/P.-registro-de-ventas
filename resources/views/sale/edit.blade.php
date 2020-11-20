@extends('layouts.app')

@section('content')
 
    
    <div id="ventas" class="ventas w-100">
        <div class="row ml-3 mb-5" >
        <!-- my-lg-5 ml-lg-5 mb-5 -->
            <div class="col-11 col-lg-8 " id="conteiner-ventas">
                <div class="card rounded-0">
                    <div class="card-header bg-grey">
                        <h6 class="font-weight-bold mb-0">Modificar Venta Realizada</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sale.update', $venta) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}} 

                            @include('sale.form', ['FORM' => 'editSale'])
                                
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-11 col-lg-4 mb-5" id="conteiner-ventas">
                <div class="card rounded-0">
                    <div class="card-header bg-grey">
                        <h6 class="font-weight-bold mb-0">Productos Antiguos</h6>
                    </div>
                    <div class="card-body">
                        @for($i=0; $i < count($venta -> productoNombre); $i++)
                            <p>{{$venta -> productoNombre[$i]}}</p>
                        @endfor

                    </div>
                </div>
            </div>
        </div>

        @if(session('error'))      
            <div class="alert alert-danger  alert-dismissible fade show mb-5 mx-5" id="MessageAlert" role="alert">
                <strong>{{session('error')}}</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>    
         @endif                        
    </div>

    

@endsection      