<?php
/**
 * includes/controllers/DashboardController.php
 */

require_once __DIR__ . '/../components/auth.php';
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../models/Announcement.php';

class DashboardController
{
    public function index(): void
    {
        global $pdo;

        classdash_require_login();

        $currentUser = classdash_get_current_user($pdo);
        $transactionModel = new Transaction($pdo);
        $announcementModel = new Announcement($pdo);

        $pageTitle    = 'Dashboard';
        $pageSubtitle = 'Selamat Datang, ' . $currentUser['name'];

        $currentBalance      = $transactionModel->getCurrentBalance();
        $totalUnpaidDebts    = $transactionModel->getTotalUnpaidDebts();
        $recentTransactions  = $transactionModel->getRecent(5);
        $announcementsCount  = $announcementModel->getThisMonthCount();
        $recentAnnouncements = $announcementModel->getRecent(3);

        require __DIR__ . '/../../public/pages/dashboard.php';
    }
}
