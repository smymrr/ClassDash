<?php
/**
 * includes/models/User.php
 * Maps to the `users` table:
 *   id, username, pwd, email, role, created_at, updated_at
 */

class User
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function findByUsername(string $fullname): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE fullname = :fullname LIMIT 1');
        $stmt->execute([':fullname' => $fullname]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function verifyPassword(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }

    /**
     * Convenience for creating new users with a properly hashed password.
     * $data expects: username, pwd (plain text), email, role (optional, defaults to 'student')
     */
    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (fullname, pwd, email, role, created_at)
             VALUES (:fullname, :pwd, :email, :role, NOW())'
        );

        return $stmt->execute([
            ':fullname' => $data['fullname'],
            ':pwd'      => password_hash($data['pwd'], PASSWORD_DEFAULT),
            ':email'    => $data['email'],
            ':role'     => $data['role'] ?? 'student',
        ]);
    }
}
