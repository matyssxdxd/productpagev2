<?php

namespace App\Models;

use Core\Product;

class FurnitureModel extends Product
{

    private int $height;
    private int $width;
    private int $length;

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(?int $height): FurnitureModel
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(?int $width): FurnitureModel
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(?int $length): FurnitureModel
    {
        $this->length = $length;

        return $this;
    }

    public function saveProduct(): void
    {
        if (empty($this->getHeight()) || empty($this->getWidth()) || empty($this->getLength())) {
            error(400, "Please, submit required data");
        }
        if (!is_numeric($this->getPrice()) || !is_numeric($this->getHeight()) || !is_numeric($this->getWidth()) || !is_numeric($this->getLength())) {
            error(400, "Please, provide the data of indicated type");
        }
        if ($this->isSkuTaken($this->getSku())) {
            error(400, "SKU is already taken");
        }

        $this->query("INSERT INTO products(sku, name, price, type, height, width, length) VALUES (:sku, :name, :price, :type, :height, :width, :length)", [
            "sku" => $this->getSku(),
            "name" => $this->getName(),
            "price" => $this->getPrice(),
            "type" => $this->getType(),
            "height" => $this->getHeight(),
            "width" => $this->getWidth(),
            "length" => $this->getLength()
        ]);
    }


}