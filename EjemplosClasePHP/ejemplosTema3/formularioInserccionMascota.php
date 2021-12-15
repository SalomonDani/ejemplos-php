<?php
    include_once "./funciones.php";

    echo "<form action='insertarMascota.php' method='post' enctype='multipart/form-data'>

        <label for='nombremascota'>Introduce el nombre de tu mascota</label>
        <input type='text' name='nombremascota' id='nombremascota'>
        <label for='imagenmascota'>Seleccionsa una imagen de tu mascota</label>
        <input type='file' name='imagenmascota' id='imagenmascota'>
        <label for='seleccionequipo'></label>
        <select name='seleccionequipo' id='seleccionequipo'>";
                    
        $con = conexionBD();
        $resultado = mysqli_query($con, "SELECT nombre_eq FROM equipo");

        while ($fila=mysqli_fetch_assoc($resultado)){
            echo "<option>".$fila['nombre_eq']."</option>";
        }

        echo "</select>
        <button type='submit'>Enviar</button>

     </form>";