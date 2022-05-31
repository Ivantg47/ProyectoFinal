<?php

session_start();
if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

//Aquí se dan de alta a los nuevos artistas en la base de datos. Se validan los datos ingresados y se insertan en la bd.


    include 'conexion.php';

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
    

#    $consulta = "SELECT artista_id id from discos WHERE disco_id = 23";
    $consulta = "SELECT compositor_id id from compositores WHERE nombre = '$nombre' AND apellido = '$apellido' AND pais_nacimiento= '$pais' AND fecha_nacimiento = '$anio'";
    echo $consulta.'<br/>';
    $disco = pg_query($con,$consulta);
    $disco = pg_fetch_assoc($disco);
    

    if (empty($disco)){

        $insercion = "INSERT INTO compositores (nombre, apellido, pais_nacimiento, fecha_nacimiento) VALUES ('$nombre', '$apellido', '$pais', '$anio')";
#        echo $insercion.'<br/>';
        $query = pg_query($con, $insercion);

        pg_close($con);
        header('Location: catalogo_compositores.php');

    } else {
        echo "ya se encuentra registrado el disco<br/>";
        pg_close($con);
       header('Location: form_compositor.php?error=5');
    }
    
}
   
?>
