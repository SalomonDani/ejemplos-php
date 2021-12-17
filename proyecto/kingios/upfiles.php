<?php
session_start();
include_once('./funciones.php');
echo print_r($_FILES);   
 
//Comprueba que hay unfichero
 
if (!isset($_FILES['upload'])){
     echo "Error. No se ha podido subir el fichero";
}

//Se asignan las variables del array FILE

$rutaFichero = $_FILES['upload']['tmp_name'];
$size = $_FILES['upload']['size'];
$name = $_FILES['upload']['name'];
$error = $_FILES['upload']['error'];

//Si el archivo se sube correctamente, es movido a la carpeta personal del usuario

if($error == UPLOAD_ERR_OK){
    $usuario = $_SESSION['nickname'];
    $ruta = getcwd();
    $rutaCompleta = $ruta."/users/".$usuario."/";
    $name = str_replace(' ','_',$name);
    move_uploaded_file($rutaFichero,$rutaCompleta.$name);
     //echo "El fichero $name está almacenado en $rutaFichero con un tamaño de $size";
}else{
    echo "No se ha podido acceder al fichero";
}

//Se vuelve al Área Personal
 
volverAreaPersonal();