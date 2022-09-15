<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajedrez</title>
    <style>
        .white{
            background-color: white;
            width: 80px;
            height: 80px;
            display: inline-block;
        }
        .black{
            width: 80px;
            height: 80px;
            background-color: black;
            display: inline-block;
        }
        .iColor {
            color: greenyellow;
        }
    </style>
</head>
<body>
<?php
    for ($k=0; $k < 8; $k++) {
        if ($k % 2 != 0){
            for ($i=0; $i < 8; $i++) {
                if ($i % 2 != 0){
                        echo "<div class='white'>
                        </div>";
                } else {
                        echo "<div class='black'/>
                        </div>";
                }
            }
        } else {
            for ($j=0; $j < 8; $j++) {
                if ($j % 2 == 0){
                        echo "<div class='white'>
                        </div>";
                } else {
                        echo "<div class='black'/>
                        </div>";
                }
            }
        }
        echo "<br/>";
    }
?>
</body>
</html>