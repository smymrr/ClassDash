<?php
/**
 * includes/models/Debt.php
 * Maps to the `debts` table:
 *   id, user_id, title, description, amount, status, due_date, created_at, updated_at
 */

class Debt
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * All debts, with the owing student's username joined in.
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT d.*, u.fullname
             FROM debts d
             JOIN users u ON u.id = d.user_id
             ORDER BY d.status ASC, d.due_date ASC'
        );
        return $stmt->fetchAll();
    }

    public function getUnpaidForUser(int $userId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM debts WHERE user_id = :user_id AND status = 'unpaid' ORDER BY due_date ASC"
        );
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO debts (user_id, title, description, amount, due_date, created_at)
             VALUES (:user_id, :title, :description, :amount, :due_date, NOW())'
        );

        return $stmt->execute([
            ':user_id'     => $data['user_id'],
            ':title'       => $data['title'],
            ':description' => $data['description'] ?? null,
            ':amount'      => $data['amount'],
            ':due_date'    => $data['due_date'] ?? null,
        ]);
    }
}
