<?php

include_once("./clases/Baraja.php");
include_once("./clases/Jugador.php");
include_once("./clases/Carta.php");
include_once("./clases/Partida.php");
const FIGURAS = ['amarillo','azul','rojo','verde'];
$cartas = [];
$jugadores = [];


session_start();

if (!isset($_SESSION['partida'])){

    $partida = new Partida();

    // CREAR CARTAS
    foreach (FIGURAS as $fig) {
        for ($i=0; $i <= 9 ; $i++) { 
            array_push($cartas,new Carta($i,$fig));
        }
    }

    // INTRODUCIR CARTAS EN PARTIDA

    $partida->setCartas($cartas);

    // SETEAR JUGADORES CON CARTAS EN PARTIDA
    for ($i=0; $i < 4; $i++) { 
        $jugador = new Jugador($partida->crearBaraja());
        $partida->setJugador($jugador);
    }
    
    // GUARDAR EN SESSION
    $_SESSION['partida'] = $partida;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUEGO UNO</title>
    <style>
        main {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            display: grid;
            grid-template-columns: repeat(4,1fr);
        }
        main div{
            margin: 15px;
            padding: 5px;
        }
        main div:nth-child(1){
            border: 2px yellowgreen solid;
        }
        main div:nth-child(2){
            border: 2px green solid;
        }
        main div:nth-child(3){
            border: 2px blue solid;
        }
        main div:nth-child(4){
            border: 2px orangered solid;
        }
    </style>
</head>
<body>
    <main>
        <?php
            for ($j=1; $j <= 4; $j++) { 
                ?>
                    <div>
                        <b><?php echo 'JUGADOR_'.$j ?></b>
                    </div>
                <?php
            }
        ?>
    </main>
</body>
</html>