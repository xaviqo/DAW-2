<?php
echo '<center style="margin-top: 25px">';

echo '<form action="index.php">
<input type="text" name="tryNumber">
<input type="submit" value="send">
</form>';

$win = false;
$br = '<br/>';
session_start();
echo "Type reset to restart game".$br;

if ($_SESSION['win']) {
    session_destroy();
    header("Refresh:0");
}

if (!isset($_SESSION['random_number'])) {

    $_SESSION['random_number'] = rand(1,1000);
    $_SESSION['played_numbers'] = [];
    $_SESSION['win'] = false;

} elseif ($_REQUEST['tryNumber'] == 'reset') {



} else {
    
    $try = count($_SESSION['played_numbers']);
    $num = (int)$_REQUEST['tryNumber'];
    $rnd = (int)$_SESSION['random_number'];
    array_push($_SESSION['played_numbers'],$_REQUEST['tryNumber']);

    if ($num == $rnd){
        echo "Correcto!";
        $win = true;
    } elseif ($num > $rnd){
        echo "El número es menor";
    } elseif ($num < $rnd){
        echo "El número es mayor";
    }
        echo $br;

    if ($win) {
        array_push($_SESSION['win'],true);
    } elseif ($try < 10) {
        echo "Te quedan ".(10-$try)." intentos.";
    } elseif ($try==10){
        echo "Ya no te quedan intentos, el número era ".$rnd;
    } else {
        session_destroy();
        header("Refresh:0");
    }

}
?>