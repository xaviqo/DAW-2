const game = {
    turn: 0,
    playing: 'one',
    shot: 0
}

window.onload = () => {
    createBoard();
    createAmazons();
    document.getElementById('turn').innerText = game.turn;
    document.querySelectorAll('.figure').forEach( fig => {
        fig.addEventListener('click', e => {
            if (e.target.getAttribute('player') === game.playing){
                
            }
        });
    });
}

function createAmazons() {

    //<i className="fa-solid fa-chess-queen"></i>

    const outterBoard = document.getElementById("outterBoard");

    outterBoard.childNodes.forEach((row, i) => {
        row.childNodes.forEach((cell, k) => {
            const figure = createFigure(i);
            if ((i == 0 || i == 9) && (k == 3 || k == 6)) cell.appendChild(figure);
            if ((i == 3 || i == 6) && (k == 0 || k == 9)) cell.appendChild(figure);
        });
    });
}

function createFigure(player){
    const figure = document.createElement('i');
    figure.classList.add('fa-solid','fa-chess-queen','figure');
    if (player > 4){
        figure.classList.add('blackfig');
        figure.setAttribute('player','one');
    } else {
        figure.classList.add('whitefig');
        figure.setAttribute('player','two');
    }
    return figure;
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
            cell.addEventListener('click', () => {
                if (game.shot > 0) console.log("se puede disparar")
            } )
            row.appendChild(cell);
        }
        document.getElementById("outterBoard").appendChild(row);
    }

}