<?php
    $minNum = 0;
    $maxNum = 36;
    $rnd = rand($minNum,$maxNum);
    $br = "<br/>";
    $num = $_REQUEST['num'];
    $type = $_REQUEST['type'];
    $bet = $_REQUEST['bet'];
    $mult=0;

    // PRINT INFO //

    echo "Valid Num: ".validValue($num).$br;
    echo "Número Apuesta: ".$num.$br;
    echo "Random: ".$rnd.$br;
    echo "Type: ".$type.$br;
    echo "Mult: ".$mult.$br;
    echo "Apuesta: ".$bet.$br;
    echo "#############".$br;

    // FUNCTIONS //

    function simpleGame($rnd,$num){
        return ($num==$rnd);
    }

    function faltaGame($rnd,$num){
        $falta = ($num==0);
        if ($rnd != 18){
            $result = ($rnd<$GLOBALS['maxNum']/2);
            return ($falta=$result);
        } else {
            return false;
        }
    }

    function parellGame($rnd,$num){
        return ($rnd%2==$num);
    }

    function colorGame($rnd,$num) {
        if ($rnd>0){
            if (($rnd>10 && $rnd<18) || $rnd>28){
                $rnd++;
            }
            return ($rnd%2!=$num);
        } else {
            return false;
        }
    }

    // SWITCH GAME //

    if (validValue($num)) {

        $win = false;
        $mult = 1;

        switch ($type) {
            case 'simple':
                $mult = 35;
                $win = simpleGame($rnd,$num);
                break;
            case 'falta':
                $win = faltaGame($rnd,$num);
                break;
            case 'parell':
                $win = parellGame($rnd,$num);
                break;
            case 'color':
                $win = colorGame($rnd,$num);
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

        if ($win) {
            echo "GANASTE: ".$bet*$mult.$br;
            echo "TOTAL: ".$bet+=$bet*$mult;
        } else {
            echo "HAS PERDIDO...";
        }

    } else {
        echo "INVALID INPUT";
        exit();
    }

    function validValue($num) {
        return ($num >= $GLOBALS['minNum'] && $num <= $GLOBALS['maxNum']);
    }
?>