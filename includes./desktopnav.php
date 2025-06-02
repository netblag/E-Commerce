<!-- desktop navigation -->
<nav class="desktop-navigation-menu">
  <div class="container">
    <ul class="desktop-menu-category-list">
      <li class="menu-category">
        <a href="index.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown'; ?>" class="menu-title">
          خانه
        </a>
      </li>
      <li class="menu-category">
        <a href="contact.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown'; ?>" class="menu-title">
          تماس با ما
        </a>
      </li>
      <li class="menu-category">
        <a href="about.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown'; ?>" class="menu-title">درباره ما</a>
      </li>
      <!-- Profile Link Setup -->
      <?php if (isset($_SESSION['id'])) { ?>
        <li class="menu-category" style="opacity:1">
          <a href="profile.php?id=<?php echo (isset($_SESSION['customer_name'])) ? $_SESSION['id'] : 'unknown'; ?>" class="menu-title">
            پروفایل
          </a>
        </li>
      <?php } else { ?>
        <li class="menu-category" style="opacity:0.5">
          <a style="cursor: not-allowed;" href="#?loginfirst" class="menu-title">
            پروفایل (لطفاً وارد شوید)
          </a>
        </li>
      <?php } ?>
      <!-- Visit Admin Panel After Login -->
      <?php if (isset($_SESSION['logged-in'])) { ?>
        <li class="menu-category">
          <a href="admin/post.php" class="menu-title">
            پنل مدیریت
          </a>
        </li>
      <?php } ?>
    </ul>
  </div>
</nav>