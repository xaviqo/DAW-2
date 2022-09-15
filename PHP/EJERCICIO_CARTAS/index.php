<?php

    $numero=['AS',2,3,4,5,6,7,8,9,10,'JOTA','REINA','REY'];
    $palo=['corazones','picas','diamantes','treboles'];

    function createDeck($palo,$numero) { 

        $deck = [];

        foreach ($palo as $p) {
            foreach ($numero as $n){
                array_push($deck, [strtolower($p),$n]);
            }
        }

        shuffle($deck);
        return $deck;
    }

    function showDeck($deck){
        foreach ($deck as $value) {
            echo '<img src="'.$value[1]."-".$value[0].'" alt="'.strtolower($value[1])."-".$value[0].'>';
        }
    }

    echo '<br/>';

    function play($deck, $players, $cardsToGive){

        $game = [];

        for ($i=0; $i < $players ; $i++) { 

            $player = [];
            $playerCards = [];

            for ($k=0; $k < $cardsToGive; $k++) { 

                $playerCards[$k] = array_pop($deck);

            }

            $player = array("cards"=>$playerCards,"name"=>"Player_".$i);

            array_push($game,$player);
        }

        return $game;
    }

    $newDeck = createDeck($numero,$palo);

    foreach(play($newDeck,4,5) as $player) {
        echo '<strong>Name: '.$player["name"].'</strong><br/>';
        foreach ($player["cards"] as $card) {
            echo '<img src="EJERCICIO_CARTAS/baraja/'.$card[1].'-'.$card[0].'.gif" alt="">';
        }
        echo '<br/><br/>';
    }

?>

