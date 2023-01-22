import {Move, Figure, game, wallChecks} from './database.js';

window.onload = () => {
    createBoard();
    createAmazons();
    changeTurn();
    document.querySelectorAll('.cell').forEach(cell => {
        cell.addEventListener('click', e => {

            if (game.movement === Move.Pick) return;

            const player = game.player;
            const movingFigure = game.movingFigure;
            const figure = document.querySelector(`.figure[player="${player}"][figure="${movingFigure}"]`);
            const oldPosition = {
                x: parseInt(figure.getAttribute('x')),
                y: parseInt(figure.getAttribute('y'))
            }
            const newPosition = {
                x: parseInt(e.target.getAttribute('x')),
                y: parseInt(e.target.getAttribute('y'))
            }
            const newCell = document.querySelector(`.cell[x="${newPosition.x}"][y="${newPosition.y}"]`);

            if (game.movement === Move.Shoot && checkMovementLimits(oldPosition,newPosition,null)){

                newCell.appendChild(document.createElement('span'));
                newCell.classList.add('wall');
                changeCellBackground(oldPosition.x,oldPosition.y,Move.Shoot,false);
                game.player = (player==='one')?'two':'one';
                checkAllFiguresStatus();
                changeTurn();
                game.movement = Move.Pick;
            }

            if (game.movement === Move.Move && checkMovementLimits(oldPosition,newPosition,null)){

                figure.setAttribute('x',newPosition.x);
                figure.setAttribute('y',newPosition.y);

                newCell.appendChild(figure);

                changeCellBackground(oldPosition.x,oldPosition.y,Move.Pick,false);
                changeCellBackground(newPosition.x,newPosition.y,Move.Shoot,true);
                game.movement = Move.Shoot;
            }

            console.log(game.movement);
        });
    });
    document.querySelectorAll('.figure').forEach( fig => {
        fig.addEventListener('click', e => {

            const player = e.target.getAttribute('player');
            const figure = e.target.getAttribute('figure');
            const x = e.target.getAttribute('x');
            const y = e.target.getAttribute('y');
            if (game.player !== player) return;

            if (game.movement === Move.Pick){
                game.movingFigure = figure;
                changeCellBackground(x,y,Move.Pick,true);
                setTimeout(() => game.movement = Move.Move,1);
            }

        });
    });
}

function paintAvailableCells(fig) {
    debugger;
    const figX = fig.getAttribute('x');
    const figY = fig.getAttribute('y');
    let keepCheckingArray = [true,true,true,true,true,true,true,true];

    while (!keepCheckingArray.every(Boolean)){
        for (let i = 0; i < 8; i++) {
            const xCheck = figX-wallChecks[i][0];
            const yCheck = figY-wallChecks[i][1];
            const cell = document.querySelector(`.cell[x="${xCheck}"][y="${yCheck}"]`);
            if (!cell.hasChildNodes() && keepCheckingArray[i]) cell.classList.add('canMove');
            else keepCheckingArray[i] = false;
        }
    }

}

function checkAllFiguresStatus() {
    Array.from(document.querySelectorAll('.figure')).forEach( fig => {
        if (checkFigureFreedom(fig)) {
            const player = fig.getAttribute('player');
            fig.classList.remove(Figure.Amazon);
            fig.classList.add(Figure.Dead);
            fig.removeAttribute('figure');
            fig.removeAttribute('player');
            game.lives[player]--;
            if (game.lives[player] < 1) alert(`Player ${(player==='one')?'two':'one'} won the game!`)
        }
    });
}

function checkFigureFreedom(fig){
    const figX = fig.getAttribute('x');
    const figY = fig.getAttribute('y');
    let aroundWalls = 0;

    for (let i = 0; i < 8; i++) {
        const xCheck = figX-wallChecks[i][0];
        const yCheck = figY-wallChecks[i][1];
        const checkingCell = document.querySelector(`.cell[x="${xCheck}"][y="${yCheck}"]`);
        if (checkingCell == null || checkingCell.classList.contains('wall')) aroundWalls++;
    }
    return (aroundWalls > 7);
}

function checkMovementLimits(oldPos,newPos,lastOffset){
    const nextOffset = {
        x: findNextMovement(oldPos.x,newPos.x),
        y: findNextMovement(oldPos.y,newPos.y)
    };
    if (nextOffset.x === 0 && nextOffset.y === 0) {
        return (lastOffset != null);
    }
    if (isLegalOffset(lastOffset,nextOffset)){

        const nextXpos = (oldPos.x+nextOffset.x);
        const nextYpos = (oldPos.y+nextOffset.y);
        const nodeToCheck = document.querySelector(`.cell[x="${nextXpos}"][y="${nextYpos}"]`);

        if (!nodeToCheck.hasChildNodes()){
            //nodeToCheck.classList.add('canMove');
            return checkMovementLimits({
                x: nextXpos,
                y: nextYpos
            },newPos,nextOffset);
        }
    }
    return false;
}
function isLegalOffset(lastOffset,newOffset){
    if (lastOffset == null) return true;
    return (lastOffset.x === newOffset.x &&
        lastOffset.y === newOffset.y);
}

function findNextMovement(op,np){
    if (op === np) return 0;
    if (np > op) return 1;
    if (np < op) return -1;
}

function createAmazons() {

    //<i className="fa-solid fa-chess-queen"></i>
    const figuresId = { 'one': 1, 'two': 1 };
    const board = document.getElementById("board");

    board.childNodes.forEach((row, i) => {
        row.childNodes.forEach((cell, k) => {
            if (setFigure(i,k)){
                const playerId = (i > 4)?'two':'one';
                const figureId = figuresId[playerId];
                const figure = createFigure(i,playerId,figureId);
                figuresId[playerId]++;
                figure.setAttribute('x',k);
                figure.setAttribute('y',i);
                cell.appendChild(figure);
            }
        });
    });
}

function createFigure(boardPosition,playerId,figureId){
    const figure = document.createElement('i');
    figure.classList.add('fa-solid',Figure.Amazon,'figure');
    figure.classList.add(playerId);
    figure.setAttribute('player',playerId);
    figure.setAttribute('figure',figureId);
    return figure;
}

function setFigure(i,k){
    return ((i == 0 || i == 9) && (k == 3 || k == 6)
        || (i == 3 || i == 6) && (k == 0 || k == 9));
}

function createBoard() {

    for (let i = 0; i < 10; i++) {
        const row = document.createElement('div');
        row.classList.add('row');
        for (let j = 0; j < 10; j++) {
            const cell = document.createElement('div');
            cell.classList.add('cell');
            if (i%2!==0){
                if (j%2 !== 0) cell.classList.add("blackbg");
                else cell.classList.add("whitebg");
            } else {
                if (j%2 !== 0) cell.classList.add("whitebg");
                else cell.classList.add("blackbg");
            }
            cell.setAttribute('x',j);
            cell.setAttribute('y',i);
            cell.setAttribute('status',true)
            row.appendChild(cell);
        }
        document.getElementById("board").appendChild(row);
    }
}

function changeTurn() {
    document.getElementById('turn').innerText = game.player;
}

function changeCellBackground(x,y,css,colorize){
    const cell = document.querySelector(`.cell[x="${x}"][y="${y}"]`);
    if (colorize) cell.classList.add(css);
    else cell.classList.remove(css);
}