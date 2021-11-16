<?php
    include "./funciones.php";

//Recorrer Array
foreach($_POST as $clave => $valor){
     echo "El valor para la clave $clave es: $valor <br>";
}

$nom_eq = $_POST['nombre_eq'];
//echo "<br> $nom_eq";
$ciudad = $_POST['ciudad'];
//echo "<br> $ciudad";
$division = $_POST['division'];
//echo "<br> $division";
$conferencia = $_POST['conferencia'];
//echo "<br> $conferencia";

function inserccionDatosEquipos($nom_eq,$ciudad,$division,$conferencia){
    $conexion = conexionBD();
    $insercion = "INSERT INTO equipos VALUES ($nom_eq,$ciudad,$division,$conferencia)";
    $comprobante = mysqli_query($conexion,$insercion);
    if($comprobante){
        echo "Se ha insewertado los datos correctamente";
    }else{
        echo "Los datos introducidos no son correctos";
    }
}