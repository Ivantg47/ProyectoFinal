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
	$.validator.addMethod("alphanumeric", function(value, element) {
    return this.optional(element) || /^[\w.áéíóúñü]+$/i.test(value);
}, "Solo se aceptan letras y numeros");

	$.validator.addMethod("letra", function(value, element) {
    return this.optional(element) || /^[a-z.áéíóúñü\s]+$/i.test(value);
	}, "Solo se aceptan letras");

	$.validator.addMethod('filesize', function(value, element, param) {
   return this.optional(element) || (element.files[0].size <= param) 
	}, "El archivo supera el límite de peso permitido");



  $('#subir').validate({ 
  	ignore: [],
    rules: {
    	portada: {
        required: true,
        filesize: 2000000,
        extension: "png|jpeg|jpg"
      },
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
			'tituloCancion[]': {
				required: true,
				alphanumeric: true
			},
			'compositor[]': {
				required: true
			},
			nombre: {
				required: true,
				letra: true
			},
			apellido: {
				required: true,
				letra: true
			},
			pais: {
				required: true,
				letra: true
			},
			'artista[]': {
				required: true
			}
    },
    messages: {
    	portada: {
				required: "Es necesario llenar el campo",
				extension: "Solo se permite la extencion png, jpg y jpeg"
			},
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
			'tituloCancion[]': {
				required: "Es necesario llenar el campo"
			},
			'compositor[]': {
				required: "Es necesario llenar el campo"
			},
			nombre: {
				required: "Es necesario llenar el campo"
			},
			apellido: {
				required: "Es necesario llenar el campo"
			},
			pais: {
				required: "Es necesario llenar el campo"
			},
			'artista[]': {
				required: "Es necesario llenar el campo"
			}
		}
  });  
});

