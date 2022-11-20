<?php
include_once('./clases/Comida.php');
include_once('./clases/Horno.php');
session_start();

const COMIDAS = ['pizza', 'burger', 'tortilla'];
const PRE = '<pre>';
const BR = '<br/>';

if (!isset($_SESSION['comidas']) || isset($_REQUEST['reset'])) {
    echo '<b>RESET</b>';
    foreach (COMIDAS as $comida) {
        $_SESSION["comidas"][$comida] = new Comida($comida);
        $_SESSION["hornos"][$comida] = new Horno($comida);
    }
    $_SESSION['total'] = 0;
    $_SESSION['total_toppings'] = 0;
}

if (isset($_REQUEST['pedido_nuevo'])){
    if ($_REQUEST['cantidad'] > 0){
        $cantidad = $_REQUEST['cantidad'];
        $tipo = $_REQUEST['tipo'];

        for ($i=0; $i < $cantidad; $i++) { 
            $_SESSION['hornos'][$tipo]->setCola(new Comida($tipo));
        }
    }
}

if (isset($_REQUEST['cocinar'])){
    $_SESSION['total_toppings'] = $_SESSION['hornos'][$_REQUEST['cocinar']]->totalToppings();
    $_SESSION['total'] = $_SESSION['hornos'][$_REQUEST['cocinar']]->cocinar();
}

if (isset($_REQUEST['topping'])){

    $com = $_REQUEST['comida'];
    $top = $_REQUEST['topping'];
    $pla = $_REQUEST['plato'];
    $act = $_REQUEST['activo'];

     $_SESSION['hornos'][$com]->getCola()[$pla]->setTopping($top,$act);

}

// var_dump($_SESSION["hornos"]);
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comida Rapida</title>
    <style>
        .selects {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
        .si{
            background-color: green;
            width: 4px;
            height: 2px;
            margin-right: 12px;
            padding: 2px;
            color: white;
        }
        .no{
            background-color: red;
            width: 4px;
            height: 2px;
            margin-right: 12px;
            padding: 2px;
            color: white;
        }
    </style>
</head>

<body>
    <section class="selects">
        <center>
            <?php
                echo 'TOTAL COCINADO: '.$_SESSION['total'].BR;
                echo 'TOTAL TOPPINGS: '.$_SESSION['total_toppings'].BR;
            ?>
        </center>
        <form action="index.php" method="get">
            <div>
                <h3>TIPO:</h3></br>
                <select name="tipo">
                    <?php
                    foreach (COMIDAS as $tipo) {
                        echo '<option>' . $tipo . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <h3>CANTIDAD:</h3></br>
                <input type="number" name="cantidad">
                <input type="submit" name="pedido_nuevo" value="ENVIAR">
            </div>
        </form>
    </section>
    <section>
        <form action="index.php" method="get">
            <?php
            foreach (COMIDAS as $comida) {
            ?>
                <div>
                    <h2>Horno de <?php echo $comida ?></h2>
                    <?php
                    echo '<a href="index.php?cocinar='.$comida.'">COCINAR</a>'
                    ?>
                    </br>
                    <ul>

                        <?php
                        foreach ($_SESSION['hornos'][$comida]->getCola() as $key => $plato) {
                            echo '<li>';
                            echo $comida . " " . $key." -> ";
                            echo $plato->getQueso() ? '<a class="si" href="index.php?plato='.$key.'&comida='.$comida.'&topping=queso&activo=false" >QUESO</a>' : '<a class="no" href="index.php?plato='.$key.'&comida='.$comida.'&topping=queso&activo=true" >QUESO</a>';
                            echo $plato->getCebolla() ? '<a class="si" href="index.php?plato='.$key.'&comida='.$comida.'&topping=cebolla&activo=false" >CEBOLLA</a>' : '<a class="no" href="index.php?plato='.$key.'&comida='.$comida.'&topping=cebolla&activo=true" >CEBOLLA</a>';
                            echo $plato->getPeperoni() ? '<a class="si" href="index.php?plato='.$key.'&comida='.$comida.'&topping=pepperoni&activo=false" >PEPERONNI</a>' : '<a class="no" href="index.php?plato='.$key.'&comida='.$comida.'&topping=pepperoni&activo=true" >PEPERONNI</a>';
                            echo $plato->getChampis() ? '<a class="si" href="index.php?plato='.$key.'&comida='.$comida.'&topping=champis&activo=false" >CHAMPIÑONES</a>' : '<a class="no" href="index.php?plato='.$key.'&comida='.$comida.'&topping=champis&activo=true" >CHAMPIÑONES</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            <?php
            }
            ?>
        </form>
        <form action="index.php" method="get">
            <input type="submit" name="reset" value="reiniciar">
        </form>
    </section>
    <input type="submit" value="SI">
    <input type="submit" value="NO" name="">
</body>
</html>