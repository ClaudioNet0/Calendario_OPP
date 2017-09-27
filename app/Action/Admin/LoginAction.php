<?php
namespace App\Action\Admin;

use \App\Action\Action as Action;
use App\BLL\UsuarioBLL;
use Slim\Http\Request;
use Slim\Http\Response;
use App\DAL\UsuarioDAL;
use PDO;

final class LoginAction extends Action {
    public function index(Request $request, Response $response){
        if(isset($_SESSION[PREFIX.'logado'])){
            return $response->withRedirect(PATH.'/admin');
        }
        return $this->view->render($response, 'admin/login/login.phtml');
    }
    public function logar(Request $request, Response $response){
        $data = $request->getParsedBody();
        $email = strip_tags(filter_var($data['email'], FILTER_SANITIZE_STRING));
        $senha = strip_tags(filter_var($data['senha'], FILTER_SANITIZE_STRING ));

        if ($email != '' && $senha != '') {
            $regraUsuario = new UsuarioBLL();
            $verificaLogin = $regraUsuario->logar($email, $senha);

            if ($verificaLogin === true) {
                $_SESSION[PREFIX.'logado'] = true;
                $slug = $regraUsuario->pegarSlug($email, $senha);
                $GLOBALS['slug'] = $slug;
                return $response->withRedirect(PATH. '/admin/'.$slug);
            }else{
                $vars['erro'] = 'Você não foi encontrado no sistema.';
                return $this->view->render($response, 'admin/login/login.phtml', $vars);
            }
        }else{
            $vars['erro'] = 'Preencha todos os campos.';
            return $this->view->render($response, 'admin/login/login.phtml', $vars);
        }
    }
    public function logout(Request $request, Response $response){
        unset($_SESSION[PREFIX.'logado']);
        $GLOBALS['slug'] = null;
        session_destroy();
        return $response->withRedirect(PATH.'/admin/login');
    }
}