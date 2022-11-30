export default class Result {

    _colorOnly;
    _colorPosition;
    _winnerSequence;
    _trySequence;

    constructor(winnerSequence, trySequence) {
        this._winnerSequence = winnerSequence;
        this._trySequence = trySequence;
        this._colorPosition = 0;
        this._colorOnly = 0;
        this.check();
    }

    check(){
        //debugger;
        for (let i = 0; i < this.trySequence.pieces.length; i++) {
            const winColor = this.winnerSequence.pieces[i];
            for (let j = 0; j < this.trySequence.pieces.length; j++) {
                const tryColor = this.trySequence.pieces[j];
                if (winColor === tryColor && ((this.colorPosition+this.colorOnly)<4)){
                    if (i === j){
                        this.colorPosition+=1;
                    } else {
                        this.colorOnly+=1;
                    }
                }
            }
        }
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