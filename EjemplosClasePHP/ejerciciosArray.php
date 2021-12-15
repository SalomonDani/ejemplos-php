<?php
/*Define el siguiente array y cálcula la suma total de 
los valores que contiene.*/

$numeros=array(2, 24, 80, 5, 7, 20 ,32 ,45 ,67, 45, 78);

$resultado=0;
foreach($numeros as $numero){
    $resultado = $resultado + $numero;
}
    echo $resultado;
    echo "<br>";
    echo "El resultado de la suma del array es". array_sum($numeros);
    echo "<br>";

/*Calcula del array definido anteriormente el productorio de los valores
pares del array por una parte y los valores impares por otra parte.*/

$productPar=1;
$productImpar=1;

for($i=0;$i<count($numeros);$i++){
    if( $i % 2 == 0 ){
        $productPar=$productPar * $numeros[$i];
    }else{
        $productImpar=$productImpar * $numeros[$i];
    }
}

echo "<br>";
echo "El productorio de los elementos pares es: $productPar";
echo "<br>";
echo "El productorio de los elementos impares es: $productImpar";

/*Crear un código en php que compruebe si el valor 76 está incluido 
en el array anterior.*/

$posicion = array_search(76,$numeros);
if($posicion !=  null) {
    echo "<br>El elemento 76 esta en la posición". $posicion;
}else{
    echo "<br>No se ha encontrado el numero 76";
}

//Crear un código en php que elimine el último valor del array y lo muestre por pantalla. 

echo "<br> El ultimo elemento del array era ". array_pop($numeros);

/*Crear un código en php que elimine los valores duplicados en el array.*/

echo "<br>";
print_r(array_unique($numeros));

?>