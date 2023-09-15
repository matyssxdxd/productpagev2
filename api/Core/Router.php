<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;
use ReflectionClass;

class Router
{

    protected array $routes = [];

    protected function add($uri, $params, $request): static
    {
        $this->routes[] = [
            "uri" => $uri,
            "controller" => $params["controller"],
            "method" => $params["method"],
            "request" => $request,
        ];

        return $this;
    }

    public function staticFile($uri, $filePath): static
    {
        $this->routes[] = [
            "uri" => $uri,
            "filePath" => $filePath
        ];

        return $this;
    }

    public function get($uri, $params): static
    {
        return $this->add($uri, $params, "GET");
    }

    public function post($uri, $params): static
    {
        return $this->add($uri, $params, "POST");
    }

    public function delete($uri, $params): static
    {
        return $this->add($uri, $params, "DELETE");
    }

    /**
     * @throws \ReflectionException
     */
    public function route($uri, $request): void
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["request"] === strtoupper($request)) {

                    $controllerClassName = "App\\Controllers\\" . $route["controller"];
                    $reflectionClass = new ReflectionClass($controllerClassName);
                    $controller = $reflectionClass->newInstance();
                    $method = $route["method"];
                    $controller->$method();
                    die();
            }
        }
    }

    #[NoReturn] protected function abort($code = 404): void
    {
        http_response_code($code);
        die();
    }

}