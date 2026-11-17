<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Motorcycle;

final class MotorcycleController extends Controller
{
    private const CATEGORIES = ['Matic', 'Sport', 'Bebek', 'Trail', 'Cruiser', 'Listrik'];

    public function dashboard(): void
    {
        $motorcycles = new Motorcycle();
        $this->render('dashboard/index', [
            'pageTitle' => 'Ringkasan showroom',
            'activePage' => 'dashboard',
            'stats' => $motorcycles->stats(),
            'recentMotorcycles' => $motorcycles->recent(),
        ]);
    }

    public function index(): void
    {
        $motorcycles = new Motorcycle();
        $search = trim((string) ($_GET['q'] ?? ''));
        $category = trim((string) ($_GET['kategori'] ?? ''));

        $this->render('motorcycles/index', [
            'pageTitle' => 'Koleksi motor',
            'activePage' => 'motorcycles',
            'motorcycles' => $motorcycles->all($search, $category),
            'categories' => $motorcycles->categories(),
            'search' => $search,
            'selectedCategory' => $category,
        ]);
    }

    public function create(): void
    {
        $this->renderForm('Tambah motor', $this->emptyMotorcycle(), []);
    }

    public function store(): void
    {
        $this->verifyCsrf();
        $data = $this->input();
        $errors = $this->validate($data);

        if ($errors !== []) {
            $this->renderForm('Tambah motor', $data, $errors);
            return;
        }

        (new Motorcycle())->create($data);
        $this->flash('success', 'Motor baru berhasil ditambahkan ke showroom.');
        $this->redirect('/motorcycles');
    }

    public function edit(string $id): void
    {
        $motorcycle = (new Motorcycle())->find((int) $id);
        if ($motorcycle === null) {
            $this->notFound();
            return;
        }

        $this->renderForm('Edit motor', $motorcycle, []);
    }

    public function update(string $id): void
    {
        $this->verifyCsrf();
        $model = new Motorcycle();
        if ($model->find((int) $id) === null) {
            $this->notFound();
            return;
        }

        $data = $this->input();
        $errors = $this->validate($data);
        if ($errors !== []) {
            $data['id'] = (int) $id;
            $this->renderForm('Edit motor', $data, $errors);
            return;
        }

        $model->update((int) $id, $data);
        $this->flash('success', 'Perubahan informasi motor berhasil disimpan.');
        $this->redirect('/motorcycles');
    }

    public function destroy(string $id): void
    {
        $this->verifyCsrf();
        $model = new Motorcycle();
        if ($model->find((int) $id) === null) {
            $this->notFound();
            return;
        }

        $model->delete((int) $id);
        $this->flash('success', 'Motor berhasil dihapus dari koleksi.');
        $this->redirect('/motorcycles');
    }

    private function renderForm(string $title, array $motorcycle, array $errors): void
    {
        $this->render('motorcycles/form', [
            'pageTitle' => $title,
            'activePage' => 'motorcycles',
            'formTitle' => $title,
            'motorcycle' => $motorcycle,
            'errors' => $errors,
            'categories' => self::CATEGORIES,
            'isEditing' => isset($motorcycle['id']),
        ]);
    }

    private function input(): array
    {
        return [
            'brand' => trim((string) ($_POST['brand'] ?? '')),
            'model' => trim((string) ($_POST['model'] ?? '')),
            'category' => trim((string) ($_POST['category'] ?? '')),
            'model_year' => trim((string) ($_POST['model_year'] ?? '')),
            'engine_cc' => trim((string) ($_POST['engine_cc'] ?? '')),
            'color' => trim((string) ($_POST['color'] ?? '')),
            'price' => trim((string) ($_POST['price'] ?? '')),
            'stock' => trim((string) ($_POST['stock'] ?? '')),
            'location' => trim((string) ($_POST['location'] ?? '')),
            'description' => trim((string) ($_POST['description'] ?? '')),
        ];
    }

    private function validate(array &$data): array
    {
        $errors = [];
        if ($data['brand'] === '' || mb_strlen($data['brand']) > 80) {
            $errors['brand'] = 'Merek wajib diisi dan maksimal 80 karakter.';
        }
        if ($data['model'] === '' || mb_strlen($data['model']) > 100) {
            $errors['model'] = 'Model wajib diisi dan maksimal 100 karakter.';
        }
        if (!in_array($data['category'], self::CATEGORIES, true)) {
            $errors['category'] = 'Pilih jenis motor yang tersedia.';
        }
        if (filter_var($data['model_year'], FILTER_VALIDATE_INT) === false
            || (int) $data['model_year'] < 1990
            || (int) $data['model_year'] > (int) date('Y') + 1) {
            $errors['model_year'] = 'Masukkan tahun produksi yang valid.';
        } else {
            $data['model_year'] = (int) $data['model_year'];
        }
        if (filter_var($data['engine_cc'], FILTER_VALIDATE_INT) === false
            || (int) $data['engine_cc'] < 0
            || (int) $data['engine_cc'] > 2500) {
            $errors['engine_cc'] = 'Kapasitas mesin harus berupa angka antara 0 hingga 2.500 cc.';
        } else {
            $data['engine_cc'] = (int) $data['engine_cc'];
        }
        if ($data['color'] === '' || mb_strlen($data['color']) > 40) {
            $errors['color'] = 'Warna wajib diisi dan maksimal 40 karakter.';
        }
        if (!is_numeric($data['price']) || (float) $data['price'] < 0 || (float) $data['price'] > 9999999999) {
            $errors['price'] = 'Harga harus berupa angka antara 0 hingga 9.999.999.999.';
        } else {
            $data['price'] = (float) $data['price'];
        }
        if (filter_var($data['stock'], FILTER_VALIDATE_INT) === false || (int) $data['stock'] < 0) {
            $errors['stock'] = 'Stok harus berupa bilangan bulat, minimal 0.';
        } else {
            $data['stock'] = (int) $data['stock'];
        }
        if ($data['location'] === '' || mb_strlen($data['location']) > 60) {
            $errors['location'] = 'Lokasi wajib diisi dan maksimal 60 karakter.';
        }
        if (mb_strlen($data['description']) > 1000) {
            $errors['description'] = 'Catatan maksimal 1.000 karakter.';
        }

        return $errors;
    }

    private function emptyMotorcycle(): array
    {
        return [
            'brand' => '',
            'model' => '',
            'category' => '',
            'model_year' => (int) date('Y'),
            'engine_cc' => '',
            'color' => '',
            'price' => '',
            'stock' => '',
            'location' => '',
            'description' => '',
        ];
    }

    private function notFound(): void
    {
        http_response_code(404);
        $this->render('errors/404', ['pageTitle' => 'Motor tidak ditemukan']);
    }
}
