<?php

/*Crea una función que reciba tres parámetros 
(nombre de producto, precio e impuesto en porcentaje sobre 100). La función hará lo siguiente:

   * Los parámetros deberán tener un valor por defecto por si no los recibe que deben ser: "Producto genérico", 100 y 21.
   * Si los números no son válidos (NaN) muestra un error. Si son válidos, muestra por consola el nombre del producto y el precio final contando impuestos.*/

foreach($_GET as $clave => $valor){
    //echo "El valor para la clave $clave es: $valor <br>";
}

$producto = $_GET['producto'];
$precio = $_GET['precio'];
$impuesto = $_GET['impuesto'];

function calcTotal($precio, $impuesto){
    $impuesto=$precio*($impuesto/100);
    $total=$precio+$impuesto;
    return $total;
}

function valido($producto="Producto Generico",$precio=100,$impuesto=21){
    if(is_numeric($precio) && is_numeric ($impuesto)){
       $total = calcTotal($precio, $impuesto);
       return $total;
    }else{
        return false;
    }
}

echo "<br>El precio total de $producto es ".valido($producto,$precio,$impuesto);

