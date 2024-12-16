<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Entities\ProductEntity;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $productModel = model('ProductModel');
        $productEntity = new ProductEntity();
        $productEntity->name = 'Indomie Goreng';
        $productEntity->quantity = 100_000;
        $productEntity->price = 3500;

        $productModel->save($productEntity);

        $productEntity->name = 'Indomie Soto';
        $productEntity->quantity = 50_000;
        $productEntity->price = 3000;

        $productModel->save($productEntity);
    }
}
