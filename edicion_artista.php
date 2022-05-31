<?php
session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

    include 'conexion.php';

    $id = $_POST['id'];
    $nombre = strtoupper($nombre = strip_tags($_POST["nombre"]));
    $apellido = strtoupper($apellido = strip_tags($_POST["apellido"]));
    $pais = strtoupper($pais = strip_tags($_POST["pais"]));
    if (empty($nombreArt = strtoupper($nombreArt = strip_tags($_POST["nombreArt"])))) {
        $nombreArt = 'INDEFINIDO';
    }
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
        header('Location: form_artista.php?error=1');
    }
    if (!preg_match('/[a-z áéíóúñü]+$/i', $apellido)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_artista.php?error=2');
    }
        if (!preg_match('/[a-z áéíóúñü\s]+$/i', $pais)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_artista.php?error=3');
    }
    if (!preg_match('/[a-z áéíóúñü\s]/i', $nombreArt)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
       header('Location: form_artista.php?error=4');
    }

    $consulta = "UPDATE artistas SET nombre = '$nombre', apellido = '$apellido',pais_nacimiento= '$pais',fecha_nacimiento = '$anio', nombre_artistico = '$nombreArt' WHERE artista_id = $id";
#    echo $consulta.'<br/>';

    $query = pg_query($con,$consulta);

#    var_dump($query);

if($query){
    pg_close($con);
    echo'<script type="text/javascript">
        alert("Registro actualizado con exito");
        window.location.href="catalogo_artistas.php";
        </script>';
}else{
    pg_close($con);
    echo'<script type="text/javascript">
        alert("Error en intento de actualizar el registro");
        window.location.href="edita_artista.php?id='.$id.'";
        </script>';
}

}
?>