<?php
include_once("./clases/Baraja.php");
include_once("./clases/Jugador.php");
include_once("./clases/Carta.php");
include_once("./clases/Partida.php");

const FIGURAS = ['amarillo','azul','rojo','verde'];
$cartas = [];
$jugadores = [];
$partida = null;

//session_destroy();
session_start();

if (!isset($_SESSION['partida']) || isset($_REQUEST['reset'])){


    $partida = new Partida();

    // CREAR CARTAS
    foreach (FIGURAS as $fig) {
        for ($i=0; $i <= 9 ; $i++) { 
            array_push($cartas,new Carta($i,$fig));
        }
    }

    // MEZCLAR CARTAS
    shuffle($cartas);

    // INTRODUCIR CARTAS EN PARTIDA
    $partida->setCartas($cartas);

    // SETEAR JUGADORES CON CARTAS EN PARTIDA
    for ($i=0; $i < 4; $i++) { 
        $jugador = new Jugador($partida->crearBaraja(),($i+1));
        $partida->setJugador($jugador);
    }

    // INICIAR PARTIDA
    $partida->start();

    // GUARDAR EN SESSION
    $_SESSION['partida'] = $partida;
}

if (isset($_SESSION['partida']) && (isset($_REQUEST['carta']) || isset($_REQUEST['pasar']))){
    
    $opcion_usuario = null;

    if (isset($_REQUEST['carta'])){
        $opcion_usuario = $_REQUEST['carta'];
        $removed_card = $_SESSION['partida']->getCurrentPlayer()->removeSelectedCard($opcion_usuario);

        

        $_SESSION['partida']->setCartaEnJuego($removed_card);
    } 

    //SI NO ES NULL Y NO HA PASADO TURNO
    if (isset($_REQUEST['pasar'])){
        $_SESSION['partida']->getCurrentPlayer()->setCarta($_SESSION['partida']->robar());
    }

    $_SESSION['partida']->nextTurno();
}

echo 'TURNO: <b>'.$_SESSION['partida']->getTurno().'</b><br/>';

// echo '<pre>';
// var_dump($_SESSION['partida']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUEGO UNO</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        .playingCard {
            display: flex;
            justify-content: center;
        }
        .players {
            display: grid;
            grid-template-columns: repeat(4,1fr);
        }
        .players div{
            margin: 15px;
            padding: 5px;
            background-color:steelblue;
        }
        .players div:nth-child(1){
            border: 2px yellowgreen solid;
        }
        .players div:nth-child(2){
            border: 2px yellow solid;
        }
        .players div:nth-child(3){
            border: 2px blue solid;
        }
        .players div:nth-child(4){
            border: 2px orangered solid;
        }
        div div a {
            margin: 5px;
            cursor: pointer;
        }
        .pasarTurno {
            margin: 15;
            font-size: large;
            text-decoration: none;
            background-color: yellowgreen;
            border-radius: 15px;
        }
    </style>
</head>
<body>
        <center>
            <form action="index.php" method="get">
                <input type="submit" value="REINICIAR" name="reset">
            </form>
        </center>
    <main>
        <div class="playingCard">
            <?php
                echo '<img src="img/'.$_SESSION['partida']->getCartaEnJuego()->getImgUrl().'">';
            ?>
        </div>
        <div class="players">
            <?php
                $count_turno = 1;
                foreach ($_SESSION['partida']->getJugadores() as $player){ 
                    ?>
                        <div>
                            <b><?php echo 'PLAYER '.$player->getId() ?></b>
                            </br>
                            <div>
                                
                                <center>
                                <?php
                                    foreach ($player->getBaraja()->getCartas() as $key => $card) {
                                        if ($count_turno == $_SESSION['partida']->getTurno()){
                                            echo '<a href="index.php?carta='.$key.'">';
                                            echo '<img src="img/'.$card->getImgUrl().'"></a>';
                                        } else {
                                            echo '<img src="img/back.png">';
                                        }
                                    }
                                    echo '<br/>';
                                    if ($count_turno == $_SESSION['partida']->getTurno()) echo '<a href="index.php?pasar">';
                                    echo '<button class="pasarTurno">PASAR TURNO</button>';
                                    if ($count_turno == $_SESSION['partida']->getTurno()) echo '</a>';
                                    echo '<br/>';
                                    if ($count_turno == $_SESSION['partida']->getTurno()){
                                        echo '<a href="pdf.php?player='.$count_turno.'">';
                                        echo '<button class="pasarTurno">PDF</button>';
                                        echo '</a>';
                                    }
                                ?>
                                </center>
                            </div>
                        </div>
                    <?php
                    $count_turno++;
                }

            ?>
            <hr></hr>
        </div>
    </main>
    <div style="margin-top: 5vh;">
        <center>
            <form action="index.php" method="get">
                <input type="submit" value="REINICIAR">
            </form>
            <center>
            <form action="pdf.php" method="get">
                <input type="submit" value="REINICIAR">
            </form>
        </center>
    </div>
</body>
</html>
<?php
?>