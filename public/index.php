<?php
declare(strict_types=1);

use App\Controllers\MotorcycleController;
use App\Core\Router;

session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
]);

if (!isset($_SESSION['_token'])) {
    $_SESSION['_token'] = bin2hex(random_bytes(32));
}

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $file = dirname(__DIR__) . '/app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

require dirname(__DIR__) . '/app/helpers.php';

$router = new Router();
$router->get('/', [MotorcycleController::class, 'dashboard']);
$router->get('/motorcycles', [MotorcycleController::class, 'index']);
$router->get('/motorcycles/create', [MotorcycleController::class, 'create']);
$router->post('/motorcycles', [MotorcycleController::class, 'store']);
$router->get('/motorcycles/{id}/edit', [MotorcycleController::class, 'edit']);
$router->post('/motorcycles/{id}/update', [MotorcycleController::class, 'update']);
$router->post('/motorcycles/{id}/delete', [MotorcycleController::class, 'destroy']);

try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (Throwable $exception) {
    error_log((string) $exception);
    http_response_code(500);
    echo '<!doctype html><html lang="id"><meta charset="utf-8"><title>Terjadi kendala</title>'
        . '<body style="font:16px sans-serif;padding:3rem;color:#303943"><h1>Showroom sedang beristirahat sebentar.</h1>'
        . '<p>Terjadi kendala saat memuat halaman. Periksa konfigurasi database dan log PHP, lalu coba lagi.</p></body></html>';
}
