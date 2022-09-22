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
            grid-template-rows: 3fr 1fr;
        }

        .center{
            display: flex;
            justify-content: center;
        }

        .betForm {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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
    </style>
</head>

<body>
    <div class="center">
        <img src="tapeteRuleta.png" style="width: 150px; transform: rotate(-90deg);" />
    </div>
    <form action="bet.php">
        <div class="betForm">
            <div class="fakeBr">
                <div>
                    <b>APUESTA:</b>
                </div>
                <div>
                    <select name="type">
                        <option value="simple">simple</option>
                        <option value="falta">falta/pasa (1/0/</option>
                    </select>
                </div>
            </div>
            <div class="fakeBr">
                <b>NUMERO:</b>
                <input type="text" name="num">
            </div>
            <div class="fakeBr">
                <b>CANTIDAD:</b>
                <input type="text" name="bet">
            </div>
        </div>
        <div class="center" style="margin-top: 10%;">
            <input type="submit" value="ENVIAR"></input>
        </div>
    </form>
</body>

</html>