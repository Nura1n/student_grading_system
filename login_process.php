
<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check username and email
    $sql = "SELECT id, name, email, password
            FROM `user`
            WHERE name = ? AND email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $admin = $result->fetch_assoc();

        // Verify password
        if ($password === $admin['password']) {

            // Regenerate session ID
            session_regenerate_id(true);

            // Store admin details
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_email'] = $admin['email'];

            // Redirect to main page
            header("Location: index.php");
            exit();
        } else {

            header("Location: login.php?error=Incorrect password");
            exit();
        }
    } else {

        header("Location: login.php?error=Invalid username or email");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {

    header("Location: login.php");
    exit();
}
?>
