$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});

$(document).ready(function(){
    //group add limit
    var maxGroup = 10;
    
    //add more fields group
    $(".btnAgregar").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".btnQuitar",function(){ 
        $(this).parents(".fieldGroup").remove();
    });
});

$(document).ready(function(){
    $("#eliminar").click(function() {
        
        var mensaje = confirm("¿Esta seguro que desea eliminar el registro?");
        //Detectamos si el usuario acepto el mensaje
        if (mensaje) {
            $("#subir").submit(function (event) {
                var eliminar = $("#doc").val()
                var formData = {
                  id: $("#id").val()
                };

                $.ajax({
                  type: "POST",
                  url: eliminar,
                  data: formData,
                  dataType: "json",
                  encode: true,
                }).done(function (data) {
                    alert(data);
                });
                //alert("Registro eliminado con exito");
                //window.location.href="form_disco.php";
            });

        }             
    });
});

$(document).ready(function(){
    $("#guardar").click(function() {
        
        var mensaje = confirm("¿Esta seguro que desea actualizar el registro?");
        //Detectamos si el usuario acepto el mensaje
        if (mensaje) {
            $("#subir").submit(function (event) {
                var editar = $("#doc").val()
                var formData = {
                  id: $("#id").val(),
                  nombre: $("#nombre").val(),
                  apellido: $("#apellido").val(),
                  pais: $("#pais").val(),
                  anio: $("#anio").val(),
                  nombreArt: $("#nombreArt").val()

                };
                
                $.ajax({
                  type: "POST",
                  url: editars,
                  data: formData,
                  dataType: "json",
                  encode: true,
                }).done(function (data) {
                    alert(data);
                });
                //alert("Registro eliminado con exito");
                //window.location.href="form_disco.php";
            });

        }             
    });
});


