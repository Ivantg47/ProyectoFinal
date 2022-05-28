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

$(document).ready(function () {
	jQuery.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.áéíóúñü]+$/i.test(value);
}, "Solo se aceptan letras y numeros");

    $('#subir').validate({ 
        rules: {
            titulo: {
                required: true,
                alphanumeric: true
            },
			grupo: {
				required: true
			},
			disquera: {
				required: true
			},
			productor: {
				required: true
			},
			genero: {
				required: true,
				alphanumeric: true
			},
			anio: {
				required: true
			},
			costo: {
				required: true,
				number: true,
				min: 0 + Number.MIN_VALUE
			},
			tituloCancion: {
				required: true,
				alphanumeric: true
			},
			compositor: {
				required: true
			}
        },
        messages: {
			titulo: {
				required: "Es necesario llenar el campo"
			},
			grupo: {
				required: "Es necesario llenar el campo"
			},
			disquera: {
				required: "Es necesario llenar el campo"
			},
			productor: {
				required: "Es necesario llenar el campo"
			},
			genero: {
				required: "Es necesario llenar el campo"
			},
			anio: {
				required: "Es necesario llenar el campo"
			},
			costo: {
				required: "Es necesario llenar el campo",
				number: "Solo se aceptan numeros",
				min: "Debe ingresar un valor mayor a 0.00"
			},
			tituloCancion: {
				required: "Es necesario llenar el campo"
			},
			compositor: {
				required: "Es necesario llenar el campo"
			}
		}
    });

});