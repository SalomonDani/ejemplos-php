<?php

$array["Miguel"]=array(102,25,32);
$array["Juan"]=array(52,25,87);
$array["Maria"]=array(104,2,95);

/*1*/
function calcSuma($array){
    $acumulador=0;
    foreach($array as $numero){
        $acumulador += $numero;
    };
    return $acumulador;
}

echo calcSuma($array["Miguel"]);

/*2*/
function calcMedia($array){
    $acumulador=0;
    foreach($array as $numero){
        $acumulador += $numero;
    }
    return $acumulador / count($array);
}

echo "<br>". calcMedia($array["Miguel"]);