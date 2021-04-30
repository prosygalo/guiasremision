function RefrescaProducto(){
            var ip = [];
            var i = 0;
            $('.contadorfilas').each(function(index, element){
                i++;
                ip.push({
                    id_pro: $(this).val()
                });
            });
            // Si la lista de Productos no es vacia Habilito el Boton Guardar
            if (i != ''){
                $('#submit').removeAttr('disabled', 'disabled');
             }else{
                $('#submit').attr('disabled', 'disabled');  
             }
}
 function agregarProducto(){

                var text = $('#pro_id').find(':selected').text(); 
                var Cod_Producto = $('#pro_id').find(':selected').val(); 
                var newtr ='<tr class="item">';
                newtr= newtr+'<td class="contadorfilas"><td><?= $this->formElement($Cod_Producto)->get($Cod_Producto)->setValueOption('+Cod_Producto+');?></td><td><?= $this->formElement($Cantidad);?></td>';
                //newtr= newtr+'<td class="contadorfilas"><input type="text" class="form-control" readonly="readonly" name="Cod_Producto[]" value="'+Cod_Producto+'"></td><td><input type="text" class="form-control" readonly="readonly"  value="'+text+'"></td><td><input type="text" class="form-control" name="Cantidad[]" value="1" onkeypress="return int(event)" ></td>';
                 newtr= newtr+'<td><button type="button" class="btn btn-danger btn-xs remove-item" ><i class="fa fa-times"></i></button></td></tr>';

                $('#ProSelected').append(newtr);

                 RefrescaProducto(); //Refresco Productos
              

                $('.remove-item').off().click(function(e){
                $(this).parent('td').parent('tr').remove(); //En accion elimino el Producto de la Tabla
                if ($('#ProSelected tr').length == 0)
                    $('#ProSelected .no-item').slideDown(300);

                 RefrescaProducto();         
             
                 }); 

        }

function int(e){
           tecla = (document.all) ? e.keyCode : e.which;
           if (tecla==8){
            return true;
             }
          patron =/^[0-9]+$/;
          tecla_final = String.fromCharCode(tecla);
          return patron.test(tecla_final);
          }
