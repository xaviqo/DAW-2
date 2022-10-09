<?php
session_start();
const ALL_DECK = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
const CARD_SUIT = ['corazones', 'picas', 'diamantes', 'treboles'];
const NUM_OF_PLAYERS = 4;
const BR = '</BR>';

$total_cards = (sizeof(ALL_DECK) * sizeof(CARD_SUIT));

$ingame_cards = [];
$players = [];
$turn = 1;
$round = 1;
$valid_movement = false;

if (isset($_REQUEST['reset']) && isset($_SESSION['cinquillo']) && !isset($_REQUEST['spend'])) {
    session_destroy();
    header("Refresh:0");
}

if (!isset($_SESSION['cinquillo'])) {

    $_SESSION['valid_movement'] = false;
    $_SESSION['turn'] = 1;
    $_SESSION['round'] = 1;
    $_SESSION['players'] = eachPlayerCards(createAndShuffle());
    $_SESSION['ingame_cards'] = array(
        "corazones" => [],
        "picas" => [],
        "diamantes" => [],
        "treboles" => []
    );

    $valid_movement = false;
}
// load data
$turn = $_SESSION['turn'];
$round = $_SESSION['round'];
$players = $_SESSION['players'];
$ingame_cards = $_SESSION['ingame_cards'];


if (isset($_REQUEST['suit']) && isset($_REQUEST['fig'])) {

    $player_pos = ($turn - 1);


    $play_result = playCard($_REQUEST['suit'], $_REQUEST['fig'], $player_pos);

    if ($play_result > -1) $valid_movement = true;
} elseif (isset($_REQUEST['spend'])) {
    $valid_movement = true;
}

if ($valid_movement || !isset($_SESSION['cinquillo'])) {

    if (isset($_SESSION['cinquillo'])) {
        $turn++;
        if ($turn > 4) {
            $turn = 1;
            $round++;
        }
    }

    foreach (CARD_SUIT as $suit){

        if (sizeof($ingame_cards[$suit])>0){
            $ingame_cards[$suit] = sortCards($ingame_cards[$suit]);
        }
    
    }

    $_SESSION['cinquillo'] = true;
    $_SESSION['turn'] = $turn;
    $_SESSION['round'] = $round;
    $_SESSION['players'] = $players;
    $_SESSION['ingame_cards'] = $ingame_cards;
}



echo
'<!DOCTYPE html>
<html>
<head>
    <title>PHP CINQUILLO</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url("tablepattern.jpg");
            background-size: 20%;
            display: flex;
            justify-content: center;
        }
        .card {
            box-sizing: border-box;
            box-shadow: 2px 2px 3px grey;
            margin: 2px;
        }
        .playable:hover {
            box-shadow: 2px 2px 3px black;
        }
        .cardVoid img {
            transform: scale(1);
        }
        .cardVoid img:hover {
            transition-delay: 5s;
            transition: 1s;
            transform: translateY(-6px);
        }
        .spendBtn {
            background-color: #4CAF50;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            padding: 4px;
            border: 1px solid black;
            color: white;
            margin: 10px;
            cursor: pointer;
        }
        .spendBtn:hover {
            background-color: green;
            transition: 1s;
        }
        .outterPlayerDiv {
            border: 2px dotted black; 
            padding: 15px; 
            background-color: moccasin; 
            box-shadow: 0px 0px 5px gray;
            width: 40vw;
        }
        .playerDiv {
            border: 1px solid black; 
            padding: 5px; 
            margin: 3px; 
            background-color: darkseagreen; 
            box-shadow: 2px 2px 2px black;
        }
        .ingameCardsDiv {
            border: 2px dotted black; 
            padding: 15px; 
            background-color: moccasin; 
            box-shadow: 0px 0px 5px gray;
            width: 40vw;
            margin-bottom: 20px;
        }
    </style>
</head>';

echo '<body> 
        <main style="display:flex; justify-content: center; flex-wrap: wrap; max-width: 50%"> 
        <div class="ingameCardsDiv">';
printIngameCards($ingame_cards);
echo '</div>
        <form action="index.php">
        ';
