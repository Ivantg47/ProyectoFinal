<?php
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

    include 'conexion.php';

    $id = $_POST['id'];
    $nombre = strtoupper($nombre = strip_tags($_POST["nombre"]));
    $apellido = strtoupper($apellido = strip_tags($_POST["apellido"]));
    $pais = strtoupper($pais = strip_tags($_POST["pais"]));
    $anio = strip_tags($_POST["anio"]);
/*
    echo $nombre.'</br>';
    echo $apellido.'</br>';
    echo $pais.'</br>';
    echo $nombreArt.'</br>';
    echo $anio.'</br>';
*/
    if (!preg_match('/[a-z áéíóúñü\s]+$/i', $nombre)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_compositor.php?error=1');
    }
    if (!preg_match('/[a-z áéíóúñü]+$/i', $apellido)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_compositor.php?error=2');
    }
        if (!preg_match('/[a-z áéíóúñü\s]+$/i', $pais)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_compositor.php?error=3');
    }

    $consulta = "UPDATE compositores SET nombre = '$nombre', apellido = '$apellido',pais_nacimiento= '$pais',fecha_nacimiento = '$anio' WHERE compositor_id = $id";
#    echo $consulta.'<br/>';

    $query = pg_query($con,$consulta);

#    var_dump($query);

if($query){
    pg_close($con);
    echo'<script type="text/javascript">
        alert("Registro actualizado con exito");
        window.location.href="catalogo_compositores.php";
        </script>';
}else{
    pg_close($con);
    echo'<script type="text/javascript">
        alert("Error en intento de actualizar el registro");
        window.location.href="edita_compositor.php?id='.$id.'";
        </script>';
}

}

?>
