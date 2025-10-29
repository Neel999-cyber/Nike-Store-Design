<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
<header>
    <nav class="navbar">
        <ul class="nav-list">
            <li><a href="men.php">Men</a></li>
            <li><a href="women.php">Women</a></li>
            <li><a href="kids.php">Kids</a></li>
        </ul>
        <div >
        <button  class="logo"><a href="viewcart.php" style="color:aliceblue"><i class="fa-solid fa-cart-shopping"></i></a></button>
        </div>
       
    </nav>
</header>


<section class="contact-form">
  <h2>IF ANY QUERY PLEASE CONTACT US</h2>
  <p>We would lOVE TO HERE FROM YOU! CONTACT US DIRECTLY BY MESSAGE.</p>
  <form action="https://api.web3forms.com/submit" method="POST">

      <input type="hidden" name="access_key" value="addeb99a-4161-48ac-b52c-5e0da33539e7">

      <input type="text" placeholder="Enter Name" name="name" required>
      <input type="email" placeholder="Enter Email" name="email" required>
      <textarea placeholder="Your Message" name="Message" required></textarea>
      <button type="submit">Send Message</button>
  </form>
</section>



<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3>About Us</h3>
            <p>We provide high-quality Shoes for customer satisfaction.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Contact</h3>
            <p>Email: contact@Nikeshoes.com</p>
            <p>Phone: +91 9874987364</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>Buy Your Dream Shoes</p>
    </div>
</footer>


</body>
</html>