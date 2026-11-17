<?php
declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $pageTitle = $pageTitle ?? 'Garasi Pukimart';
        $activePage = $activePage ?? '';

        ob_start();
        require dirname(__DIR__) . '/Views/' . $view . '.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/Views/layout.php';
    }

    protected function redirect(string $path): never
    {
        header('Location: ' . $path);
        exit;
    }

    protected function flash(string $type, string $message): void
    {
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    protected function verifyCsrf(): void
    {
        $token = $_POST['_token'] ?? '';
        if (!is_string($token) || !hash_equals($_SESSION['_token'] ?? '', $token)) {
            http_response_code(419);
            exit('Sesi formulir tidak valid. Muat ulang halaman, lalu coba lagi.');
        }
    }
}
