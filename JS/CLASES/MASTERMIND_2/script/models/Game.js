import Sequence from "./Sequence.js";
import Result from "./Result.js";

export default class Game {

    _colorPieces_HTML;
    _checkButton_HTML;
    _userSequences_HTML;
    _results_HTML;
    _msg_box_HTML;
    _winnerSequence;
    _trySequence;
    _tries;

    constructor(colorPieces_HTML,checkButton_HTML,userSequences_HTML,results_HTML,msg_box_HTML) {
        this._colorPieces_HTML = colorPieces_HTML;
        this._checkButton_HTML = checkButton_HTML;
        this._userSequences_HTML = userSequences_HTML;
        this._results_HTML = results_HTML;
        this._msg_box_HTML = msg_box_HTML;
        this._tries = [];
        this._winnerSequence = new Sequence();
        this._trySequence = new Sequence();
        this.eventListeners();
        this.generateWinnerSequence();
        console.log(this.winnerSequence.pieces);
    }

    eventListeners(){
        this.colorPieces_HTML.forEach( el => {
        el.addEventListener('click', ev => {
            this.trySequence.setPiece(this.getEventColor(ev));
            this.printSequence(this.trySequence);
            });
        })

        this.checkButton_HTML.addEventListener('click', () => {
            if (this.isTrySequenceReady()){
                const result = new Result(this.winnerSequence,this.trySequence);
                this.printResult(result);
                this.tries = result;
            } else {
                 this.messageBox('⚠️ Your sequence is not ready ⚠️');
            }
        })
    }

    get results_HTML() {
        return this._results_HTML;
    }

    set results_HTML(value) {
        this._results_HTML = value;
    }

    messageBox(msg){
        this.msg_box_HTML.innerHTML = msg;
        setTimeout(() => this.msg_box_HTML.innerHTML = '',1000 );
    }

    printSequence(seq){
        seq.pieces.forEach( (color,index) => {
            this.userSequences_HTML[this.getTryPosition()].children[index].className = `piece ${color}`;
        })
    }

    printResult(res){
        console.log(res);
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
        this.trySequence = new Sequence();
    }

    getTryPosition(){
        return (this.userSequences_HTML.length - this.tries.length)-1;
    }

    generateWinnerSequence(){
        for (let i = 0; i < 4; i++) {
            //const randomPiece = Math.floor(Math.random() * this.colorPieces_HTML.length);
            //const color = this.colorPieces_HTML[randomPiece].classList[2];
            //this.winnerSequence.setPiece();
        }
        const testSeq = new Sequence();
        testSeq.setPiece("green");
        testSeq.setPiece("green");
        testSeq.setPiece("lilac");
        testSeq.setPiece("orange");
        this.winnerSequence = testSeq;
    }

    getEventColor(piece){
        return piece.target.classList[2];
    }

    isTrySequenceReady(){
        return (this.trySequence.pieces.length === 4);
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

    set tries(value) {
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