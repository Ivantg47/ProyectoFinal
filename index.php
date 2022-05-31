

<!DOCTYPE html>
<html>
  <!-- index.php: Aqui se muestra el un formulario para indicar el nombre de usuario y contraseña para ingresar al sistema -->
  <!-- Los datos de usuario y contraseña que se ingresen en esta parte serán mandados a login.php -->
  <!-- Si los datos son correctos y coinciden con los que son almacenados en la bd se redirige a catalogo_discos.php, en caso contrario, regresa a index.php. -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> // Esta línea nos permite que el área que es visible para el usuario en la pantalla se ajuste al dispositivo que utiliza.

  <link rel="stylesheet" href="css/estilo1.css" type="text/css" />
  <script src="js/jquery-3.6.0.js"></script> // La versión de jquery que se usa es la 3.6.0.
  <script src="js/01.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/validar.js"></script> // Aqui se hace uso del archivo validar.js para hacer las validaciones requeridas al usuario y contraseña.
  
  <title>Inicio sesion</title>
</head>
<body>
    <div class="login-page">
      <div class="form">
        <form id="formInicio" class="login-form" action="login.php" method="post">
            <?php
              //Si el usuario o contraseña está mal se muestra un mensaje.
              if(isset($_GET['error'])){
                //Sugerencia para que no muestre la advertencia del index
                echo "<p class=\"error\">Usuario y/o contraseña incorrecto</p>";
              }
            ?>  
            <input class="form input" type="text" id="usuario" name="usuario" placeholder="usuario"/>
            <input class="form input" type="password" id="contrasena" name="contrasena" placeholder="contraseña"/>
            <button>acceder</button>
        </form>      
      </div>
    </div>
</body>
</html>

