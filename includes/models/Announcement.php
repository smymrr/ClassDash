<?php
/**
 * includes/models/Announcement.php
 */

class Announcement
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getRecent(int $limit = 5): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM announcements ORDER BY created_at DESC LIMIT :limit'
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getThisMonthCount(): int
    {
        $stmt = $this->pdo->query(
            "SELECT COUNT(*) AS total FROM announcements
             WHERE MONTH(created_at) = MONTH(CURRENT_DATE())
               AND YEAR(created_at) = YEAR(CURRENT_DATE())"
        );
        return (int) $stmt->fetch()['total'];
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO announcements (title, body, tag, pinned, created_at)
             VALUES (:title, :body, :tag, :pinned, NOW())'
        );

        return $stmt->execute([
            ':title'  => $data['title'],
            ':body'   => $data['body'],
            ':tag'    => $data['tag'],
            ':pinned' => $data['pinned'] ?? 0,
        ]);
    }
}
