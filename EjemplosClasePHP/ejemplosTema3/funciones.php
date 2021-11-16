<?php

//Declaraciones de la conexion a base de datos
define("SERVIDOR","localhost");
define("USER","iawe_dani");
define("PASSWD","dani1");
define("BASEDATOS","bd_ejemplo");

//Conexion a la base de datos
function conexionBD(){
    $conexion = mysqli_connect(SERVIDOR,USER,PASSWD,BASEDATOS);
    return $conexion;
}
/*
if(!$conexion){
    echo "Se ha establecido conexión<br>";
    return false;
}else{
    echo "No se ha podido establecer conexion<br>";
}*/

//Aumentar edad
function aumentarEdadCincuentones($aumento){
    $conexion = conexionBD();
    $consultaBD = "update entrenadores where edad>50 set edad=edad+$aumento";
    $comprobante = mysqli_query($conexion,$consultaBD);
    if($comprobante){
        echo "El cambio de edad se ha efectuado correctamente";
    }else{
        echo "Este señor no enevejece hoy";
    }
}

//HTML

function generarFormularioRegistro($action){
    echo "<form name='registro' action='".$action."' method='post'>
            <label for='usuario'>Introduce tu usuario</label>
            <input type='text' name='usuario' id='usuario'>
            <br>
            <label for='passwd'>Introduce tu contraseña</label>
            <input type='password' name=passwd id=passwd>
            <br>
            <button type='submit'>Registrarme</button>
        <form>";
}

function generarEncabezadoHTML($titulo){
    echo "<html charset=utf8
            <head>
                <title>$titulo</title>
            </head>
            <body>";
}

function generarCierreHTML(){
    echo "
        <div id=pie>
            <br><center><a href='./indiceChungo.php'>Inicio</a></center>
        </div>
        </body>
        </html>";
}

function comprobarUser($usuario,$passwd){
    $con = conexionBD();
    $sql = "SELECT passwd from usuario WHERE nombre = ?";

//Se prepara la sentencia
    $sentencia = mysqli_prepare($con,$sql);

//Se asocian los parametros a la sentencia y se ejecuta
    mysqli_stmt_bind_param($sentencia,"s",$usuario);
    mysqli_stmt_execute($sentencia);

//Modo corto de acceder
    //Acceso a los resultados de la ejecución de la consulta
    mysqli_stmt_bind_result($sentencia,$passwd_cifrado);
    //Se mueve a la siguiente fila del conjunto de resultados
    mysqli_stmt_fetch($sentencia);

    if (password_verify($passwd,$passwd_cifrado)){
        return true;
    }else{
        return false;
    }
}

function usuarioExiste(){
    $con = conexionBD();
    $sql = "SELECT passwd from usuario WHERE nombre = ?";

//Se prepara la sentencia
    $sentencia = mysqli_prepare($con,$sql);

//Se asocian los parametros a la sentencia y se ejecuta
    mysqli_stmt_bind_param($sentencia,"s",$usuario);
    if(mysqli_stmt_execute($sentencia)){
        return true;
    }else{
        return false;
    }
}

function formularioCargaArchivos($paginaAction){

    echo "<form method='POST' name='formularioSubida' enctype='multipart/form-data' action='$paginaAction'>
                <label for='usuario'>Introduce tu nombre de usuario</label>
                <input type='text' name='usuario' id='usuario'>
                <label for='upload'>Carga el fichero a subir</label>
                <input type='file' name='upload' id='upload'>

                <button type='submit'>Enviar</button>
            </form>";

    
}