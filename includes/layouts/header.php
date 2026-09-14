<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Undefined') ?> · ClassDash</title>

    <link rel="stylesheet" href="../assets/css/global/variables.css">
    <link rel="stylesheet" href="../assets/css/global/reset.css">
    <link rel="stylesheet" href="../assets/css/global/layout.css">
    
    <link rel="stylesheet" href="../assets/css/components.css">
    <link rel="stylesheet" href="../assets/css/components/navbar.css">
    <link rel="stylesheet" href="../assets/css/components/topbar.css">
    <link rel="stylesheet" href="../assets/css/components/sidebar.css">
    
    <!-- Load page-specific CSS files if defined -->
    <?php if (!empty($styles) && is_array($styles)): ?>
        <?php foreach ($styles as $style): ?>
            <link rel="stylesheet" href="<?= htmlspecialchars($style) ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
    <?php require __DIR__ . '/../../includes/components/navbar.php'; ?>

    <div class="cd-layout">
        <?php require __DIR__ . '/../../includes/components/sidebar.php'; ?>

        <main class="cd-main">
            <?php require __DIR__ . '/../../includes/components/topbar.php'; ?>