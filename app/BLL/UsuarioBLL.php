<?php
namespace App\BLL;

use App\DAL\DB;
use App\DAL\UsuarioDAL;
use App\Model\UsuarioInfo;
use Exception;

class UsuarioBLL{

    /**
     * @param string $email
     * @param string $senha
     * @return bool
     */
    public function logar($email, $senha){
        $regraUsuario = new UsuarioDAL();
        $logar = $regraUsuario->logar($email, $senha);
        if(!is_null($logar) && is_numeric($logar)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param string $slug
     * @return UsuarioInfo
     * @throws Exception
     */
    public function pegarPorSlug($slug){

        if(!isset($slug) || is_null($slug)){
            throw new Exception('O Slug está nulo!');
        }

        $dal = new UsuarioDAL();
        return $dal->pegarPorSlug($slug);
    }

    /**
     * @param string $email
     * @param string $senha
     * @throws Exception
     * @return string
     */
    public function pegarSlug($email, $senha){
        if(!isset($email) || is_null($email) || !isset($senha) || is_null($senha)){
            throw new Exception('Emai lou senha está nulo!');
        }
        $dal = new UsuarioDAL();
        return $dal->pegarSlug($email, $senha);
    }

}