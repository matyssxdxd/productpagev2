<?php

namespace App\Models;

use Core\Product;

class DVDModel extends Product
{

    private int $size;

    public function getSize(): int
    {
        return $this->size;
    }

    public function setSize(?int $size): DVDModel
    {
        $this->size = $size;

        return $this;
    }

    public function saveProduct(): array
    {
        if (empty($this->getSize())) {
            error(400, "Please, submit required data");
        }
        if (!is_numeric($this->getPrice()) || !is_numeric($this->getSize())) {
            error(400, "Please, provide the data of indicated type");
        }
        if ($this->isSkuTaken($this->getSku())) {
            error(400, "SKU is already taken");
        }

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