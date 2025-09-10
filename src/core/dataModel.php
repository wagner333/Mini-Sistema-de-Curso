<?php
require_once __DIR__ . "/Database.php";

abstract class Model {
    protected string $table;
    protected array $fillable = [];
    public function all(): array {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find(int $id): ?array {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    public function create(array $data): bool {
        $db = Database::getInstance();
        $fields = array_intersect_key($data, array_flip($this->fillable));
        $cols = implode(", ", array_keys($fields));
        $placeholders = ":" . implode(", :", array_keys($fields));
        $stmt = $db->prepare("INSERT INTO {$this->table} ($cols) VALUES ($placeholders)");
        return $stmt->execute($fields);
    }
    public function update(int $id, array $data): bool {
        $db = Database::getInstance();
        $fields = array_intersect_key($data, array_flip($this->fillable));
        $set = implode(", ", array_map(fn($col) => "$col = :$col", array_keys($fields)));
        $fields["id"] = $id;
        $stmt = $db->prepare("UPDATE {$this->table} SET $set WHERE id = :id");
        return $stmt->execute($fields);
    }
    public function delete(int $id): bool {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

