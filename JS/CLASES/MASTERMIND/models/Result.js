export default class Result{

    _colorPosition;
    _onlyColor;
    _playerSeq;
    _winnerSeq;

    constructor(playerSeq,winnerSeq){

        this._colorPosition = 0;
        this._onlyColor = 0;

        this._playerSeq = playerSeq;
        this._winnerSeq = winnerSeq;

        this.checkSequence();

    }

    checkSequence(){
        for (const wColor of this._winnerSeq.pieces.keys()){
            for (const pColor of this._playerSeq.pieces.keys()){
                if (this.checkColor(wColor,pColor)){
                    if (this.checkPosition(wColor,pColor)){
                        this.plusColorPos();
                    } else {
                        this.plusOnlyColor();
                    }
                }
            }
        }
    }

    checkColor(winner, player){
        return (winner.split("_")[0] == player.split("_")[0]);
    }

    checkPosition(winner,player){
        return (winner.split("_")[1] == player.split("_")[1]);
    }

    plusColorPos(){
        this._colorPosition++;
    }

    plusOnlyColor(){
        this._onlyColor++;
    }

    // get sequence() {
    //     return this._sequence;
    // }

    // set sequence(value) {
    //     this._sequence = value;
    // }

    get onlyColor() {
        return this._onlyColor;
    }

    get colorPosition() {
        return this._colorPosition;
    }

    print(where){
        const DIV_TO_DELETE = document.querySelectorAll(`#res_${where}`);
        const DIV_TO_PRINT = document.querySelector(`#res_${where}`);
        console.log(DIV_TO_PRINT);

        DIV_TO_DELETE.forEach(el => el.remove());

        const empty = '<div class="resultHole"></div>';
        const green = '<div class="resultHoleGreen"></div>';
        const white = '<div class="resultHoleWhite"></div>';

        let total = 4;

        for (let g = 0; g < this.colorPosition; g++) {
            DIV_TO_PRINT.innerHTML+=green;
            total--;
        }
        for (let w = 0; w < this.onlyColor; w++) {
            DIV_TO_PRINT.innerHTML+=white;
            total--;
        }
        for (let e = 0; e < total; e++) {
            DIV_TO_PRINT.innerHTML+=empty;
        }
    }

}