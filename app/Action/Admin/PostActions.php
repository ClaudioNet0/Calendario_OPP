<?php
namespace App\Action\Admin;
use \App\Action\Action as Action;
use App\DAL\EventoDAL;
use App\Model\EventoInfo;
use Slim\Http\Request;
use Slim\Http\Response;
use App\BLL\EventoBLL;
use \Exception;

final class PostActions extends Action{
    public function editTitle(Request $request, Response $response){
        if (isset($_POST['delete']) && isset($_POST['id'])){

            $id_evento = $_POST['id'];
            $regraEvento = new EventoBLL();
            $regraEvento->deletar($id_evento);
        }elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){

            $id_evento = $_POST['id'];
            $title = $_POST['title'];
            $color = $_POST['color'];

            $evento = new EventoInfo();
            $evento->setId($id_evento);
            $evento->setTitle($title);
            $evento->setColor($color);

            $dal = new EventoDAL();
            $dal->alterarCaracteristicas($evento);
        }
        $slug = $_POST['slug'];
        if (is_null($slug) || empty($slug)){
            throw new Exception('Slug está vazio!');
        }
        
        return $response->withStatus(302)->withHeader('Location', '/admin/'.$slug);

    }

    public function addEvent(Request $request, Response $response){
        if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['id_usuario'])){

            $id_usuario = $_POST['id_usuario'];
            $title = $_POST['title'];
            $start = $_POST['start'];
            $end = $_POST['end'];
            $color = $_POST['color'];

            $evento = new EventoInfo();
            $evento->setIdUsuario($id_usuario);
            $evento->setTitle($title);
            $evento->setStart($start);
            $evento->setEnd($end);
            $evento->setColor($color);


            $regraEvento = new EventoBLL();
            $regraEvento->inserir($evento);
        }
        $slug = $_POST['slug'];
        if (is_null($slug) || empty($slug)){
            throw new Exception('Slug está vazio!');
        }
        return $response->withStatus(302)->withHeader('Location', '/admin/'.$slug);
    }
}