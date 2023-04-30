//////////// Cuadrados ////////////

//C1A
let element = document.getElementById("c1a");

let ctx = element.getContext("2d");
ctx.fillStyle = "black";
ctx.fillRect(0, 0, 200, 150);
let ctxRed = element.getContext("2d");
ctxRed.fillStyle = "red";
ctxRed.fillRect(20, 20, 130, 100);
let ctxBlue = element.getContext("2d");
ctxBlue.fillStyle = "blue";
ctxBlue.fillRect(150, 180, 130, 100);

//C1B
let c1b = document.getElementById("c1b");

let ctx2 = c1b.getContext("2d");
ctx2.fillStyle = "cyan";
ctx2.fillRect(0, 0, 200, 150);
let ctx3 = c1b.getContext("2d");
ctx3.fillStyle = "rgba(255, 0, 0, 0.5)";
ctx3.fillRect(50, 50, 200, 150);

//C1C
let c1c = document.getElementById("c1c");

let ctx5 = c1c.getContext("2d");
let ctx4 = c1c.getContext("2d");

for (let j = 0; j < 11; j++) {
  ctx5.fillStyle = "blue";
  ctx5.fillRect(j * 15, 150 - j * 15, 6, 6);
}

for (let j = 0; j < 11; j++) {
  ctx4.strokeStyle = "cyan";
  ctx4.strokeRect(j * 15, j * 15, 6, 6);
  ctx4.lineaWidth = 8;
}

//C1D
let c1d = document.getElementById("c1d");

let ctx6 = c1d.getContext("2d");
let ctx7 = c1d.getContext("2d");

for (let j = 0; j < 11; j++) {
  ctx6.fillStyle = "blue";
  ctx6.fillRect(j * 15, 150 - j * 15, 6, 6);
}

for (let j = 0; j < 11; j++) {
  ctx7.strokeStyle = "cyan";
  ctx7.strokeRect(j * 15, j * 15, 6, 6);
  ctx7.lineaWidth = 8;
}

document
  .getElementById("borradoParcial")
  .addEventListener("click", (e) => borradoParcial(e));

function borradoParcial(e) {
  e.preventDefault();
  let ctx8 = c1d.getContext("2d");
  ctx8.clearRect(55, 55, 45, 45);
}

//si ponemos rgb(128,128,128) <- si subimos el gris sera mas claro y viceversa,
//si ponemos el mismo color en los tres siemre sera un gris

//////////////// Lineas 'curvas' ////////////

//Curva
let curva = document.getElementById("curvas1");
let ctx9 = curva.getContext("2d");

let inicioY = 300;
let inicioX = 300;
let finX = 0;

for (let i = 0; i < 30; i++) {
  ctx9.beginPath();
  //Posicionate aqui para dibujar
  ctx9.moveTo(finX, 300);
  //Termina aqui la linea para dibujar
  ctx9.lineTo(inicioX, inicioY);
  ctx9.closePath();
  ctx9.stroke();

  inicioY -= 10;
  finX += 10;
}

//Dos triangulos
let curva2 = document.getElementById("curvas2");
let ctx10 = curva2.getContext("2d");
mitadUno();
mitadDos();

function mitadUno() {
  let mitadY = 300 / 2;
  let mitadX = 300 / 2;
  let inicio = 0;

  for (let i = 0; i < 30; i++) {
    ctx10.beginPath();
    //Posicionate aqui para dibujar
    ctx10.moveTo(300, mitadY);
    //Termina aqui la linea para dibujar
    ctx10.lineTo(mitadX, inicio);
    ctx10.lineWidth = 0.2;

    ctx10.closePath();
    ctx10.stroke();
    inicio += 10;
  }
}

function mitadDos() {
  let mitadY = 300 / 2;
  let mitadX = 300 / 2;
  let inicio = 0;

  for (let i = 0; i < 30; i++) {
    ctx10.beginPath();
    //Posicionate aqui para dibujar
    ctx10.moveTo(0, mitadY);
    //Termina aqui la linea para dibujar
    ctx10.lineTo(mitadX, inicio);
    ctx10.closePath();
    ctx10.stroke();
    inicio += 10;
  }
}

//Cuadrado
let curva3 = document.getElementById("curvas3");
let ctx11 = curva3.getContext("2d");
//ofset x TODO hacer lo del mouse
let punteroY = 0;
let punteroX = 0;

document.addEventListener("mousemove", function (event) {
  // Actualizar las variables con las coordenadas del ratón
  punteroY = event.clientY;
  punteroX = event.clientX;

  ctx11.clearRect(0, 0, curva3.width, curva3.height);

  mitadCuadradoIzquierda(punteroY, punteroX);
  mitadCuadradoArriba(punteroY, punteroX);
  mitadCuadradoDerecha(punteroY, punteroX);
  mitadCuadradoAbajo(punteroY, punteroX);
});

function mitadCuadradoIzquierda(punteroY, punteroX) {
  let posY = 0;
  let posX = 0;
  
  for (let i = 0; i < 33; i++) {
    ctx11.beginPath();
    //Posicionate aqui para dibujar
    ctx11.moveTo(posY, posX);
    //Termina aqui la linea para dibujar
    ctx11.lineTo(punteroX, punteroY);
    ctx11.closePath();
    ctx11.stroke();
    posX += 10;
  }
}

function mitadCuadradoArriba(punteroY, punteroX) {
  let posY = 0;
  let posX = 0;


  for (let i = 0; i < 33; i++) {
    ctx11.beginPath();
    //Posicionate aqui para dibujar
    ctx11.moveTo(posY, posX);
    //Termina aqui la linea para dibujar
    ctx11.lineTo(punteroX, punteroY);
    ctx11.closePath();
    ctx11.stroke();
    posY += 10;
  }
}

function mitadCuadradoDerecha(punteroY, punteroX) {
  let posY = 0;
  let posX = 300;

  for (let i = 0; i < 32; i++) {
    ctx11.beginPath();
    //Posicionate aqui para dibujar
    ctx11.moveTo(posX, posY);
    //Termina aqui la linea para dibujar
    ctx11.lineTo(punteroX, punteroY);
    ctx11.closePath();
    ctx11.stroke();
    posY += 10;
  }
}

function mitadCuadradoAbajo(punteroY, punteroX) {
  let posY = 0;
  let posX = 300;


  for (let i = 0; i < 33; i++) {
    ctx11.beginPath();
    //Posicionate aqui para dibujar
    ctx11.moveTo(posY, posX);
    //Termina aqui la linea para dibujar
    ctx11.lineTo(punteroX, punteroY);
    ctx11.closePath();
    ctx11.stroke();
    posY += 10;
  }
}

///////////////ARCOS//////////////  - El ultimo parametro 'sentido contratio del reloj' no es necesario hacerlo
//la funcion acepta grados radiantes, para pasarlo a radiantes: var radians = (Math.PI/180)*degrees
