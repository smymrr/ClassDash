<?php
/**
 * includes/models/Transaction.php
 * Maps to the `transactions` table (see classdash_schema.sql):
 *   id, title, description, amount, type, category, debt_id, created_by, created_at
 */

class Transaction
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getRecent(int $limit = 5): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM transactions ORDER BY created_at DESC LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCurrentBalance(): int
    {
        $stmt = $this->pdo->query(
            "SELECT COALESCE(SUM(CASE WHEN type = 'income' THEN amount ELSE -amount END), 0) AS balance
             FROM transactions"
        );
        return (int) $stmt->fetch()['balance'];
    }

    public function getTotalUnpaidDebts(): int
    {
        $stmt = $this->pdo->query(
            "SELECT COALESCE(SUM(amount), 0) AS total FROM debts WHERE status = 'unpaid'"
        );
        return (int) $stmt->fetch()['total'];
    }

    public function getUnpaidDebtorCount(): int
    {
        $stmt = $this->pdo->query(
            "SELECT COUNT(DISTINCT user_id) AS total FROM debts WHERE status = 'unpaid'"
        );
        return (int) $stmt->fetch()['total'];
    }

    /**
     * Records a plain income/expense transaction not tied to a specific debt
     * (e.g. "Supplies", "Event Proceeds").
     */
    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO transactions (title, description, amount, type, category, created_by, created_at)
             VALUES (:title, :description, :amount, :type, :category, :created_by, NOW())'
        );

        return $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'] ?? null,
            ':amount'      => $data['amount'],
            ':type'        => $data['type'],
            ':category'    => $data['category'],
            ':created_by'  => $data['created_by'] ?? null,
        ]);
    }

    /**
     * Records a payment against a specific debt, and marks that debt as
     * paid, in one transaction (both the money-ledger kind and the
     * database-transaction kind).
     */
    public function payDebt(int $debtId, int $amount, ?int $createdBy = null): bool
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare(
                'INSERT INTO transactions (title, amount, type, category, debt_id, created_by, created_at)
                 VALUES (:title, :amount, "income", "debt_payment", :debt_id, :created_by, NOW())'
            );
            $stmt->execute([
                ':title'      => 'Debt Payment',
                ':amount'     => $amount,
                ':debt_id'    => $debtId,
                ':created_by' => $createdBy,
            ]);

            $stmt = $this->pdo->prepare(
                "UPDATE debts SET status = 'paid' WHERE id = :id"
            );
            $stmt->execute([':id' => $debtId]);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            error_log('payDebt failed: ' . $e->getMessage());
            return false;
        }
    }
}
