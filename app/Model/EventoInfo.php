<?php
namespace App\Model;

class EventoInfo{
    private $id_usuario;
    private $id_evento;
    private $title;
    private $color;
    private $start;
    private $end;

    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param int $value
     */
    public function setIdUsuario($value)
    {
        $this->id_usuario = $value;
    }



    /**
     * @return integer
     */
    public function getId(){
        return $this->id_evento;
    }

    /**
     * @param integer $value
     */
    public function setId($value){
        $this->id_evento = $value;
    }

    /**
     * @return string
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * @param string $value
     */
    public function setTitle($value){
        $this->title = $value;
    }

    /**
     * @return string $color
     */
    public function getColor(){
        return $this->color;
    }

    /**
     * @param string $value
     */
    public function setColor($value){
        $this->color = $value;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param string $value
     */
    public function setStart($value)
    {
        $this->start = $value;
    }

    /**
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param string $value
     */
    public function setEnd($value)
    {
        $this->end = $value;
    }
}