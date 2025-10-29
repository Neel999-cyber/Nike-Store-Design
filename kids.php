<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'ecommerce_nike');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Handle Add to Cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $price = $_POST['price'];

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['pending_cart'] = [
            'product_id' => $product_id,
            'color' => $color,
            'size' => $size,
            'price' => $price
        ];
        header("Location: login.php");
        exit;
    } else {
        $user_id = $_SESSION['user_id'];
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, color, size, price) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $user_id, $product_id, $color, $size, $price);
        $stmt->execute();
        $stmt->close();
    }
}

// Check if there's a pending cart item (after login)
if (isset($_SESSION['user_id'], $_SESSION['pending_cart'])) {
    $user_id = $_SESSION['user_id'];
    $p = $_SESSION['pending_cart'];
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, color, size, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $user_id, $p['product_id'], $p['color'], $p['size'], $p['price']);
    $stmt->execute();
    $stmt->close();
    unset($_SESSION['pending_cart']);
}

$result = $conn->query("SELECT * FROM kids_products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kids Section</title>
    <style>
        * {box-sizing: border-box; margin: 0; padding: 0; font-family: Arial;}
        .container {display: flex; flex-wrap: wrap; gap: 10px; padding: 20px;}
        .card {
            width: 23%;
            border: 1px solid #ccc;
            margin-left: 20px;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .card img {width: 100%; height: 200px; object-fit: cover;}
        .card h3, .card p {margin: 10px 0;}
        .form-group {margin: 5px 0;}
        select, button {
            padding: 5px;
            width: 100%;
            border: 1px solid #888;
            margin-top: 5px;
        }
        .btn {background-color:rgb(238, 110, 13); color: white; border: none; cursor: pointer;}
        .btn:hover {background-color:rgb(220, 133, 12);}
        .checkout {margin-left: 48%; margin-top: 30px; margin-bottom: 3%;}
        .checkout a {
            text-decoration: none; background: #007bff; color: white;
            padding: 10px 20px; border-radius: 5px;
        }
        h1 {
            margin-left: 3%;
            margin-top: 3%;
            margin-bottom: 2%;
            font-size: 48px;
            font-weight: bold;
            color: #111;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
            display: inline-block;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        h1::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -10px;
            height: 4px;
            width: 60%;
            background-color:rgb(238, 110, 13);
            border-radius: 2px;
        }
    </style>
</head>
<body>
<h1>Kids shoes section</h1>
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
