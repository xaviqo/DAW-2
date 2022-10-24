<html>
<style>
    .ficha {
        border: 1px solid black;
        height: 100px;
        width: 50px;
    }

    .bot {
        border-top: 1px solid black;
    }
    .contenedor {
        height: 50px;
        display: flex;
        flex-wrap: wrap;
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: repeat(3,1fr);
    }
    .punto {
        width: 6px;
        height: 6px;
        background-color: black;
        margin-top: 6px;
        margin-left: 12px;
        border-radius: 50%;

        display: inline-block;
    }

    .puntoR {
        margin-left: 28px;
    }
    .puntoM {
        margin-left: 21px;
    }
</style>
<?php


for ($i=0; $i <= 6; $i++) { 
    for ($k=$i; $k <= 6; $k++) { 
        printFicha($i,$k);
    }
}


?>
</html>
<?php
function printFicha($top, $bot)
{
?>
    <div class="ficha" style="display: inline-block; margin: 12px;">
        <div class="contenedor">
            <?php
            printDot($top);
            ?>
        </div>
        <div class="contenedor bot">
            <?php
            printDot($bot);
            ?>
        </div>
    </div>
<?php
}

function printDot($dots)
{

    echo '<div>';
    //TOP
    switch ($dots) {
        case 6:
        case 5:
        case 4:
            for ($i = 0; $i < 2; $i++) echo '<div class="punto"></div>';
            break;
        case 3:
        case 2:
            echo '<div class="punto puntoR"></div>';
            break;
    }
    echo '</div>';

    echo '<div>';
    //MID
    switch ($dots) {
        case 6:
            for ($i = 0; $i < 2; $i++) echo '<div class="punto"></div>';
            break;
        case 5:
        case 3:
        case 1:
            echo '<div class="punto puntoM"></div>';
            break;
    }
    echo '</div>';

    echo '<div>';
    //BOT
    switch ($dots) {
        case 6:
        case 5:
        case 4:
            for ($i = 0; $i < 2; $i++) echo '<div class="punto"></div>';
            break;
        case 3:
        case 2:
            echo '<div class="punto"></div>';
            break;
    }
    echo '</div>';
}
?>