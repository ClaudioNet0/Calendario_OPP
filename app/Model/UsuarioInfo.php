<?php

namespace App\Model;


class UsuarioInfo{

    private $id_usuario;
    private $nome;
    private $senha;
    private $email;
    private $slug;

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
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $value
     */
    public function setNome($value)
    {
        $this->nome = $value;
    }

    /**
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param string $value
     */
    public function setSenha($value)
    {
        $this->senha = $value;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $value
     */
    public function setEmail($value)
    {
        $this->email = $value;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $value
     */
    public function setSlug($value)
    {
        $this->slug = $value;
    }


}