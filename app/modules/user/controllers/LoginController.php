<?php
namespace App\Modules\User\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Flash\Session;

use App\Modules\User\Forms\RegisterForm;
use App\Modules\User\Forms\LoginForm;
use App\Modules\User\Models\Customer\Customer;

/**
 *
 * @RoutePrefix("/user")
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
     *      '/login',
     *      methods={'POST'}
     *  )
     *
     * @property Session $flashSession
     */
    public function loginAction()
    {
        $form = new LoginForm();

        if ($this->request->isPost()) {
            $postData = $this->request->getPost();

            if ($form->isValid($postData) === false) {
                foreach ($form->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
                return $this->response->redirect('/');
            }
            $loginResult = $this->userRepo->checkLogin($postData);

            if ($loginResult == 1) {
                $this->session->set('user', $loginResult);
                $this->session->set('start_time', time());
                $this->flashSession->success('Login success!');
                return $this->response->redirect('/product');
            } elseif ($loginResult == -1) {
                $this->flashSession->error('No account exists!');
                return $this->response->redirect('/');
            } else {
                $this->flashSession->error('Incorrect password!');
                return $this->response->redirect('/');
            }
        }
    }

    /**
     * @Route(
     *      '/logout',
     *      methods={'GET'}
     *  )
     *
     * @property Session $flashSession
     */
    public function logoutAction()
    {
        $this->session->destroy();
        unset($this->session->user);
        $this->response->redirect('/');
    }

    /**
     * @Route(
     *      '/signup',
     *      methods={'POST'}
     *  ) 
     * @property Session $flashSession
     */
    public function signupAction(): void
    {
        $form = new RegisterForm();
        $newUser = new Customer();
        $postData = $this->request->getPost();

        if (!$this->request->isPost()) {
            $this->view->form = $form;
            $this->response->redirect('/signup');
            return;
        }

        if (!$form->isValid($postData, $newUser)) {
            foreach ($form->getMessages() as $message) {
                $this->flashSession->error($message);
            }
            $this->view->form = $form;
            $this->response->redirect('/signup');
            return;
        }

        try {
            $result = $this->userRepo->signUp($postData, $newUser);

            if(!$result) {  
                foreach ($form->getMessages() as $message) {
                    $this->flashSession->error((string) $message);
                }
                $this->view->form = $form;
                $this->response->redirect('/signup');
                return;
            }
    
            $this->flashSession->success('Registration success!');
            $this->response->redirect('/');
        } catch (ErrorException $e) {
            $this->flashSession->error('Registration failed. Please try again.');
            $this->view->form = $form;
            $this->response->redirect('/signup');
        }
    }
}
?>