<<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/estilo1.css" type="text/css" />
  <script src="js/jquery-3.6.0.js"></script>
  <script src="js/01.js"></script>

  <title>Inicio sesion</title>
</head>
<body>
  <div class="login-page">
  <div class="form">
    <!--<form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>-->
    <form class="login-form" action="login.php" method="post">
      <input type="text" id="usuario" name="usuario" placeholder="usuario"/>
      <input type="password" id="contrasena" name="contrasena" placeholder="contraseña"/>
      <button>acceder</button>
      <!--<p class="message">Not registered? <a href="#">Create an account</a></p>-->
    </form>
  </div>
</div>
</body>
</html>

