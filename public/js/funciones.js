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
function eliminarPrendaEntrada(id){
    $('form').append(`
    <input type="hidden" name="idprendaeliminar[]" value="${id}" />
    `);
}
//Funcion para agregar las prendas que contiene una entrada
var ifilaagPrenda = 1;
function agregarPrenda(){
    if($('#idprenda').val() >= 1 && $('#idtalla').val() >= 1 && $('#cantidad').val() >= 1){
        $('#prendasEntrada > tbody:last-child').append(`
            <tr id="fila-${ifilaagPrenda}">
                <td>${$('#idprenda > option:selected').text()}<input type="hidden" name="idprenda[]" value="${$('#idprenda').val()}"></td>
                <td>${$('#idtalla > option:selected').text()}<input type="hidden" name="idtalla[]" value="${$('#idtalla').val()}"></td>
                <td>${$('#idcolor > option:selected').text()}<input type="hidden" name="idcolor[]" value="${$('#idcolor').val()}"></td>
                <td>${$('#cantidad').val()}<input type="hidden" name="cantidad[]" value="${$('#cantidad').val()}"></td>
                <td class="text-center">
                    <button class="btn btn-danger" onClick="eliminarEntrada(${ifilaagPrenda})"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `);
        ifilaagPrenda++;
    }
    return false;
}

//Eliminar Entrada al Editar 
$('.tr-editar-entrada').each(function(){
    var tr = $(this);
    tr.find('.btn-rm-entrada').on('click', function(){tr.remove()});
})

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

//Manejo de la Galería de Detalles de Producto
$(document).ready(function(){
    'use strict';
    var gallery = $('#js-gallery');
    //=== Gallery Object ===//
    var Gallery = {
        zoom: function(imgContainer, img) {
          var containerHeight = imgContainer.outerHeight(),
          src = img.attr('src');
          
          if ( src.indexOf('/products/normal/') != -1 ) {
            // Set height of container
            imgContainer.css( "height", containerHeight );
            
            // Switch hero image src with large version
            img.attr('src', src.replace('/products/normal/', '/products/zoom/') );
            
            // Add zoomed class to gallery container
            gallery.addClass('is-zoomed');
            
            // Enable image to be draggable
            img.draggable({
              drag: function( event, ui ) {
                ui.position.left = Math.min( 100, ui.position.left );
                ui.position.top = Math.min( 100, ui.position.top );
              }
            });
          } else {
            // Ensure height of container fits image
            imgContainer.css( "height", "auto" );
            
            // Switch hero image src with normal version
            img.attr('src', src.replace('/products/zoom/', '/products/normal/') );
            
            // Remove zoomed class to gallery container
            gallery.removeClass('is-zoomed');
          }
        },
        switch: function(trigger, imgContainer) {
          var src = trigger.attr('href'),
          thumbs = trigger.siblings(),
          img = trigger.parent().prev().children();
          
          // Add active class to thumb
          trigger.addClass('is-active');
          
          // Remove active class from thumbs
          thumbs.each(function() {
            if( $(this).hasClass('is-active') ) {
              $(this).removeClass('is-active');
            }
          });
      
          // Reset container if in zoom state
          if ( gallery.hasClass('is-zoomed') ) {
            gallery.removeClass('is-zoomed');
            imgContainer.css( "height", "auto" );
          }
      
          // Switch image source
          img.attr('src', src);
        }
      };

    // Listen for clicks on anchors within gallery
    gallery.delegate('a', 'click', function(event) {
        var trigger = $(this);
        var triggerData = trigger.data("gallery");
    
        if ( triggerData === 'zoom') {
          var imgContainer = trigger.parent(),
          img = trigger.siblings();
          Gallery.zoom(imgContainer, img);
        } else if ( triggerData === 'thumb') {
          var imgContainer = trigger.parent().siblings();
          Gallery.switch(trigger, imgContainer);
        } else {
          return;
        }
    
        event.preventDefault();
      });
});


//Validación de la cantidad de Prenda en Detalles para que no se compre más
//de la cantidad disponible en el inventario

$('#form-detalles-prenda').on('submit', function(e){
    
    var isValid = false;

    /* $('.row-talla-color').each(function(i){
        
        if($(this).find('.col-talla .checkbox').prop('checked')){

            var checkColors = $(this).find('.col-color .check-color');
            var cantCheckColors = checkColors.length;
            var cantCheckColorsFalse = 0;

            checkColors.each(function(i){

                if($(this).find('input[type="checkbox"]').prop('checked') == false){
                    ++cantCheckColorsFalse;
                }
            });

            if(cantCheckColorsFalse == cantCheckColors) isValid = false;

        }
    }); */
    var radioTalla = $(this).find("input[name='talla']:checked");
    var talla = radioTalla.val();
    var tallaMaxCant = radioTalla.data("maxcant");
    var cant = $(this).find("input[name='cantidad']").val();

    if(cant < 1) {
        alert('Lo sentimos, debes llevar al menos una unidad de este producto para continuar');
        return false;
    }else if(isNaN(cant)){
        alert('Error: La cantidad debe ser numérica');
        return false;
    }

    isValid = (cant > tallaMaxCant)? false: true;

    if(!isValid) {
        alert('Lo sentimos, solo nos quedan ' + tallaMaxCant + ' unidades de este producto');
        return false;
    }
})