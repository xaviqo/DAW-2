<?php
session_start();

if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito']=[];
}
if(isset($_REQUEST['producto'])){
    array_push($_SESSION['carrito'], $_REQUEST['producto']);

}
if(isset($_REQUEST['id'])){
    array_splice($_SESSION['carrito'], $_REQUEST['id'],1);

}

echo '<form action="index.php" method="get">';
echo '<input type="text" name="producto"></input> ';
echo '<input type="submit" value="compra"></input> <br><br>';
echo '</form>';

foreach ($_SESSION['carrito'] as $key => $value) {
    echo $key.'-'.$value.'<a href="index.php?id='.$key.'">X</a><br>';
}

?>

