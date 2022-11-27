export default class Sequence {

    _pieces;

    constructor() {
        this._pieces = [];
    }

    setPiece(piece){
        if (this._pieces.length<4){
            this._pieces.push(piece);
        }
    }


    get pieces() {
        return this._pieces;
    }

    set pieces(value) {
        this._pieces = value;
    }
}