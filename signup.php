<?php include_once('./includes/headerNav.php'); ?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <title>ثبت‌نام</title>
    <style>
      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }
      body {
        display: flex;
        flex-direction: column;
        height: 100vh;
        justify-content: center;
        align-items: center;
      }
      .registeration-box {
        width: 60%;
        padding: 15px;
      }
      .logo-box {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-bottom: 25px;
      }
      .signup-title {
        text-align: center;
        text-transform: uppercase;
        margin: 10px;
      }
    </style>
  </head>
  <body>
    <div class="registeration-box">
      <div class="logo-box">
        <img
          src="admin/upload/<?php echo htmlspecialchars($_SESSION['web-img'] ?? 'default-logo.png'); ?>"
          alt="لوگو"
          width="200px"
        />
      </div>
      <h1 class="signup-title">لطفاً ثبت‌نام کنید</h1>
      <hr>
      <?php
      if (isset($_GET['error'])) {
          $error = urldecode($_GET['error']);
          echo '<p style="color: red; text-align: center;">' . htmlspecialchars($error) . '</p>';
      } elseif (isset($_GET['success'])) {
          echo '<p style="color: green; text-align: center;">ثبت‌نام با موفقیت انجام شد!</p>';
      }
      ?>
      <form action="includes/signup.inc.php" method="post" class="row g-3">
        <div class="col-md-6">
          <label for="inputAddress2" class="form-label">نام کامل</label>
          <input
            type="text"
            class="form-control"
            name="name"
            placeholder="نام کامل..."
          />
        </div>
        <div class="col-md-6">
          <label for="inputAddress" class="form-label">شماره تماس</label>
          <input
            type="text"
            class="form-control"
            name="number"
            placeholder="+98 912 345 6789"
          />
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">ایمیل</label>
          <input 
            type="text" 
            class="form-control"
            name="email"
            placeholder="ایمیل"
          />
        </div>
        <div class="col-md-6">
          <label for="inputAddress" class="form-label">شناسه بازی</label>
          <input
            type="text"
            class="form-control"
            name="address"
            placeholder="مثال: ۱۲۳۴۵۶۷۸۹"
          />
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">رمز عبور</label>
          <input 
            type="password"
            class="form-control"
            name="pwd"
            placeholder="رمز عبور"
            required="required"
          />
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">تأیید رمز عبور</label>
          <input 
            type="password" 
            class="form-control" 
            name="rpwd"
            placeholder="تأیید رمز عبور"
            required="required"
          />
        </div>
        <div class="col-12">
          <button 
            type="submit" 
            class="btn btn-primary"
            name="submit"
          >ثبت‌نام</button>
        </div>
      </form>
    </div>
    <script src="./js/jquery.js" type="text/javascript"></script>
    <script src="./js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>