<?php
/**
 * includes/models/Member.php
 * Maps to `users` (id, username, email, role) joined with `debts`.
 */

class Member
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query('SELECT id, username, role, email FROM users ORDER BY username ASC');
        return $stmt->fetchAll();
    }

    /**
     * All members plus their total unpaid debt amount (0 if none).
     */
    public function getAllWithDebtTotals(): array
    {
        $stmt = $this->pdo->query(
            "SELECT u.id, u.username, u.role, u.email,
                    COALESCE(SUM(CASE WHEN d.status = 'unpaid' THEN d.amount ELSE 0 END), 0) AS unpaid_total
             FROM users u
             LEFT JOIN debts d ON d.user_id = u.id
             GROUP BY u.id, u.username, u.role, u.email
             ORDER BY u.username ASC"
        );
        return $stmt->fetchAll();
    }

    public function getUnpaidDebtorsCount(): int
    {
        $stmt = $this->pdo->query(
            "SELECT COUNT(DISTINCT user_id) AS total FROM debts WHERE status = 'unpaid'"
        );
        return (int) $stmt->fetch()['total'];
    }
}
