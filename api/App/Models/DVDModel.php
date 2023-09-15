<?php

namespace App\Models;

class DVDModel extends ProductModel
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
        if (empty($this->getSize())) {
            return ['status' => 400, 'message' => 'Please, submit required data'];
        }
        if (!is_numeric($this->getPrice()) || !is_numeric($this->getSize())) {
            return ['status' => 400, 'message' => 'Please, provide the data of indicated type'];
        }
        if ($this->isSkuTaken($this->getSku())) {
            return ['status' => 400, 'message' => 'SKU is already taken'];
        }

        $this->query("INSERT INTO products(sku, name, price, type, size) VALUES (:sku, :name, :price, :type, :size)", [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "type" => $this->getType(),
            "size" => $this->getSize()
        ]);

        return ["status" => 200];
    }

}