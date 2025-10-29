<?php
session_start();

$conn = new mysqli('localhost', 'root', '', 'ecommerce_nike');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'] ?? '';

// Remove item
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $conn->query("DELETE FROM cart WHERE id = $id AND user_id = '$user_id'");
}

// Get user info
$username = $_SESSION['username'] ?? "Guest";

// Get cart items for current user
$result = $conn->query("SELECT cart.id, products.name, products.image, cart.color, cart.size, cart.price 
                        FROM cart 
                        JOIN products ON cart.product_id = products.id 
                        WHERE cart.user_id = '$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Header Styling */
        h2.cart-heading {
            font-size: 28px;
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        /* Cart Table Styling */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Table Header Styling */
        th {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 16px;
        }

        /* Table Data Styling */
        td {
            padding: 15px;
            text-align: left;
            font-size: 16px;
        }

        /* Image in Table */
        td img {
            max-width: 60px;
            height: auto;
            border-radius: 5px;
        }

        /* Link Button for Removing Item */
        .remove-btn {
            background-color: #f44336;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .remove-btn:hover {
            background-color: #d32f2f;
        }

        /* Total Section Styling */
        .total {
            text-align: center;
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Total Price Text Styling */
        .total p {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Checkout Button Styling */
        .checkout-btn {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #555;
        }

        /* Welcome User Section */
        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            td img {
                max-width: 50px;
            }

            .total {
                width: 95%;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

<p style="font-size: 18px; color: #555; margin-bottom: 15px;">
    👤 Welcome, <strong><?= htmlspecialchars($username) ?></strong>
</p>

<h2 class="cart-heading">🛒 Your Shopping Cart</h2>
<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Color</th>
        <th>Size</th>
        <th>Price</th>
        <th>Remove</th>
    </tr>
    <?php $total = 0; while($row = $result->fetch_assoc()): $total += $row['price']; ?>
    <tr>
        <td><img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>"></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['color'] ?></td>
        <td><?= $row['size'] ?></td>
        <td>₹<?= $row['price'] ?></td>
        <td><a href="?remove=<?= $row['id'] ?>"><button class="remove-btn">Remove</button></a></td>
    </tr>
    <?php endwhile; ?>
</table>

<div class="total">
    <p><strong>Total:</strong> ₹<?= $total ?></p>
    <a class="checkout-btn" href="login.php">Checkout</a>
</div>

</body>
</html>
