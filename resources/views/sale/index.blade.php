@extends('layouts.app')

@section('content')
<div class="container"> 
    
    <div id="ventas" class="ventas w-100">
        <div class="row" >
            <div class="col-11 col-lg-8 my-lg-5 ml-lg-5 ml-3 mb-5" id="conteiner-ventas">
                <div class="card rounded-0">
                    <div class="card-header bg-grey">
                        <h6 class="font-weight-bold mb-0">Registrar Venta Realizada</h6>
                    </div>
                    <div class="card-body">
                        <!-- <form action="{{url('/sale')}}" method="post" enctype="multipart/form-data"> -->
                        <form action="">
                        {{ csrf_field() }}

                            @include('sale.form', ['FORM' => 'createSale'])
                                
                        </form>
                    </div>
                </div>
            </div>
        </div>                        
    </div>

    
</div>
@endsection      