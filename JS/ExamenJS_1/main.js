class Vehicle {
    
    _conductor;
    _tipus;
    _kmsDescans;
    _kmsTotal;

    constructor(conductor,tipus){
        this._conductor = conductor;
        this._tipus = tipus;
        this._kmsDescans = 0;
        this._kmsTotal = 0;
        console.log(this);
    }

    get conductor() {
        return this._conductor;
    }
    set conductor(value) {
        this._conductor = value;
    }

    descans(){
        let descans =  false;
        switch (this._tipus) {
            case "moto":
                this._kmsDescans += 15;
                if (this._kmsDescans >= 60){
                    descans = true;
                }
                break;
            case "cotxe":
                this._kmsDescans += 10;
                if (this._kmsDescans >= 80){
                    descans = true;
                }
                break;
            case "camio":
                this._kmsDescans += 8;
                if (this._kmsDescans >= 120){
                    descans = true;
                }
                break;
        }
        if (descans) this._kmsDescans = 0;
        return descans;
    }

    avanca(){

        let pasos = 0;

        if (!this.descans() && (this._kmsTotal <= this._conductor.kms)){
            switch (this._tipus) {
                case "moto":
                    pasos = 15;
                    break;
                case "cotxe":
                    pasos = 10;
                    break;
                case "camio":
                    pasos = 8;
                    break;
            }

            if ((this._kmsTotal+pasos) > this.conductor.kms) {
                this._kmsTotal = this.conductor.kms;
            } else {
                this._kmsTotal += pasos;
            }
        }

        console.log(this);

    }
    
    print(){

        const printHere = document.getElementById(this._tipus);
        printHere.innerHTML="["+this._tipus+"]";
        printHere.innerHTML+="("+this.conductor.origen+")";

        for (let i = 0; i < this._kmsTotal; i++) {
            printHere.innerHTML+=" - ";
        }
        for (let k = 0; k < (this.conductor.kms-this._kmsTotal); k++) {
            printHere.innerHTML+=" . ";    
        }
        console.log(this.conductor.desti);
        printHere.innerHTML+="("+this.conductor.desti+")";
    }
}

class Conductor {

    _origen;
    _desti;
    _kms;

    constructor(){
        this._origen = ""
        this._desti = "";
        this._kms = 0;
    }


    get origen() {
        return this._origen;
    }
    set origen(value) {
        this._origen = value;
    }
    get desti() {
        return this._desti;
    }
    set desti(value) {
        this._desti = value;
    }
    get kms() {
        return this._kms;
    }
    set kms(value) {
        this._kms = value;
    }
}

function cercarEx1(matrix){

    let repetido1 = [];
    let repetido2 = [];

    //debugger;
    for (let i = 0; i < matrix.length; i++) {
        for (let k = 0; k < matrix[i].length; k++) {
            const check = matrix[i][k];
            console.log(check);
            repetido1 = [i,k];
            for (let x = 0; x < matrix.length; x++) {
                for (let z = 0; z < matrix.length; z++) {
                    if (check === matrix[x][z] &&
                        (i != x) && (k != z)){
                            console.log("check "+check);
                            console.log(i+" "+k);
                            console.log("matrix "+matrix[x][z]);
                            console.log(x+" "+z);
                        repetido2 = [x,z];
                    }
                }
            }
        }
    }

    let res = [repetido1,repetido2];
    document.querySelector("#resultatEx1 > span").innerHTML=resultatEx1;

    console.log(repetido1);
    console.log(repetido2);
}

console.log(cercarParella([[1,5,8,10,2],
    [22,12,3,9,11],
    [78,34,4,15,20],
    [9,0,32,18,64],
    [6,52,14,38,77]]));

function jugarEx2() {



    const opcions = ["Pedra","Paper","Tisores"];
    let user = "";
    let pc = "";
    let msg = ""

    if (document.getElementById("pedra").checked){
        user = document.getElementById("pedra").value;
    }

    if (document.getElementById("paper").checked){
        user = document.getElementById("paper").value;
    }

    if (document.getElementById("tisores").checked){
        user = document.getElementById("tisores").value;
    }

    let rnd = Math.floor(Math.random()*3);

    pc = opcions[rnd];

    msg = `l'ordinador a escollit ${pc}... `;

    if (user == pc){
        msg += "empat";
    }

    if (pc == opcions[0]){
        switch (user) {
            case opcions[1]:
                msg += "guanyes";
                break;
            case opcions[2]:
                msg += "perds";
                break;
        }
    } else if (pc == opcions[1]){
        switch (user) {
            case opcions[0]:
                msg += "perds";
                break;
            case opcions[2]:
                msg += "guanyes";
                break;
        }
    } else if (pc == opcions[2]){
        switch (user) {
            case opcions[0]:
                msg += "guanyes";
                break;
            case opcions[1]:
                msg += "perds";
                break;
        }
    }

    alert(msg);

}
let insertedColors = [];

