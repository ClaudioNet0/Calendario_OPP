<?php
namespace App\Action\Admin;
use \App\Action\Action as Action;
use Slim\Http\Request;
use Slim\Http\Response;

final class HomeAction extends Action{
    public function index(Request $request, Response $response){
        $vars['page'] = 'home';
        $vars['slug'] = $request->getAttribute('slug');
        return $this->view->render($response, 'admin/template.phtml', $vars);
    }
}