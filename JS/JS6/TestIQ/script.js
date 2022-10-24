const iqTest = {
    q1: {
        correct: 'r4',
        result: false,
        id: 'divPregunta1',
    },
    q2: {
        correct: 'r3',
        result: false,
        id: 'divPregunta2',
    },
    q3: {
        correct: 'r2',
        result: false,
        id: 'divPregunta3',
    },
    q4: {
        correct: 'r4',
        result: false,
        id: 'divPregunta4',
    },
    q5: {
        correct: 'r4',
        result: false,
        id: 'divPregunta5',
    }
}

window.onload = () => {
    const questionBtn = document.querySelectorAll('.questionBtn');
    const respuestaBtn = document.querySelectorAll('.respuestaBtn');
    const responseMessage = document.querySelector('#correctWrongText');
    const resultBtn = document.querySelector('.resultBtn');

    let question = "";
    let respuesta = "";
    let hideDiv = "";

    questionBtn.forEach(q => {
        q.addEventListener('click', event => {
            changeDivToShow(hideDiv,event.target.id);
            hideDiv = event.target.id;
            question = event.target.id;
        });
    });

    respuestaBtn.forEach(r => {
        r.addEventListener('click', event => {
            respuesta = event.target.id;
            iqTest[question]['result'] = evaluateRespuesta(question,respuesta);
            showMessage(responseMessage,iqTest[question]['result']);
        })
    })

    resultBtn.addEventListener('click', e => {
        console.log(checkResult(iqTest));
    });
}

function checkResult(test) {
    let correct = 0;
    Object.values(test).forEach((r) => {
        if (r.result) correct++;
    });
    return correct;
}

function showMessage(responseMessage,bool) {
    responseMessage.style.visibility = 'visible';
    if (bool){
        responseMessage.innerHTML = 'Correcto! 🥳';
        responseMessage.style.backgroundColor = 'greenyellow'
    } else {
        responseMessage.innerHTML = 'Fallaste... 😭';
        responseMessage.style.backgroundColor = '#EE6C4D';
    }
    setTimeout(() => responseMessage.style.visibility = 'hidden', 1200);
}

function changeDivToShow(hide,show){
    if (hide) document.getElementById(iqTest[hide]['id']).style.display = "none";
    document.getElementById(iqTest[show]['id']).style.display = "initial"
}

function evaluateRespuesta(ques,resp){
    return (iqTest[ques]['correct'] == resp);
}