<?php
session_start();
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

if (isset($_REQUEST['camion'])){
    $_SESSION['gasolineras'] = null;
}

//TODO cuando camion, reset.
if (!isset($_SESSION['gasolineras']) || $_SESSION['gasolineras'] == null) {
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
            "color" => "rojo"
        )
    );
} else {
    $gasolineras = $_SESSION['gasolineras'];
}

if (isset($_SESSION['cola'])) {
    $cola = $_SESSION['cola'];

    if ((sizeof($cola) > 3) && isset($_REQUEST['camion'])) {
        if ($_REQUEST['camion']) $cola = deleteLastCar($cola);
    }

    if (isset($_REQUEST['color'])) {
        $colorReq = $_REQUEST['color'];
        $lastCar = getLastCar($cola);
        if ($colorReq == $lastCar['color'] && $_REQUEST['litros'] > 0) {
            $llenado = $_REQUEST['litros'];
            // check litros gas disponibles
            $pickedGasolinera = getGasolinera($colorReq, $gasolineras);
            // update gasolinera
            if ($llenado <= $pickedGasolinera['litros']) {
                $pickedGasolinera['litros'] = $pickedGasolinera['litros']-$llenado;
                $gasolineras = updateGasolinera($pickedGasolinera, $gasolineras);
            }
        }
        //  update car
        $totalDeposito = $lastCar['deposito'] + $llenado;

        if ($lastCar['maxDeposito'] >= $totalDeposito) {
            $lastCar['deposito'] = $totalDeposito;
        }

        $cola = updateLastCar($lastCar, $cola);
    }
}






$cola = fillCola($cola);

$_SESSION['cola'] = $cola;
$_SESSION['gasolineras'] = $gasolineras;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasolinera</title>
    <style>
        .coche {
            margin: 60px;
        }
    </style>
</head>

<body>
    <?php
    foreach ($cola as $coche) {
        echo '<div style="display: inline-block; margin: 10px;">';
        printHtml($coche['color'], "margin-right: 10px; ");
        echo '<div>Depósito: ' . $coche['deposito'] . '/' . $coche['maxDeposito'] . '</div>';
        echo '</div>';
    }

    foreach ($gasolineras as $gas) {
        echo '<div style="display: inline-block; margin: 20px;">';
        printHtml('gas-' . $gas['color'], "width: 100px;");
        echo BR . '<strong>Litros:</strong>: ' . $gas['litros'];
    ?>
        <form action="index.php">
            <?php
            echo '<input type="hidden" name="color" value="' . $gas['color'] . '">';
            ?>
            <input type="number" name="litros" style="width: 40px;">€
            <input type="submit" value="Pagar">
        </form>
    <?php
        echo '</div>';
    }
    echo '<a href="index.php?camion=true">';
    echo '<img src="/img/camion.png" style="margin-left:15px; width: 200px"></img>';
    echo '</a>';
    ?>
</body>

</html>

<?php

function printHtml($var, $style)
{
    echo '<img src="/img/' . $var . '.png" style="' . $style . '"></img>';
}

function generateCar()
{
    $coche = COCHES[rand(0, 2)];
    $coche['maxDeposito'] = rand(90, 100);
    return $coche;
}

function updateLastCar($car, $cola)
{
    $cola[3] = $car;
    return $cola;
}

function deleteLastCar($cola)
{
    array_pop($cola);
    return $cola;
}

function getLastCar($cola)
{
    return $cola[3];
}

function fillCola($cola)
{
    if (sizeof($cola) < MAX_COLA) {

        for ($i = sizeof($cola); $i < MAX_COLA; $i++) {
            array_unshift($cola, generateCar());
        }
    }

    return $cola;
}

function getGasolinera($color, $gasolineras)
{
    foreach ($gasolineras as $gasolinera) {
        if ($gasolinera['color'] == $color) return $gasolinera;
    }
}

function updateGasolinera($newGasolinera, $gasolineras)
{
    foreach ($gasolineras as $key => $gasolinera) {
        if ($gasolinera['color'] == $newGasolinera['color']) {
            $gasolineras[$key] = $newGasolinera;
            var_dump($gasolineras[$key]);
        }
    }
    return $gasolineras;
}
?>