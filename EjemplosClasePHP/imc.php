<?php
    $peso = 75;
    $altura = 1.70;

    $imc = $peso/($altura*$altura);

    echo "Tu IMC es: $imc";
    echo "</br>";

    if($imc > 20){
        echo "Te hace falta algun kilo";
    }else{
        echo "Tu peso ta piola";
    }