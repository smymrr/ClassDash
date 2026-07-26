<?php

/**
 * includes/controllers/AuthController.php
 */

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    public function login(): void
    {
        global $pdo;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User($pdo);
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $userModel->findByEmail($email);
            
            if ($user && $userModel->verifyPassword($password, $user['pwd'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: /dashboard');
                exit;
            } elseif (!$user || !$userModel->verifyPassword($password, $user['pwd'])) {
                $loginError = 'Invalid email or password. Please try again.';
            }
        }

        require __DIR__ . '/../../public/pages/login.php';
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        header('Location: /login');
        exit;
    }
}
