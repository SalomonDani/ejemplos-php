<?php
    include "./funciones.php";

    //Conexion base de datos
    $conexion = conexionBD();

    $query = "INSERT INTO entrenador VALUES(?,?,?)";

//Preparamos la consulta almacenandola en la base de datos.
    $consultaPreparada = mysqli_prepare($conexion,$query);

    $idEntrenador = 9; //En fomrulario cambiar por $_POST["id"]
    $nombreEntrenador = "Brad Stevens";
    $edadEntrenador = 56;

//Sustituir parametros
    mysqli_stmt_bind_param($consultaPreparada, "isi",$idEntrenador,$nombreEntrenador,$edadEntrenador);


/*Comprobante
if (mysqli_stmt_bind_param($consultaPreparada, "isi",$idEntrenador,$nombreEntrenador,$edadEntrenador);){
    echo "Se han sustituido correctamente los parametros";
}else{
    echo "Ha habido un problema en la sustitución";
}*/


//Ejecucion de la consulta

    $resultador = mysqli_stmt_execute($consultaPreparada);

    echo "<br>Se han insertado " .mysqli_stmt_affected_rows($consultaPreparada);


    echo "<br>Se ha producido un error ".mysqli_stmt_error($consultaPreparada);


//Creacion de una consulta con sentencias preparadas

    $parametroEdadEntrenador = 50;

    $query2 = "SELECT * FROM entrenador WHERE edad > ?";

    $consultaPreparada2 = mysqli_prepare($conexion,$query2);

    mysqli_stmt_bind_param($consultaPreparada2,"i",$parametroEdadEntrenador);

    mysqli_stmt_execute($consultaPreparada2);

    echo "<br>La consulta ha devuelto ".mysqli_stmt_affected_rows($consultaPreparada2)." filas";

    $resultado2 = mysqli_stmt_get_result($consultaPreparada2);

    while ($flia = mysqli_fetch_assoc($resultado2)){
        echo "<br>";
        print_r($flia);

    }