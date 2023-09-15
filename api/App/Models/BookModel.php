<?php

namespace App\Models;

class BookModel extends ProductModel
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
        if (empty($this->getWeight())) {
            return ['status' => 400, 'message' => 'Please, submit required data'];
        }
        if (!is_numeric($this->getPrice()) || !is_numeric($this->getWeight())) {
            return ['status' => 400, 'message' => 'Please, provide the data of indicated type'];
        }
        if ($this->isSkuTaken($this->getSku())) {
            return ['status' => 400, 'message' => 'SKU is already taken'];
        }

        $this->query("INSERT INTO products(sku, name, price, type, weight) VALUES (:sku, :name, :price, :type, :weight)", [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "type" => $this->getType(),
            "weight" => $this->getWeight()
        ]);

        return ["status" => 200, "message" => "success"];
    }

}