<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class Motorcycle
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function all(string $search = '', string $category = ''): array
    {
        $sql = "SELECT * FROM motorcycles WHERE (:search = '' OR brand LIKE :brand_search OR model LIKE :model_search OR location LIKE :location_search)"
            . " AND (:category = '' OR category = :selected_category) ORDER BY updated_at DESC, id DESC";
        $statement = $this->db->prepare($sql);
        $term = '%' . $search . '%';
        $statement->execute([
            'search' => $search,
            'brand_search' => $term,
            'model_search' => $term,
            'location_search' => $term,
            'category' => $category,
            'selected_category' => $category,
        ]);

        return $statement->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM motorcycles WHERE id = :id');
        $statement->execute(['id' => $id]);
        $motorcycle = $statement->fetch();

        return $motorcycle === false ? null : $motorcycle;
    }

    public function create(array $data): void
    {
        $statement = $this->db->prepare(
            'INSERT INTO motorcycles (brand, model, category, model_year, engine_cc, color, price, stock, location, description)'
            . ' VALUES (:brand, :model, :category, :model_year, :engine_cc, :color, :price, :stock, :location, :description)'
        );
        $statement->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $statement = $this->db->prepare(
            'UPDATE motorcycles SET brand = :brand, model = :model, category = :category, model_year = :model_year,'
            . ' engine_cc = :engine_cc, color = :color, price = :price, stock = :stock, location = :location, description = :description,'
            . ' updated_at = CURRENT_TIMESTAMP WHERE id = :id'
        );
        $statement->execute($data);
    }

    public function delete(int $id): void
    {
        $statement = $this->db->prepare('DELETE FROM motorcycles WHERE id = :id');
        $statement->execute(['id' => $id]);
    }

    public function stats(): array
    {
        $statement = $this->db->query(
            'SELECT COUNT(*) AS varieties, COALESCE(SUM(stock), 0) AS units,'
            . ' COALESCE(SUM(price * stock), 0) AS inventory_value,'
            . ' COALESCE(SUM(CASE WHEN stock <= 2 THEN 1 ELSE 0 END), 0) AS low_stock'
            . ' FROM motorcycles'
        );

        return $statement->fetch();
    }

    public function categories(): array
    {
        return $this->db->query('SELECT DISTINCT category FROM motorcycles ORDER BY category')->fetchAll(PDO::FETCH_COLUMN);
    }

    public function recent(int $limit = 5): array
    {
        $statement = $this->db->prepare('SELECT * FROM motorcycles ORDER BY created_at DESC, id DESC LIMIT :limit');
        $statement->bindValue('limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
