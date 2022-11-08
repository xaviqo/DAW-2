class Persona {
    nom;
    cognoms;
    edat;
    email;

    constructor(nom){
        this.nom = nom;
    }

    sayHello(){
        console.log("Hola, em dic "+this.nom);
    }

}

class Conductor extends Persona {

    constructor(nom,cognoms){
        super(nom, cognoms);
    }

    sayHello(){
        super.sayHello();
        console.log("I soc conductor");
    }

}

const p = new Persona();

const c = new Conductor("Xavi");

p.nom = "pedro";

p.sayHello();

c.sayHello();
