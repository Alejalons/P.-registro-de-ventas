@extends('layouts.app')

@section('css')
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet" />    
@endsection

@section('content')

<div class="container">

   

    <div class="row justify-content-center mb-5 col-12 col-sm-12 col-md-11 col-lg-12">
            <div class="card ">
                <div class="card-header">{{ __('Ventas Realizadas') }}</div>
                <div class="card-body">
                    <table class="table table-striped responsive display nowrap"  id="listProducts" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre Cliente</th>
                                <th>Rut</th>
                                <th>Dirección</th>
                                <th>Contactos</th>
                                <th>Productos</th>
                                <th>Estado</th>
                                <th>Metodo de Pago</th>
                                <th>Valores</th>
                                <th>Vendedor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventas as $venta)                    
                                <tr>
                                    <td>{{$venta -> nameClient}}</td>
                                    <td>{{$venta -> rut}}</td>
                                    <td>{{$venta -> address}}</td>
                                    <td>{{$venta -> contact}} <br> 
                                        @if($venta -> contactSecond) 
                                            {{$venta -> contactSecond}}<br> 
                                        @endif                                     
                                        {{$venta -> mail}}
                                    </td>                             
                                    <td>
                                        @foreach ($venta -> productoNombre as $item => $value)
                                                <li>{{$item}} x {{$value}} </li>
                                        @endforeach
                                    </td>                             
                                    <td>{{$venta -> status}}</td>                             
                                     
                                    <td>{{$venta -> paymentMethod}}</td>                             

                                    <td>
                                    <br>Subtotal: {{number_format($venta -> price)}};<br> Despacho: {{number_format($venta -> dispatchPrice)}} <br> 
                                    <?php 
                                        $total = number_format($venta -> price + $venta -> dispatchPrice);
                                    ?> 
                                        Total: {{$total}}
                                    </td>  
                                    <td>{{$venta -> user -> name}}</td>    

                                    <td>
                                        <div class="row ">
                                            <div class="d-flex justify-content-start">
                                                <div>
                                                    <a class="btn btn-warning fas fa-edit" style="background: rgb(241,163,19); width: 40px" href="{{  url('sale/'.$venta -> id.'/edit')  }}"></a> 
                                                </div>
                                                <div>
                                                    <form action="{{ route('sale.destroy', $venta -> id) }}" method="post">{{ csrf_field() }}{{ method_field('DELETE')}}<button type="submit" class="btn btn-danger fas fa-trash-alt"  onclick="return confirm('¿Eliminar Venta?');" ></button></form>
                                                </div>
                                            </div>                                    
                                        </div>
                                    </td>                          

                                </tr>
                            @endforeach
                        </tbody>                    
                    </table>    
                </div>    
            </div>
    </div>
    @if(Session::has('MensajeUpdate'))
        <div class="alert alert-success alert-dismissible fade show mb-5 mx-5" id="MessageAlert" role="alert">
            <strong>{{Session::get('MensajeUpdate')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endif
    @if(Session::has('MensajeCreacion'))
        <div class="alert alert-success alert-dismissible fade show mb-5 mx-5" id="MessageAlert" role="alert">
            <strong>{{Session::get('MensajeCreacion')}}</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endif
    @if(Session::has('MsjSaleDelete'))
        <div class="alert alert-success alert-dismissible fade show mb-5 mx-5" id="MessageAlert" role="alert">
            <strong>{{Session::get('MsjSaleDelete')}}</strong> 
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

@section('scripts')
    
    
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
    
    <script> 
        $('#listProducts').DataTable({
            "responsive": true,
            autoWith: false,
            "language": {
                "lengthMenu": "Mostrar "+
                             `<select>
                                <option value = '10'>10</option>
                                <option value = '25'>25</option>
                                <option value = '50'>50</option>
                                <option value = '100'>100</option>
                                <option value = '-1'>All</option>
                             <select>` +
                             " Registros por página",                             
                "zeroRecords": "Nada encontrado - lo siento",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(Filtro de un total de _MAX_ registros)",
                'search': 'Buscar:',
                'paginate': {
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                }
            }
        });
    </script>
@endsection


