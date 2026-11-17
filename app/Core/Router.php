<?php
declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = '/' . trim((string) parse_url($uri, PHP_URL_PATH), '/');
        $path = $path === '//' ? '/' : $path;

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method || preg_match($route['pattern'], $path, $matches) !== 1) {
                continue;
            }

            $parameters = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            [$controllerClass, $action] = $route['handler'];
            (new $controllerClass())->{$action}(...array_values($parameters));
            return;
        }

        http_response_code(404);
        echo 'Halaman tidak ditemukan.';
    }

    private function add(string $method, string $path, array $handler): void
    {
        $pattern = preg_replace_callback(
            '/\{([a-zA-Z][a-zA-Z0-9_]*)\}/',
            static fn (array $match): string => '(?P<' . $match[1] . '>[0-9]+)',
            $path
        );

        $this->routes[] = [
            'method' => $method,
            'pattern' => '#^' . $pattern . '$#',
            'handler' => $handler,
        ];
    }
}
