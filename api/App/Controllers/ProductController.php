<?php

namespace App\Controllers;

use App\Factory\ProductFactory;
use App\Models\BookModel;
use App\Models\DVDModel;
use App\Models\FurnitureModel;
use App\Models\ProductsModel;

class ProductController
{

    public function addProduct()
    {

        $sku = array_key_exists("sku", $_POST) ? $_POST["sku"] : null;
        $name = array_key_exists("name", $_POST) ? $_POST["name"] : null;
        $price = array_key_exists("price", $_POST) ? (int)$_POST["price"] : null;
        $productType = array_key_exists("type", $_POST) ? $_POST["type"] : null;
        $weight = array_key_exists("weight", $_POST) ? (int)$_POST["weight"] : null;
        $size = array_key_exists("size", $_POST) ? (int)$_POST["size"] : null;
        $height = array_key_exists("height", $_POST) ? (int)$_POST["height"] : null;
        $width = array_key_exists("width", $_POST) ? (int)$_POST["width"] : null;
        $length = array_key_exists("length", $_POST) ? (int)$_POST["length"] : null;

        if (empty($productType)) {
            http_response_code(400);
            echo json_encode(["message" => "Please, select a type"]);
            die();
        }
        else if (empty($name) || empty($sku) || empty($price)) {
            http_response_code(400);
            echo json_encode(["message" => "Please, provide the required data"]);
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

    public function getProducts()
    {
        echo json_encode((new ProductsModel())->getAllProducts());
    }

    public function deleteProduct()
    {
        echo explode("/", $_SERVER["REQUEST_URI"])[2];
        die();
        (new ProductsModel())->deleteProduct($sku);
    }
}