export default class Result {

    _colorOnly;
    _colorPosition;
    _winnerSequence;
    _trySequence;
    _win;

    constructor(winnerSequence, trySequence) {
        this._winnerSequence = winnerSequence;
        this._trySequence = trySequence;
        this._colorPosition = 0;
        this._colorOnly = 0;
        this._win = false;
        this.check();
    }

    check(){
        //debugger;
        for (let i = 0; i < this.trySequence.pieces.length; i++) {
            if (this.winnerSequence.pieces[i] === this.trySequence.pieces[i]){
                this.colorPosition+=1;
            } else {
                for (let j = 0; j < this.trySequence.pieces.length; j++) {
                    if (this.winnerSequence.pieces[i] === this.trySequence.pieces[j]) {
                        this.colorOnly+=1;
                        break;
                    }
                }
            }
        }
        this._win = (this.colorPosition === 4);
    }

    get win() {
        return this._win;
    }

    get colorOnly() {
        return this._colorOnly;
    }

    set colorOnly(value) {
        this._colorOnly = value;
    }

    get colorPosition() {
        return this._colorPosition;
    }

    set colorPosition(value) {
        this._colorPosition = value;
    }

    get winnerSequence() {
        return this._winnerSequence;
    }

    set winnerSequence(value) {
        this._winnerSequence = value;
    }

    get trySequence() {
        return this._trySequence;
    }

    set trySequence(value) {
        this._trySequence = value;
    }
}