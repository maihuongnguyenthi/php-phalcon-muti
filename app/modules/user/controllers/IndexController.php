<?php
    namespace App\Modules\User\Controllers;

    use Phalcon\Mvc\Controller;
    use Phalcon\Mvc\View;

    use App\Modules\User\Forms\RegisterForm;
    use App\Modules\User\Forms\LoginForm;
    /**
     * @RoutePrefix("/")
     */

    /** 
     * @property View $view
     */

    class IndexController extends Controller
    {
        /**
         * @Get("/")
         */
        public function indexAction(){ 
            $form = new LoginForm();
            try {
                $this->view->form = $form;
                $this->view->pick(['user/login']);
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }        
        }
        
         /**
         * @Get("/signup")
         */
        public function signUpAction(){
            $form = new RegisterForm();
            try {
                $this->view->form = $form;
                $this->view->pick(['user/signUp']);
            } catch (\Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }       
            
        }
    }
?>