<?php

namespace App\Controllers;

use App\Factory\ProductFactory;
use App\Models\BookModel;
use App\Models\DVDModel;
use App\Models\FurnitureModel;

class ProductController
{

    public function addProduct()
    {
        $product = json_decode(file_get_contents("php://input"));

        $name = $product->inputs->name;
        $sku = $product->inputs->sku;
        $price = (int)$product->inputs->price;
        $productType = $product->inputs->type;
        $weight = $product->attributes->weight ?? null;
        $size = $product->attributes->size ?? null;
        $height = $product->attributes->height ?? null;
        $width = $product->attributes->width ?? null;
        $length = $product->attributes->length ?? null;

        match ($productType) {
            'Book' => $productClass = (new BookModel()),
            'DVD' => $productClass = (new DVDModel()),
            'Furniture' => $productClass = (new FurnitureModel()),
        };

        $product = (new ProductFactory())->create(
            $productClass,
            $name,
            $sku,
            $price,
            $productType,
            weight: $weight,
            size: $size,
            width: $width,
            height: $height,
            length: $length
        );

        return $product->saveProduct();
    }
}