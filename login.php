<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$success = '';
$email = '';

if (($_GET['msg'] ?? '') === 'registered') {
    $success = 'Registrasi berhasil! Silakan login dengan akun kamu.';
}

$file = __DIR__ . '/users.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {

        $error = 'Email dan password wajib diisi.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = 'Format email tidak valid.';

    } else {

        $users = [];

        if (file_exists($file)) {

            $json = file_get_contents($file);

            $decoded = json_decode($json, true);

            $users = is_array($decoded) ? $decoded : [];
        }

        $foundUser = null;

        foreach ($users as $user) {

            if (
                strtolower($user['email']) === $email
            ) {

                $foundUser = $user;

                break;
            }
        }

        if (
            $foundUser &&
            password_verify(
                $password,
                $foundUser['password']
            )
        ) {

            session_regenerate_id(true);

            $_SESSION['user_id'] =
                $foundUser['id'];

            $_SESSION['username'] =
                $foundUser['nama'];

            $_SESSION['email'] =
                $foundUser['email'];

            header('Location: dashboard.php');

            exit;
        }

        $error = 'Email atau password salah.';
    }
}
?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | PHP Auth System</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>


<body>

<main class="auth-page">

    <section class="auth-card">


        <!-- HEADER -->

        <div class="auth-topbar">

            <a
                href="index.php"
                class="back-link"
            >
                ← Kembali ke Home
            </a>


            <button
                type="button"
                class="theme-toggle"
                id="themeToggle"
                aria-label="Ganti tema"
            >
                🌙
            </button>

        </div>


        <!-- HEADING -->

        <div class="auth-heading">

            <div class="heading-icon">
                🔑
            </div>

            <div>

                <p class="eyebrow">
                    AUTHENTICATION
                </p>

                <h1>
                    Welcome back.
                </h1>

            </div>

        </div>


        <p class="auth-description">
            Login untuk melanjutkan ke
            dashboard kamu.
        </p>


        <!-- SUCCESS MESSAGE -->

        <?php if ($success !== ''): ?>

            <div class="alert success">

                <?= htmlspecialchars(
                    $success,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>

            </div>

        <?php endif; ?>


        <!-- ERROR MESSAGE -->

        <?php if ($error !== ''): ?>

            <div class="alert error">

                <?= htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>

            </div>

        <?php endif; ?>


        <!-- FORM -->

        <form
            method="POST"
            action=""
            class="auth-form"
        >


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars(
                        $email,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn primary full"
            >
                🔓 Login ke Akun
            </button>


        </form>


        <!-- REGISTER -->

        <p class="switch-text">

            Belum punya akun?

            <a href="register.php">
                Buat akun
            </a>

        </p>


        <!-- SECURITY INFO -->

        <div class="auth-security">

            <span>🛡️</span>

            <div>

                <strong>
                    Secure authentication
                </strong>

                <small>
                    Password diverifikasi menggunakan
                    password_verify().
                </small>

            </div>

        </div>


    </section>

</main>


<!-- DARK MODE -->

<script>

    const themeToggle =
        document.getElementById('themeToggle');


    const savedTheme =
        localStorage.getItem('theme');


    if (savedTheme === 'dark') {

        document.body.classList.add(
            'dark-mode'
        );

        themeToggle.textContent = '☀️';

    }


    themeToggle.addEventListener(
        'click',
        function () {

            document.body.classList.toggle(
                'dark-mode'
            );


            const isDark =
                document.body.classList.contains(
                    'dark-mode'
                );


            localStorage.setItem(
                'theme',
                isDark ? 'dark' : 'light'
            );


            themeToggle.textContent =
                isDark ? '☀️' : '🌙';

        }
    );

</script>


</body>

</html>