import Game from "./models/Game.js";

window.onload = () => {
    const ALL_COLOR_PIECES = document.querySelectorAll(".colorPiece");
    const CHECK_BUTTON = document.querySelector(".checkButtonDiv > button");
    const USER_SEQUENCES = document.querySelectorAll(".sequence");
    const MSG_BOX = document.querySelector(".messageBox");
    new Game(ALL_COLOR_PIECES,CHECK_BUTTON,USER_SEQUENCES,MSG_BOX);
}