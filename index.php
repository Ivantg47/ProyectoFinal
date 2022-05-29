<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/estilo1.css" type="text/css" />
  <script src="js/jquery-3.6.0.js"></script>
  <script src="js/01.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/validar.js"></script>

  <title>Inicio sesion</title>
</head>
<body>
  <div class="login-page">
  <div class="form">
    <form id="formInicio" class="login-form" action="login.php" method="post">
      <?php
        if(isset($_GET)){
          if(isset($_GET['error'])){
            //Sugerencia para que no muestre la advertencia del index
            echo "<p class=\"error\">Usuario y/o contraseña incorrecto</p>";
            <?php
          }
        }
      ?>
      <input class="form input" type="text" id="usuario" name="usuario" placeholder="usuario"/>
      <input class="form input" type="password" id="contrasena" name="contrasena" placeholder="contraseña"/>
      <button>acceder</button>
      <!--<p class="message">Not registered? <a href="#">Create an account</a></p>-->
    </form>
  </div>
</div>
</body>
</html>

