    <div class="form-group">
        <label for="nombre">Nombre del Cliente:</label>
        <input type="text" class="form-control" placeholder="Nombre del Cliente" name="nombre" id="nombre">
    </div>
    <div class="row form-group">
        <div class="col-12 col-md-6 mb-3">
            <label for="rut">Rut del Cliente:</label>
            <input type="text" class="form-control" placeholder="Rut del Cliente" name="rut" id="rut">
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="direcccion">Direccion: </label>
            <input type="text" class="form-control" placeholder="Dirección del Cliente" name="direcccion" id="direcccion">
        </div>
    </div>
    
    <div class="row form-group">
        <div class="col-12 col-md-6 mb-3">
            <label for="contacto">N° Contacto: </label>
            <input type="text" class="form-control" placeholder="Número Contacto" name="contacto" id="contacto">
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="mail">Correo:</label>
            <input type="mail" class="form-control" placeholder="Correo Electrónico" name="mail" id="mail">
        </div>
    </div>

    
    <div class="col form-group">
        <label for="producto">Producto:</label>
            <select name="producto[]" id="producto" class="form-control livesearch" onchange="onChange()" multiple="true"></select>
    </div>
    <div class="row form-group">
        <div class="col-12 col-md-6 mb-3">
            <label for="tipo-pago">Metodo Pago:</label>
            <select name="tipo-pago" id="tipo-pago" class="form-control">
                <option value="Debito">Débito</option>
                <option value="Credito">Crédito</option>
                <option value="Efectivo">Efectivo</option>
            </select>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="valor">Precio:</label>
            <input type="text" class="form-control" placeholder="Valor Producto" name="valor" id="valor">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-12 col-md-6 mb-3">
            <label for="valorDespacho">Precio Despacho:</label>
            <input type="text" class="form-control" placeholder="Valor del Despacho Producto" name="valorDespacho" id="valorDespacho">
        </div>
        <div class="col-12 col-md-6 mb-3">
            <label for="estado">Estado del Producto: </label>

            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-info active">
                    <input type="radio" name="options" id="optionPagado" checked> Pagado
                </label>
                <label class="btn btn-info">
                    <input type="radio" name="options" id="optionEnviado"> Enviado
                </label>
                <label class="btn btn-info">
                    <input type="radio" name="options" id="optionDespachado"> Despachado
                </label>
            </div>
        </div>
    </div>                        

    <br>
    <button class="btn btn-primary w-100" type="submit">Guardar</button>


    @section('scripts')
    <script type="text/javascript">

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



                //obtengo los 
                var titleLi = [];
                $("#select2-producto-container li").each(function(){
                    titleLi.push($(this).attr('title'));
                });

                //obtiene los option ingresados -> captura su id para almacenar en un
                //                                 array y asi poder consultar el precio por cada id
                var id_price = [];
                
                for (let x = 0; x < titleLi.length; x++) 
                {                    
                    var id_prod =  document.getElementById('producto').options;    

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
                        $("#valor").val(price);                    
                    });
                }
                

            }


            //setea los numeros por numeros en miles
            function formatNumber (n) 
            {
                n = String(n).replace(/\D/g, "");
                return n === '' ? n : Number(n).toLocaleString();
            }            

            const number = document.querySelector('#valor');
            number.addEventListener('keyup', (e) => {
                const element = e.target;
                const value = element.value;
                element.value = formatNumber(value);
            });

         
    </script>
@endsection
  