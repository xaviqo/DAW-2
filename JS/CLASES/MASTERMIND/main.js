import Game from './models/Game.js';
import Sequence from './models/Sequence.js';
import Result from './models/Result.js';

const piecesMap = new Map();
const colors = [];
const game = new Game();
const userSequence = new Sequence();

window.onload = () => {

    const SEQ_HTML = document.querySelector('.sequence');
    const NUM_HTML = document.querySelector('.allNumbers');
    const RES_HTML = document.querySelector('.result');
    const ALL_SEQ_HTML_DIV = document.querySelector('.allSequences');
    const ALL_RES_HTML_DIV = document.querySelector('.allResults');
    const ALL_COLOR_PIECES = document.querySelectorAll('.allPieces > div');
    const EMPTY_HOLE = document.querySelector('.seqHole');
    const CHECK_BTN = document.querySelector('.checkButtonDiv > button');

    SEQ_HTML.remove();
    RES_HTML.remove();

    for (let i = 10; i > 0; i--) {
        NUM_HTML.innerHTML += `<div>${i}</div>`;

        SEQ_HTML.setAttribute('id', `seq_${i}`);
        ALL_SEQ_HTML_DIV.appendChild(SEQ_HTML.cloneNode(true));

        RES_HTML.setAttribute('id', `res_${i}`);
        ALL_RES_HTML_DIV.appendChild(RES_HTML.cloneNode(true));
    }

    ALL_COLOR_PIECES.forEach(piece => {

        piecesMap.set(pieceColor(piece), piece.cloneNode(true));
        colors.push(pieceColor(piece));

        piece.addEventListener('click', ev => {

            const PLAYING_HOLES = document.querySelector(`#seq_${game.whereToPrint()}`);
            PLAYING_HOLES.innerHTML='';

            if (userSequence.pieces.size < 4){

                userSequence.setPiece(
                    pieceColor(ev.target)+'-'+userSequence.holeNumber(),
                    piecesMap.get(pieceColor(ev.target)).cloneNode(true)
                );

            }

            let remainingHoles = 4;

                for (let piece of userSequence.pieces.values()) {
                    piece.setAttribute('hole',remainingHoles);
                    PLAYING_HOLES.appendChild(piece);
                    remainingHoles--;
                }
    
                for (let y = 0; y < remainingHoles; y++) {
                    PLAYING_HOLES.appendChild(EMPTY_HOLE.cloneNode(true));
                }


        })

    });

    CHECK_BTN.addEventListener('click', () => {
        //CHECK userSequence against winnerSequence
        console.log(game.winnerSequence);
    });

    const winnerSequence = new Sequence();

    for (let k = 0; k < 4; k++) {
        const color = colors[Math.floor(Math.random() * piecesMap.size)];
        winnerSequence.setPiece(color,piecesMap.get(color));
    }

    game.winnerSequence = winnerSequence;

}

const pieceColor = (piece) => {
    return piece.className.split(' ')[1];
}