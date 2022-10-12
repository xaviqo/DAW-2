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

if (isset($_SESSION['cola'])){
    $cola = $_SESSION['cola'];
} 

// crear cola coches
if (sizeof($cola) < MAX_COLA) {
    for ($i=sizeof($cola); $i < MAX_COLA; $i++) { 
        $cola[$i] = generateCar();
    }
}
$_SESSION['cola'] = $cola;


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
            echo '<div style="display: inline-block; margin: 10px;">';
            printHtml($coche['color'],"margin-right: 10px; ");
            echo '<div>Depósito: '.$coche['deposito'].'/'.$coche['maxDeposito'].'</div>';
            echo '</div>';
        }

        foreach ($gasolineras as $gas) {
            echo '<div style="display: inline-block; margin: 20px;">';
            printHtml('gas-'.$gas['color'],"width: 100px;");
            echo BR.'<strong>Litros:</strong>: '.$gas['litros'];
            ?>
            <form>
                <?php
                echo '<input type="hidden" name="gas" value="'.$gas['color'].'">';
                ?>
                    <input type="number" name="" style="width: 40px;">€
                    <input type="button" value="Pagar">
            </form>
            <?php
            echo '</div>';
        }
        echo '<img src="/img/camion.png" style="margin-left:15px; width: 200px"></img>'
    ?>
</body>

</html>

<?php

    function printHtml($var,$style){
        echo '<img src="/img/'.$var.'.png" style="'.$style.'"></img>';
    }

    function generateCar(){
        $coche = COCHES[rand(0,2)];
        $coche['maxDeposito'] = rand(90,100);
        return $coche;
    }

?>