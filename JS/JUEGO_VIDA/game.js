import Board from "./model/Board.js";

window.onload = () => {

    const ROWS = 20;
    const COLS = 15;
    const BOARD_ELE = document.getElementById('board');
    const START_BTN = document.getElementById('start');

    const board = new Board(BOARD_ELE,ROWS,COLS,START_BTN);
    board.printBoard();

}