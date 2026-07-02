<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in · ClassDash</title>
    <link rel="stylesheet" href="/assets/css/global/variables.css">
    <link rel="stylesheet" href="/assets/css/global/reset.css">
    <link rel="stylesheet" href="/assets/css/pages/login.css">
</head>
<body class="cd-auth-page">
    <form class="cd-auth-form" method="POST" action="/login">
        <h1>ClassDash</h1>

        <?php if (!empty($loginError)): ?>
            <p class="cd-auth-form__error"><?= htmlspecialchars($loginError) ?></p>
        <?php endif; ?>

        <label>
            Email
            <input type="email" name="email" required>
        </label>
        <label>
            Password
            <input type="password" name="password" required>
        </label>
        <button type="submit">Log in</button>
    </form>
</body>
</html>
