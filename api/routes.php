<?php

global $router;

$router->post("/api/addproduct", [
    "controller" => "ProductController",
    "method" => "addProduct"
]);