<?php
    include_once "./funciones.php";

    $archivo = $_GET['file'];

    if(!isset($_GET['file'])){
        echo "Parametros insuficientes";
    }else{
        if(file_exists($archivo)){
            //El parametro y el fichero existe
            header("Content-type: ".mime_content_type($archivo));
            header("Content-Disposition: attachment; filename".$archivo);
            header("Content-lenght:".filesize($archivo));
            readfile($archivo);
        }
    }