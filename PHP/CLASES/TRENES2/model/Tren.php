<?php

class Tren
{

    private $id;
    private $vagones;

    /**
     * @param $vagones
     */
    public function __construct($id,$vagones)
    {
        $this->id = $id;
        $this->vagones = $vagones;
    }

    public function salir(){
        $this->setVagones([]);
    }

    public function ocupado(){
        $espacio_total = sizeof($this->getVagones())*30;
        foreach ($this->getVagones() as $vagon) {
            $espacio_total-=$vagon->getLibre();
        }
        return $espacio_total;
    }

    public function introducirPasajerosVagon($vagon){
        $this->vagones[$vagon]->introducirPasajeros();
    }

    /**
     * @return mixed
     */
    public function getVagones()
    {
        return $this->vagones;
    }

    /**
     * @param mixed $vagones
     */
    public function setVagones($vagones): void
    {
        $this->vagones = $vagones;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }






}