<?php
    $minNum = 0;
    $maxNum = 36;
    $rnd = rand($minNum,$maxNum);
    $br = "<br/>";
    $num = $_REQUEST['num'];
    $type = $_REQUEST['type'];
    $bet = $_REQUEST['bet'];
    $mult= multiplicador($type);

    echo "Valid Num: ".validValue($num).$br;
    echo "Número: ".$num.$br;
    echo "Type: ".$type.$br;
    echo "Mult: ".$mult.$br;
    echo "Apuesta: ".$bet.$br;
    echo "#############".$br;

    if (validValue($num)) {

    } else {
        echo "INVALID INPUT";
        exit();
    }

    function switchGame($tipo){
        switch ($tipo) {
            case 'simple':
                break;
            case 'falta':
                break;
            case 'parell':
                break;
            case 'color':
                break;
            case 'dotzena':
                break;
            case 'quadre':
                break;
            case 'transversal':
                break;
            case 'cavall':
                break;
            case 'columna':
                break;
            default:
                echo "INVALID GAME TIME";
                break;
        }
    }

    function multiplicador($tipo){
        switch ($tipo) {
            case 'sisena':
                return 5;
            case 'quadre':
                return 8;
            case 'transversal':
                return 11;
            case 'cavall':
                return 11;
            default:
                return 2;
        }
    }

    function simpleGame($rnd,$num){
        $num = $_REQUEST['num'];
        echo "RANDOM: ".$rnd.$GLOBALS['br'];
        echo "NUMERO: ".$num.$GLOBALS['br'];
        if ($num==$rnd){
            echo "GANASTE: ".$GLOBALS['bet']*$GLOBALS['mult'];
        }
    }

    function validValue($num) {
        return ($num > $GLOBALS['minNum'] && $num < $GLOBALS['maxNum']);
    }
?>