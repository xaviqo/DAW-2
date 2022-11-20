import Game from "./models/Game.js";
import Sequence from "./models/Sequence.js";
import Result from "./models/Result.js";

const piecesMap = new Map();
const colors = [];
// const userSequence = new Sequence();

window.onload = () => {
  const SEQ_HTML = document.querySelector(".sequence");
  const NUM_HTML = document.querySelector(".allNumbers");
  const RES_HTML = document.querySelector(".result");
  const ALL_COLOR_PIECES = document.querySelectorAll(".allPieces > div");
  const EMPTY_HOLE = document.querySelector(".seqHole");
  const CHECK_BTN = document.querySelector(".checkButtonDiv > button");

  const game = new Game(
    SEQ_HTML,
    NUM_HTML,
    RES_HTML,
    ALL_COLOR_PIECES,
    EMPTY_HOLE
  );

  const winnerSequence = new Sequence();

  for (let k = 0; k < 4; k++) {
    const color = [...game.colorPiecesMap.keys()][Math.floor(Math.random() * 8)];
    winnerSequence.setPiece(color+"_"+k, game.colorPiecesMap.get(color));
  }

  game.winnerSequence = winnerSequence;

  console.log(game.winnerSequence);

  game.activateListeners();
  game.newSequence = new Sequence();

  CHECK_BTN.addEventListener("click", () => {
    if (game.isSequenceReady()) {
      game.tries = game.sequenceResult();
    } else {
      alert("Your sequence is not ready.");
    }
  });
};
