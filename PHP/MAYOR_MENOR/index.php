<?php
session_start();
echo "Type reset to restart game";
if (!isset($_SESSION['random_number'])) {

    $_SESSION['random_number'] = rand(1,1000);
    $_SESSION['played_numbers'] = [];

} elseif ($_REQUEST['tryNumber'] == 'reset') {

    session_destroy();
    header("Refresh:0");

} else {
    
    $try = count($_SESSION['played_numbers']);
    $num = $_REQUEST['tryNumber'];
    $rnd = $_SESSION['random_number'];
    array_push($_SESSION['played_numbers'],$_REQUEST['tryNumber']);

    if ($try <= 10) {
        echo "Te quedan ".(10-$try)." intentos.";
    } else {
        echo "No te quedan mas intentos :(";
        session_destroy();
        header("Refresh:0");
    }

    if ($num == $rnd){
        echo "Correcto!";
    } elseif ($num > $rnd){
        echo "El número es menor";
    } elseif ($rnd < $num){
        echo "El número es mayor";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mayor/Menor</title>
</head>
<body>
    <form action="index.php">
        <input type="text" name="tryNumber">
        <input type="submit" value="send">
    </form>
</body>
</html>