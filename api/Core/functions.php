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

#[NoReturn] function error($responseCode, $errorMessage): void
{
    http_response_code($responseCode);
    echo json_encode(["message" => $errorMessage]);
    die();
}

function success($responseCode, $message): void
{
    http_response_code($responseCode);
    echo json_encode(["message" => $message]);
    die();
}