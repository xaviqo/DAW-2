import Sequence from "./Sequence.js";
import Result from "./Result.js";

export default class Game {

    _colorPieces_HTML;
    _checkButton_HTML;
    _resetButton_HTML;
    _userSequences_HTML;
    _results_HTML;
    _msg_box_HTML;
    _winnerSequence;
    _trySequence;
    _tries;
    _win;

    constructor(colorPieces_HTML,checkButton_HTML,resetButton_HTML,userSequences_HTML,results_HTML,msg_box_HTML) {
        this._colorPieces_HTML = colorPieces_HTML;
        this._checkButton_HTML = checkButton_HTML;
        this._resetButton_HTML = resetButton_HTML;
        this._userSequences_HTML = userSequences_HTML;
        this._results_HTML = results_HTML;
        this._msg_box_HTML = msg_box_HTML;
        this._tries = [];
        this._winnerSequence = new Sequence();
        this._trySequence = new Sequence();
        this._win = false;
        this.eventListeners();
        this.generateWinnerSequence();
    }

    eventListeners(){

        this.colorPieces_HTML.forEach( el => {
        el.addEventListener('click', ev => {
            if (!this.win){
                this.trySequence.setPiece(this.getEventColor(ev));
                this.printSequence(this.trySequence);
            }
            });
        });

        this.checkButton_HTML.addEventListener('click', () => {
            if (!this.win) {
                if (this.isTrySequenceReady()){
                    const result = new Result(this.winnerSequence,this.trySequence);
                    this.printResult(result);
                    this.setTry(result);
                } else {
                    this.messageBox('⚠️ Your sequence is not ready ⚠️');
                }
            }
        });

        console.log(this.resetButton_HTML)
        this.resetButton_HTML.addEventListener('click', () => {
            window.location.reload();
        });
    }

    get results_HTML() {
        return this._results_HTML;
    }

    messageBox(msg){
        this.msg_box_HTML.innerHTML = msg;
        setTimeout(() => this.msg_box_HTML.innerHTML = '',4000 );
    }

    printSequence(seq){
        seq.pieces.forEach( (color,index) => {
            this.userSequences_HTML[this.getTryPosition()].children[index].className = `piece ${color}`;
        })
    }

    printResult(res){
        const white = 4 - (res.colorPosition + res.colorOnly);
        for (let i = 0; i < res.colorPosition; i++) {
            this.results_HTML[this.getTryPosition()].children[i].className = `resultHoleGreen`;
        }
        for (let k = res.colorPosition; k < (res.colorPosition + res.colorOnly); k++) {
            this.results_HTML[this.getTryPosition()].children[k].className = `resultHoleWhite`;
        }
        for (let j = (res.colorPosition + res.colorOnly); j < white; j++) {
            this.results_HTML[this.getTryPosition()].children[j].className = `resultHole`;
        }
        this.win = res.win;
        this.trySequence = new Sequence();
        if (this.win){
            this.messageBox('🥳 Awesome! You got the sequence right 🥳');
        }
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
        console.log(this.winnerSequence)
    }

    getEventColor(piece){
        return piece.target.classList[2];
    }

    isTrySequenceReady(){
        return (this.trySequence.pieces.length === 4);
    }

    get win() {
        return this._win;
    }

    set win(value) {
        this._win = value;
    }

    get resetButton_HTML() {
        return this._resetButton_HTML;
    }

    set resetButton_HTML(value) {
        this._resetButton_HTML = value;
    }

    get msg_box_HTML() {
        return this._msg_box_HTML;
    }

    set msg_box_HTML(value) {
        this._msg_box_HTML = value;
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

    setTry(value) {
        this._tries.push(value);
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