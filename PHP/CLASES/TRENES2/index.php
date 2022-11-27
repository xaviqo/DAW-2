<?php
require 'smarty-4.2.1/libs/Smarty.class.php';
require 'model/Tren.php';
require 'model/Vagon.php';

session_start();
$pasajeros = 0;
if (!isset($_SESSION['estacion']) || isset($_REQUEST['reset'])){

    $estacion = [];

    //generar trenes
    for ($i = 0; $i <= 5; $i++) {
        array_push($estacion,new Tren($i,getRandomVagones()));
    }

    $_SESSION['estacion'] = $estacion;

}

if (isset($_REQUEST['tren']) && isset($_REQUEST['vagon'])){
    $tren = $_REQUEST['tren'];
    $vagon = $_REQUEST['vagon'];

    $_SESSION['estacion'][$tren]->introducirPasajerosVagon($vagon);
}

if (isset($_REQUEST['salir'])){
    $tren = $_REQUEST['salir'];
    $_SESSION['estacion'][$tren]->salir();
}

foreach ($_SESSION['estacion'] as $tren) {
    $pasajeros+=$tren->ocupado();
}

//echo '<pre>';
//var_dump($_SESSION['estacion']);

$smarty = new Smarty();
$smarty->assign("estacion",$_SESSION['estacion']);
$smarty->assign("pasajeros",$pasajeros);
$smarty->display("template.tpl");

function getRandomVagones(){
    $cuantos = rand(2,6);
    $array_vagones = [];
    for ($i = 0; $i <= $cuantos; $i++) {
        array_push($array_vagones,new Vagon($i,getRandomViajeros()));
    }
    return $array_vagones;
}

function getRandomViajeros(){
    return rand(10,30);
}