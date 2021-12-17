<?php
session_start();
include_once('./funciones.php');
generarEncabezadoHTML("Personal Area");
generarHeaderHTML($_SESSION['logeado']);
areaPersonal();
formularioCargaArchivos();
generarFooterHTML();
generarCierreHTML();