<?php

session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Aquí se dan de alta a los nuevos artistas en la base de datos. Se validan los datos ingresados y se insertan en la bd.


    include 'conexion.php';

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

#    $consulta = "SELECT artista_id id from discos WHERE disco_id = 23";
    $consulta = "SELECT artista_id id from artistas WHERE nombre = '$nombre' AND apellido = '$apellido' AND pais_nacimiento= '$pais' AND fecha_nacimiento = '$anio' AND nombre_artistico = '$nombreArt'";
#    echo $consulta.'<br/>';
    $disco = pg_query($con,$consulta);
    $disco = pg_fetch_assoc($disco);
    
    echo $disco['id'].'<br/>';

    if (empty($disco)){

        $insercion = "INSERT INTO artistas (nombre, apellido, pais_nacimiento, fecha_nacimiento, nombre_artistico) VALUES ('$nombre', '$apellido', '$pais', '$anio', '$nombreArt')";
#        echo $insercion.'<br/>';
        $query = pg_query($con, $insercion);

    } else {
#        echo "ya se encuentra registrado el disco<br/>";
        pg_close($con);
       header('Location: form_artista.php?error=5');
    }

    pg_close($con);
    header('Location: catalogo_artista.php');
    
}
   
?>
