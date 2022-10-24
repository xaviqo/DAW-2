<?php
session_start();
if (isset($_REQUEST['destroy'])){
    session_destroy();
    session_start();
}
const BR = '<br/>';
const MAX_VIAJEROS = 50;
const ADD_VIAJEROS = 10;
$estacion = [];
$viajeros = 0;

if (!isset($_SESSION['estacion'])){
    $_SESSION['estacion'] = iniciarEstacion();
    $_SESSION['viajeros'] = $viajeros;
}

$estacion = $_SESSION['estacion'];
$viajeros = $_SESSION['viajeros'];

if (isset($_REQUEST['rail']) && isset($_REQUEST['vagon'])){
    $rail = $_REQUEST['rail'];
    $vagon = $_REQUEST['vagon'];

    $viajeros = $viajeros + ADD_VIAJEROS;

    $estacion = setPasajeros($rail,$vagon,$estacion);
} elseif (isset($_REQUEST['salida'])) {
    $salida = $_REQUEST['salida'];
    array_splice($estacion,$salida,1);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trenes</title>
</head>
<body>
    <strong> Total viajeros nuevos: </strong>
    <?php
        echo $viajeros.BR;
        printEstacion($estacion);
    ?>
    <form action="index.php">
        <br/>
        <input type="submit" value="reset" name="destroy">
    </form>
</body>
</html>
<?php

function setPasajeros($rail,$vagon,$estacion){
    $estacion[$rail][$vagon] = $estacion[$rail][$vagon] + ADD_VIAJEROS;
    return $estacion;
}

function printEstacion($estacion){

    for ($i=0; $i < sizeof($estacion); $i++) {
        printMarchar($i);
        echo '<div style="display: flex;">';
        for ($k=0; $k < sizeof($estacion[$i]); $k++) {
            echo '<div style="display: flex; flex-wrap: wrap; wdith: 100px;">';
            printVagon($i,$k);
            echo BR.$estacion[$i][$k];
            echo '</div>';
        }
        echo '</div>';
    }
}

function printVagon($railId,$vagonId){
    echo '<a href="index.php?rail='.$railId.'&vagon='.$vagonId.'">';
    echo '<img src="vagon.jpg" style="width: 120px"/></a>';
}

function printMarchar($railId){
    echo '<a href="index.php?salida='.$railId.'"><<<</a>';
}

function iniciarEstacion() {

    $estacion = [];

    for ($i=0; $i < 6; $i++) {
        $vagones = randomVagones();
        for ($k=0; $k < $vagones; $k++) { 
            $estacion[$i][$k] = randomViajeros();
        }
    }

    return $estacion;

}

function randomViajeros(){
    return rand(10,40);
}

function randomVagones(){
    return rand(3,6);
}
$_SESSION['viajeros']  = $viajeros;
$_SESSION['estacion'] = $estacion;
?>