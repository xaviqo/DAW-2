let getPreguntaButton = (init,limit) => {

    let html = "";
    while (init<limit) {
        let plantilla = `<a href="#${init}"><button class="preguntaButton">Pregunta ${init}</button></a>`;
        html+=plantilla;
        init++;
    }

    return html;
}

let getHtmlBtn = (id,obj) => {
    return `<div style="width: 100px; color: ${!obj['color'][id]?'black':obj['color'][id]}" class="colorBtn">
                ${obj['opt'][id]}
            </div>`;
}

const preguntasHtml = {
    1: {
        q : 'Cual es rojo?',
        opt: {
            1: 'Amarillo',
            2: 'Rosa',
            3: 'Rojo',
            4: 'Verde'
        },
        color: {
            1: 'blue',
            2: 'red',
            3: 'blueviolet',
            4: 'green'
        },
        res: 'Rojo'
    },
    2: {
        q : '1, 3, 5, 7...',
        opt: {
            1: '7',
            2: '8',
            3: '9',
            4: '10',
        },
        color: false,
        res: '9'
    },
    3: {
        q: false,
        img: 'q01-3003-44.jpg',
        opt: {
            1: 'a',
            2: 'b',
            3: 'c',
            4: 'd',
        },
        color: false,
        res: 'c'
    },
    4: {
        
    }
}


document.querySelector("#cajaPreguntas").innerHTML = getPreguntaButton(1,11);

window.addEventListener('hashchange', (e) =>{


    const option = window.location.hash.substring(1);
    document.querySelector('#tituloPreg').innerHTML=preguntasHtml[option]['q'];
    document.querySelector('#juegoPreg').innerHTML="";
    const eachPregunta = preguntasHtml[option]['opt'];
    let pregId = 1;
    Object.keys(eachPregunta).forEach(e => {
        console.log(e);
        document.querySelector('#juegoPreg').innerHTML+=getHtmlBtn(pregId,preguntasHtml[option]);
        pregId++;
    });

})





