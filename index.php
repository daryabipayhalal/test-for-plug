<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang = "en-US">
    <meta charset = "UTF-8">
    <head>
        <link rel = "stylesheet" type = "text/css" href = "layout.css" />
        
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        
    </head>
    <body>
        <main class="container">

  <!-- Left Column / Headphones Image -->
  <div class="left-column">
      <!--<img data-image="black" src="images/black.png" alt="">-->
      <!-- <img data-image="blue" src="images/blue.png" alt=""> -->
    <img data-image="red" class="active" src="images/black.jpg" alt="">
  </div>


  <!-- Right Column -->
  <div class="right-column">
  <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <!-- Product Description -->
    <div class="product-description">
      <span>Headphones</span>
      <h1>Beats EP</h1>
      <p>The preferred choice of a vast range of acclaimed DJs. Punchy, bass-focused sound and high isolation. Sturdy headband and on-ear cushions suitable for live performance</p>
    </div>

    <!-- Product Configuration -->
    <div class="product-configuration">

      <!-- Product Color -->
      <div class="product-color">
        <span>Color</span>

        <div class="color-choose">
          <div>
            <input data-image="red" type="radio" id="red" name="color" value="red" checked>
            <label for="red"><span></span></label>
          </div>
          <div>
            <input data-image="blue" type="radio" id="blue" name="color" value="blue">
            <label for="blue"><span></span></label>
          </div>
          <div>
            <input data-image="black" type="radio" id="black" name="color" value="black">
            <label for="black"><span></span></label>
          </div>
        </div>

      </div>

      <!-- Cable Configuration -->
      <div class="cable-config">
        <span>Cable configuration</span>

        <div class="cable-choose">
          <button>Straight</button>
          <button>Coiled</button>
          <button>Long-coiled</button>
        </div>

        <a href="#">How to configurate your headphones</a>
      </div>
    </div>

    <!-- Product Pricing -->
    <div class="product-price">
      <span>MYR. 102</span>
      <form action="checkout.php" method="post">
        <input type="hidden" name="order_id" value="order-01" />
        <input type="hidden" name="amount" value="10" />
        <button type="submit" class="cart-btn">
          Checkout with PayHalal
        </button>
      </form>
    </div>
  </div>
</main>
    </body>
</html>
