<?php


#session_start();
#if (isset($_SESSION['valida']) && $_SESSION['valida'] == true){

    include 'conexion.php';

    $filename = $_FILES['portada']['name'];
    $filetmpname = $_FILES['portada']['tmp_name'];
    $filetype = $_FILES['portada']['type'];
    $filesize = $_FILES['portada']['size'];

    $titulo = strip_tags($_POST["titulo"]);
    $grupo_id = strip_tags($_POST["grupo"]);
    $genero = strip_tags($_POST["genero"]);
    $disquera_id = strip_tags($_POST["disquera"]);
    $productor_id = strip_tags($_POST["productor"]);
    $anio = strip_tags($_POST["anio"]);
    $costo = strip_tags($_POST["costo"]);

    $imagen = "img/".$titulo.$grupo_id.$disquera_id;
    #move_uploaded_file($filetmpname, $imagen);

    if (!preg_match('/[a-z áéíóúñü]{2,50}/i', $titulo)) {
        header('Location: form_disco.php?error=1');
    }
    if (!preg_match('/[a-z áéíóúñü]{2,50}/i', $genero)) {
        header('Location: form_disco.php?error=1');
    }
    if (!(is_numeric($costo) && $costo >= 0)) {
        header('Location: form_disco.php?error=1');
    }

    $insercion = "INSERT INTO discos (titulo, grupo_id, año, genero, disquera_id, productor_id, costo, portada) VALUES ('$titulo', '$grupo_id', '$anio', '$genero', '$disquera_id', '$productor_id', '$costo', '$imagen')";
    $query = pg_query($con, $insercion);


    if ($filetype == "image/jpeg" && $filesize <= 2000000) {
        move_uploaded_file($filetmpname, $imagen);
    } else if ($filetype == "image/png" && $filesize <= 2000000){
        move_uploaded_file($filetmpname, $imagen);
    } else {
        header('Location: form_disco.php?error=1');
    }


    $consulta = "SELECT disco_id id from discos WHERE titulo = '$titulo' AND grupo_id = ".$grupo_id." AND productor_id= ".$productor_id." AND disquera_id = ".$disquera_id;

    #$consulta = "SELECT disco_id id from discos WHERE disco_id = 23";
    $disco = pg_query($con,$consulta);
    $disco = pg_fetch_assoc($disco);

    /*
    if (!empty($disco)){
        echo 'hola <br/>';
    }else{
        echo 'adios <br/>';
    }
    */

    $tituloCancionArr = $_POST['tituloCancion'];
    $compositorArr = $_POST['compositor'];

    if(!empty($tituloCancionArr)){
        for($i = 0; $i < count($tituloCancionArr); $i++){
            if(!empty($tituloCancionArr[$i])){
                $tituloCancion = $tituloCancionArr[$i];
                $compositor = $compositorArr[$i];

                //verifica que no exista el titulo de la cancion
                $consulta = "SELECT cancion_id id from canciones WHERE titulo = '$tituloCancion'";
                $resultado = pg_query($con,$consulta);
                $resultado = pg_fetch_assoc($resultado);
    #            echo $resultado['id'].'<br/>';
    #            echo $resultado.'<br/>';

                if (empty($resultado['id'])){
                    
                   $insercion = "INSERT INTO canciones (titulo) VALUES ('$tituloCancion')";
    #               echo $insercion.'<br/>';
                    $query = pg_query($con, $insercion);

                    $consulta = "SELECT cancion_id id from canciones WHERE titulo = '$tituloCancion'";
     #               echo $consulta .'<br/>';
     #               $consulta = "SELECT cancion_id id from canciones WHERE cancion_id = 1";
                    $resultado = pg_query($con,$consulta);
                    $resultado = pg_fetch_assoc($resultado);
                }

                $insercion = "INSERT INTO cancion_compositor VALUES (".$resultado['id'].",".$compositor.") ON CONFLICT DO NOTHING";
    #            echo $insercion.'<br/>';
                $query = pg_query($con, $insercion);

                $insercion = "INSERT INTO disco_cancion VALUES (".$disco['id'].",".$resultado['id'].") ON CONFLICT DO NOTHING";
    #           echo $insercion.'<br/>';
                $query = pg_query($con, $insercion);

            #    echo $tituloCancion.'<br/>';
            #    echo $compositor.'<br/>';
            }
        }
    }else{
        echo 'no canciones';
    }

    pg_close($con);
#}
?>