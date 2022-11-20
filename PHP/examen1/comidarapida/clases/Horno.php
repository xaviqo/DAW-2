<?php

class Horno {

    protected $tipo;
    protected $cola;

    public function __construct($tipo)
    {
        $this->tipo = $tipo;
        $this->cola = [];
    }

    public function cocinar(){
        $cocinado = sizeof($this->cola);
        $this->cola = [];
        return $cocinado;
    }

    public function totalToppings(){
        $tt = 0;
        foreach ($this->cola as $v) {
            $tt += $v->toppings();
        }
        return $tt;
    }

    /**
     * Get the value of cola
     */ 
    public function getCola()
    {
        return $this->cola;
    }

    /**
     * Set the value of cola
     *
     * @return  self
     */ 
    public function setCola($prod)
    {
        array_push($this->cola,$prod);

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}