<?php  
    include_once ("./funciones.php");

    setcookie("nombreUser",$_SESSION['nombreUser'], time()+3600,"/iespacomolla.es","iespacomolla.es",false,false);
    setcookie("cookie2");

    generarEncabezadoHTML("Hola");