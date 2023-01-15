const Figure = {
    Amazon: 'fa-chess-queen',
    Dead: 'fa-skull'
}

const Move = {
    Pick: "pick",
    Move: "move",
    Shoot: "shoot"
}

const game = {
    movement: Move.Pick,
    player: 'one',
    movingFigure: null,
    lives: {
        'one': 4,
        'two': 4
    }
}

const wallChecks = [
    [-1,0],[-1,1],[0,1],
    [1,1],[1,0],[+1,-1],
    [0,-1],[-1,-1]
]

/*
 x bajar - y igual ( -1 / o )
 x bajar - y subir ( -1 / +1 )
 x igual - y subir ( 0 / +1 )
 x subir - y subir ( +1 / +1 )
 x subir - y igual ( +1 / 0 )
 x subir - y bajar ( +1 / -1 )
 x igual - y bajar ( 0 / -1 )
 x bajar - y bajar ( -1 / -1 )
 */

export { Move, Figure, game, wallChecks } ;