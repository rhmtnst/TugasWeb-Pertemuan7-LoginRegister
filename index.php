<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';

$message = '';

if (($_GET['msg'] ?? '') === 'logged_out') {
    $message = 'Kamu berhasil logout. Sampai jumpa!';
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

    <title>PHP Auth System</title>

    <link rel="stylesheet" href="style.css">

</head>


<body>

<main class="home-page">

    <section class="home-card">


        <!-- =========================
             HEADER
        ========================== -->

        <header class="home-header">

            <div class="brand">

                <div class="brand-icon">
                    🔐
                </div>

                <span>
                    PHP AUTH SYSTEM
                </span>

            </div>


            <nav class="nav">

                <a href="index.php">
                    Home
                </a>

                <a href="login.php">
                    Login
                </a>

                <a href="register.php">
                    Register
                </a>

                <button
                    type="button"
                    class="theme-toggle"
                    id="themeToggle"
                    aria-label="Ganti tema"
                >
                    🌙
                </button>

            </nav>

        </header>


        <!-- =========================
             MAIN TWO COLUMN
        ========================== -->

        <div class="hero-layout">


            <!-- =====================
                 LEFT CONTENT
            ====================== -->

            <section class="hero">


                <div class="hero-label">
                    ● PHP NATIVE AUTHENTICATION
                </div>


                <h1>

                    Simple auth,<br>

                    <span>
                        clean experience.
                    </span>

                </h1>


                <p class="hero-description">

                    Sistem autentikasi sederhana menggunakan
                    PHP Native, JSON, password hashing, dan
                    session management.

                </p>


                <?php if ($message !== ''): ?>

                    <div class="alert success">

                        <?= htmlspecialchars(
                            $message,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>

                    </div>

                <?php endif; ?>


                <?php if ($isLoggedIn): ?>


                    <div class="welcome-box">

                        <span>
                            👋
                        </span>

                        <div>

                            <small>
                                Selamat datang kembali
                            </small>

                            <strong>

                                <?= htmlspecialchars(
                                    $username,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                            </strong>

                        </div>

                    </div>


                    <div class="home-actions">

                        <a
                            href="dashboard.php"
                            class="btn primary"
                        >
                            📊 Dashboard
                        </a>

                        <a
                            href="logout.php"
                            class="btn danger"
                        >
                            🚪 Logout
                        </a>

                    </div>


                <?php else: ?>


                    <div class="home-actions">

                        <a
                            href="login.php"
                            class="btn primary"
                        >
                            🔑 Login
                        </a>

                        <a
                            href="register.php"
                            class="btn secondary"
                        >
                            📝 Buat Akun
                        </a>

                    </div>


                <?php endif; ?>


            </section>


            <!-- =====================
                 RIGHT VISUAL
            ====================== -->

            <section class="visual-panel">


                <div class="visual-glow"></div>


                <div class="visual-window">


                    <div class="window-header">

                        <div class="window-dots">

                            <span></span>
                            <span></span>
                            <span></span>

                        </div>

                        <span>
                            secure.app
                        </span>

                    </div>


                    <div class="visual-content">


                        <div class="visual-icon">
                            🔐
                        </div>


                        <p class="visual-small">
                            AUTHENTICATION
                        </p>


                        <h2>
                            Welcome<br>
                            back.
                        </h2>


                        <div class="fake-input">

                            <span>
                                ✉
                            </span>

                            <span>
                                your@email.com
                            </span>

                        </div>


                        <div class="fake-input">

                            <span>
                                ••••••••
                            </span>

                            <span>
                                🔒
                            </span>

                        </div>


                        <div class="fake-button">
                            Continue →
                        </div>


                        <div class="visual-status">

                            <span class="status-dot"></span>

                            Session protected

                        </div>


                    </div>


                </div>


                <div class="floating-card card-one">

                    <span>
                        ✓
                    </span>

                    Password hashed

                </div>


                <div class="floating-card card-two">

                    🛡️ Session active

                </div>


            </section>


        </div>


        <!-- =========================
             FEATURES
        ========================== -->

        <div class="feature-list">


            <div class="feature-item">

                <div class="feature-icon">
                    🔒
                </div>

                <div>

                    <strong>
                        Secure Password
                    </strong>

                    <small>
                        Password disimpan menggunakan
                        password_hash().
                    </small>

                </div>

            </div>


            <div class="feature-item">

                <div class="feature-icon">
                    🛡️
                </div>

                <div>

                    <strong>
                        Session Protection
                    </strong>

                    <small>
                        Dashboard hanya dapat diakses
                        setelah login.
                    </small>

                </div>

            </div>


            <div class="feature-item">

                <div class="feature-icon">
                    💾
                </div>

                <div>

                    <strong>
                        JSON Storage
                    </strong>

                    <small>
                        Data pengguna disimpan dalam
                        file JSON.
                    </small>

                </div>

            </div>


        </div>


        <!-- =========================
             FOOTER
        ========================== -->

        <p class="footer-text">

            TUGAS RUTIN 7 — PEMROGRAMAN WEB

        </p>


    </section>

</main>


<!-- =========================
     DARK MODE
========================== -->

<script>

    const themeToggle =
        document.getElementById('themeToggle');


    const savedTheme =
        localStorage.getItem('theme');


    if (savedTheme === 'dark') {

        document.body.classList.add('dark-mode');

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