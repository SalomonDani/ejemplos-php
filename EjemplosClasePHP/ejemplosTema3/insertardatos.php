<?php
    include_once ("./funciones.php");

    $password = $_POST["passwd"];
    $usuario = $_POST["usuario"];
    
    $consulta = "INSERT INTO usuario VALUES (?,?)";
    $passwd_cifrado = password_hash($password,PASSWORD_DEFAULT);

    $con = conexionBD();
    $sentencia = mysqli_prepare($con,$consulta);

    mysqli_stmt_bind_param($sentencia,"ss",$usuario,$passwd_cifrado);

   if (mysqli_stmt_execute($sentencia)){
       echo "Registrado correctamente";
   }else{
       echo "No se ha podisido registrar";
   }