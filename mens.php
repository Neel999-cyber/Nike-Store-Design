<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'ecommerce_nike');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = uniqid("guest_", true);
    $_SESSION['username'] = "Guest";
}

// Handle Add to Cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        $_SESSION['pending_cart'] = $_POST;
        header("Location: login.php");
        exit();
    }

    $product_id = $_POST['product_id'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, color, size, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sisss", $user_id, $product_id, $color, $size, $price);
    $stmt->execute();
    $stmt->close();
}

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mens Sections</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background-color: whitesmoke;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .card {
            width: 23%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #fff;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            text-align: center;
            box-sizing: border-box;
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 16px;
            color: #777;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn {
            background: black;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background: #333;
        }

        .checkout {
            margin-top: 30px;
            text-align: center;
        }

        .checkout a {
            background: black;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .checkout a:hover {
            background: #333;
        }
    </style>
</head>
<body>

<h1>Men shoes section</h1>
<div class="container">
<?php while($row = $result->fetch_assoc()): ?>
    <div class="card">
        <img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
        <h3><?= $row['name'] ?></h3>
        <p><del>₹<?= $row['price'] * 2 ?></del> <strong>₹<?= $row['price'] ?></strong></p>
        <form method="POST">
            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
            <input type="hidden" name="price" value="<?= $row['price'] ?>">
            <div class="form-group">
                <label>Color:</label>
                <select name="color" required>
                    <?php foreach (explode(",", $row['colors']) as $color): ?>
                        <option value="<?= trim($color) ?>"><?= trim($color) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Size:</label>
                <select name="size" required>
                    <?php foreach (explode(",", $row['sizes']) as $size): ?>
                        <option value="<?= trim($size) ?>"><?= trim($size) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn" name="add_to_cart">Add to Cart</button>
        </form>
    </div>
<?php endwhile; ?>
</div>

<div class="checkout">
    <a href="cart_page.php">Go to Cart</a>
</div>

</body>
</html>
