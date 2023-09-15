<?php

namespace App\Factory;

use App\Models\BookModel;
use App\Models\FurnitureModel;
use App\Models\DVDModel;
use Core\Product;

class ProductFactory
{
    public function create(
        Product $product,
        string  $name,
        string  $sku,
        int     $price,
        string  $type,
        ?string $weight = null,
        ?string $size = null,
        ?string $width = null,
        ?string $height = null,
        ?string $length = null
    ): Product
    {
        $product = (new $product)
            ->setName($name)
            ->setSku($sku)
            ->setPrice($price)
            ->setType($type);

        if ($product instanceof BookModel) {
            $product->setWeight($weight);
        }

        if ($product instanceof DVDModel) {
            $product->setSize($size);
        }

        if ($product instanceof FurnitureModel) {
            $product->setWidth($width)
                ->setHeight($height)
                ->setLength($length);
        }

        return $product;
    }
}