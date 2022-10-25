<?php

if (!isset($_SESSION['informacion']) || isset($_REQUEST['reset'])) {
    $_SESSION['informacion'] = [];
}

if (isset($_REQUEST['informacion'])){
    $_SESSION['informacion'] = $_REQUEST['informacion'];
    echo $_SESSION['informacion'];;
}


// BOTON DE RESET Y DESTROY SESSION


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
    </style>
</head>
<body>
    <main>
        <form action="index.php">
            <input type="text" name="informacion">
            <input type="submit" name="enviarSubmit">
            <input type="submit" value="reset" name="reset">
        </form>
    </main>
</body>
</html>
<?php

?>