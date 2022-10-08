<?php

const ALL_DECK = ['AS',2,3,4,5,6,7,8,9,10,'JOTA','REINA','REY'];
const CARD_SUIT = ['CORAZONES','PICAS','DIAMANTES','TREBOLES'];
const NUM_OF_PLAYERS = 4;
$total_cards = (sizeof(ALL_DECK)*sizeof(CARD_SUIT));

$ingame_cards = [];
$players = [];
$turn = 0;

if (!isset($_SESSION['cinquillo']) || !$_SESSION['cinquillo']) {
    
    session_start();
    $turn = 1;
    $suffled_cards = createAndShuffle();
    $players = eachPlayerCards($suffled_cards);

    $_SESSION['cinquillo'] = true;
    $_SESSION['turn'] = $turn;
    $_SESSION['players'] = $players;
    $_SESSION['ingame_cards'] = [];

    
} else {
    $turn = $_SESSION['turn'];
    $ingame_cards = $_SESSION['ingame_cards'];
    $players = $_SESSION['players'];
}

echo 
'<!DOCTYPE html>
<html>
<head>
    <title>PHP CINQUILLO</title>
    <style>
    </style>
</head>';

echo 
    '<body>
        <main>
        <form action="index.php">
        ';
printIngameCards($ingame_cards);
printPlayersFrame($players,$turn);
echo   '
        </form>
        </main>
    </body>';

function createAndShuffle(){

    $deck = [];

    foreach (CARD_SUIT as $s) {
        foreach (ALL_DECK as $f){
            array_push($deck, ['suit' => strtolower($s), 'fig' => strtolower($f)]);
        }
    }

    shuffle($deck);
    var_dump($deck);
    return $deck;
}

function printPlayersFrame($players,$turn){

    $playerId = 1;
    foreach ($players as $cards){
        echo '<strong>PLAYER_'.$playerId.'</strong> ';
        foreach ($cards as $card) printCard($playerId,$card,($playerId == $turn));
        echo '<br/>';
        $playerId++;
    }

}

function printCard($player,$card,$click){
    if ($click) echo '<a href="index.php?turn='.$player.'">';

    echo '<img src="baraja/'.$card['suit'].'-'.$card['fig'].'.gif">';

    if ($click) echo '</a>';
}

function printIngameCards($ingame_cards){

    foreach ($ingame_cards as $card) {
        explode("-",$card);
        echo $card;
    }

}

function eachPlayerCards($cards_to_deal){

    $cards = [];

    for ($i=0; $i < NUM_OF_PLAYERS; $i++) { 
        $player_cards = [];
        for ($k=0; $k < sizeof(ALL_DECK); $k++) {
            $card = array_pop($cards_to_deal);
            array_push($player_cards,$card);
        }
        $cards[$i] = $player_cards;
    }

    return $cards;

}

?>