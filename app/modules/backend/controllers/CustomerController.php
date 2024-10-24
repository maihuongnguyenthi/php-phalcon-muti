<?php
namespace App\Modules\Backend\Controllers;

use Phalcon\Mvc\Controller;
/**
 *
 * @RoutePrefix("/admin/customer")
 */
class CustomerController extends Controller
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
            $listCustomer = $this->beRepo->getList();
            $this->view->customers = $listCustomer;           
            $this->view->pick(['backend/customer/list']);
        }
       
    }


    /**
     * @Get('/show/{id:[0-9]+}')
     * 
     * @property Session $flashSession
     */
    public function showAction($id)
    {
        if(!isset($this->session->user)){
            $this->response->redirect('/');
        }else{
            $customer = $this->beRepo->getCustomerByID($id);

            if(!$customer){
                $this->flashSession->error("Customer not exists!");
                $this->response->redirect('/admin/customer/list');
            }else{
                $this->view->customer = $customer;
                $this->view->pick(['backend/customer/show']);
            }
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
            $phone = $this->request->getPost('phone');
            $address = $this->request->getPost('address');
            $email = $this->request->getPost('email');
            
            $insertResult = $this->beRepo->insertCustomer($name, $phone, $address, $email);

            if($insertResult == 1){
                $this->flashSession->success('Insert customer success!');
            }else if ($insertResult == -1) {
                $this->flashSession->error("Email exists!");
            } else {
                $this->flashSession->error('Insert failed. Please try again!');
            }

            $this->response->redirect('/admin/customer/list');

        }
    }

     /**    
     * @Route('/delete/{id:[0-9]+}', methods={'GET'})
     *
     * @property Session $flashSession 
     */
    public function updateAction($id){
        if(!isset($this->session->user)){
            $this->response->redirect('/');
        }else{
            $updateResult = $this->beRepo->deleteCustomer($id);
            if($updateResult == 1){
                $this->flashSession->success('Delete customer success!');
            }else if($updateResult == -1){
                $this->flashSession->error('Customer not exists!');
            }else{
                $this->flashSession->error('Delete failed. Please try again!');
            }
            $this->response->redirect('/admin/customer/list');
        }
    }
}