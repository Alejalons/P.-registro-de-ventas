@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    

    <style>
    .select2 {
        width:100%!important;
    }

    .divProduct
    {
        margin-left: -15px;
    }
    </style>
@endsection    


    <div class="form-group">
        <label for="cliente">Nombre del Cliente:</label>
        <input type="text" class="form-control {{ $errors -> has('cliente') ? 'is-invalid' : '' }}" placeholder="Nombre del Cliente" name="cliente" id="cliente" value="{{ isset($venta -> nameClient) ?  $venta -> nameClient : old('cliente') }}" required>
        {!! $errors -> first('cliente', 
        '<div class="invalid-feedback">
            :message
        </div>')!!}
    </div>
    <div class="row form-group">
        <div class="col-12 col-md-6 mb-3">
            <label for="rut">Rut del Cliente:</label>
            <input type="text" class="form-control {{ $errors -> has('rut') ? 'is-invalid' : '' }}" placeholder="Rut del Cliente" name="rut" id="rut"  value="{{ isset($venta -> rut) ?  $venta -> rut : old('rut') }}" required>
            {!! $errors -> first('rut', 
                '<div class="invalid-feedback">
                    :message
                </div>')!!}
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="direccion">Direccion: </label>
            <input type="text" class="form-control {{ $errors -> has('direccion') ? 'is-invalid' : '' }}" placeholder="Dirección del Cliente" name="direccion" id="direccion" value="{{ isset($venta -> address) ?  $venta -> address : old('direccion') }}" required>
            {!! $errors -> first('direccion', 
            '<div class="invalid-feedback">
                :message
            </div>')!!} 
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-12 col-md-6 mb-3">
            <label for="contacto">N° Contacto: </label>
            <input type="text" class="form-control {{ $errors -> has('contact') ? 'is-invalid' : '' }}" placeholder="Número Contacto" name="contacto" id="contacto" value="{{ isset($venta -> contact) ?  $venta -> contact : old('contacto') }}" required>
            {!! $errors -> first('contacto', 
            '<div class="invalid-feedback">
                :message
            </div>')!!} 
            <input type="text" class="form-control {{ $errors -> has('contact2') ? 'is-invalid' : '' }}" placeholder="Número Contacto Secundario (opcional)" name="contact2" id="contact2" value="{{ isset($venta -> contactSecond) ?  $venta -> contactSecond : old('contact2') }}" >
            {!! $errors -> first('contact2', 
            '<div class="invalid-feedback">
                :message
            </div>')!!} 
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="mail">Correo:</label>
            <input type="email" class="form-control {{ $errors -> has('email') ? 'is-invalid' : '' }}" placeholder="Correo Electrónico" name="mail" id="mail" value="{{ isset($venta -> mail) ?  $venta -> mail : old('mail') }}">
            {!! $errors -> first('mail', 
            '<div class="invalid-feedback">
                :message
            </div>')!!}    
        </div>
    </div>

    
    <div class="form-group">
        <div class="divProduct col-12 col-md-10 col-lg-12 mb-3"> 
            <label for="producto">Producto:</label>
            {!! $errors -> first('producto', 
                '<div class="invalid-feedback">
                    :message
                </div>')!!} 
            <select name="producto[]" id="producto" class="form-control livesearch {{ $errors -> has('producto') ? 'is-invalid' : '' }}" onchange="onChange()" multiple="true" required></select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-8 col-sm-12 col-md-6 mb-3">
            <label for="tipo-pago">Metodo Pago:</label>
            <select name="tipo-pago" id="tipo-pago" class="form-control">
                <option value="Debito"
                    @if(isset($venta -> paymentMethod) && $venta -> paymentMethod == "Debito" )
                        selected
                    @endif
                >Débito</option>
                <option value="Credito"
                    @if(isset($venta -> paymentMethod) && $venta -> paymentMethod == "Credito" )
                        selected
                    @endif
                >Crédito</option>
                <option value="Efectivo" 
                    @if(isset($venta -> paymentMethod) && $venta -> paymentMethod == "Efectivo" )
                        selected
                    @endif
                >Efectivo</option>
            </select>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="price">Precio:</label>
            <input type="text" class="form-control {{ $errors -> has('price') ? 'is-invalid' : '' }}" placeholder="Valor Producto" name="price" id="price" value="{{ isset($venta -> price) ?  number_format($venta -> price) : old('price') }}" required>
            {!! $errors -> first('price', 
            '<div class="invalid-feedback">
                :message
            </div>')!!} 
        </div>
    </div>
    <div class="row form-group">
        <div class="col-12 col-md-6 mb-3">
            <label for="dispatchPrice">Precio Despacho:</label>
            <input type="text" class="form-control {{ $errors -> has('dispatchPrice') ? 'is-invalid' : '' }}" placeholder="Valor del Despacho Producto" name="dispatchPrice" id="dispatchPrice" value="{{ isset($venta -> dispatchPrice) ?  number_format($venta -> dispatchPrice) : old('dispatchPrice') }}" required>
            {!! $errors -> first('dispatchPrice', 
            '<div class="invalid-feedback">
                :message
            </div>')!!}
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="estado">Estado del Producto: </label>

            <div class="btn-group btn-group-toggle flex-wrap" data-toggle="buttons">
                <label class="btn btn-info active border border-light">
                    <input type="radio" name="status" id="optionPagado" 
                        @if($FORM == "editSale")
                            @if($venta -> status == "Pagado")
                                checked
                            @endif
                        @else
                             checked
                        @endif
                    value="Pagado"> Pagado
                </label>
                <label class="btn btn-info border border-light">
                    <input type="radio" name="status" id="optionEnviado" 
                        @if($FORM == "editSale")
                            @if($venta -> status == "Enviado")
                                checked
                            @endif
                        @endif                    
                    value="Enviado"> Enviado
                </label>
                <label class="btn btn-info border border-light">
                    <input type="radio" name="status" id="optionDespachado" 
                        @if($FORM == "editSale")
                            @if($venta -> status == "Despachado")
                                checked
                            @endif
                        @endif                        
                    value="Despachado"> Despachado
                </label>
                <label class="btn btn-info border border-light">
                    <input type="radio" name="status" id="optionDespachado" 
                        @if($FORM == "editSale")
                            @if($venta -> status == "Entregado")
                                checked
                            @endif
                        @endif  
                    value="Entregado"> Entregado
                </label>
            </div>
        </div>
    </div>                        

    <br>
    <input class="btn  w-100" type="submit" style="background: rgb(241,163,19);" value="{{$FORM == 'edit' ? 'Modificar' : 'Guardar'}}"/>

    


    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/es.js') }}"></script>
    <script src="{{ asset('js/validacionRut.min.js') }}"></script>

    <script type="text/javascript">   
            //validacion de rut
            $('#rut').rut();
    
            // inicializamos el plugin
            $('.livesearch').select2({
                // Activamos la opcion "Tags" del plugin
                tags: true,
                placeholder: "Ingrese Producto a Buscar",
                tokenSeparators: [','],
                language: "es",
                ajax: {
                    url: '/search_ajax',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.text,
                                    $precio: item.price,
                                    id: item.id                                    
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            var valuePrice = 0;                 

            function onChange() {



                //obtengo los tags li que se encuentran disponible
                var titleLi = [];
                $("#select2-producto-container li").each(function(){
                    titleLi.push($(this).attr('title'));
                });

              
                var id_price = [];
                
                //
                for (let x = 0; x < titleLi.length; x++) 
                {                    
                    var id_prod =  document.getElementById('producto').options;    

                      //obtiene los option ingresados -> captura su id para almacenar en un
                      //                                 array y asi poder consultar el precio por cada id
                    for (let i = 0; i < id_prod.length; i++) 
                    {
                        if(titleLi[x] == id_prod[i].text)
                        {
                            id_price.push(id_prod[i].value);
                        }
                    }
                }   

                if(id_price.length > 0){
                    //consulta en price_ajax donde se calcula total precio segun id enviado
                    $.ajax({
                        url: '/price_ajax',
                        method: 'get',
                        data: {
                            id: id_price
                        }

                    }).done(function(res){

                        console.log(res);                   

                        var price = formatNumber(res);
                        $("#price").val(price);                    
                    });
                }
                

            }


            //setea los numeros por numeros en miles
            function formatNumber (n) 
            {
                n = String(n).replace(/\D/g, "");
                return n === '' ? n : Number(n).toLocaleString();
            }            

            const number = document.querySelector('#price');
            number.addEventListener('keyup', (e) => {
                const element = e.target;
                const value = element.value;
                element.value = formatNumber(value);
            });

            const valorDespacho = document.querySelector('#dispatchPrice');
            valorDespacho.addEventListener('keyup', (e) => {
                const element = e.target;
                const value = element.value;
                element.value = formatNumber(value);
            });


         
    </script>
@endsection
  