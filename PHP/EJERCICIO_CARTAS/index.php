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
        for ($i=0; $i <= $players ; $i++) { 
            $playerName = ["name"=>"Player_".$i];
            array_push($game,$playerName);
            for ($k=0; $k < $cardsToGive; $k++) { 
                $playerCards[$k] = array_pop($deck);
            }
            $playerCards = ["cards"=>$playerCards];
            array_push($game,$playerCards);
        }

        return $game;

    }

    $newDeck = createDeck($numero,$palo);
    $game = play($newDeck,2,4);
    
    echo '<pre>';
    var_dump($game);
    foreach($game as $val) {
        echo 'Name: '.$val.'<br/>';

        //var_dump($val['cards']);
    }

    // echo '<pre>';
    // var_dump(play($newDeck,7,3));
?>

