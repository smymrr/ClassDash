<?php
/**
 * includes/controllers/MemberController.php
 */

require_once __DIR__ . '/../core/auth.php';
require_once __DIR__ . '/../models/Member.php';

class MemberController
{
    public function index(): void
    {
        global $pdo;

        classdash_require_login();

        $pageTitle    = 'Members';
        $pageSubtitle = '';

        $memberModel = new Member($pdo);
        $members       = $memberModel->getAllWithDebtTotals();

        require __DIR__ . '/../../public/pages/members.php';
    }
}
