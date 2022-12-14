import Game from "./models/Game.js";

window.onload = () => {
    const ALL_COLOR_PIECES = document.querySelectorAll(".colorPiece");
    const CHECK_BUTTON = document.querySelector(".checkBtn");
    const RESET_BUTTON = document.querySelector(".resetBtn");
    const USER_SEQUENCES = document.querySelectorAll(".sequence");
    const RESULT_SEQUENCES = document.querySelectorAll(".allResults > div");
    const MSG_BOX = document.querySelector(".messageBox");
    new Game(ALL_COLOR_PIECES,CHECK_BUTTON,RESET_BUTTON,USER_SEQUENCES,RESULT_SEQUENCES,MSG_BOX);
}