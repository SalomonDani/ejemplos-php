<?php


/*Define un función que muestre todos los elementos de un array que se 
pase por parámetro. Nota: el array solamente tendrá una dimensión.*/

$array = array ("hola", "adios", "es miernes");

function imprimirArray($miarray){
    foreach ($miarray as $cadena){
        echo "$cadena <br>";
    }
}

imprimirArray($array);

$array = array ("hola", "adios", "es miernes");

function imprimirArrayCapital($miarray){
    foreach ($miarray as $cadena){
        $cadena[0]=strtoupper($cadena[0]); 
        echo "$cadena <br>";
    }
}

imprimirArrayCapital($array);

/*Crea una función que ponga la primera letra de cada palabra en 
mayúscula para una cadena de caracteres que reciba como parámetro.*/

$cadena = "hola que tal bb, tas bien";

function estiloTitulo($cadena){
    $i=0;
    do{
        if($i==0){
            $cadena[$i]=strtoupper($cadena[$i]);
        }elseif($cadena[$i]==" "){
            $cadena[$i+1] = strtoupper($cadena[$i+1]);
        }
        $i++;

    }while($i<strlen($cadena));
    return $cadena;
}

echo estiloTitulo($cadena);


/*Crea una función que recibiendo un número variable de parámetros 
numéricos calcule la media aritmética de los mismos.*/

/*Crea un función que pasados dos arrays los una en una matriz de dos diménsiones que se le pase como un tercer parámetro por referencia.*/

/*Crear una función que pasado un IBAN (Número de cuenta corriente) por parámetro devuelva en una array con las claves pais, ccontrol, cbanco, csucursal, ccontrol, ccuenta. Además realiza dentro de la función la comprobación de que el número IBAN es correcto.*/

?>