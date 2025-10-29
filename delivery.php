<?php
session_start();
include 'db1.php';

// Temporary login for demo (remove in production)
if (!isset($_SESSION["user_id"])) {
    $_SESSION["user_id"] = 1; // simulate logged-in user
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["user_id"];
    $name = trim($_POST["name"]);
    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);
    $city = trim($_POST["city"]);
    $postal_code = trim($_POST["postal_code"]);
    $state = trim($_POST["state"]);

    // JSON encode the delivery details
    $json_data = json_encode([
        "name" => $name,
        "phone" => $phone,
        "address" => $address,
        "city" => $city,
        "postal_code" => $postal_code,
        "state" => $state
    ]);

    // Save into database
    $stmt = $conn->prepare("INSERT INTO delivery_info (user_id, name, phone, address, city, postal_code, state, json_data) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $user_id, $name, $phone, $address, $city, $postal_code, $state, $json_data);

    if ($stmt->execute()) {
        $message = "✅ Delivery details saved successfully!";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delivery Information</title>
    <style>
        body {
            background-color: #111;
            font-family: 'Segoe UI', sans-serif;
            color: #eee;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 50px;
            margin: 0;
        }

        .form-container {
            background-color: #1f1f1f;
            padding: 30px 35px;
            border-radius: 12px;
            width: 420px;
            box-shadow: 0 0 15px rgba(0,255,255,0.2);
        }

        h2 {
            color: #00ffff;
            text-align: center;
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background: #2a2a2a;
            border: none;
            border-radius: 6px;
            color: #fff;
        }

        textarea {
            resize: vertical;
            min-height: 60px;
        }

        button {
            width: 100%;
            background-color: #00ffff;
            color: #000;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #00cccc;
        }

        .message {
            text-align: center;
            color: #ffa500;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Delivery Details</h2>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <textarea name="address" placeholder="Full Address" required></textarea>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="postal_code" placeholder="Postal Code" required>
        <input type="text" name="state" placeholder="State" required>
        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
