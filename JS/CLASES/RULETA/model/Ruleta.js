export default class Ruleta{

    _resultats;
    _numero;
    _color;
    _gradosGiro;
    _totalSpins;

    constructor(){
        this._resultats = [];
        this._numero = 0;
        this._color = "";
        this._gradosGiro = 0;
        this._totalSpins = 0;
    }

    jugar(aposta){
        
    }

    getGradosGiro(){
        const transform = this._degreesValues[this._numero];
        this._gradosGiro+=(1080*this._totalSpins);
        return (this._gradosGiro+transform);
    }

    getColor(){
        let rnd = this._numero;
        if (rnd == 0) return 'green';
        if ((rnd > 10 && rnd < 18) || rnd > 28) rnd++;
        return (rnd % 2 == 0) ? 'black' : 'red';
    }

    getNumero(){
        return this._numero;
    }

    getResultado(){
        return this._getResultado;
    }

    spin(){
        this._totalSpins++;
        this._numero = Math.round(Math.random() * 37);
    }

    _degreesValues = {
        34: 5,
        17: 15,
        25: 25,
        2: 35,
        21: 44,
        4: 54,
        19: 64,
        15: 73,
        32: 83,
        0: 92,
        26: 102,
        3: 112,
        35: 121,
        12: 131,
        28: 141,
        7: 150,
        29: 160,
        18: 170,
        22: 180,
        9: 190,
        31: 200,
        14: 209,
        20: 219,
        1: 229,
        33: 238,
        16: 248,
        24: 258,
        5: 268,
        10: 277,
        23: 287,
        8: 297,
        30: 307,
        11: 317,
        36: 326,
        13: 336,
        27: 346,
        6: 355
    }

}