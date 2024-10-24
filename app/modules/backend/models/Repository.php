<?php
namespace App\Modules\Backend\Models;

use App\Modules\User\Models\Customer\Customer;

use Phalcon\Encryption\Security;
use Phalcon\Di\Injectable;
use Exception;

class Repository extends Injectable
{
    private $security;
    public function __construct()
    {
        $this->security = new Security();
    }

    public function getList()
    {
        $list = $this->getDi()->get('modelsManager')->createBuilder()
            ->from(['customer' => "App\Modules\User\Models\Customer\Customer"])
            ->columns([
                "customer.*",
            ])
            ->orderBy('customer.id')
            ->getQuery()
            ->execute();  

        if (!empty($list)) {
            return $list;
       }

       return false;
    }

    public function getCustomerByID($id){
        $checkCustomer = Customer::findFirst([
            'conditions' => 'id = :id:',
            'bind'       => [
                'id' => $id,
            ],
        ]);

        if($checkCustomer){
            return $checkCustomer;
        }
        return false;
    }

    public function getCustomerByEmailDifId($id, $email){
        $checkCustomer = Customer::findFirst([
            'conditions' => 'id != :id: AND email = :email:',
            'bind'       => [
                'id' => $id,
                'email' => $email,
            ],
        ]);

        if($checkCustomer){
            return $checkCustomer;
        }
        return false;
    }

    public function insertCustomer($name, $phone, $address, $email){
        $checkCustomer = Customer::findFirst([
            'conditions' => 'email = :email:',
            'bind'       => [
                'email' => $email,
            ],
        ]);

        if($checkCustomer){
            return -1;
        }

        $pass = $this->security->hash('123456');

        $customer = new Customer();
        $customer->name = $name;
        $customer->phone = $phone;
        $customer->address = $address;
        $customer->email = $email;
        $customer->pass = $pass;
        $customer->save();

        if($customer){
            return 1;
        }else{
            return 0;
        }

    }

    public function updateCustomer($id, $data){
        $this->db->begin();
        try{
            $checkCustomer = $this->getCustomerByEmailDifId($id, $data['email']);
            if($checkCustomer){
                return -1;
            }else{
                $find = Customer::findFirst([
                    'conditions' => 'id = :id:',
                    'bind'       => [
                        'id' => $id,
                    ],
                ]);
        
                if($find){
                    $find->name = $data['name'];
                    $find->phone = $data['phone'];
                    $find->address = $data['address'];
                    $find->email = $data['email'];
                    $result = $find->update();
                    if(!$result){
                        $this->db->rollback();
                        return 0;
                    }
                    $this->db->commit();
                    return 1;
                }
            }
    
        }catch(Exception $ex){
            throw new Exception($ex->getMessage());
            return 0;
        }
    }

    public function deleteCustomer($id){
        $this->db->begin();

        try{
            $customer = $this->getCustomerByID($id);

            if(!$customer){
                return -1;
            }else{
                $result = $customer->delete();
                if(!$result){
                    $this->db->rollback();
                    return 0; 
                }
                $this->db->commit();
                return 1;
            }

        }catch(Exception $ex){
            throw new Exception($ex->getMessage());
            return 0;
        }
        
    }
}