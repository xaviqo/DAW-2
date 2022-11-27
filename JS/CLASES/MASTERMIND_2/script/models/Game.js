import Sequence from "./Sequence.js";

export default class Game {

    _colorPieces_HTML;
    _checkButton_HTML;
    _userSequences_HTML;
    _winnerSequence;
    _trySequence;
    _tries;

    constructor(colorPieces_HTML,checkButton_HTML,userSequences_HTML) {
        this._colorPieces_HTML = colorPieces_HTML;
        this._checkButton_HTML = checkButton_HTML;
        this._userSequences_HTML = userSequences_HTML;
        this._tries = [];
        this._winnerSequence = new Sequence();
        this._trySequence = null;
        this.eventListeners();
        this.generateWinnerSequence();
        console.log(this._userSequences_HTML);
    }

    eventListeners(){
        this.colorPieces_HTML.forEach( el => {
        el.addEventListener('click', ev => {
            if (this.trySequence == null) this.trySequence = new Sequence();
            this.trySequence.setPiece(this.getEventColor(ev));
            this.printSequence(this.trySequence);
            });
        })

        this.checkButton_HTML.addEventListener('click', () => {
            if (this.isTrySequenceReady()){

            }
        })
    }

    printSequence(seq){
        seq.pieces.forEach( (color,index) => {
            this.userSequences_HTML[this.getTryPosition()].children[index].className = `piece ${color}`;
        })
    }

    getTryPosition(){
        return (this.userSequences_HTML.length - this.tries.length)-1;
    }

    generateWinnerSequence(){
        for (let i = 0; i < 4; i++) {
            const randomPiece = Math.floor(Math.random() * this.colorPieces_HTML.length);
            const color = this.colorPieces_HTML[randomPiece].classList[2];
            this.winnerSequence.setPiece(color);
        }
    }

    getEventColor(piece){
        return piece.target.classList[2];
    }

    isTrySequenceReady(){
        return (this.trySequence.pieces.length === 4);
    }


    get userSequences_HTML() {
        return this._userSequences_HTML;
    }

    set userSequences_HTML(value) {
        this._userSequences_HTML = value;
    }

    get checkButton_HTML() {
        return this._checkButton_HTML;
    }

    set checkButton_HTML(value) {
        this._checkButton_HTML = value;
    }

    get tries() {
        return this._tries;
    }

    set tries(value) {
        this._tries = value;
    }

    get trySequence() {
        return this._trySequence;
    }

    set trySequence(value) {
        this._trySequence = value;
    }

    get winnerSequence() {
        return this._winnerSequence;
    }

    set winnerSequence(value) {
        this._winnerSequence = value;
    }

    get colorPieces_HTML() {
        return this._colorPieces_HTML;
    }

    set colorPieces_HTML(value) {
        this._colorPieces_HTML = value;
    }
}