//Sirve para dar de alta los discos

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

    if (!preg_match('/[a-z áéíóúñü 0-9\s]+$/i', $titulo)) {
#        echo "no es alfanumerico titulo<br/>";
        pg_close($con);
        header('Location: form_disco.php?error=1');
    }
    if (!preg_match('/[a-z áéíóúñü 0-9\s]+$/i', $genero)) {
#        echo "no es alfanumerico genero<br/>";
        pg_close($con);
        header('Location: form_disco.php?error=2');
    }
    if (!(is_numeric($costo) && $costo >= 0)) {
#        echo "no es numero o es menor a 0<br/>";
        pg_close($con);
        header('Location: form_disco.php?error=3');
    }

    if ($filetype == "image/jpeg" && $filesize <= 2000000) {
        $subir = true;
    } else if ($filetype == "image/png" && $filesize <= 2000000){
        $subir = true;
    } else {
#        echo "no cumple con especificaciones<br/>";
        pg_close($con);
        header('Location: form_disco.php?error=4');
    }

#    $consulta = "SELECT disco_id id from discos WHERE disco_id = 23";
    $consulta = "SELECT disco_id id from discos WHERE titulo = '$titulo' AND grupo_id = ".$grupo_id." AND productor_id= ".$productor_id." AND disquera_id = ".$disquera_id;
#    echo $consulta.'<br/>';
    $disco = pg_query($con,$consulta);
    $disco = pg_fetch_assoc($disco);
    
#    echo $disco['id'].'<br/>';

    if (empty($disco)){

        $insercion = "INSERT INTO discos (titulo, grupo_id, año, genero, disquera_id, productor_id, costo, portada) VALUES ('$titulo', '$grupo_id', '$anio', '$genero', '$disquera_id', '$productor_id', '$costo', '')";
#        echo $insercion.'<br/>';
        $query = pg_query($con, $insercion);

        $consulta = "SELECT disco_id id from discos WHERE titulo = '$titulo' AND grupo_id = ".$grupo_id." AND productor_id= ".$productor_id." AND disquera_id = ".$disquera_id;
#        echo $consulta.'<br/>';
        $disco = pg_query($con,$consulta);
        $disco = pg_fetch_assoc($disco);

        if (!empty($disco)){

            $imagen = "img/".$titulo."-".$disco['id']."-".$grupo_id."-".$disquera_id;
            $insercion = "UPDATE discos SET portada = '$imagen' WHERE disco_id =".$disco['id'];
#            echo $insercion.'<br/>';
            $query = pg_query($con, $insercion);
            move_uploaded_file($filetmpname, $imagen);

            $tituloCancionArr = $_POST['tituloCancion'];
            $compositorArr = $_POST['compositor'];

            if(!empty($tituloCancionArr)){

                for($i = 0; $i < count($tituloCancionArr); $i++){

                    if(!empty($compositorArr[$i])){

                        $tituloCancion = $tituloCancionArr[$i];
                        $compositor = $compositorArr[$i];

                        //verifica que no exista el titulo de la cancion
                        $consulta = "SELECT cancion_id id from canciones WHERE titulo = '$tituloCancion'";
#                        echo $consulta.'<br/>';
                        $resultado = pg_query($con,$consulta);
                        $resultado = pg_fetch_assoc($resultado);
#                        echo $resultado['id'].'<br/>';

                        if (empty($resultado['id'])){
                            #inserta cancion si no existe
                           $insercion = "INSERT INTO canciones (titulo) VALUES ('$tituloCancion')";
#                           echo $insercion.'<br/>';
                            $query = pg_query($con, $insercion);

                            $consulta = "SELECT cancion_id id from canciones WHERE titulo = '$tituloCancion'";
#                            echo $consulta .'<br/>';
#                            $consulta = "SELECT cancion_id id from canciones WHERE cancion_id = 1";
                            $resultado = pg_query($con,$consulta);
                            $resultado = pg_fetch_assoc($resultado);
                        }

                        $insercion = "INSERT INTO cancion_compositor VALUES (".$resultado['id'].",".$compositor.") ON CONFLICT DO NOTHING";
#                        echo $insercion.'<br/>';
                        $query = pg_query($con, $insercion);

                        $insercion = "INSERT INTO disco_cancion VALUES (".$disco['id'].",".$resultado['id'].") ON CONFLICT DO NOTHING";
#                       echo $insercion.'<br/>';
                        $query = pg_query($con, $insercion);

#                        echo $tituloCancion.'<br/>';
#                        echo $compositor.'<br/>';

                    } else {
#                       echo "no se ingresaron compositor<br/>";
                        pg_close($con);
                        header('Location: form_disco.php?error=6');
                    }
                }

            }else{
#               echo "no se ingresaron canciones<br/>";
                pg_close($con);
                header('Location: form_discos.php?error=5');
            }

            pg_close($con);
            header('Location: catalogo_disco.php');
        }

    } else {
#        echo "ya se encuentra registrado el disco<br/>";
       pg_close($con);
       header('Location: form_disco.php?error=4');
    }
  
#}
   
?>
