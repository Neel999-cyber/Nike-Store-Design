<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'ecommerce_nike');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $conn->query("DELETE FROM cart WHERE id = $id");
}

$result = $conn->query("SELECT cart.id, products.name, products.image, cart.color, cart.size, cart.price 
                        FROM cart 
                        JOIN products ON cart.product_id = products.id");

$total = 0;
$items = [];
while($row = $result->fetch_assoc()) {
    $total += $row['price'];
    $items[] = $row;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body {font-family: Arial; padding: 20px; background-color:whitesmoke;}
        table {width: 100%; border-collapse: collapse; border: 1px solid #ccc;}
        th, td {padding: 10px; border: 1px solid #ccc; text-align: center;}
        img {width: 80px;}
        .remove-btn {background: #dc3545; color: white; padding: 5px 10px; border: none; border-radius: 5px;}
        .checkout-btn {background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;}
        .total {text-align: right; font-size: 18px; margin-top: 20px;}
    </style>
</head>
<body>

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
    <?php foreach($items as $item): ?>
    <tr>
        <td><img src="<?= $item['image'] ?>"></td>
        <td><?= $item['name'] ?></td>
        <td><?= $item['color'] ?></td>
        <td><?= $item['size'] ?></td>
        <td>₹<?= $item['price'] ?></td>
        <td><a href="?remove=<?= $item['id'] ?>"><button class="remove-btn">Remove</button></a></td>
    </tr>
    <?php endforeach; ?>
</table>

<div class="total">
    <p><strong>Total:</strong> ₹<?= $total ?></p>
    <button class="checkout-btn" onclick="payNow()">Pay with Razorpay</button>
</div>

<script>
function payNow() {
    var options = {
        "key": "YOUR_RAZORPAY_KEY", // Replace with your Razorpay Key ID
        "amount": <?= $total * 100 ?>, // Razorpay amount is in paisa
        "currency": "INR",
        "name": "Nike Shoes",
        "description": "Order Payment",
        "handler": function (response){
            alert('Payment Successful! Razorpay ID: ' + response.razorpay_payment_id);
            // Redirect to thank you or save to DB
            window.location.href = "thank_you.php?payment_id=" + response.razorpay_payment_id;
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
}
</script>

</body>
</html>
