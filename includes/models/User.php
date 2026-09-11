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
        $query = 'SELECT * FROM users WHERE id = :id LIMIT 1';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();
        
        return $user ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $query = 'SELECT * FROM users WHERE email = :email LIMIT 1';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        
        return $user ?: null;
    }

    public function findByUsername(string $fullname): ?array
    {
        $query = 'SELECT * FROM users WHERE fullname = :fullname LIMIT 1';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':fullname' => $fullname]);
        $user = $stmt->fetch();
        
        return $user ?: null;
    }
    
    public function findAll(): array
    {
        $query = 'SELECT * FROM users';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function verifyPassword(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }
    
    public function updatePassword(int $userId, string $newPlainPassword): bool
    {
        $hashedPassword = password_hash($newPlainPassword, PASSWORD_DEFAULT);
        
        $query = 'UPDATE users SET pwd = :pwd, updated_at = NOW() WHERE id = :id';
        $stmt = $this->pdo->prepare($query);
        
        return $stmt->execute([':pwd' => $hashedPassword, ':id' => $userId]);
    }

    /**
     * Convenience for creating new users with a properly hashed password.
     * $data expects: username, pwd (plain text), email, role (optional, defaults to 'student')
     */
    public function create(array $data): bool
    {
        $query = '
            INSERT INTO users (fullname, pwd, email, role, created_at)
            VALUES (:fullname, :pwd, :email, :role, NOW())
        ';
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([
            ':fullname' => $data['fullname'],
            ':pwd'      => password_hash($data['pwd'], PASSWORD_DEFAULT),
            ':email'    => $data['email'],
            ':role'     => $data['role'] ?? 'student',
        ]);
    }
}
