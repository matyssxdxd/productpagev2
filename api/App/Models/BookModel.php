<?php

namespace App\Models;

use Core\Product;

class BookModel extends Product
{

    private int $weight;

    public function getWeight(): string
    {
        return $this->weight;
    }

    public function setWeight(int $weight): BookModel
    {
        $this->weight = $weight;

        return $this;
    }

    public function saveProduct(): array
    {
        $this->query("INSERT INTO products(sku, name, price, type, weight) VALUES (:sku, :name, :price, :type, :weight)", [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "type" => $this->getType(),
            "weight" => $this->getWeight()
        ]);

        return ["status" => 1, "message" => "yay"];
    }

}