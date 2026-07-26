<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Added 'id' to the check (Assuming you still want to manually insert ID)
    if (!isset($_POST['id'], $_POST['fullname'], $_POST['displayname'], $_POST['email'], $_POST['password'], $_POST['role'])) {
        header("Location: temp.php?error=missing_fields");
        exit();
    }

    // 2. Trim whitespace from text inputs to prevent accidental spaces
    $id = trim($_POST['id']);
    $name = trim($_POST['fullname']);
    $displayName = trim($_POST['displayname']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // Don't trim passwords, spaces might be intentional!
    $role = $_POST['role'];

    // 3. Prevent empty submissions
    if ($name === '' || $email === '' || $password === '') {
        header("Location: temp.php?error=empty_fields");
        exit();
    }

    $allowedRoles = ['teacher', 'president', 'vice', 'treasurer', 'secretary', 'student'];
    if (!in_array($role, $allowedRoles)) {
        header("Location: temp.php?error=invalid_role");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: temp.php?error=invalid_email");
        exit();
    }

    try {
        require_once 'config/config.php'; // adjust path depth as needed

        // Check if email already exists before trying to insert
        $checkStmt = $pdo->prepare("SELECT email FROM users WHERE email = :email");
        $checkStmt->execute([':email' => $email]);
        if ($checkStmt->fetch()) {
            header("Location: temp.php?error=email_exists");
            exit();
        }

        $query = "INSERT INTO users (fullname, displayname, pwd, email, role)
          VALUES (:fullname, :displayname, :pwd, :email, :role)";
        $stmt = $pdo->prepare($query);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->execute([
            ':fullname'    => $name,
            ':displayname' => $displayName ?? $name, // fallback if no separate display name given
            ':pwd'         => $hashedPassword,
            ':email'       => $email,
            ':role'        => $role
        ]);

        header("Location: temp.php?success=account_created");
        exit();
    } catch (PDOException $e) {
        // You can log $e->getMessage() here for your own debugging
        header("Location: temp.php?error=database_error");
        exit();
    }
} else {
    header("Location: temp.php");
    exit();
}
