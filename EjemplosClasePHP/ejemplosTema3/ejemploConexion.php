<?php

//Proceso de conexión a la base de datos
$conexion = mysqli_connect('localhost','iawe_dani','dani1','bd_ejemplo');

if($conexion!=FALSE){
    echo "<br>Conectado corretamente<br>";
}else{
    echo "<br>ERROR: No se ha podido conectar con la base de datos<br>";
}

//Insertzioni
$query="INSERT INTO entrenador VALUES(8,'Michael Jordan',54)";
$resultado=mysqli_query($conexion,$query);

//Ejempli di lectura da base dades
$query="SELECT * FROM entrenador";
$resultado = mysqli_query($conexion,$query);

while($fila=mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
    print_r($fila);
    echo "<br>";
}

//Comprobanti di insertzioni
if($resultado){
    echo "<br>La insertzioni sa relitzato correcti";
}else{
    echo "<br>Questo di mama, habiere una errata in l'insertzioni";
}

//Proceso de desconexión de la base de datos
if($conexion!=FALSE){
    mysqli_close($conexion);
}