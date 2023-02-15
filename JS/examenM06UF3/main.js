let selectedColors = [];

function CalcularEx4() {
    const board = document.getElementsByClassName(".board");
    console.log(board)
    board.children[0].forEach( el => {
        console.log(el);
    })
}

function clicEx3(color) {
    selectedColors.push(color);
}

function reproduirEx3() {
    recursiveChangeColor(selectedColors[0],0);
}

function recursiveChangeColor(element,pos) {
    element.classList.add('seleccionat');
    setTimeout(() => {
        element.classList.remove('seleccionat');
        if (selectedColors[pos+1] != undefined) {
            recursiveChangeColor(selectedColors[pos+1],pos+1);
        }
    },1000);
}
function checkSanitari(e) {
    //console.log(ev)
    const specialChars = ['!','"','·','$','%','&','/','(',')','=','?','¿','*','_','-'];
    const name = document.getElementById('sname');
    const last = document.getElementById('slastname');
    const tsi = document.getElementById('tsi');
    const errorDiv = document.getElementById('resultatEx2');
    const tsiChars = 14;
    const errors = {
        tsiCount: "",
        onlyLetters: "",
        specialChars: "",
        tsiFormat: ""
    }
    const lastNameCodes = {
        first: '',
        second: ''
    }

    errorDiv.innerText=''

    name.value.split('').forEach( l => {
       if (!isNaN(l)){
           errors.onlyLetters = "Noms i cognoms només poden contenir lletres";
       }
       if (specialChars.includes(l)){
           errors.specialChars = "Els noms o cognoms no poden contenir símbols especials";
       }
    });

    last.value.split('').forEach( l => {
        if (!isNaN(l)){
            errors.onlyLetters = "Primer cognoms i segon cognom només poden contenir lletres";
        }
        if (specialChars.includes(l)){
            errors.specialChars = "Els noms o cognoms no poden contenir símbols especials";
        }
    });

    const lnArrays = last.value.split(' ');

    if (lnArrays.length === 2){
        lastNameCodes.first = lnArrays[0].substring(0,2);
        lastNameCodes.second = lnArrays[1].substring(0,2);
    } else {
        lastNameCodes.first = last.value.substring(0,2);
        lastNameCodes.second = lastNameCodes.first;
    }

    let tsiCnt = 0;

    tsi.value.split('').forEach( l => {
        if (tsiCnt < 3){
            if (!isNaN(l)) errors.tsiFormat = "Format del codi TSI incorrecte";
        } else {
            if (isNaN(l)) errors.tsiFormat = "Format del codi TSI incorrecte";
        }
        tsiCnt++;
    });

/*    if (lastNameCodes.second.length !== 2){
        lastNameCodes.second = lastNameCodes.first;
    }*/

    //console.log(lastNameCodes);

    if (tsiChars>0) errors.tsiCount = 'Falten '+(tsiChars-e.target.value.length)+' caràcters.';

    if (tsi.value.length > 14) tsi.value = tsi.value.substring(0,14);

    const last2dig = e.target.value.substring(12,14);
    const nums = e.target.value.substring(4,11);

    console.log(last2dig);

    let suma = 0;
    nums.split('').forEach( num => {
        suma+=parseInt(num);
    });

    const mod = suma%15;

    console.log("suma: "+suma);
    console.log("mod: "+mod)

    Object.values(errors).forEach( e => {
        if (e != ''){
            errorDiv.appendChild(document.createElement('br'));
            errorDiv.innerText+=e;
        }
    })

    setTimeout(()=>errorDiv.innerText='',3000);
}


function checkParking(){
    const specialChars = ['!','"','·','$','%','&','/','(',')','=','?','¿','*','_','-'];
    const vocals = ['a','e','i','o','u'];
    const nom = document.getElementById('pname');
    const cognom = document.getElementById('plastname');
    const matricula = document.getElementById('licensePlate');
    const formCheck = {
        nom: nom.value.length > 0,
        cog: cognom.value.length > 0,
        mat: matricula.value.length > 0
    }
    let matCounter = 0;
    nom.value.split('').forEach( l => {
        const isInt = parseInt(l);
        if (!isNaN(isInt) || !formCheck.nom){
            formCheck.nom = false;
            parkingInputError(nom);
        }
        if (specialChars.includes(l)){
            formCheck.nom = false;
            parkingInputError(nom);
        }

    });
    cognom.value.split('').forEach( l => {
        const isInt = parseInt(l);
        if (!isNaN(isInt) || !formCheck.cog){
            formCheck.cog = false;
            parkingInputError(cognom);
        }
        if (specialChars.includes(l)){
            formCheck.cog = false;
            parkingInputError(cognom);
        }
    });
    matricula.value.split('').forEach( l => {
        const isInt = parseInt(l);
        if (matCounter <= 3 || !formCheck.mat){
            if (isNaN(isInt)){
                formCheck.mat = false;
                parkingInputError(matricula);
            }
        } else {
            if (vocals.includes(l.toLowerCase())){
                formCheck.mat = false;
                parkingInputError(matricula);
            }
        }
        matCounter++;
    });
    if (matricula.value.length !== 7){
        formCheck.mat = false;
        parkingInputError(matricula);
    }


    if (formCheck.nom && formCheck.cog && formCheck.mat){
        document.getElementById('resultatEx1').innerText = "Reserva Confirmada";

    }

}

function parkingInputError(el){
    el.classList.add('error');
    setTimeout(() => {
        el.classList.remove('error');
    },1000);
}