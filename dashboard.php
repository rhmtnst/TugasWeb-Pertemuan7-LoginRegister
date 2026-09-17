<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'] ?? 'User';
$email = $_SESSION['email'] ?? '-';
$userId = $_SESSION['user_id'] ?? '-';
?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Dashboard | PHP Auth System
    </title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>


<body>


<main class="dashboard-page">

    <section class="dashboard-card">


        <!-- =========================
             TOP BAR
        ========================== -->

        <div class="dashboard-topbar">

            <a
                href="index.php"
                class="back-link"
            >
                ← Home
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


        <!-- =========================
             HEADER
        ========================== -->

        <div class="dashboard-header">


            <div>

                <div class="dashboard-status">

                    <span class="status-dot"></span>

                    SESSION ACTIVE

                </div>


                <h1>

                    Hello,
                    <?= htmlspecialchars(
                        $username,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>.

                </h1>


                <p class="dashboard-subtitle">

                    Kamu berhasil login.
                    Selamat datang di dashboard.

                </p>

            </div>


            <div class="avatar">

                👤

            </div>


        </div>


        <!-- =========================
             PROFILE + SECURITY
        ========================== -->

        <div class="dashboard-grid">


            <!-- PROFILE -->

            <div class="dashboard-section">


                <div class="section-label">
                    USER PROFILE
                </div>


                <div class="profile-box">


                    <div class="profile-row">

                        <span>
                            User ID
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                (string) $userId,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>

                        </strong>

                    </div>


                    <div class="profile-row">

                        <span>
                            Nama
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $username,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>

                        </strong>

                    </div>


                    <div class="profile-row">

                        <span>
                            Email
                        </span>

                        <strong>

                            <?= htmlspecialchars(
                                $email,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>

                        </strong>

                    </div>


                    <div class="profile-row">

                        <span>
                            Status
                        </span>

                        <strong class="status-text">

                            ● Login aktif

                        </strong>

                    </div>


                </div>


            </div>


            <!-- SECURITY -->

            <div class="dashboard-section">


                <div class="section-label">
                    SECURITY
                </div>


                <div class="security-card">


                    <div class="security-icon">
                        🛡️
                    </div>


                    <h2>
                        Session Protected
                    </h2>


                    <p>

                        Halaman dashboard dilindungi
                        menggunakan PHP Session.
                        User yang belum login akan
                        diarahkan kembali ke halaman login.

                    </p>


                    <div class="security-check">

                        <span>
                            ✓
                        </span>

                        Authentication verified

                    </div>


                    <div class="security-check">

                        <span>
                            ✓
                        </span>

                        Session ID active

                    </div>


                </div>


            </div>


        </div>


        <!-- =========================
             SESSION INFORMATION
        ========================== -->

        <div class="session-info">


            <div>

                <span class="info-icon">
                    🔐
                </span>

                <div>

                    <strong>
                        Protected Area
                    </strong>

                    <small>
                        Hanya user yang sudah login
                        dapat mengakses halaman ini.
                    </small>

                </div>

            </div>


            <a
                href="logout.php"
                class="btn danger"
            >
                🚪 Logout
            </a>


        </div>


        <!-- =========================
             FOOTER
        ========================== -->

        <p class="footer-text">

            PHP NATIVE • SESSION • JSON
            &nbsp; | &nbsp;
            TUGAS RUTIN 7

        </p>


    </section>

</main>


<!-- =========================
     DARK MODE
========================== -->

<script>

    const themeToggle =
        document.getElementById(
            'themeToggle'
        );


    const savedTheme =
        localStorage.getItem(
            'theme'
        );


    if (
        savedTheme === 'dark'
    ) {

        document.body.classList.add(
            'dark-mode'
        );

        themeToggle.textContent =
            '☀️';

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
                isDark
                    ? 'dark'
                    : 'light'
            );


            themeToggle.textContent =
                isDark
                    ? '☀️'
                    : '🌙';

        }
    );

</script>


</body>

</html>