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
        $weight = (int)$product->attributes->weight ?? null;
        $size = (int)$product->attributes->size ?? null;
        $height = (int)$product->attributes->height ?? null;
        $width = (int)$product->attributes->width ?? null;
        $length = (int)$product->attributes->length ?? null;

        if (empty($productType) || empty($name) || empty($sku) || empty($price)) {
            echo json_encode(["status" => 400, "message" => "Please provide the required data"]);
            die();
        }

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

        echo json_encode($product->saveProduct());
    }
}