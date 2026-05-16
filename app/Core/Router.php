<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->map('GET', $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->map('POST', $path, $handler);
    }

    private function map(string $method, string $path, array $handler): void
    {
        $this->routes[$method][$path] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        $dynamicPattern = '#^/undangan/([a-z0-9\-]+)$#i';
        if (preg_match($dynamicPattern, $path, $matches)) {
            [ $controller, $action ] = $this->routes['GET']['/undangan/{slug}'];
            (new $controller())->$action($matches[1]);
            return;
        }

        $handler = $this->routes[$method][$path] ?? null;
        if ($handler === null) {
            http_response_code(404);
            echo View::render('errors/404', ['title' => '404']);
            return;
        }

        [$controller, $action] = $handler;
        (new $controller())->$action();
    }
}
