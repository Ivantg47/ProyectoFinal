<?php
#session_start();
#if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

    include 'conexion.php';

    $nombre = strtoupper($nombre = strip_tags($_POST["nombre"]));
    $pais = strtoupper($pais = strip_tags($_POST["pais"]));

#    echo $nombre.'</br>';
#    echo $pais.'</br>';

    if (!preg_match('/[a-z áéíóúñü 0-9\s]+$/i', $nombre)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_disquera.php?error=1');
    }
    if (!preg_match('/[a-z áéíóúñü\s]+$/i', $pais)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_disquera.php?error=2');
    }

    $consulta = "SELECT grupo_id id from grupos WHERE nombre = '$nombre' AND pais_origen = '$pais'";
#    echo $consulta.'<br/>';
    $disco = pg_query($con,$consulta);
    $disco = pg_fetch_assoc($disco);
    
#    echo $disco['id'].'<br/>';

    if (empty($disco)){

        $insercion = "INSERT INTO grupos (nombre, pais_origen) VALUES ('$nombre', '$pais')";
#        echo $insercion.'<br/>';
        $query = pg_query($con, $insercion);

        $consulta = "SELECT grupo_id id from grupos WHERE nombre = '$nombre' AND pais_origen = '$pais'";
#        echo $consulta.'<br/>';
        $disco = pg_query($con,$consulta);
        $disco = pg_fetch_assoc($disco);

        $artistaArr = $_POST['artista'];

        if(!empty($artistaArr)){
            for($i = 0; $i < count($artistaArr); $i++){
            
                $artista = $artistaArr[$i];
                
                //verifica que no exista el titulo de la cancion

                $insercion = "INSERT INTO grupo_artista VALUES (".$disco['id'].",".$artista.") ON CONFLICT DO NOTHING";
#                echo $insercion.'<br/>';
                $query = pg_query($con, $insercion);

#                echo $artista.'<br/>';
                
            }
        }else{
#            echo "no se ingresaron canciones<br/>";
            pg_close($con);
            header('Location: form_disco.php?error=3');
        }
        pg_close($con);
        header('Location: catalogo_productores.php');

    } else {
#        echo "ya se encuentra registrado el grupo<br/>";
        pg_close($con);
       header('Location: form_disquera.php?error=4');
    }


#}
   
?>