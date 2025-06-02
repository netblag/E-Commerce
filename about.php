<?php 
  include_once('./includes/headerNav.php');
?>

<div class="overlay" data-overlay></div>
<!--
    - HEADER
  -->

<header>
  <!-- top head action, search etc in php -->
  <?php require_once './includes/topheadactions.php'; ?>

  <!-- desktop navigation -->
  <?php require_once './includes/desktopnav.php' ?>
  <!-- mobile nav in php -->
 <?php require_once './includes/mobilenav.php'; ?>
</header>

<!--
    - MAIN
  -->

<main>

  <div class="product-container">
    <div class="container">
      <!--
          - SIDEBAR
        -->
      <!-- CATEGORY SIDE BAR MOBILE MENU -->
      <?php require_once './includes/categorysidebar.php' ?>
      <!-- ############################# -->

      <div class="product-box">
        <!-- get id and url for each category and display its dat from table her in this secton -->
        <div class="product-main">

          <!--  -->
          <!-- about us section -->
          <div class="about-us">
            <div class="about-us-section">
              <!-- about us text -->
              <div class="about-us-content">
                <div class="about-us-text">
                  <h1 id="about-title" style="text-align: center;">درباره ما!</h1>
                  <br>
                  <h2 style="text-align: center;">
                  خوش آمدید به <span id="about-title"><?php echo $_SESSION['web-name'];?></span>
                  </h2>
                  <p>
                    <strong id="about-title"> <?php echo $_SESSION['web-name']; ?></strong> یک پلتفرم حرفه‌ای تجارت الکترونیک است. در اینجا ما فقط محتوای جذاب را به شما ارائه می‌دهیم که بسیار دوست خواهید داشت. ما متعهد به ارائه بهترین خدمات تجارت الکترونیک با تمرکز بر قابلیت اطمینان و فروش آنلاین هستیم. ما در تلاشیم تا اشتیاق خود به تجارت الکترونیک را به یک وبسایت آنلاین پررونق تبدیل کنیم. امیدواریم از تجارت الکترونیک ما به همان اندازه که ما از ارائه آن لذت می‌بریم، لذت ببرید.
                  </p>
                  <p style="font-weight: bold; text-align: center;">
                    از شما برای بازدید از <strong id="about-title"> <?php echo $_SESSION['web-name']; ?></strong>
                    <br>
                    <br>
                    <span style="font-size: 16px; font-weight: bold; text-align: center;">
                      روز خوبی داشته باشید!
                    </span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!--  -->

        </div>
      </div>
    </div>
  </div>

  <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

  <!--
      - BLOG
    -->

</main>

<?php require_once './includes/footer.php'; ?>