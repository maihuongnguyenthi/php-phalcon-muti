<?php
namespace App\Modules\Product\Models\Product;

use Phalcon\Di\Injectable;

class Repository extends Injectable
{
    public function getListProduct()
    {
        $list = $this->getDi()->get('modelsManager')->createBuilder()
            ->from(['products' => "App\Modules\Product\Models\Product\Product"])
            ->columns([
                "products.*",
            ])
            ->orderBy('products.id')
            ->getQuery()
            ->execute();  

        if (!empty($list)) {
            return $list;
       }

       return false;
    }
}