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
     
     $("#lisProduct table tbody tr").remove();

     //obtengo los tags li que se encuentran disponible
     var titleLi = [];
     $("#select2-producto-container li").each(function(){
         titleLi.push($(this).attr('title'));
     });

   
     var id_price = [];
     var obj = [];
     for (let x = 0; x < titleLi.length; x++) 
     {                    
         var id_prod =  document.getElementById('producto').options;    

           //obtiene los option ingresados -> captura su id para almacenar en un
           //                                 array y asi poder consultar el precio por cada id
           //compara con los existentes y las opciones que se encuentran, 
         for (let i = 0; i < id_prod.length; i++) 
         {
             if(titleLi[x] == id_prod[i].text)
             {
                 // $("#lisProduct table tbody").append("<tr><td>"+id_prod[i].text+"</td><td><input type='number' name='cantProduct[]' style='width:40px;' class='inputCant "+id_prod[i].value+"cant'  onChange='onChangeCant()' title="+id_prod[i].value+" id='cantProduct' value='1'></td></tr>");                            
                 $("#lisProduct table tbody").append("<tr id="+id_prod[i].value+"><td><li class='fas fa-trash-alt'  onclick='deleteInput("+id_prod[i].value+")' style='cursor: pointer;'></li>"+id_prod[i].text+"</td><td><input type='number' style='width:40px;'  name='cantProduct[]' class='inputCant' onChange='onChangeCant()' title="+id_prod[i].value+" id="+id_prod[i].value+"cant value='1'></td></tr>");                            
                 
                 // cantidad = document.getElementsByClassName(id_prod[i].value+'cant').value;
                 cantidad = document.getElementById(id_prod[i].value+'cant').value;
                  objeto ={"Id":id_prod[i].value,"cantidad":cantidad};

                  obj.push(objeto);

                  // id_price.push(id_prod[i].value);
             }
         }
     }               

       sendinsertPrice(obj);
 }

 function onChangeCant(){
     var inputCant = document.getElementsByClassName("inputCant");

     var objinputs = [];
     for (let i = 0; i < inputCant.length; i++) 
     {
         objValue ={"Id":inputCant[i].title,"cantidad":inputCant[i].value};
         objinputs.push(objValue);
     }
     sendinsertPrice(objinputs);

 }

 function deleteInput(id){
     
     $("#producto option[value="+id+"]").remove();
     $("#lisProduct table tbody tr#"+id).remove();

 }

 function sendinsertPrice(obj)
 {
     if(obj.length > 0){
         //consulta en price_ajax donde se calcula total precio segun id enviado
         $.ajax({
             url: '/price_ajax',
             contentType: "application/json",
             type: 'get',
             data: {'array': JSON.stringify(obj)}

         }).done(function(res){

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
