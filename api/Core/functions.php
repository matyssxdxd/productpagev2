<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function dd($value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function error($responseCode, $errorMessage)
{
    http_response_code($responseCode);
    echo json_encode(["message" => $errorMessage]);
    die();
}