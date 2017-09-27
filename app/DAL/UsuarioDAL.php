<?php
namespace App\DAL;

use PDO;
use App\DAL\DB;
use App\Model\UsuarioInfo;

class UsuarioDAL{
    public function query(){
        $query = "SELECT 
                    usuario.id_usuario,
                    usuario.nome,
                    usuario.senha,
                    usuario.email,
                    usuario.slug
                    FROM calendar.usuario
                    ";

        return $query;
    }

    /**
     * @param string $email
     * @param string $senha
     * @return integer
     */
    public function logar($email, $senha){
        $query = "SELECT id_usuario FROM usuario WHERE email = :email AND senha = :senha";
        $db = DB::getDB()->prepare($query);
        $db->bindValue(":email", $email, PDO::PARAM_STR);
        $db->bindValue(":senha", $senha, PDO::PARAM_STR);
        $db->execute();
        return DB::getValue($db, "id_usuario");
    }

    /**
     * @param string $slug
     * @return UsuarioInfo
     */
    public function pegarPorSlug($slug){
        $query = $this->query();
        $query.= " WHERE usuario.slug = :slug";
        $db = DB::getDB()->prepare($query);
        $db->bindValue(":slug", $slug, PDO::PARAM_STR);
        return DB::getValueClass($db, "\\App\\Model\\UsuarioInfo");
    }

    /**
     * @param string $email
     * @param string $senha
     * @return string
     */
    public function pegarSlug($email, $senha){
        $query = "SELECT usuario.slug FROM usuario WHERE usuario.email = :email AND usuario.senha = :senha";
        $db = DB::getDB()->prepare($query);
        $db->bindValue(':email', $email, PDO::PARAM_STR);
        $db->bindValue(':senha',$senha, PDO::PARAM_STR);
        $db->execute();
        return DB::getValue($db,'slug');
    }

}