<?php
    session_start();
//Comprobamos si existe una sesión activa
    if(isset($_SESSION['nombreUser'])){
        setcookie("nombreUser",$_SESSION['nombreUser'], time()+3600);
    }

//Generamos el encabezado de la pagina
    include_once('./funciones.php');
    generarEncabezadoHTML('Enemigos de los Sapos');

//Comprobamos si existe una cookie en el navegador
    if(isset($_COOKIE['nombreUser'])){
        //Coprobamos que el user este en la bd
       if(usuarioExiste($_COOKIE['nombreUser'])){
           //Creamos una sesion y almacenamos el nombre de usuario
           $_SESSION['nombreUser']=$_COOKIE['nombreUser'];
       }
    }
    
//Comprobamos que exista la infomación del usuario en la sesiñon para que siga logeado
    if(isset($_SESSION['nombreUser'])){
       echo "Bienvenido ".$_SESSION["nombreUser"];
    }else{
        echo "Hola tú, registrate para saber mas de nososotros";
    }
        
    generarCierreHTML();