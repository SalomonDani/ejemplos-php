<?php
    session_start();
    setcookie("nombreUser","", time()+3600);
    include_once ("./funciones.php");

    generarEncabezadoHTML("Comprobar Usuario");

    $usuario = $_POST["usuario"];
    $passwd = $_POST["passwd"];

    $con = conexionBD();
    $sql = "SELECT passwd from usuario WHERE nombre = ?";

//Se prepara la sentencia
    $sentencia = mysqli_prepare($con,$sql);

//Se asocian los parametros a la sentencia y se ejecuta
    mysqli_stmt_bind_param($sentencia,"s",$usuario);
    mysqli_stmt_execute($sentencia);

//Modo corto de acceder
    mysqli_stmt_bind_result($sentencia,$passwd_cifrado);

    mysqli_stmt_fetch($sentencia);

    if (password_verify($passwd,$passwd_cifrado)){
        echo "<br>La contraseña es correcta";
        $_SESSION['nombreUser'] = $usuario;
        $_COOKIE['nombreUser'] = $usuario;
    }

//Otro modo de acceder a los resultados
  /*  $resultado = mysqli_stmt_get_result($sentencia);

    $fila = mysqli_fetch_assoc($resultado);

    echo $fila["passwd"];

    if (password_verify($passwd,$fila["passwd"])){
        echo "<br>La contraseña es correcta";
    }*/

    if(comprobarUser($_POST['usuario'],$_POST['passwd'])){
        $_SESSION['nombreUser']=$_POST['usuario'];
    }

    generarCierreHTML();