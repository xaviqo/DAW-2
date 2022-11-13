import Ruleta from './model/Ruleta.js';

const ruleta = new Ruleta();
const ROULETTE_IMG = document.getElementById("roulette");
const SPIN_BTN = document.querySelector(".spinBtn");
const DIVS_APUESTAS = document.querySelectorAll(".selectsDiv > div");
const TIPO_APUESTA = document.querySelector(".tipoApuesta");

// PORQUE DENTRO DE UNA CLASE NO SE PUEDE HACER const
window.onload = () => {

    DIVS_APUESTAS.forEach(select => {
        select.style.display = 'none';
    });

    TIPO_APUESTA.style.display = 'initial';

    SPIN_BTN.addEventListener('click', () => {

        ruleta.spin();
    
        ROULETTE_IMG.style.transitionDuration = 5 + "s";
        ROULETTE_IMG.style.transform = "rotate(+" + ruleta.getGradosGiro() + "deg)"
        ROULETTE_IMG.style.transitionTimingFunction = "cubic-bezier(.19,.83,.49,.85)";

    
    });



}