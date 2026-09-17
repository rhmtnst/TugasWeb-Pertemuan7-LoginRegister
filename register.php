<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

$nama = '';
$email = '';

$file = __DIR__ . '/users.json';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama = trim($_POST['nama'] ?? '');

    $email = strtolower(
        trim($_POST['email'] ?? '')
    );

    $password = $_POST['password'] ?? '';


    /* =========================
       VALIDATION
    ========================== */

    if (
        $nama === '' ||
        $email === '' ||
        $password === ''
    ) {

        $error = 'Semua field wajib diisi.';

    } elseif (
        !filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $error = 'Format email tidak valid.';

    } elseif (
        strlen($password) < 6
    ) {

        $error = 'Password minimal 6 karakter.';

    } else {

        $users = [];


        /* =========================
           READ JSON
        ========================== */

        if (file_exists($file)) {

            $json =
                file_get_contents($file);

            $decoded =
                json_decode(
                    $json,
                    true
                );

            $users =
                is_array($decoded)
                    ? $decoded
                    : [];
        }


        /* =========================
           CHECK DUPLICATE EMAIL
        ========================== */

        $emailExists = false;

        foreach ($users as $user) {

            if (
                strtolower(
                    $user['email']
                ) === $email
            ) {

                $emailExists = true;

                break;
            }
        }


        if ($emailExists) {

            $error =
                'Email sudah terdaftar. Silakan gunakan email lain.';

        } else {


            /* =========================
               CREATE USER
            ========================== */

            $newUser = [

                'id' =>
                    empty($users)
                        ? 1
                        : max(
                            array_column(
                                $users,
                                'id'
                            )
                        ) + 1,

                'nama' => $nama,

                'email' => $email,

                'password' =>
                    password_hash(
                        $password,
                        PASSWORD_DEFAULT
                    ),

                'created_at' =>
                    date(
                        'Y-m-d H:i:s'
                    )
            ];


            $users[] = $newUser;


            /* =========================
               SAVE JSON
            ========================== */

            file_put_contents(

                $file,

                json_encode(
                    $users,
                    JSON_PRETTY_PRINT |
                    JSON_UNESCAPED_UNICODE
                ),

                LOCK_EX

            );


            header(
                'Location: login.php?msg=registered'
            );

            exit;
        }
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

    <title>
        Register | PHP Auth System
    </title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>


<body>


<main class="auth-page">

    <section class="auth-card">


        <!-- =========================
             TOP BAR
        ========================== -->

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


        <!-- =========================
             HEADING
        ========================== -->

        <div class="auth-heading">

            <div class="heading-icon">
                📝
            </div>

            <div>

                <p class="eyebrow">
                    REGISTRATION
                </p>

                <h1>
                    Create account.
                </h1>

            </div>

        </div>


        <p class="auth-description">

            Buat akun baru untuk mulai
            menggunakan sistem.

        </p>


        <!-- =========================
             ERROR
        ========================== -->

        <?php if ($error !== ''): ?>

            <div class="alert error">

                <?= htmlspecialchars(
                    $error,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>

            </div>

        <?php endif; ?>


        <!-- =========================
             FORM
        ========================== -->

        <form
            method="POST"
            action=""
            class="auth-form"
        >


            <!-- NAMA -->

            <div class="form-group">

                <label for="nama">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="<?= htmlspecialchars(
                        $nama,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>"
                    placeholder="Masukkan nama lengkap"
                    autocomplete="name"
                    required
                >

            </div>


            <!-- EMAIL -->

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


            <!-- PASSWORD -->

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Minimal 6 karakter"
                    autocomplete="new-password"
                    minlength="6"
                    required
                >

            </div>


            <!-- SUBMIT -->

            <button
                type="submit"
                class="btn primary full"
            >
                ✨ Buat Akun
            </button>


        </form>


        <!-- =========================
             LOGIN LINK
        ========================== -->

        <p class="switch-text">

            Sudah punya akun?

            <a href="login.php">
                Login di sini
            </a>

        </p>


        <!-- =========================
             SECURITY INFO
        ========================== -->

        <div class="auth-security">

            <span>
                🔒
            </span>

            <div>

                <strong>
                    Your data is protected
                </strong>

                <small>
                    Password disimpan menggunakan
                    password_hash().
                </small>

            </div>

        </div>


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