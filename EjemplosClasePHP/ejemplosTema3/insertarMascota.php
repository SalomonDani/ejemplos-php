<?php
    include_once ('./funciones.php');

    print_r($_POST);
    //Conseguimos el nombre de la mascota
    $nombreMascota = $_POST['nombremascota'];

    //Consultar el id del nombre de equipo
    $idEquipo = saberIdEquipo($_POST['seleccionequipo']);
    echo $idEquipo;

    //Tratamiento de la imagen para almacenarla en BLOB
    $ruta_imagen = $_FILES['imagenmascota']['tmp_name'];
    echo "<br>".$ruta_imagen;
    $imagen_binaria = file_get_contents($ruta_imagen);
    //echo "<br>"$imagen_binaria;

    almacenarMascota($nombreMascota,$imagen_binaria,$idEquipo);
 