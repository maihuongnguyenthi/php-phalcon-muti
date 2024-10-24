<?php
namespace App\Modules\Product\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Flash\Session;
/**
 *
 * @RoutePrefix("/product")
 */
class LoginController extends Controller
{   
    private $session;

    private $userRepo;

    public function initialize()
    {
        $this->session = $this->di->get('session');
        $this->userRepo = $this->di->get('userRepo');
    }


    /**
     * @Route(
     *      '/add',
     *      methods={'POST'}
     *  ) 
     * @property Session $flashSession
     */
    public function addAction(){
        $name = $this->request->getPost("name");
        $price = $this->request->getPost("price");
        $description = $this->request->getPost("description");

        $addResult = $this->userRepo->add($name, $price, $description);

        if($addResult == 1){
            $this->flashSession->success('Add product success!');
            $this->response->redirect('/admin/product/list');
        }else if ($addResult == -1) {
            $this->flashSession->error("Product exists!");
            $this->response->redirect('/addProduct');
        } else {
            $this->flashSession->error('Registration failed. Please try again.');
            $this->response->redirect('/addProduct');
        }
    }
}
?>