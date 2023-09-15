<?php

namespace Core;

use App\Interfaces\ProductInterface;

abstract class Product extends Database implements ProductInterface
{
    private string $sku;
    private string $name;
    private int $price;
    private string $type;

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): Product
    {
        $this->sku = $sku;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): Product
    {
        $this->price = $price;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Product
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