<?php
namespace App\Modules\User\Models\Customer;

use App\Modules\User\Models\Customer\Customer;

use Phalcon\Di\Injectable;
use Phalcon\Encryption\Security;
use Phalcon\Encryption\Crypt;


class Repository extends Injectable
{
    // private $security;
    // public function __construct()
    // {
    //     $this->security = new Security();
    // }

    public function createCustomer(Customer $users)
    {
        $users->save();
    }

    public function findUserByEmail(string $email): ?Customer
    {
        return Customer::findFirst([
            'conditions' => 'email = :email:',
            'bind' => [
                'email' => $email,
            ],
        ]) ?: null;
    }

    public function signUp(array $postData, $newUser)
    {
        $crypt  = new Crypt();
        $crypt->setCipher('aes256')->useSigning(false);
        $encryptedPassword = $crypt->encrypt($postData['pass'], 'mykey');
        $newUser->pass = base64_encode($encryptedPassword);
        try {
            $this->createCustomer($newUser);
            return $newUser;   
        }
        catch (\Exception $e) {
            throw new \ErrorException(500, 'Server Error');
        }
    }

    public function checkLogin(array $postData)
    {            
        $user = $this->findUserByEmail($postData['email']);
        if (!$user) {
            return -1;
        }
        $crypt = new Crypt();
        $crypt->setCipher('aes256')->useSigning(false);
        $encryptedPassword = base64_decode($user->pass);
        $decryptedPassword = $crypt->decrypt($encryptedPassword, 'mykey');
        if($postData['pass'] === $decryptedPassword){
            return 1;
        }else{
            return 0;
        } 
    }
}