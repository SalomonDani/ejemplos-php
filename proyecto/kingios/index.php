<?php
session_start();
include_once('./funciones.php');
if (isset($_SESSION['logeado'])){
    generarEncabezadoHTML("Kingio's Services");
    generarHeaderHTML(true);
    generarBodyHTML();
    generarFooterHTML();
    generarCierreHTML();
}else{
    generarEncabezadoHTML("Kingio's Services");
    generarHeaderHTML(false);
    generarBodyHTML();
    generarFooterHTML();
    generarCierreHTML();
}