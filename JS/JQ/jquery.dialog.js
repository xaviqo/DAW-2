jQuery.fn.initDialog = function (config) {
    //variable global porque esta en este tipo de función
    //datos por defecto
     dialogConfig = {
        'height': '50vh',
        'width': '50vw',
        'background': 'rgba(0,0,0,0.2)',
        'scroll': false,
    };
    //el segundo parametro machaca las variables iguales del primero (dialogConfig)
    //es decir, la conf del usuario machaca a la por defecto
    jQuery.extend(dialogConfig, config);
}

//otra manera seria pasar config directamente a cada función

jQuery.fn.createDialog = function () {
    //creamos el div gris, lo ponemos al final del body y le añadimos el formulario
    let wrapper = $('<div class="dialogWrapper"></div>');
    $('body').append(wrapper);
    wrapper.append(this);
    this.css({
        'height': dialogConfig.height,
        'width': dialogConfig.width,
        //si no ponemos esto, el max-height y max-with del css afectaban y no cambiaba si superaba ese tamaño cuando se lo pasamos aquí
        'max-height': dialogConfig.height,
        'max-width': dialogConfig.width,
    })
    //añadimos un background-color con el contenido de la configuración
    wrapper.css('background-color', dialogConfig.background);
}       

jQuery.fn.showDialog = function () {
    this.parent().addClass('dialogShow');
    //si es falso se aplica, sino, no
    if(!dialogConfig.scroll){
        $('body').addClass('hideScroll');
    }
}

jQuery.fn.hideDialog = function () {
    this.parent().removeClass('dialogShow');
    $('body').removeClass('hideScroll');
}

/* 
jQuery.fn.createDialog = function () {
    var dialog = this;
    dialog.hide();
    dialog.dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            "Aceptar": function () {
                $(this).dialog("close");
            },
            "Cancelar": function () {
                $(this).dialog("close");
            }
        }
    });
    return dialog;
}
*/