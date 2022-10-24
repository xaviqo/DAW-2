<?php
const BR = '<br/>';
const PRE = '<pre>';
session_start();
$operaciones = [];
$tarea = null;
$solucion = null;
$respuesta = null;

$arrayBien = [];
$arrayMal = [];


if (!isset($_SESSION['operaciones']) || isset($_REQUEST['reset'])) {
    $_SESSION['operaciones'] = generarOperaciones();
    $_SESSION['bien'] = [];
    $_SESSION['mal'] = [];
}
var_dump($_SESSION['operaciones']);

$operaciones = $_SESSION['operaciones'];
$arrayBien = $_SESSION['bien'];
$arrayMal = $_SESSION['mal'];
$tarea = array_pop($operaciones);
$solucion = getSolucion($tarea);

if (isset($_REQUEST["respuesta"])){
    $respuesta = $_REQUEST["respuesta"];

    if (checkRespuesta($solucion,$respuesta)){
        array_push($arrayBien,$tarea);
    } else {
        array_push($arrayMal,$tarea);
    }

    //eliminarTarea($operaciones);

    $_SESSION['bien'] = $arrayBien;
    $_SESSION['mal'] = $arrayMal;
    $_SESSION['operaciones'] = $operaciones;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>operaciones</title>
    <style>
        .tareas {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="tareas">
        <?php
            printArray($operaciones);
        ?>
    </div>
    <div>
        <div>
            <strong>BIEN:</strong><br/>
            <?php
                printArray($arrayBien);
            ?>
        </div>
        <div>
            <strong>MAL:</strong><br/>
            <?php
                printArray($arrayMal);
            ?>
        </div>
    </div>
    <div>
            <strong>TAREA:</strong><br/>
            <?php
                echo $tarea;
            ?>
        </div>
    <form action="index.php">
        <input type="text" name="respuesta">
        <input type="submit" value="enviar" name="enviar">
    </form>
    <form>
        <input type="submit" value="reset" name="reset">
    </form>
</body>
</html>
<?php

function generarOperaciones(){
    $symbols = array('+','-','x');
    $newOperaciones = [];
    for ($i=0; $i < 10; $i++) { 
        array_push($newOperaciones,
        rand(0,9).$symbols[rand(0,2)].rand(0,9));
    }
    return $newOperaciones;
}

function getTarea($operaciones){
    //return $operaciones[sizeof($operaciones)-1];
    return array_pop($operaciones);
}

function eliminarTarea($operaciones){
    array_pop($operaciones);
}


function checkRespuesta($solucion,$respuesta){
    return ($solucion == $respuesta);
}

function getSolucion($tarea){
    switch ($tarea[1]) {
        case 'x':
            return $tarea[0]*$tarea[2];
        case '-':
            return $tarea[0]-$tarea[2];
        case '+':
            return $tarea[0]+$tarea[2];
    }
}

function printArray($arrayN){
    if (count($arrayN)>0) {
        foreach ($arrayN as $op) {
            echo $op.BR;
        }
    }
}
?>