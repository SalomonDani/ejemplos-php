<?php
    include_once "./funciones.php";

 $archivo=$_GET['name'];

if (!isset($_GET['name'])){
    echo "Parámetros insuficientes";
}else{
    $ruta = getcwd();
    $rutaCompleta = $ruta."./users/".$usuario."/".$archivo;
    if(file_exists($rutaCompleta)){
        //El parámetro y el fichero existen
    header("Content-type: ".mime_content_type($rutaCompleta));
    header("Content-Disposition: attachment; filename=".$archivo);
    header("Content-length:".filesize($rutaCompleta));
    readfile($rutaCompleta);
    }
}