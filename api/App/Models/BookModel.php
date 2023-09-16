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

    public function setWeight(?int $weight): BookModel
    {
        $this->weight = $weight;

        return $this;
    }

    public function saveProduct(): void
    {
        if (empty($this->getWeight())) {
            error(400, "Please, submit required data");
        }
        if (!is_numeric($this->getPrice()) || !is_numeric($this->getWeight())) {
            error(400, "Please, provide the data of indicated type");
        }
        if ($this->isSkuTaken($this->getSku())) {
            error(400, "SKU is already taken");
        }

        $this->query("INSERT INTO products(sku, name, price, type, weight) VALUES (:sku, :name, :price, :type, :weight)", [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "type" => $this->getType(),
            "weight" => $this->getWeight()
        ]);

    }

}