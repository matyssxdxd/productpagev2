<?php

namespace App\Factory;

use App\Models\BookModel;
use App\Models\DVDModel;
use App\Models\FurnitureModel;
use App\Models\ProductModel;

class ProductFactory
{
    public function create(
        ProductModel $product,
        string       $name,
        string       $sku,
        int          $price,
        string       $type,
        ?int      $weight = null,
        ?int      $size = null,
        ?int      $width = null,
        ?int      $height = null,
        ?int      $length = null
    ): ProductModel
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