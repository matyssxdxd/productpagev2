<?php

global $router;

$router->post("/api/addproduct", [
    "controller" => "ProductController",
    "method" => "addProduct"
]);

$router->get("/api/getproducts", [
    "controller" => "ProductController",
    "method" => "getProducts"
]);

$router->get("/api/deleteproduct", [
    "controller" => "ProductController",
    "method" => "deleteProduct"
]);