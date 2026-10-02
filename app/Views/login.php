<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Puihaha Electric</title>

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    >

    <!-- Login CSS -->
    <link
        rel="stylesheet"
        href="<?= base_url('public/style/loginview_cs.css') ?>"
    >
</head>

<body>

    <!-- Error Message -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <!-- Success Message -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <div class="container" id="container">

        <!-- Login Form -->
        <div class="form-container sign-in">

            <form action="<?= base_url('login') ?>" method="POST">

                <?= csrf_field() ?>

                <h1>Log In</h1>

                <p class="login-subtitle">
                    Sign in to access the customer account dashboard.
                </p>

                <!-- Username -->
                <input
                    type="text"
                    name="username"
                    id="username"
                    placeholder="Username"
                    value="<?= esc(old('username')) ?>"
                    required
                    autofocus
                >

                <!-- Password -->
                <div class="input-wrapper">

                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password"
                        required
                    >

                    <i
                        id="eyePassword"
                        class="fa-solid fa-eye-slash toggle-icon"
                        onclick="togglePassword('password', 'eyePassword')">
                    </i>

                </div>

                <!-- Login Button -->
                <button type="submit" id="sign-in-btn">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Log In
                </button>

            </form>

        </div>

        <!-- Welcome Panel -->
        <div class="toggle-container">

            <div class="toggle">

                <div class="toggle-panel toggle-left">

                    <h1>Welcome!</h1>

                    <p>
                        Sign in to continue to Puihaha Electric.
                    </p>

                </div>

                <div class="toggle-panel toggle-right">

                    <i
                        class="fa-solid fa-bolt"
                        style="font-size: 3rem; margin-bottom: 15px;">
                    </i>

                    <h1>Welcome Back!</h1>

                    <p>
                        Access the Puihaha Electric Customer Account
                        Management System.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- Login JavaScript -->
    <script src="<?= base_url('public/javascript/login_js.js') ?>"></script>

</body>

</html>