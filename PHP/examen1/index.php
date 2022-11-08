<?php
session_start();
const PRE = '<pre>';
const BR = '<br/>';

//reset
if (isset($_REQUEST['reset'])) {
    echo 'reset';
    $gastos = array(
        "black_gasto" => 1.2,
        "yellow_gasto" => 0.2,
        "magenta_gasto" => 0.4,
        "cyan_gasto" => 0.2,
    );
    $impresoras = array(
        array(
            "black" => 200,
            "yellow" => 200,
            "cyan" => 200,
            "magenta" => 200,
            "cola" => [],
            "max" => 200
        ),
        array(
            "black" => 250,
            "yellow" => 250,
            "cyan" => 250,
            "magenta" => 250,
            "cola" => [],
            "max" => 250
        ),
        array(
            "black" => 500,
            "yellow" => 500,
            "cyan" => 500,
            "magenta" => 500,
            "cola" => [],
            "max" => 500
        )
    );
    $_SESSION["impresoras"] = $impresoras;
    $_SESSION["gastos"] = $gastos;
    $_SESSION["numero_impresiones"] = 0;
}

//enviar a cola 
if (isset($_REQUEST['n_impresora'])) {
    $_SESSION["numero_impresiones"] = $_SESSION["numero_impresiones"] + 1; //NO ME FUNCIONA ++ LOL
    $num_imp = $_REQUEST['n_impresora'];

    // METER TEXTO EN COLA
    array_push($_SESSION["impresoras"][$num_imp]['cola'], $_REQUEST['texto']);

}

//imprimir
if (isset($_REQUEST['impresora'])){
    $num_imp = $_REQUEST['impresora'];
    $txt_imp = quitarDeCola($num_imp);
    echo $txt_imp;
    if (restarDeToners($num_imp,$txt_imp)){
        // restar de toner
    } else {
        echo '<strong> LA IMPRESORA '.$num_imp.' NO TIENE NINGUN DOCUMENTO EN COLA </stong>'.BR;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .tinta {
            width: 50px;
            height: 50px;
            float: left;
            padding: 5px;
        }
    </style>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body>
    <main>
        <div class="container">
            <div class="row">
                <h3>Hojas:</h3>
                <?php
                echo $_SESSION["numero_impresiones"];
                ?>
                <p>Introduce la impresora y el texto a imprimir</p>
                <form action="index.php" method="get" class="form-inline" role="form">Impresora: <select class="form-control" name="n_impresora">
                        <option value="0">Impresora0</option>
                        <option value="1">Impresora1</option>
                        <option value="2">Impresora2</option>
                    </select><textarea class="form-control" rows="4" name="texto"></textarea><input type="submit" value="Enviar a impresora"></form>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="row"><a href="index.php?impresora=0"><img src="http://nadia.cat/copisteria/A2.jpg" alt="Procesa cola"></a></div>
                    <div class="row">
                        <div class="toner">
                            <div class="tinta" style="background-color:black">
                            <?php
                                printPercent(0,"black");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:yellow">
                            <?php 
                                printPercent(0,"yellow");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:cyan">
                            <?php 
                                printPercent(0,"cyan");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:magenta">
                            <?php 
                                printPercent(0,"magenta");
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="list-group">
                            <?php
                            printarTexto($_SESSION["impresoras"][0]);
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row"><a href="index.php?impresora=1"><img src="http://nadia.cat/copisteria/A3.jpg" alt="Procesa cola"></a></div>
                    <div class="row">
                        <div class="toner">
                            <div class="tinta" style="background-color:black">
                            <?php
                                printPercent(1,"black");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:yellow">
                            <?php 
                                printPercent(1,"yellow");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:cyan">
                            <?php 
                                printPercent(1,"cyan");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:magenta">
                            <?php 
                                printPercent(1,"magenta");
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="list-group">
                            <?php
                            printarTexto($_SESSION["impresoras"][1]);
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row"><a href="index.php?impresora=2"><img src="http://nadia.cat/copisteria/A4.jpg" alt="Procesa cola"></a></div>
                    <div class="row">
                        <div class="toner">
                            <div class="tinta" style="background-color:black">
                            <?php
                                printPercent(2,"black");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:yellow">
                            <?php 
                                printPercent(2,"yellow");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:cyan">
                            <?php 
                                printPercent(2,"cyan");
                            ?>
                            </div>
                            <div class="tinta" style="background-color:magenta">
                            <?php 
                                printPercent(2,"magenta");
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="list-group">
                            <?php
                            printarTexto($_SESSION["impresoras"][2]);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <form action="index.php" method="get">
            <input type="submit" name="reset" value="reiniciar">
        </form>
    </main>
</body>

</html>
<?php

function printPercent($n_imp,$color)
{
    echo calcPorcentaje($_SESSION["impresoras"][$n_imp][$color],$_SESSION["impresoras"][0]["max"]).'ml';
}

function restarDeToners($n_imp, $texto)
{

    //TODO: MIRAR LO DE TEXTO NULL Y TAL
    if ((strlen($texto) <= $_SESSION["impresoras"][$n_imp]["black"])) {
        $_SESSION["impresoras"][$n_imp]["black"] -= strlen($texto);
        $_SESSION["impresoras"][$n_imp]["yellow"] -= strlen($texto);
        $_SESSION["impresoras"][$n_imp]["cyan"] -= strlen($texto);
        $_SESSION["impresoras"][$n_imp]["magenta"] -= strlen($texto);
        return true;
    } else {
        return false;
    }
}

function quitarDeCola($n_imp)
{
    return array_shift($_SESSION["impresoras"][$n_imp]['cola']);
}


function printarTexto($impresora)
{
    foreach ($impresora["cola"] as $txt) {
        echo '<li>' . $txt . '</li>';
    }
}

function calcPorcentaje($tinta,$max){
    return ($tinta/$max*100);
}


echo PRE;
var_dump($_SESSION["impresoras"]);
?>