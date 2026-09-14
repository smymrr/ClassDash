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
        $pageSubtitle = 'Lacak iuran kelas, pengeluaran, dan saldo saat ini.';
        $pageActions = [
            [
                'label' => '+ Tambah Pemasukan',
                'url' => 'javascript:openModal("modal-add-income")',
                'class' => 'cd-btn--primary',
            ],
            [
                'label' => '+ Tambah Pengeluaran',
                'url' => 'javascript:openModal("modal-add-expense")',
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
