<?php
session_start();
include_once('./funciones.php');
generarEncabezadoHTML("Register");
generarHeaderHTML($logeado);
generarFormularioRegistro();
generarFooterHTML();
generarCierreHTML();
