<?php
session_start();

// If admin is already logged in
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - Student Grading System</title>

    <link rel="stylesheet" href="style.css?v=3">
</head>

<body class="login-page">

    <div class="login-container">

        <div class="login-card">

            <div class="login-icon">
            </div>

            <h2>Login Student Grading System</h2>

            <p class="login-subtitle">
                Admin Login
            </p>

            <!-- Error Message -->
            <?php if (isset($_GET['error'])): ?>
                <p class="login-error">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </p>
            <?php endif; ?>
            <style>
                label {
                    display: inline-block;
                    width: 85px;
                    height: 30px;
                }
            </style>

            <!-- Login Form -->
            <form action="login_process.php" method="POST">

                <!-- Username -->
                <div class="input-group">

                    <label for="username">Username</label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter your username"
                        required>

                </div>

                <!-- Email -->
                <div class="input-group">

                    <label for="email">Email</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required>

                </div>

                <!-- Password -->
                <div class="input-group">

                    <label for="password">Password</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required>

                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    name="login"
                    class="login-button">

                    Login

                </button>

            </form>

            <?php include 'footer.php'; ?>

        </div>

    </div>

</body>

</html>