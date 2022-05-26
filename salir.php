<?php
//liberar variables de sesion:
session_start();
session_unset();
//destruir la sesion
session_destroy();
//regresar index
header('Location: index.php');
?>