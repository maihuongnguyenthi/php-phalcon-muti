<?php 
    namespace App\Modules\Product\Models\Product;

    class Product extends \Phalcon\Mvc\Model{
        public $id;
        public $name;
        public $price;
        public $description;

        public function initialize()
        {
            $this->setSource('products');
        }

        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getPrice(){
            return $this->price;
        }

        public function getDescription(){
            return $this->description;
        }
    }
?>