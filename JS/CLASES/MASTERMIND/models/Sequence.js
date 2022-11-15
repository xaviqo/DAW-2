export default class Sequence {

    _pieces;

    constructor(){
        this._pieces = new Map();
    }

    get pieces() {
        return this._pieces;
    }

    holeNumber(){
        return this.pieces.size+1;
    }
    
    setPiece(color,piece){
        this._pieces.set(color,piece)
    }

    print(){
        this.pieces.forEach(piece => {

        })
    }

}