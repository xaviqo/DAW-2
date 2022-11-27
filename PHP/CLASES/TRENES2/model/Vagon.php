<?php

class Vagon
{
    private $id;
    private $libre;

    /**
     * @param $libre
     */
    public function __construct($id,$libre)
    {
        $this->id = $id;
        $this->libre = $libre;
    }

    public function introducirPasajeros(){
        $libre = $this->getLibre();
        if ($libre>=1) ($libre>10)?$this->setLibre($libre-10):$this->setLibre(0);
    }

    /**
     * @return mixed
     */
    public function getLibre()
    {
        return $this->libre;
    }

    /**
     * @param mixed $libre
     */
    public function setLibre($libre): void
    {
        $this->libre = $libre;
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