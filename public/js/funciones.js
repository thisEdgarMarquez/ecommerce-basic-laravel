function confirmacion(msj,url,iditem){
    var respuesta = confirm(msj);
    if(respuesta){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "POST",
            url: url,
            data: {id: iditem},
        }).done(function(response){
            $(`[data-id=${iditem}]`).remove();
            $('#ajaxRespuesta').empty();
            $('#ajaxRespuesta').append(`<div class="alert alert-info text-center">${response.msj}</div>`);
        }).fail(function(err){
            $('#ajaxRespuesta').empty();
            $('#ajaxRespuesta').append(`<div class="alert alert-danger text-center">Lo sentimos, ocurrió un error</div>`);
        });

    }
}
//Funcion para agregar las prendas que contiene una entrada
var ifilaagPrenda = 1;
function agregarPrenda(){
    if($('#idprenda').val() >= 1 && $('#idtalla').val() >= 1 && $('#cantidad').val() >= 1){
        $('#prendasEntrada > tbody:last-child').append(`
            <tr id="fila-${ifilaagPrenda}">
                <td>${$('#idprenda > option:selected').text()}<input type="hidden" name="idprenda[]" value="${$('#idprenda').val()}"></td>
                <td>${$('#idtalla > option:selected').text()}<input type="hidden" name="idtalla[]" value="${$('#idtalla').val()}"></td>
                <td><div class="row"><div class="col-md-10">${$('#cantidad').val()}<input type="hidden" name="cantidad[]" value="${$('#cantidad').val()}"></div><div class="col-md-2"><i class="fas fa-trash" onClick="eliminarEntrada(${ifilaagPrenda})"></i></div></div></td>
            </tr>
        `);
        ifilaagPrenda++;
    }
    return false;
}
//Funcion para eliminar las prendas que contiene una entrada
function eliminarEntrada(id){
    $(`#fila-${id}`).remove();
}
//Funcion para agregar las tallas que contiene una prenda.
var ifilaagTalla
function agregarTalla(){
    if($('#idtalla').val() >= 1){
        $('#tallasEntrada > tbody:last-child').append(`
            <tr id="fila-${ifilaagTalla}">
                <td>
                    <div class="row">
                        <div class="col-md-10">${$('#idtalla > option:selected').text()}<input type="hidden" name="idtalla[]" value="${$('#idtalla').val()}"></div>
                        <div class="col-md-2"><i class="fas fa-trash" onClick="eliminarEntrada(${ifilaagTalla})"></i></div>
                    </div>
                </td>
            </tr>
        `);
        ifilaagTalla++;
    }
    return false;
}
//Funcion para eliminar las talals que contiene una prenda.
function eliminarPrenda(id){
    $(`#fila-${id}`).remove();
}

//Función para actualizar el Select de Tallas al cambiar el Select de Prendas
function actualizarTallaPrenda (prendaElement,tallaSelect, url){
   $.get(url,{idprenda:$(prendaElement).val()},function(data){
       $(tallaSelect).html('');
       data.tallas.forEach(talla => {
           $(tallaSelect).append('<option value="'+talla.id+'">'+talla.medida+'</option>');
       });
   });
}