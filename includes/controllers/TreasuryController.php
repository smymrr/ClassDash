<?php
/**
 * includes/controllers/TreasuryController.php
 */

require_once __DIR__ . '/../components/auth.php';
require_once __DIR__ . '/../models/Transaction.php';

class TreasuryController
{
    public function index(): void
    {
        global $pdo;

        classdash_require_login();

        $pageTitle    = 'Treasury';
        $pageSubtitle = 'Track class dues, expenses, and debts';

        $transactionModel = new Transaction($pdo);
        $currentBalance     = $transactionModel->getCurrentBalance();
        $totalUnpaidDebts   = $transactionModel->getTotalUnpaidDebts();
        $transactions        = $transactionModel->getRecent(50);

        require __DIR__ . '/../../public/pages/treasury.php';
    }
}
