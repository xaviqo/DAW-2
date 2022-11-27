<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .vagon {
            display: inline-block;
        }
        img{
            width: 65px;
        }
    </style>
</head>
<body>
    <h1>Estación Xavi</h1>
    <h3>VIAJEROS: {$pasajeros}</h3>
    <br>
    <form action="index.php" method="get">
    <div>
        {foreach from=$estacion item=tren}
            <a href="index.php?salir={$tren->getId()}"><<<</a>
            {foreach from=$tren->getVagones() item=vagon}
                <div class="vagon">
                    <div>
                        <a href="index.php?tren={$tren->getId()}&vagon={$vagon->getId()}">
                            <img src="vagon.jpg">
                        </a>
                    </div>
                    <div>
                        {$vagon->getLibre()}
                    </div>
                </div>
            {/foreach}
            <br>
        {/foreach}
    </div>
        <input type="submit" value="reset" name="reset" style="margin-top: 15px">
    </form>
</body>
</html>