<?php

class UserModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT id, name, email, password_hash, role FROM users WHERE email = ?');
        $stmt->execute([$email]);

        return $stmt->fetch() ?: null;
    }

    public function create(string $name, string $email, string $passwordHash): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)'
        );
        $stmt->execute([$name, $email, $passwordHash]);

        return (int) $this->db->lastInsertId();
    }
}
