<?php
/**
 * includes/controllers/TreasuryController.php
 */

require_once __DIR__ . '/../core/auth.php';
require_once __DIR__ . '/../models/Transaction.php';

class TreasuryController
{
    public function index(): void
    {
        global $pdo;

        classdash_require_login();

        $pageTitle    = 'Kas Kelas';
        $pageSubtitle = '';
        $pageActions = [
            [
                'label' => '+ Tambah Pemasukan',
                'action' => 'modal-add-income',
                'class' => 'cd-btn--primary',
            ],
            [
                'label' => '+ Tambah Pengeluaran',
                'action' => 'modal-add-expense',
                'class' => 'cd-btn--secondary',
            ],
        ];
        
        $transactionModel = new Transaction($pdo);
        $currentBalance     = $transactionModel->getCurrentBalance();
        $totalUnpaidDebts   = $transactionModel->getTotalUnpaidDebts();
        $transactions        = $transactionModel->getRecent(50);

        require __DIR__ . '/../../public/pages/treasury.php';
    }
}
