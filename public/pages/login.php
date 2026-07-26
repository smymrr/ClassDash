<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in · ClassDash</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/tobiasroeder/lucide-icon-font@main/lucide.css">

    <link rel="stylesheet" href="../assets/css/global/variables.css">
    <link rel="stylesheet" href="../assets/css/global/reset.css">
    <link rel="stylesheet" href="../assets/css/pages/login.css">

    <script src=" ../assets/js/pages/login.js" defer></script>
</head>

<body class="cd-auth-page">
    <form class="cd-auth-form" method="POST" action="/login">
        <div class="cd-auth__brand">
            <span class="cd-auth__brand-mark">&#8722;</span>
            <span class="cd-auth__brand-text">Class<i>Dash</i></span>
        </div>
        
        <?php if (!empty($loginError)): ?>
            <div class="cd-auth-form__error">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-alert-icon lucide-circle-alert">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" x2="12" y1="8" y2="12" />
                    <line x1="12" x2="12.01" y1="16" y2="16" />
                </svg>
                <p><?= htmlspecialchars($loginError) ?></p>
            </div>
        <?php endif; ?>

        <label>
            Email
            <input type="email" name="email" placeholder="you@school.edu" required>
        </label>
        <label>
            Password
            <div class="cd-auth-password-wrapper">
                <input type="password" name="password" placeholder="••••••••" required>
                <button type="button" class="cd-auth-form cd-auth-password-toggle" aria-label="Toggle password visibility" onclick="toggleCdPassword(this)">
                    <svg class="cd-auth-password-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </label>
        <button type="submit">Sign in</button>
        <p class="cd-auth-form__footer">
            Don't have an account? Contact your class administrator.
        </p>
    </form>
</body>

</html>