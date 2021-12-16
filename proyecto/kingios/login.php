<?php
session_start();
include_once('./funciones.php');
generarEncabezadoHTML("Login");
generarHeaderHTML($_SESSION['logeado']);
generarFormularioLogin();
generarFooterHTML();
generarCierreHTML();