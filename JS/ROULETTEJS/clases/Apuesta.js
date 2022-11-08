export default class Apuesta {
    
    _diners;
    _valor;

    constructor(diners,valor){
        this._diners = diners;
        this._valor = valor;
    }

    setDiners(diners){
        this._diners = diners;
    }

    getDiners(){
        this._diners;
    }

    setValor(valor){
        this._valor = valor;
    }

    getValor(){
        this._valor;
    }

}