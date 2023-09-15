<?php

namespace App\Models;

use App\Interfaces\ProductInterface;
use Core\Database;

abstract class ProductModel extends Database implements ProductInterface
{
    private string $sku;
    private string $name;
    private int $price;
    private string $type;

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): ProductModel
    {
        $this->sku = $sku;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProductModel
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): ProductModel
    {
        $this->price = $price;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): ProductModel
    {
        $this->type = $type;

        return $this;
    }

    protected function isSkuTaken(string $sku): bool
    {
        $skuList = $this->query("SELECT sku FROM products")->findAll();

        foreach ($skuList as $value)
        {
            if ($value["sku"] == $sku) {
                return true;
            }
        }

        return false;
    }


}