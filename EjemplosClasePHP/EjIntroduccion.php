<?php
echo "<h3>Crea un script en PHP con dos variables numéricas, la primera indicará cuantas veces debemos imprimir el segundo por pantalla, 
pero en cada iteración muestra el valor anterior multiplicado por 2. Por ejemplo, si las variables valen 4 y 6 la salida será: 6 12 24 48.</h3>";

$repeticiones=4;
$var1=6;
echo $var1 ." ";
for($i=1;$i<$repeticiones;$i++){
    $var1=($var1 * 2);
    if($i==$repeticiones){
        echo $var1.".";
    }else{
    echo $var1 ." ";
    }
}

echo "<h3>Juan y Miguel juegan al baloncesto en equipos diferentes. En los últimos tres partidos el equipo de Juan consiguió 89,120 y 103 puntos, 
  mientras que el de Miguel consiguió 116, 94 y 123</h3>";
   
echo "<h4>Calcula la puntuación media de cada equipo</h4>";
$array["Juan"]=array(89, 120, 103);
$array["Miguel"]=array(116, 94, 123);

function calcMedia($array){
    $acumulador=0;
    foreach($array as $numero){
        $acumulador += $numero;
    }
    return $acumulador / count($array);
}

echo "La media de Juan es " .calcMedia($array["Juan"]);
echo "<br>La media de Miguel es " .calcMedia($array["Miguel"]);

echo "<h4>Decide qué equipo tiene mejor media de puntuación e imprime el ganador por pantalla. Incluye en la salida también 
        la media de puntuación del equipo.</h4>";

if(calcMedia($array["Miguel"]) > calcMedia($array["Juan"])){
    echo "La media del equipo de Miguel es mejor";
}elseif(calcMedia($array["Miguel"]) < calcMedia($array["Juan"])){
    echo "<br>La media del equipo de Juan es mejor";
}

echo "<h4>María también juega al baloncesto y su equipo consiguió 97, 134 y 105 puntos. 
        Como antes, registra en la consola el equipo de los tres que tenga mejor puntuación media.</h4>";

$array["Maria"]=array(97, 134, 105);

if(calcMedia($array["Miguel"]) > calcMedia($array["Juan"])){
    echo "La media del equipo de Miguel es mejor";
}elseif(calcMedia($array["Miguel"]) < calcMedia($array["Juan"])){
    echo "<br>La media del equipo de Juan es mejor";
}elseif(calcMedia($array["Maria"]) > calcMedia($array["Juan"])){
    echo "<br>La media del equipo de Maria es mejor";
}elseif(calcMedia($array["Maria"]) > calcMedia($array["Miguel"])){
    echo "<br>La media del equipo de Maria es mejor";
}

/*Juan y su familia se fueron de vacaciones a EE.UU. y comieron en tres restaurantes distintos. Pagaron 124, 48 y 268$. Allí todo el mundo deja propina, así que Juan quiere crear una calculadora de propinas. Ha pensado que le gustaría dar un 20 % de propina si la factura es menor de 50 $, 15 % si la factura está entre 50 $ - 200 $ y un 10 % si la factura es de más de 200 $.
   Al final, a Juan le encantaría tener tres arrays:

   * El primero contiene el valor de todas las facturas. Este no se calcula, hay que crear el array poniendo a mano los valores
   * El segundo contiene las tres propinas (una por cada factura)
   * El tercero contiene las tres cantidades finales que tiene que pagar 

   Muestra el resultado por pantalla debidamente formateado.*/

/*Crea una función que reciba tres parámetros (nombre de producto, precio e impuesto en porcentaje sobre 100). La función hará lo siguiente:

   * Los parámetros deberán tener un valor por defecto por si no los recibe que deben ser: "Producto genérico", 100 y 21.
   * Si los números no son válidos (NaN) muestra un error. Si son válidos, muestra por consola el nombre del producto y el precio final contando impuestos.*/

?>