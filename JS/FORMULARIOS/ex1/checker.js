const MAX_LETRAS = 300;

window.onload = () => {

    // INPUTS
    const DNI_VAL = document.getElementById("dni");
    const LETRA_DNI_VAL = document.getElementById("letra-dni");
    const NOMBRE_VAL = document.getElementById("nombre");
    const APELLIDOS_VAL = document.getElementById("apellidos");
    const EMAIL_VAL = document.getElementById("email");
    const POBLACION_VAL = document.getElementById("poblacion");
    const PROVINCIA_VAL = document.getElementById("provincia");
    const DESCRIPCION_VAL = document.getElementById("descripcion");
    const LETRAS_RESTANTES_DESCRIPCION = document.getElementById("descripcion-letras");
    const FILE_VAL = document.getElementById("file");
    const FILE_TYPE_ZIP = document.getElementById("file-zip");
    const FILE_TYPE_CRP = document.getElementById("file-crp")

    PROVINCIA_VAL.disabled = true;
    FILE_TYPE_ZIP.disabled = true;
    FILE_TYPE_CRP.disabled = true;
    LETRAS_RESTANTES_DESCRIPCION.innerText = MAX_LETRAS;

    // ARRAY DE INPUTS A COMPROBAR QUE NO ESTEN VACÍOS
    const NOT_EMPTY = [DNI_VAL,LETRA_DNI_VAL,NOMBRE_VAL,APELLIDOS_VAL,EMAIL_VAL];

    NOT_EMPTY.forEach( el => {
        el.addEventListener( 'input', e => {
            if (isEmpty(e.target.value)) {
                el.style.backgroundColor = 'palevioletred';
            } else {
                el.style.backgroundColor = 'darkseagreen';
            }
        })
    });

    NOMBRE_VAL.addEventListener('input', e => {
        e.target.value = e.target.value.toUpperCase();
    });

    APELLIDOS_VAL.addEventListener('input', e => {
        e.target.value = e.target.value.toUpperCase();
    });

    LETRA_DNI_VAL.addEventListener('input', () => {
        if (checkDNI(DNI_VAL.value,LETRA_DNI_VAL.value)){
            DNI_VAL.style.backgroundColor = 'darkseagreen';
            LETRA_DNI_VAL.style.backgroundColor = 'darkseagreen';
        } else  {
            DNI_VAL.style.backgroundColor = 'palevioletred';
            LETRA_DNI_VAL.style.backgroundColor = 'palevioletred';
        }
    });

    POBLACION_VAL.addEventListener('input', () => {
        if (isEmpty(POBLACION_VAL.value)){
            PROVINCIA_VAL.disabled = true;
        } else  {
            PROVINCIA_VAL.disabled = false;
        }
    });

    DESCRIPCION_VAL.addEventListener('input', () => {
        if (exceededMaxLength(DESCRIPCION_VAL)){
            DESCRIPCION_VAL.style.backgroundColor = 'grey';
        } else {
            DESCRIPCION_VAL.style.backgroundColor = 'white';
        }

        LETRAS_RESTANTES_DESCRIPCION.innerText = (MAX_LETRAS-DESCRIPCION_VAL.value.length);
    });

    FILE_VAL.addEventListener('input', () => {
        FILE_TYPE_ZIP.disabled = false;
        FILE_TYPE_CRP.disabled = false;
    });

}

function exceededMaxLength(description){
    return (description.value.length > MAX_LETRAS);
}
function checkDNI(numsDni,letraDni) {

    const VALID_LETTERS = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];

    let resultadoModulo = 0;
    let letraValida = "";

    try {
        resultadoModulo = (numsDni%23);
        letraValida = VALID_LETTERS[resultadoModulo];
    } catch (e) {
        console.log(e)
    }

    return (letraDni.toUpperCase() == letraValida.toUpperCase());
}

function isEmpty(inputValue) {
    return (inputValue.length<1);
}