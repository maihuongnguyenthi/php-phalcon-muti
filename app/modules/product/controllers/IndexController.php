<?php
    namespace App\Modules\Product\Controllers;

    use Phalcon\Mvc\Controller;
    use Phalcon\Mvc\View;
    /**
     * @RoutePrefix("/")
     */

    /** 
     * @property View $view
     */

    class IndexController extends Controller
    {
        private $session;

        private $userRepo;

        public function initialize()
        {
            $this->session = $this->di->get('session');
            $this->userRepo = $this->di->get('userRepo');
        }

        /**
        * @Get("/product")
        */
        public function listAction(){
            if(!isset($this->session->user)){
                $this->response->redirect('/');
            }else{
                $listProduct = $this->userRepo->getListProduct();
                $this->view->products = $listProduct;           
                $this->view->pick(['product/list']);
            }  
        }
    }
?>