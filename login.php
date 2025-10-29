<?php
session_start();
include 'db1.php';

$message = "";

// Handle login
if (isset($_POST['login'])) {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $name, $hashed);
        $stmt->fetch();

        if (password_verify($password, $hashed)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $name;
            $_SESSION["logged_in"] = true;

            // Handle pending cart
            if (isset($_SESSION['pending_cart'])) {
                $item = $_SESSION['pending_cart'];
                unset($_SESSION['pending_cart']);

                $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, color, size, price) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sisss", $id, $item['product_id'], $item['color'], $item['size'], $item['price']);
                $stmt->execute();
                $stmt->close();
            }

            header("Location: mens.php");
            exit();
        } else {
            $message = "❌ Invalid password.";
        }
    } else {
        $message = "❌ Email not registered.";
    }
}

// Handle registration
if (isset($_POST['register'])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = "❌ Email already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $message = "✅ Registration successful. You can now login.";
        } else {
            $message = "❌ Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login / Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: none;
            flex-direction: column;
            gap: 15px;
        }

        form.active {
            display: flex;
        }

        input[type="email"], input[type="password"], input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            width: 94%;
        }

        button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        .switch {
            text-align: center;
            margin-top: 15px;
        }

        .switch a {
            color: #333;
            cursor: pointer;
            font-weight: bold;
        }

        .switch a:hover {
            color: #555;
        }

        .message {
            background-color: #ffcccb;
            color: red;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .message.success {
            background-color: #d4edda;
            color: green;
        }

        /* Animation for smooth form transition */
        form {
            transition: opacity 0.3s ease;
        }

        /* The form's transition effect */
        form:not(.active) {
            opacity: 0;
            pointer-events: none;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                width: 90%;
            }
        }
    </style>
    <script>
        function showForm(type) {
            document.getElementById('login-form').classList.remove('active');
            document.getElementById('register-form').classList.remove('active');
            document.getElementById(type + '-form').classList.add('active');
        }
    </script>
</head>
<body>

<div class="container">
    <h2 id="form-title">Login / Register</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="post" id="login-form" class="active">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <div class="switch">Don't have an account? <a onclick="showForm('register')">Register</a></div>
    </form>

    <!-- Register Form -->
    <form method="post" id="register-form">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="register">Register</button>
        <div class="switch">Already have an account? <a onclick="showForm('login')">Login</a></div>
    </form>
</div>

</body>
</html>
