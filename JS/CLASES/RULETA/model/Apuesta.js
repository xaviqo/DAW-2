export default class Apuesta {
    
    _ganancia;
    _valor;
    _ganador;
    _apuesta;

    constructor(apuesta,valor){
        this._apuesta = apuesta;
        this._valor = valor;
    }

    getGanador(){
        return this._ganador;
    }

    getApuesta(){
        return this._apuesta;
    }

    setApuesta(apuesta){
        this._apuesta = apuesta;
    }

    getGanancia(){
        return this.ganancia;
    }

    setValor(valor){
        this._valor = valor;
    }

    getValor(){
        return this._valor;
    }

}