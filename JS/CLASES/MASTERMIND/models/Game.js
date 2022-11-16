export default class Game {

    _tries;
    _winnerSequence;
    _newSequence;
    _seq_HTML;
    _num_HTML;
    _res_HTML;
    _colors;
    _colorPieces_HTML;
    _emptyHole_HTML;

    constructor(seq_HTML,num_HTML,res_HTML,colorPieces_HTML,emptyHole_HTML){

        this._tries = [];
        this._winnerSequence = null;
        this._newSequence = null;
        this._seq_HTML = seq_HTML;
        this._num_HTML = num_HTML;
        this._res_HTML = res_HTML;
        this._colors = new Array();
        this._colorPieces_HTML = colorPieces_HTML;
        this._emptyHole_HTML = emptyHole_HTML;

        for (let i = 10; i > 0; i--) {
            
            this.num_HTML.innerHTML += `<div>${i}</div>`;
    
            this.seq_HTML.setAttribute('id', `seq_${i}`);
            document.querySelector('.allSequences').appendChild(this.seq_HTML.cloneNode(true));
    
            this.res_HTML.setAttribute('id', `res_${i}`);
            document.querySelector('.allResults').appendChild(this.res_HTML.cloneNode(true));

        }

        this.seq_HTML.remove();
        this.res_HTML.remove();

    }

    activateListeners(){

        const piecesMap = new Map();

        this.colorPieces_HTML.forEach(piece => {

            piecesMap.set(this.pieceColor(piece), piece.cloneNode(true));
            this.colors.push(this.pieceColor(piece));
    
            piece.addEventListener('click', ev => {
        
                const PLAYING_HOLES = document.querySelector(`#seq_${this.whereToPrint()}`);
                PLAYING_HOLES.innerHTML='';
    
                if (this.newSequence.pieces.size < 4){
    
                    this.newSequence.setPiece(
                        this.pieceColor(ev.target)+'-'+this.newSequence.holeNumber(),
                        piecesMap.get(this.pieceColor(ev.target)).cloneNode(true)
                    );
    
                }
        
                let remainingHoles = 4;
    
                    for (let piece of this.newSequence.pieces.values()) {
                        piece.setAttribute('hole',remainingHoles);
                        PLAYING_HOLES.appendChild(piece);
                        remainingHoles--;
                    }
        
                    for (let y = 0; y < remainingHoles; y++) {
                        PLAYING_HOLES.appendChild(this.emptyHole_HTML.cloneNode(true));
                    }
    
            })
    
        });
    }

    get emptyHole_HTML() {
        return this._emptyHole_HTML;
    }
    set emptyHole_HTML(value) {
        this._emptyHole_HTML = value;
    }

    get colors() {
        return this._colors;
    }
    set colors(value) {
        this._colors = value;
    }

    get colorPieces_HTML() {
        return this._colorPieces_HTML;
    }

    set colorPieces_HTML(value) {
        this._colorPieces_HTML = value;
    }

    get res_HTML() {
        return this._res_HTML;
    }
    set res_HTML(value) {
        this._res_HTML = value;
    }
    get num_HTML() {
        return this._num_HTML;
    }
    set num_HTML(value) {
        this._num_HTML = value;
    }
    get seq_HTML() {
        return this._seq_HTML;
    }
    set seq_HTML(value) {
        this._seq_HTML = value;
    }
    get newSequence() {
        return this._newSequence;
    }
    set newSequence(value) {
        this._newSequence = value;
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
    
    isSequenceReady(){
        return (this._newSequence.holeNumber()>3);
    }

    whereToPrint(){
        return this.tries.length+1;
    }
    
    pieceColor(piece){
        return piece.className.split(' ')[1];
    }
}