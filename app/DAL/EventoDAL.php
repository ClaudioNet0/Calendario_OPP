<?php
namespace App\DAL;

use App\Model\EventoInfo;
use PDO;
use Exception;
use PDOStatement;

class EventoDAL{

    public function query(){
        $query = "
                SELECT 
                   events.id_usuario,
                   events.id_evento,
                   events.title,
                   events.color,
                   events.start,
                   events.end
                FROM calendar.events
                ";
        return $query;
    }

    /**
     * @return array[]
     */
    public function listar(){
        $query = $this->query();
        $query.=" INNER JOIN usuario ON events.id_usuario = usuario.id_usuario ";
        $db = DB::getDB()->prepare($query);
        $db->execute();
        return $db->fetchAll();
    }

    /**
     * @param PDOStatement $db PDO do banco
     * @param EventoInfo $evento
     * @return  void
     */
    public function preencherCampos($db, $evento){
        $db->bindValue(':id_usuario', $evento->getIdUsuario());
        $db->bindValue(':start', $evento->getStart());
        $db->bindValue(':end', $evento->getEnd());
        $db->bindValue(':title', $evento->getTitle(), PDO::PARAM_STR);
        $db->bindValue(':color', $evento->getColor(), PDO::PARAM_STR);
    }


    public function inserir($evento){

        $query = "INSERT INTO calendar.events (
                                                events.id_usuario,
                                                events.title, 
                                                events.color,
                                                events.end, 
                                                events.start
                                                )
                                                
                                                VALUES(
                                                :id_usuario,
                                                :title, 
                                                :color, 
                                                :end,
                                                :start
                                                )  ";
        $db = DB::getDB()->prepare($query);
        $this->preencherCampos($db, $evento);
        $db->execute();
        return DB::getDB()->lastInsertId();

    }

    /**
     * @param EventoInfo $event
     */
    public function alterarData($event){
        $query = "UPDATE calendar.events SET  events.start = :start, events.end = :end WHERE events.id_evento = :id_evento ";
        $db = DB::getDB()->prepare($query);
        $db->bindValue(':id_evento', $event->getId(), PDO::PARAM_INT);
        $db->bindValue(':start', $event->getStart(), PDO::PARAM_STR);
        $db->bindValue(':end', $event->getEnd(), PDO::PARAM_STR);
        $db->execute();
    }

    /**
     * @param EventoInfo $event
     */
    public function alterarCaracteristicas($event){
        $query = "UPDATE calendar.events SET  events.title = :title, events.color = :color WHERE events.id_evento = :id_evento ";
        $db = DB::getDB()->prepare($query);
        $db->bindValue(':id_evento', $event->getId(), PDO::PARAM_INT);
        $db->bindValue(':title', $event->getTitle(), PDO::PARAM_STR);
        $db->bindValue(':color', $event->getColor(), PDO::PARAM_STR);
        $db->execute();
    }

    /**
     * @param integer $id_evento
     * @throws Exception
     */
    public function deletar($id_evento){
        $query = "DELETE FROM calendar.events WHERE events.id_evento = :id_evento";
        $db = DB::getDB()->prepare($query);
        $db->bindValue(":id_evento", $id_evento, PDO::PARAM_INT);
        $db->execute();
    }
}