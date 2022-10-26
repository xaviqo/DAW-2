window.onload = () => {

    const ROTATION_BTN = document.getElementById("rotateBtn");
    const ROULETTE_IMG = document.getElementById("roulette");

    ROTATION_BTN.addEventListener('click', () => {

        const RND_TRANSFORM = randomTransform();
        console.log(RND_TRANSFORM);
        console.log(getNumByDeg(RND_TRANSFORM));

        ROULETTE_IMG.style.transitionDuration = randomDuration()+"s";
        ROULETTE_IMG.style.transform = "rotate("+RND_TRANSFORM+"deg)"//randomTransform();
        ROULETTE_IMG.style.transitionTimingFunction = "cubic-bezier(.19,.83,.49,.85)";
    })

}

function getNumByDeg(num) {

    let winner = 0;

    if (num>=360){
        num = num-360;
    } else if (num >= 720){
        num = num-720;
    }

    if (num >= 0 && num < 10) {
        winner = 34;
    } else if (num >= 10 && num < 20) {
        winner = 17;
    } else if (num >= 20 && num < 30) {
        winner = 25;
    } else if (num >= 30 && num < 40) {
        winner = 2;
    } else if (num >= 39 && num < 49) {
        winner = 21;
    } else if (num >= 49 && num < 59) {
        winner = 4;
    } else if (num >= 59 && num < 69) {
        winner = 19;
    } else if (num >= 68 && num < 68) {
        winner = 15;
    } else if (num >= 78 && num < 88) {
        winner = 32;
    } else if (num >= 88 && num < 98) {
        winner = 0;
    } else if (num >= 97 && num < 107) {
        winner = 26;
    } else if (num >= 107 && num < 117) {
        winner = 3;
    } else if (num >= 117 && num < 127) {
        winner = 
    }
    return winner;
}

function randomDuration() {
    return Math.ceil(Math.random()*3)+3;
}

function randomTransform(){
    return Math.ceil(Math.random()*720)+360;
}