printPlayersFrame($players, $turn);
echo   '<center style="margin-top: 2vh;">
            <input type="submit" value="RESET GAME" name="reset" class="spendBtn" style="color: black; font-size: 20px;">
        </center>
        </form>
        </main>
    </body>';

function createAndShuffle()
{

    $deck = [];

    foreach (CARD_SUIT as $s) {
        foreach (ALL_DECK as $f) {
            array_push($deck, ['suit' => strtolower($s), 'fig' => $f]);
        }
    }
    shuffle($deck);
    return $deck;
}

function printPlayersFrame($players, $turn)
{

    echo '<div class="outterPlayerDiv">';
    $playerId = 1;
    foreach ($players as $cards) {
        echo '<div class="playerDiv">';
        echo '<strong style="color: black; ">PLAYER ' . $playerId . '</strong>';
        if ($playerId == $turn) echo '<input type="submit" value="SPEND TURN" name="spend" class="spendBtn">';
        echo BR;
        foreach ($cards as $card) printCard($playerId, $card, ($playerId == $turn));
        echo BR;
        echo '</div>';
        $playerId++;
    }

    echo '</div>';
}

function printCard($player, $card, $show)
{
    if ($show) {
        echo '<a href="index.php?player=' . $player . '&suit=' . $card['suit'] . '&fig=' . $card['fig'] . '" class="cardVoid">';
        echo '<img src="baraja/' . $card['suit'] . '-' . numToFigure($card['fig']) . '.gif" class="card playable">';
        echo '</a>';
    } else {
        echo '<img src="baraja/back.gif" class="card">';
    }
}

function printIngameCards($ingame_cards)
{

    foreach (CARD_SUIT as $suit) {
        echo '<div>';
        if (sizeof($GLOBALS['ingame_cards'][$suit]) > 0) echo strtoupper($suit);
        echo '<div style="margin-left: 25px;">';
        foreach ($GLOBALS['ingame_cards'][$suit] as $card) {
            echo '<img src="baraja/' . $card['suit'] . '-' . numToFigure($card['fig']) . '.gif" class="card" style="margin-left: -20px;">';
        }
        echo '</div>
            </div>';
    }
}

function eachPlayerCards($cards_to_deal)
{

    $cards = [];

    for ($i = 0; $i < NUM_OF_PLAYERS; $i++) {
        $player_cards = [];
        for ($k = 0; $k < sizeof(ALL_DECK); $k++) {
            $card = array_pop($cards_to_deal);
            array_push($player_cards, $card);
        }
        $cards[$i] = $player_cards;
    }

    return $cards;
}

//TODO: CHECK IF ALREADY CONTAINS THAT CARD!
function playCard($suit, $fig, $player_pos)
{

    $itr = 0;
    foreach ($GLOBALS['players'][$player_pos] as $card) {

        if ($card['suit'] == $suit && $card['fig'] == $fig) {
            if (checkIfValid($card)) {
                array_splice($GLOBALS['players'][$player_pos], $itr, 1);
                return putIntoIngameCards($card);
            } else {
                //break;
            }
        }
        $itr++;
    }
    return -1;
}

function checkIfValid($card)
{

    $suit = $card['suit'];
    $fig = $card['fig'];
    $valid = false;

    if ($fig == 5) {
        $valid = true;
    } else {
        foreach ($GLOBALS['ingame_cards'][$suit] as $checkFig) {
            if ($fig - 1 == $checkFig['fig'] || $fig + 1 == $checkFig['fig']) $valid = true;
        }
    }

    return $valid;
}

function putIntoIngameCards($card)
{
    return array_push($GLOBALS['ingame_cards'][$card['suit']], $card);
}

function numToFigure($num)
{
    switch ($num) {
        case 1:
            return 'as';
        case 11:
            return 'jota';
        case 12:
            return 'reina';
        case 13:
            return 'rey';
        default:
            return $num;
    }
}

function sortCards($cardsArray)
{

    for($i=0;$i<count($cardsArray);$i++){
		$val = $cardsArray[$i]['fig'];
		$j = $i-1;
		while($j>=0 && $cardsArray[$j]['fig'] > $val){
			$cardsArray[$j+1]['fig'] = $cardsArray[$j]['fig'];
			$j--;
		}
		$cardsArray[$j+1]['fig'] = $val;
	}

    return $cardsArray;

}


?>