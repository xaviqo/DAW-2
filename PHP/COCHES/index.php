<?php
$cola = [];
const BR = '<br/>';
const MAX_COLA = 4;
const COCHES = array(
    array(
        "deposito" => 0,
        "maxDeposito" => 0,
        "color" => "azul"
    ),
    array(
        "deposito" => 0,
        "maxDeposito" => 0,
        "color" => "verde"
    ),
    array(
        "deposito" => 0,
        "maxDeposito" => 0,
        "color" => "rojo"
    )
);

$gasolineras = array(
    array(
        "litros" => 1000,
        "color" => "azul"
    ),
    array(
        "litros" => 1000,
        "color" => "verde"
    ),
    array(
        "litros" => 1000,
        "color" => "azul"
    )
);

if (sizeof($cola) < MAX_COLA) {
    for ($i=sizeof($cola); $i < MAX_COLA; $i++) { 
        $cola[$i] = generateCar();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasolinera</title>
    <style>
        .coche{
            margin: 60px;
        }
    </style>
</head>

<body>
    <?php
        foreach ($cola as $coche) {
            printHtml($coche['color']);
        }
    ?>
</body>

</html>

<?php
    function printHtml($var){
        echo '<img src="/img/'.$var.'.png" class="coche"></img>';
    }

    function generateCar(){
        $coche = COCHES[rand(0,2)];
        $coche['maxDeposito'] = rand(90,100);
        return $coche;
    }

?>