<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RULETA FRANCESA</title>
    <style>
        body {
            background-color: #4C633C;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .center{
            display: flex;
            justify-content: center;
        }

        .betForm {
            display: grid;
            grid-template-columns: 1fr;
        }

        .betForm div {
            color: white;
        }

        .fakeBr{
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 1fr;
        }

        .betForm div input {
            margin: 0 10px 10 10px;
        }

        .betBox {
            padding: 0 15%;
            margin: 25% 25%;
        }
    </style>
</head>

<body>
    <div class="betBox">
        <form action="bet.php">
            <div class="betForm">
                <div class="fakeBr">
                    <div class="center">
                        <b>APUESTA:</b>
                    </div>
                    <div class="center">
                        <select name="type">
                            <option value="simple">Simple</option>
                            <option value="falta">Falta[0] / Passa[1] (0/1)</option>
                            <option value="parell">Parell[0] / Senar[1] (0/1)</option>
                            <option value="color">Vermell[0] / Negre[1] (0/1)</option>
                        </select>
                    </div>
                </div>
                <div class="fakeBr">
                    <b class="center">NUMERO/LUGAR:</b>
                    <input type="text" name="num">
                </div>
                <div class="fakeBr">
                    <b class="center">CANTIDAD:</b>
                    <input type="text" name="bet">
                </div>
            </div>
            <div class="center" style="margin-top: 4%;">
                <input type="submit" value="ENVIAR"></input>
            </div>
        </form>
    </div>
    <div class="center">
        <img src="tapeteRuleta.png" style="width: 35%; transform: rotate(-90deg);" />
    </div>
</body>

</html>