import Ruleta from './clases/Ruleta.js';

let totalDeg = 0;
let spins = 1;

window.onload = () => {

    const ruleta = new Ruleta();

    

    const ROTATION_BTN = document.getElementById("rotateBtn");
    const ROULETTE_IMG = document.getElementById("roulette");
    const SELECTS = document.querySelectorAll('select');
    const OPTION = document.querySelectorAll('option');

    let select = null;
    const option = null;
    const input = null;


    OPTION.forEach(element => {
        element.addEventListener('change', event => {
            select = event.target.id;
            console.log(select);
        })
    })

    SELECTS.forEach(element => {
        element.addEventListener('change', event => {
            select = event.target.id;
            console.log(select);
        })
    });

    ROTATION_BTN.addEventListener('click', () => {

        const randomNum = randomNumber();
        const numToDeg = getTransform(randomNum);
        totalDeg+=(1080*spins);
        spins++;

        const time = randomDuration();

        ROULETTE_IMG.style.transitionDuration = time + "s";
        ROULETTE_IMG.style.transform = "rotate(+" + (numToDeg+totalDeg) + "deg)"
        ROULETTE_IMG.style.transitionTimingFunction = "cubic-bezier(.19,.83,.49,.85)";

        document.querySelector('.winnerNumber').innerHTML = '?';
        document.querySelector('.winnerNumber').style.backgroundColor = 'grey';

        setTimeout(() => {
            const color = findColor(randomNum);
            document.querySelector('.winnerNumber').innerHTML = randomNum;
            document.querySelector('.winnerNumber').style.backgroundColor = color;
        }, time * 1000);
    })

}

function findColor(randomNum) {
    let rnd = randomNum;
    if (rnd == 0) return 'green';
    if ((rnd > 10 && rnd < 18) || rnd > 28) rnd++;
    return (rnd % 2 == 0) ? 'black' : 'red';
}

function getTransform(num) {
    return degreesValues[num];
}

function randomDuration() {
    return Math.ceil(Math.random() * 3) + 3;
}

function multiplyDeg(deg) {
    return deg + 1080;
}

const degreesValues = {
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