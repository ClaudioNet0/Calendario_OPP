<?php
namespace App\DAL;

use PDO;
use Exception;
use PDOStatement;
class DB {
    public static function getDB(){

        if (!defined("DB_HOST")) {
            throw new Exception("DB_HOST não foi definido.");
        }
        if (!defined("DB_NAME")) {
            throw new Exception("DB_NAME não foi definido.");
        }
        if (!defined("DB_USER")) {
            throw new Exception("DB_NAME não foi definido.");
        }
        if (!defined("DB_PASS")) {
            throw new Exception("DB_PASS não foi definido.");
        }

        $cnnStr = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";

        $cnn = new PDO($cnnStr, DB_USER, DB_PASS);
        $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

        return $cnn;
    }

    /**
     * @param PDOStatement $db
     * @param string $fieldName
     * @return array
     */
    public static function getList($db, $fieldName) {
        $retorno = array();
        while ($row = $db->fetch(PDO::FETCH_ASSOC)) {
            $retorno[] = $row[$fieldName];
        }
        $db->closeCursor();
        return $retorno;
    }

    /**
     * @param PDOStatement $db
     * @param string $fieldName
     * @return null|mixed
     */
    public static function getValue($db, $fieldName) {
        $retorno = null;
        if ($row = $db->fetch(PDO::FETCH_ASSOC)) {
            $retorno = $row[$fieldName];
        }
        $db->closeCursor();
        return $retorno;
    }

    /**
     * @param PDOStatement $db
     * @param string $className
     * @return array
     */
    public static function getResult($db, $className = "stdClass") {
        $retorno = array();
        $db->execute();
        while ($row = $db->fetchObject($className)) {
            $retorno[] = $row;
        }
        $db->closeCursor();
        return $retorno;
    }
    /**
     * Pegar dado do banco e jogar parar classe
     * @param mixed $db
     * @param string $className
     * @throws Exception
     * @return mixed
     */
    public static function getValueAsClass($db, $className = "") {
        if (trim($className) == "")
            throw new Exception("Preencha o nome da classe.");
        $db->execute();
        $retorno = null;
        if ($row = $db->fetchObject($className)) {
            $retorno = $row;
        }
        $db->closeCursor();
        return $retorno;
    }
    /**
     * Pegar dado do banco e jogar parar classe
     * @param mixed $db
     * @param string $className
     * @throws Exception
     * @return mixed
     */
    public static function getValueClass($db, $className = "") {
        return DB::getValueAsClass($db, $className);
    }
    /**
     * Retorna o ultimo ID inserido
     * @return int
     */
    public static function lastInsertId() {
        $query  = "SELECT LAST_INSERT_ID() AS 'lastid'";
        $db = DB::getDB()->prepare($query);
        $db->execute();
        $retorno = -1;
        if ($row = $db->fetch(PDO::FETCH_ASSOC)) {
            $retorno = intval($row["lastid"]);
        }
        $db->closeCursor();
        return $retorno;
    }
}