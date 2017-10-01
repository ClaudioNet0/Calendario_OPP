<?php
namespace App\Action;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Action\Action as Action;

final class HomeAction extends Action{
    public function index(Request $request, Response $response){
        $vars['page'] = 'home';
        return $this->view->render($response, "template.phtml", $vars);
    }
}