<?php
namespace App\Modules\User\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Flash\Session;

use App\Modules\User\Forms\RegisterForm;
use App\Modules\User\Forms\LoginForm;

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

            $loginResult = $this->userRepo->checkLogin($postData['email'], $postData['pass']);

            if ($loginResult == 1) {
                $this->session->set('user', $loginResult);
                $this->session->set('start_time', time());
                return $this->response->redirect('/product');
            } elseif ($loginResult == -1) {
                $this->flashSession->error('No account exists!');
                return $this->response->redirect('/');
            } else {
                $this->flashSession->error('Incorrect password!');
                return $this->response->redirect('/');
            }
        }

        $this->view->form = $form;
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
    public function signUpAction()
    {
        $form = new RegisterForm();

        if ($this->request->isPost()) {
            $postData = $this->request->getPost();
            
            if ($form->isValid($postData) === false) {
                foreach ($form->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
                return $this->response->redirect('/signup');
            }

            $signUpResult = $this->userRepo->signUp(
                $postData['name'], 
                $postData['phone'], 
                $postData['address'], 
                $postData['email'], 
                $postData['pass']
            );

            if ($signUpResult == 1) {
                $this->flashSession->success('Registration success!');
                return $this->response->redirect('/');
            } elseif ($signUpResult == -1) {
                $this->flashSession->error("Email exists!");
                return $this->response->redirect('/signup');
            } else {
                $this->flashSession->error('Registration failed. Please try again.');
                return $this->response->redirect('/signup');
            }
        }

        $this->view->form = $form;
    }
}
?>