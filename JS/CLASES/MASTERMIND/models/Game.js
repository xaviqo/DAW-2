export default class Game {

    _tries;
    _winnerSequence;

    constructor(){
        this._tries = [];
        this._winnerSequence = null;
    }

    get tries() {
        return this._tries;
    }

    set tries(value){
        this._tries = value;
    }

    get winnerSequence() {
        return this._winnerSequence;
    }
    set winnerSequence(value) {
        this._winnerSequence = value;
    }
    
    whereToPrint(){
        return this.tries.length+1;
    }
    
}