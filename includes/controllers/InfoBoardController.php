<?php
/**
 * includes/controllers/InfoBoardController.php
 */

require_once __DIR__ . '/../components/auth.php';
require_once __DIR__ . '/../models/Announcement.php';

class InfoBoardController
{
    public function index(): void
    {
        global $pdo;

        classdash_require_login();

        $pageTitle = 'Info Board';
        $pageSubtitle = '';

        $announcementModel = new Announcement($pdo);
        $announcements = $announcementModel->getRecent(50);

        require __DIR__ . '/../../public/pages/info_board.php';
    }
}
