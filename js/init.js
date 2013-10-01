var cliente = cliente || {};

cliente.modo = "";
cliente.url = "";
cliente.puerto = "";
cliente.nota = "";
cliente.xmlstr = "";
cliente.xml = "";
cliente.tmp = "";
cliente.urlServer = "";
cliente.portServer = "";
cliente.modelo = "";

cliente.mensaje = function(msj){
    if(null !== msj){
        $("#mensaje").append(msj);
    }
};

var AbsolutePath = function () {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
};

//envio el xml por curl
cliente.curl = function(){
    var url = AbsolutePath()+"?a=cp";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            url: cliente.urlServer,
            xmlstr : cliente.xmlstr
        }
    }).done(function(msg) {
            cliente.mensaje(" listo!<br />");
            cliente.mensaje(msg);
        }).fail(function(jqXHR, textStatus) {
            cliente.mensaje(textStatus);
        });
};




// Obtengo el modelo xml
cliente.cargarModeloXML = function(){
    var data = $('#datos').serialize();
    var url = AbsolutePath()+"?a=xml";
    $.ajax({
        type: "GET",
        url: url,
        dataType: "xml",
        data: {modelo:cliente.modelo},
        success: function(xml) {
            cliente.xml = xml;
            cliente.urlServer = $(cliente.xml).find("datos").attr("url");
            cliente.portServer = $(cliente.xml).find("datos").attr("puerto");
            $('#datos').html(""); // borro el contenido del formulario
            cliente.crearcampos();

        }
    });
};

cliente.crearcampos = function(){
    $(cliente.xml).find("dato").children().each(
        function (i,e){
            var llave = e.localName;
            var valor = e.innerHTML;
            $('#datos').append('<label for="'+llave+'">'+llave+'</label><input type="text" id="'+llave+'" name="'+llave+'" value="'+valor+'"/><br/>');
        }
    );
    $('#datos').append('<input type="button" value="Enviar consulta" id="enviar" />');
    $("#enviar").click(function(){cliente.mensaje("Creando XML... ");cliente.genXML();});
};

// creo un select con los modelos disponibles
cliente.crearListaModelos = function(){
    var url = AbsolutePath()+"?a=lm";
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function(lista) {
            $('#modelos').html(""); // borro el contenido del formulario
            $('#modelos').append('<label for="modelo">Selecciona el modelo</label><select id="modelo"></select><br/>');
            $('<option>', {text:"Seleccione",value: "0"}).appendTo("#modelo");
            $.each(lista, function(i, elemento) {
                $('<option>', {text:elemento,value: elemento}).appendTo("#modelo");
            });
            $('#modelo').on('change', function (e) {
                cliente.modelo = this.value;
                if(cliente.modelo !=0){
                    cliente.cargarModeloXML();
                    $("#mensaje").html("");
                }

            });



        }
    });
};

// Genero el xml a partir de los datos llenados
cliente.genXML = function(){
    var data = $('#datos').serialize();
    var url = AbsolutePath()+"?a=p2x";
    $.post(url, data)
        .done(function(msg) {
            cliente.mensaje(" listo!<br />");
            cliente.xmlstr = msg;
            cliente.mensaje("Iniciando transmisión CURL... ");
            cliente.curl();
        })
        .fail(function(jqXHR, textStatus) {cliente.mensaje(textStatus); });
};

$(function() {
    cliente.crearListaModelos();
    cliente.cargarModeloXML();                           // cargo el modelo xml y genero los campos de formulario
});

