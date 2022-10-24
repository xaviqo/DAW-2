let coche = {puertas: 2, color: 'verde', ruedas: 4};

Object.keys(coche).forEach( k  => {
    console.log(coche[k]);
    console.log(k);
});