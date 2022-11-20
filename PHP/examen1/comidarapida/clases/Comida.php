<?php
class Comida {
    protected $tipo;
    protected $queso;
    protected $cebolla;
    protected $peperoni;
    protected $champis;


    public function __construct($tipo)
    {
        $this->tipo = $tipo;
        $this->queso = false;
        $this->cebolla = false;
        $this->peperoni = false;
        $this->champis = false;
    }

    public function setTopping($top,$act){
        $bl = ($act=='true')?true:false;
        switch ($top) {
            case 'pepperoni':
                $this->peperoni = $bl;
                break;
            case 'cebolla':
                $this->cebolla = $bl;
                break;
            case 'queso':
                $this->queso = $bl;
                break;
            case 'champis':
                $this->champis = $bl;
                break;
            default:
                echo 'lol';
                break;
        }
    }

    public function toppings(){
        $toppings = 0;
        if ($this->peperoni){
            $toppings++;
        }
        if ($this->cebolla){
            $toppings++;
        }
        if ($this->queso){
            $toppings++;
        }
        if ($this->champis){
            $toppings++;
        }
        return $toppings;
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

    /**
     * Get the value of queso
     */ 
    public function getQueso()
    {
        return $this->queso;
    }

    /**
     * Set the value of queso
     *
     * @return  self
     */ 
    public function setQueso($queso)
    {
        $this->queso = $queso;

        return $this;
    }

    /**
     * Get the value of peperoni
     */ 
    public function getPeperoni()
    {
        return $this->peperoni;
    }

    /**
     * Set the value of peperoni
     *
     * @return  self
     */ 
    public function setPeperoni($peperoni)
    {
        $this->peperoni = $peperoni;

        return $this;
    }

    /**
     * Get the value of champis
     */ 
    public function getChampis()
    {
        return $this->champis;
    }

    /**
     * Set the value of champis
     *
     * @return  self
     */ 
    public function setChampis($champis)
    {
        $this->champis = $champis;

        return $this;
    }

    /**
     * Get the value of cebolla
     */ 
    public function getCebolla()
    {
        return $this->cebolla;
    }

    /**
     * Set the value of cebolla
     *
     * @return  self
     */ 
    public function setCebolla($cebolla)
    {
        $this->cebolla = $cebolla;

        return $this;
    }
}
