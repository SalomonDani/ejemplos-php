<?php
session_start();
include_once('./funciones.php');
generarEncabezadoHTML("Login");
generarHeaderHTML(false);
generarFormularioLogin();
generarFooterHTML();
generarCierreHTML();