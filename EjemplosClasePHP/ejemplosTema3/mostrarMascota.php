<?php

    include_once ('./funciones.php');

    $con = conexionBD();
    $resultado = mysqli_query($con,"SELECT id_mascota,nombre,foto FROM mascotas");
    
    echo "<table border = '1px black solid'
        <th>
            <td> Id Mascota</td>
            <td> Nombre </td>
            <td> Foto </td>
        </th>";
    while($fila = mysqli_fetch_assoc($resultado)){
        echo "<tr>
                <td>".$fila['id_mascota']."</td>
                <td>".$fila['nombre']."</td>
                <td><img src='data:image/png;base64'".base64_encode($fila['foto'])."with=50px height=50px</td>
            </tr>";
    }