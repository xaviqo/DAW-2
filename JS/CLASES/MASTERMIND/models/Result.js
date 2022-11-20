export default class Result{

    _colorPosition;
    _onlyColor;
    _sequence;
    _winnerSequence;

    constructor(seq,wSeq){
        this._sequence = seq;
        this._winnerSequence = wSeq;

        // this.sequence.forEach(piece => {
        //     if ()
        // });
    }

    get sequence() {
        return this._sequence;
    }

    set sequence(value) {
        this._sequence = value;
    }

    get onlyColor() {
        return this._onlyColor;
    }

    get colorPosition() {
        return this._colorPosition;
    }

    print(){
    }

}