<?php

namespace App\Models;

use Core\Product;

class DVDModel extends Product
{

    private int $size;

    public function getSize()
    {
        return $this->size;
    }

    public function setSize(int $size): DVDModel
    {
        $this->size = $size;

        return $this;
    }

    public function saveProduct(): array
    {
        $this->query("INSERT INTO products(sku, name, price, type, size) VALUES (:sku, :name, :price, :type, :size)", [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "type" => $this->getType(),
            "size" => $this->getSize()
        ]);

        return [];
    }

}