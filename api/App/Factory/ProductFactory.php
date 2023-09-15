<?php

namespace App\Factory;

use App\Models\BookModel;
use App\Models\DVDModel;
use App\Models\FurnitureModel;
use Core\Product;

class ProductFactory
{
    public function create(
        Product $product,
        string  $name,
        string  $sku,
        int     $price,
        string  $type,
        ?int    $weight = null,
        ?int    $size = null,
        ?int    $width = null,
        ?int    $height = null,
        ?int    $length = null
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