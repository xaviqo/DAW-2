export default class Board {

    _row;
    _col;
    _boardElement;
    _aliveCells;
    _toCheckCells;
    _startBtn;

    constructor(boardElement, row, col, startBtn) {
        this._boardElement = boardElement;
        this._row = row;
        this._col = col;
        this._aliveCells = [];
        this._startBtn = startBtn;
        this._toCheckCells = [];
    }

    printBoard(){
        for (let r = 0; r < this.row; r++) {
            const row = document.createElement('div');
            row.setAttribute('row',r.toString());
            row.classList.add('row');
            for (let c = 0; c < this.col; c++) {
                const col = document.createElement('div');
                col.classList.add('cell', 'dead');
                col.setAttribute('col',c.toString());
                col.addEventListener('click', (e)=> {
                    this.pushCell(e.target);
                });
                row.appendChild(col);
            }
            this.boardElement.appendChild(row);
        }
        this.startBtn.addEventListener('click', () => {
            this.startGame();
        });
    }

    startGame(){
        // change alive cells for querySelectorAll('alive');
        this.aliveCells.forEach( cell => {
            const row = cell.parentElement.attributes[0].value;
            const col = cell.attributes[1].value;
            this.recursiveCheck(row-1,col-1,1,[]);
        });
    }

    recursiveCheck(row,col,loop,nodeArr){
        //debugger;
        if (loop%3===0){
            row++;
        } else {
            col++;
            row = row-2;
        }
        if (loop < 10){
            if (loop !== 5){
                console.log("loop "+loop);
                console.log("row "+row);
                console.log("col "+col);
                this._toCheckCells.push(
                    this.boardElement.childNodes[row].children[col]
                );
            }
            this.recursiveCheck(row,col,++loop,nodeArr);
        }
        console.log(this.toCheckCells);
    }

    pushCell(cell){
        if (!this.isAlive(cell)){
            cell.classList.remove('dead')
            cell.classList.add('alive');
            this._aliveCells.push(cell);
        } else {
            cell.classList.remove('alive')
            cell.classList.add('dead');
            const indexOfCell = this.aliveCells.indexOf(cell);
            if (indexOfCell !== -1) this.aliveCells.splice(indexOfCell,1);
        }
    }

    isAlive(cell){
        return cell.classList[1] === 'alive';
    }

    get toCheckCells() {
        return this._toCheckCells;
    }

    get aliveCells() {
        return this._aliveCells;
    }

    get nextIterationCells() {
        return this._nextIterationCells;
    }

    set nextIterationCells(value) {
        this._nextIterationCells = value;
    }

    get boardElement() {
        return this._boardElement;
    }

    set boardElement(value) {
        this._boardElement = value;
    }

    get startBtn() {
        return this._startBtn;
    }

    set startBtn(value) {
        this._startBtn = value;
    }

    get row() {
        return this._row;
    }

    set row(value) {
        this._row = value;
    }

    get col() {
        return this._col;
    }

    set col(value) {
        this._col = value;
    }
}