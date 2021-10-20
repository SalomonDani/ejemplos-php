<?php
/*Juan y su familia se fueron de vacaciones a EE.UU. y comieron en tres restaurantes distintos. 
Pagaron 124, 48 y 268$. Allí todo el mundo deja propina, 
así que Juan quiere crear una calculadora de propinas. 
Ha pensado que le gustaría dar un 20 % de propina si la factura 
es menor de 50 $, 15 % si la factura está entre 50 $ - 
200 $ y un 10 % si la factura es de más de 200 $.
   Al final, a Juan le encantaría tener tres arrays:

   * El primero contiene el valor de todas las facturas. 
     Este no se calcula, hay que crear el array poniendo a mano los valores
   * El segundo contiene las tres propinas (una por cada factura)
   * El tercero contiene las tres cantidades finales que tiene que pagar 

   Muestra el resultado por pantalla debidamente formateado.*/

//Accedemos solo a los valores del array
foreach($_POST as $parametro){
    echo "<br>El paramtro que se ha pasado por web es: $parametro";
}

//Acceder a los valore pero tambien a las claves

foreach($_POST as $clave => $valor){
    echo "<br> El parametro con nombre $clave tiene el valor: $valor";
}

//Acceso a un valor del array asociativo mediante su clave
echo "<br> El gasto en el tercer restaurante es de ".$_POST['Rest3'];

//Funcion calcula porcentaje sobre un numero en este caso la propina
function  calcPropina($numero, $porcentaje){
    return $numero*($porcentaje/100);
}

//Funcion que suma un valor a otro en este caso el precio mas la propina
function calcTotal($percioComida, $propina){
    return $percioComida+$propina;
}

//Funcion que calcula el porcentaje aplicado sobre un numero, en este caso precio de comida
function calcPorcentajes($precioComida){
    $porcentaje=0;
    if($precioComida <=50){
        $porcentaje = 20;
    }elseif($precioComida>200){
        $porcentaje = 10;
    }else{
        $porcentaje = 15;
    }
    return $porcentaje;
}
    $arrayPropinas;
    $arrayTotal;


foreach($_POST as $clave=>$precioComida){
    $porcentaje =  calcPorcentajes($precioComida);
    $arrayPropinas[$clave] = calcPropina($precioComida,$porcentaje);
    $arrayTotal[$clave] = calcTotal($precioComida, $arrayPropinas[$clave]);
}

echo "<br>";
print_r($arrayPropinas);
print_r($arrayTotal);




