<?php
session_start();
include_once('./funciones.php');
generarEncabezadoHTML("Register");
generarHeaderHTML(false);
generarFormularioRegistro();
generarFooterHTML();
generarCierreHTML();
