<?php
//Sirve para dar de lata las diqueras

#session_start();
#if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

    include 'conexion.php';

    $nombre = strtoupper($nombre = strip_tags($_POST["nombre"]));
    $pais = strtoupper($pais = strip_tags($_POST["pais"]));
/*
    echo $nombre.'</br>';
    echo $pais.'</br>';
*/
    if (!preg_match('/[a-z áéíóúñü\s]+$/i', $nombre)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_disquera.php?error=1');
    }
    if (!preg_match('/[a-z áéíóúñü\s]+$/i', $pais)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_disquera.php?error=2');
    }

    $consulta = "SELECT disquera_id id from disqueras WHERE nombre = '$nombre' AND pais = '$pais'";
#    echo $consulta.'<br/>';
    $disco = pg_query($con,$consulta);
    $disco = pg_fetch_assoc($disco);
    
#    echo $disco['id'].'<br/>';

    if (empty($disco)){

        $insercion = "INSERT INTO disqueras (nombre, pais) VALUES ('$nombre', '$pais')";
#        echo $insercion.'<br/>';
        $query = pg_query($con, $insercion);

        pg_close($con);
        echo'<script type="text/javascript">
        alert("Disquera registrada con exito");
        window.location.href="catalogo_disqueras.php";
        </script>';

    } else {
#        echo "ya se encuentra registrado el disco<br/>";
        pg_close($con);
        header('Location: form_disquera.php?error=3');
    }

#}
   
?>
