parImpar = num => num%2?console.log("impar"):console.log("par");


parImpar(100);

esParImpar(100);



function esParImpar(numero) {
    
    let resultado = numero%2;
    
    if (resultado == 0){
        console.log("es par");
    } else if(resultado != 0) {
        console.log("es impar");
    }
    
}