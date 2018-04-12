function confirmacion(msj,url,iditem){
    var respuesta = confirm(msj);
    if(respuesta){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: "POST",
            url: 'as',
            data: {id: iditem},
        }).done(function(response){
            $(`[data-id=${iditem}]`).remove();
            $('#ajaxRespuesta').append(`<div class="alert alert-info text-center">${response.msj}</div>`);
        }).fail(function(err){
            $('#ajaxRespuesta').append(`<div class="alert alert-danger text-center">Lo sentimos, ocurrio un error</div>`);
        });

    }
}