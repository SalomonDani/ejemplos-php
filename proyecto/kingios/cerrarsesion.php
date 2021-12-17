<?php
session_start();
include_once('./funciones.php');
$con = conectarBD();
if ($con != false){
    session_destroy();
    paginaInicio();
}