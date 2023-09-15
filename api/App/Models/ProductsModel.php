<?php

namespace App\Models;

use Core\Database;

class ProductsModel extends Database
{
    public function getAllProducts()
    {
        return $this->query("SELECT * FROM products")->findAll();
    }

    public function deleteProduct(string $sku)
    {
        $this->query("DELETE FROM products WHERE sku = :sku", [
            "sku" => $sku
        ]);
    }
}