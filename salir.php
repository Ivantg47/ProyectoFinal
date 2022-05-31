//salir.php: Aqui se liberará y destruirán las variables de inicio de sesión del usuario al momento en que se cierre la sesión.
<?php
//liberar variables de sesion:
session_start();
session_unset();
//destruir la sesion
session_destroy();
//regresar index
header('Location: index.php');
?>
