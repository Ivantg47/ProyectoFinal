<?php
//Sirve para dar de alta a los productores

#session_start();
#if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

    include 'conexion.php';

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
        header('Location: form_disquera.php?error=1');
    }
    if (!preg_match('/[a-z áéíóúñü\s]+$/i', $apellido)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_disquera.php?error=2');
    }

    $consulta = "SELECT productor_id id from productores WHERE nombre = '$nombre' AND apellido = '$apellido' AND fecha_nacimiento = '$anio'";
#    echo $consulta.'<br/>';
    $disco = pg_query($con,$consulta);
    $disco = pg_fetch_assoc($disco);
    
#    echo $disco['id'].'<br/>';

    if (empty($disco)){

        $insercion = "INSERT INTO productores (nombre, apellido, fecha_nacimiento) VALUES ('$nombre', '$apellido', '$anio')";
        echo $insercion.'<br/>';
        $query = pg_query($con, $insercion);

    } else {
#        echo "ya se encuentra registrado el disco<br/>";
        pg_close($con);
        header('Location: form_disquera.php?error=3');
    }

    pg_close($con);
    header('Location: catalogo_productores.php');
#}
   
?>
