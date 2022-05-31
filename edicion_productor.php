<?php
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

    include 'conexion.php';

    $id = $_POST['id'];
    $nombre = strtoupper($nombre = strip_tags($_POST["nombre"]));
    $apellido = strtoupper($apellido = strip_tags($_POST["apellido"]));
    $anio = strip_tags($_POST["anio"]);
/*
    echo $nombre.'</br>';
    echo $apellido.'</br>';
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


    $consulta = "UPDATE productores SET nombre = '$nombre', apellido = '$apellido',fecha_nacimiento = '$anio' WHERE productor_id = $id";
#    echo $consulta.'<br/>';

    $query = pg_query($con,$consulta);

#    var_dump($query);

if($query){
    pg_close($con);
    echo'<script type="text/javascript">
        alert("Registro actualizado con exito");
        window.location.href="catalogo_productores.php";
        </script>';
}else{
    pg_close($con);
    echo'<script type="text/javascript">
        alert("Error en intento de actualizar el registro");
        window.location.href="edita_productor.php?id='.$id.'";
        </script>';
}

}
?>