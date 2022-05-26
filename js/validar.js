$(document).ready(function(){
	$("#formInicio").validate({
		rules: {
			usuario: {
				required: true
			},
			contrasena: {
				required: true
			}
		},
		messages: {
			usuario: {
				required: "Favor de introduzcir su nombre"
			},
			contrasena: {
				required: "Favor de introduzcir la contraseña"
			}
		}
	});
});