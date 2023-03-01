/**
 * HTML
 **/
 // html modal con dos botones, aceptar onclick -> sentData(), cancelar onclick -> cancelDialog()
//importaremos en el html este escript pero ANTES el jquery.dialog.js
 $(document).ready(function () {

    //datos que pasa el usuario
    $(document).initDialog({
        'height': '500px',
        'width': '500px',
        'background': 'rgba(0,0,0,0.2)',
        'scroll': true,
    });

    $('#dadesUsuariDialog').createDialog();
    });

    function showDialog(){
        $('#dadesUsuariDialog').showDialog();
    }

    function sentData(){
        
        $('#dadesUsuariDialog').hideDialog();
    }

    function cancelDialog(){
        $('#dadesUsuariDialog').hideDialog();
    }