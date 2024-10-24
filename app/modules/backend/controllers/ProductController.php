<?php
namespace App\Modules\Backend\Controllers;

use Phalcon\Mvc\Controller;
/**
 *
 * @RoutePrefix("/admin/product")
 */
class ProductController extends Controller
{   
    private $session;
    private $beRepo;

    public function initialize()
    {
        $this->session = $this->di->get('session');
        $this->beRepo = $this->di->get('beRepo');
    }

    /**
    * @Get("/list")
    */
    public function listAction(){
        if(!isset($this->session->user)){
            $this->response->redirect('/');
        }else{
            $listProduct = $this->beRepo->getListProduct();
            $this->view->products = $listProduct;           
            $this->view->pick(['backend/product/list']);
        }  
    }

    /**
     * @Route('/insert', methods={'POST'})
     * 
     * @property Session $flashSession
     */
    public function insertAction(){
        if(!isset($this->session->user)){   
            $this->response->redirect('/');
        }else{

            $name = $this->request->getPost("name");
            $price = $this->request->getPost('price');
            $description = $this->request->getPost('description');
            
            $insertResult = $this->beRepo->insertProduct($name, $price, $description);

            if($insertResult == 1){
                $this->flashSession->success('Insert product success!');
            }else if ($insertResult == -1) {
                $this->flashSession->error("product exists!");
            } else {
                $this->flashSession->error('Insert failed. Please try again!');
            }

            $this->response->redirect('/admin/product/list');

        }
    }
}