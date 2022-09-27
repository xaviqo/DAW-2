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

    function cavallGame($rnd,$num) {
        return in_array($rnd,explode("-",$num));
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

    function dotzenaGame($rnd,$num){
        
        switch ($num) {
            case 0:
                $num = explode("-","1-12");
                break;
            case 1:
                $num = explode("-","12-24");
                break;
            case 2:
                $num = explode("-","25-36");
                break;
            default:
                return false;
        }

        return (($num[0] >= $rnd) || ($num[1] <= $rnd));
    }

    function quadreGame($rnd,$num){
        return in_array($rnd,array($num,$num+1,$num+3,$num+4));
    }

    // SWITCH GAME //

    if (validValue($num)) {

        $win = false;
        $mult = 1;
        
        //$rnd = 2;

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
                $mult = 3;
                $win = dotzenaGame($rnd,$num);
            case 'transversal':
                break;
            case 'quadre':
                $mult = 8;
                $win = quadreGame($rnd,$num);
                break;
            case 'cavall':
                $mult = 17;
                $win = cavallGame($rnd,$num);
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