function colors(color) {
    const toInsert = `<td class="${color}"></td>`
    console.log(insertedColors);
    if (!insertedColors.includes(color)){
        document.querySelector("div:nth-child(5) > table > tbody").innerHTML+=toInsert;
        insertedColors.push(color);
    }
}


function checkPassword() {

    let pwdMsg = "";
    let security = 4;
    let errorColor = 'purple';

    const caracteristiques = ['Més de 7 caràcters.','Contenir lletres en majúscules i minúscules.',`Contenir els següents caràcters especials , . - ! $ % & / ( )`,'Contenir espais'];

    const pwd = document.getElementById('passwordEx4').value;

    if (!checkLength(pwd)){
        pwdMsg = caracteristiques[0];
        security--;
    }

    if (!checkUpperLower(pwd)){
        pwdMsg += " "+caracteristiques[1];
        security--;
    }

    if (!checkUpperLower(pwd)){
        pwdMsg += " "+caracteristiques[2];
        security--;
    }

    if (!containsSpaces(pwd)){
        pwdMsg += " "+caracteristiques[3];
        security--;
    }

    document.querySelector(".caracteristiquesPassword").innerHTML=pwdMsg;

    console.log("security: "+security);

    switch (security) {
        case 0:
            errorColor = 'red';
            break;
        case 1:
            errorColor = 'orange';
            break;
        case 3:
            errorColor = 'green'
            break;
    }

    document.querySelector(".colorPassword").innerHTML=`<div style='width: 50px; height: 50px; background-color: ${errorColor}'>         </div>`;
}

function checkLength(pwd){
    return (pwd.length > 7);
}

function checkUpperLower(pwd) {
    return !(pwd === pwd.toUpperCase() || pwd === pwd.toLowerCase());
}

function specialChars(pwd) {
    const specialChars = `, . - ! $ % & / ( )`.split(' ');
    const splitedPwd = pwd.split("");
    let ok = false;
    specialChars.forEach(char => {
        for (let i = 0; i < splitedPwd.length; i++) {
            if (splitedPwd[i] == char) {
                ok = true;
            }
        }
        if (ok) return;
    });
    return ok;
}

function containsSpaces(pwd) {
    let ok = false;
   pwd.split("").forEach( char => {
        if (char == " "){
            ok = true;
            return;
        }
    });
    return ok;
}

function searchText(){
    const text = document.getElementById('textCerca').value;
    const startChar = document.getElementById('marcaIncial').value;
    const endChar = document.getElementById('marcaFinal').value;
    let finalText = "";
    let capture = false;
    text.split("").forEach(char => {
        if (char == startChar) capture = true;
        if (char == endChar) capture = false;
        if (capture && char != startChar){
            finalText+=char;
        }
    });

    alert(finalText);

    // Hola <Pepito>!
}


let conductor1 = new Conductor();
let conductor2 = new Conductor();
let conductor3 = new Conductor();

let moto = null;
let cotxe = null;
let camio = null;

function start() {

    conductor1.origen = document.querySelector("#origenMoto").value;
    conductor2.origen = document.querySelector("#origenCotxe").value;
    conductor3.origen = document.querySelector("#origenCamio").value;

    conductor1.desti = document.querySelector("#destiMoto").value;
    conductor2.desti = document.querySelector("#destiCotxe").value;
    conductor3.desti = document.querySelector("#destiCamio").value;

    conductor1.kms = document.querySelector("#kmsMoto").value;
    conductor2.kms = document.querySelector("#kmsCotxe").value;
    conductor3.kms = document.querySelector("#kmsCamio").value;

    moto = new Vehicle(conductor1,"moto");
    cotxe = new Vehicle(conductor2,"cotxe");
    camio = new Vehicle(conductor3,"camio");
}

function go() {

    moto.avanca();
    cotxe.avanca();
    camio.avanca();
    moto.print();
    cotxe.print();
    camio.print();
    
}