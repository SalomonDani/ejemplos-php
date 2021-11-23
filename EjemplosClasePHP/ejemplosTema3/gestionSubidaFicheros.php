<?php

    include_once ("./funciones.php");

    if(isset($_POST['upload'])){
        echo "<br>Error. No se ha podido procesar los datos";
    }

    //Mostrar el fichero subido
    if(!isset($_FILES['upload'])){
        echo "<br>Error. No se ha podido subir el fichero";
    }

    $ruta_fichero = $_FILES['upload']['tmp_name'];

    $tamanyo = $_FILES['upload']['size'];

    $nombre_fichero = $_FILES['upload']['name'];

    $error = $_FILES['upload']['error'];

    if($error == UPLOAD_ERR_OK){
        echo "<br>El fichero $nombre_fichero esta almacenado en $ruta_fichero con un tamaño de $tamanyo";
    }else{
        echo "no se ha podido encontrar el fichero";
    }

//Comprobamos si existe la carpeta y si no la crea
    $ruta_destino = "./".$_POST["usuario"]."/";
    $ruta_anyo_actual = ($ruta_destino.date("Y")."/");
    if(!file_exists($_POST['usuario'])){
        mkdir($ruta_destino,0755,true);
    }else{
 
        if(!file_exists($ruta_anyo_actual)){
            mkdir($ruta_anyo_actual,0755,true);
        }
    }

    $nombre_fichero = str_replace(' ','_',$nombre_fichero);
    move_uploaded_file($ruta_fichero,$ruta_anyo_actual.$nombre_fichero);

    //<a href="./descargarDocumentos.php?file=".$ruta_anyo_actual.$nombre_fichero"&type=".mime_content_type($ruta_anyo_actual.$nombre_fichero)></a>;

