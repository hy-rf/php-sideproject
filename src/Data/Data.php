<?php

namespace Data;

class Data
{
    private \PDO $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new \PDO(
            "mysql:host=localhost;dbname=db",
            "root",
            ""
        );
    }

    public function save(array $data): bool
    {
        $stmt = $this->dbConnection->prepare(
            "INSERT INTO users (name, email) VALUES (:name, :email)"
        );
        return $stmt->execute([
            "name" => $data["name"],
            "email" => $data["email"],
        ]);
    }

    public function fetch(int $id): ?array
    {
        $stmt = $this->dbConnection->prepare(
            "SELECT * FROM users WHERE id = :id"
        );
        $stmt->execute(["id" => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function getTableList(): array
    {
        $stmt = $this->dbConnection->query("SHOW TABLES");
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
}
