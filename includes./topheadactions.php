<?php
$total_cart_items = 0;
if (isset($_SESSION['mycart'])) {
    $total_cart_items = count($_SESSION['mycart']);
}
?>

<div class="header-top">
  <div class="container">
    <ul class="header-social-container">
      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-facebook"></ion-icon>
        </a>
      </li>
      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-twitter"></ion-icon>
        </a>
      </li>
      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-instagram"></ion-icon>
        </a>
      </li>
      <li>
        <a href="#" class="social-link">
          <ion-icon name="logo-linkedin"></ion-icon>
        </a>
      </li>
    </ul>
    <div class="header-alert-news">
      <p>
        <b>پرداخت کن</b>
        لذت ببر؛ بدون مرز!
      </p>
    </div>
    <div class="header-top-actions">
      <!-- <select name="currency">
        <option value="usd">تومان</option>
        <option value="eur">یورو €</option>
      </select> -->
      <!-- <select name="language">
        <option value="fa-IR">فارسی</option>
        <option value="en-US">انگلیسی</option>
        <option value="fr">فرانسوی</option>
      </select> -->
    </div>
  </div>
</div>

<div class="header-main">
  <div class="container">
    <!-- logo section -->
    <a href="./index.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown'; ?>" class="header-logo" style="color: hsl(0, 0%, 13%);">
      <h1 style="text-align: center;">
        <img src="admin/upload/<?php echo $_SESSION['web-img']; ?>" alt="لوگو" width="200px">
      </h1>
    </a>
    <!-- search input -->
    <div class="header-search-container">
      <form class="search-form" method="post" action="./search.php">
        <input type="search" name="search" class="search-field" placeholder="نام محصول را وارد کنید..." required oninvalid="this.setCustomValidity('نام محصول را وارد کنید...')" oninput="this.setCustomValidity('')" />
        <button class="search-btn" type="submit" name="submit">
          <ion-icon name="search-outline"></ion-icon>
        </button>
      </form>
    </div>
    <div class="header-user-actions">
      <!-- Logout button -->
      <?php if (isset($_SESSION['id'])) { ?>
        <button id="lg-btn" class="action-btn">
          <a href="logout.php" id="a" role="button">
            <ion-icon name="log-out-outline"></ion-icon>
          </a>
        </button> 
        <!-- TODO: This script does not execute: Work on this, Directly logout user -->
        <script src="./js/logout.js"></script>
      <?php } else { ?>
        <!-- Login Button -->
        <button class="action-btn">
          <a href="./login.php" id="a">
            <ion-icon name="person-outline"></ion-icon>
          </a>
        </button>
      <?php } ?>
      <!-- Favourite Counter -->
      <button class="action-btn">
        <ion-icon name="heart-outline"></ion-icon>
        <span class="count">0</span>
      </button>
      <!-- Cart Button -->
      <?php if (!(isset($_SESSION['logged-in']))) { ?>
        <button class="action-btn">
          <a href="./cart.php">
            <ion-icon name="bag-handle-outline"></ion-icon>
          </a>
          <span class="count"> 
            <?php echo $total_cart_items; ?>
          </span>
        </button>
      <?php } ?>
    </div>
  </div>
</div>