<?php
namespace App\BLL;

use App\DAL\EventoDAL;
use App\Model\EventoInfo;
use Exception;

class EventoBLL{

    /**
     * @return array[]
     */
    public function listar(){
        $dal = new EventoDAL();
        return $dal->listar();
    }

    /**
     * @param EventoInfo $evento
     * @throws Exception
     * @return integer
     */
    public function inserir($evento){
        if(is_null($evento) || empty($evento)){
            throw new Exception('Evento é nulo ou vazio!');
        }
        $dal = new EventoDAL();
        return $dal->inserir($evento);
    }

    /**
     * @param EventoInfo $event
     * @throws Exception
     * @return boolean
     */
    public function alterarData($event){
        if(is_null($event) || empty($event)){
            throw new Exception('Evento é nulo!');
        }
        try{
            $dal = new EventoDAL();
            $dal->alterarData($event);
            return true;
        }
        catch (Exception $e){
            return false;
        }

    }

    /**
     * @param EventoInfo $event
     * @throws Exception
     */
    public function alterarCaracteristicas($event){
        if(is_null($event) || empty($event)){
            throw new Exception('Evento é nulo!');
        }

        $dal = new EventoDAL();
        $dal->alterarCaracteristicas($event);
    }

    /**
     * @param int $id_evento
     * @throws Exception
     */
    public function deletar($id_evento){
        if (is_null($id_evento) || empty($id_evento)){
            throw new Exception('Id do evento foi passado como nulo!');
        }
        $dal = new EventoDAL();
        $dal->deletar($id_evento);
    }
}