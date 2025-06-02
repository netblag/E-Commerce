<?php
session_start();

$total_price = 0;
if (isset($_SESSION['mycart'])) {
  foreach ($_SESSION['mycart'] as $item) {
    $total_price += $item['price'] * $item['product_qty'];
  }
}
function format_price($price) {
    return number_format($price) . " ریال";
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>درگاه پرداخت</title>
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      font-family: 'Vazirmatn', sans-serif;
      box-sizing: border-box;
    }
    body {
      margin: 0;
      padding: 0;
      background: #f3f4f6;
      color: #333;
    }
    .container {
      max-width: 1100px;
      margin: 40px auto;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .card-box {
      background: #fff;
      border: 1px solid #d1d5db;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 20px 12px rgba(0,0,0,0.06);
    }
    .main { flex: 1 1 65%; }
    .sidebar { flex: 1 1 30%; display: flex; flex-direction: column; gap: 20px; }

    h2 {
      font-size: 20px;
      margin-bottom: 20px;
      color: #2563eb;
      background: #e0edff;
      padding: 12px;
      border-radius: 10px;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 16px;
      text-align: center;
      background-color: #f0f5ff;
    }

    .form-row {
      display: flex;
      gap: 10px;
    }

    .form-row .form-group {
      flex: 1;
    }

    .captcha {
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: flex-start;
      margin-bottom: 20px;
    }

    .captcha input {
      flex: 0.4;
      padding: 8px 10px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 16px;
      text-align: center;
      background-color: #f0f5ff;
    }

    .captcha-box {
      background: linear-gradient(135deg, #3a7bd5, #3aafd5);
      color: white;
      padding: 10px 20px;
      font-size: 20px;
      border-radius: 10px;
      letter-spacing: 2px;
    }

    .captcha-refresh {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 20px;
      color: #3a7bd5;
    }

    .submit-btn, .pay-btn {
      width: 100%;
      background: #3a7bd5;
      color: white;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 15px;
      transition: background 0.3s;
    }

    .submit-btn:hover, .pay-btn:hover {
      background: #2c66c7;
    }

    .checkbox {
      margin-top: 15px;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 14px;
    }

    .otp-button-wrapper {
      flex: 1;
      margin-top: 30px;
    }

    .sidebar .info-card h3 {
      font-size: 14px;
      font-weight: normal;
      color: #6b7280;
      margin-bottom: 6px;
    }

    .sidebar .info-card p {
      margin: 6px 8;
    }

    .amount {
      font-size: 28px;
      font-weight: bold;
      color: #111827;
    }

    .amount-label {
      font-size: 14px;
      color: #6b7280;
    }

    .line {
      height: 1px;
      background: #e5e7eb;
      margin: 15px 0;
    }

    .small-label {
      font-size: 13px;
      color: #6b7280;
    }

    .bold-text {
      font-size: 16px;
      font-weight: bold;
      color: #111827;
    }

    .time-inside {
      background: #e0edff;
      color: #1e3a8a;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
      border-radius: 10px;
      text-align: center;
      margin-bottom: 15px;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

<div class="container">

  <!-- فرم اطلاعات کارت -->
  <div class="card-box main">
    <h2>اطلاعات کارت خود را وارد کنید</h2>

    <div class="form-group">
      <label>شماره کارت</label>
      <input type="text" maxlength="19" placeholder="---- ---- ---- ----" oninput="formatCardNumber(this)">
    </div>

    <div class="form-group">
      <label>شماره شناسایی دوم (CVV2)</label>
      <input type="text" maxlength="3" placeholder="CVV2" oninput="this.value=this.value.replace(/[^\d]/g,'');">
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>تاریخ انقضا</label>
        <input type="text" maxlength="2" placeholder="ماه" oninput="this.value=this.value.replace(/[^\d]/g,'');">
      </div>
      <div class="form-group">
        <label style="color:white">سال</label>
        <input type="text" maxlength="2" placeholder="سال" oninput="this.value=this.value.replace(/[^\d]/g,'');">
      </div>
    </div>

    <div class="form-row captcha">
      <input type="text" maxlength="5" placeholder="کد امنیتی" oninput="this.value=this.value.replace(/[^\d]/g,'');">
      <div class="captcha-box">56388</div>
      <button class="captcha-refresh" title="تغییر کد">🔄</button>
    </div>

    <div class="form-row">
      <div class="form-group" style="flex: 1">
        <label>رمز دوم</label>
        <input id="otp-input" type="text" maxlength="5" placeholder="رمز دوم" oninput="this.value=this.value.replace(/[^\d]/g,'');">
      </div>
      <div class="otp-button-wrapper">
        <button class="submit-btn" onclick="startTimer(this)" id="otp-button">دریافت رمز پویا</button>
      </div>
    </div>

    <div class="checkbox">
      <input type="checkbox" id="saveCard">
      <label for="saveCard">شماره کارت ذخیره شود</label>
    </div>

    <button class="pay-btn">پرداخت</button>
  </div>

  <!-- سایدبار با تایمر داخل پذیرنده -->
  <div class="sidebar">

    <!-- اطلاعات پذیرنده -->
    <div class="card-box info-card">
      <div class="time-inside">
        زمان باقی‌مانده: <span id="main-timer">10:00</span>
      </div>

      <h3>پذیرنده</h3>
      <p class="bold-text">فروشگاه پادرو</p>

      <div class="amount-label">مبلغ</div>
      <p class="amount"><?php echo format_price($total_price); ?></p>

      <div class="line"></div>

      <p class="small-label">شماره پذیرنده / ترمینال</p>
      <p class="bold-text">14875889 / 16411439</p>

      <p class="small-label">سایت پذیرنده</p>
      <p class="bold-text">podro.shop</p>
    </div>

  </div>

</div>

<!-- اسکریپت‌ها -->
<script>
  function formatCardNumber(input) {
    input.value = input.value.replace(/[^\d]/g, '').replace(/(.{4})/g, '$1 ').trim();
  }

  function startTimer(button) {
    let duration = 120;
    button.disabled = true;
    const originalText = "دریافت رمز پویا";
    const interval = setInterval(() => {
      const minutes = Math.floor(duration / 60);
      const seconds = duration % 60;
      button.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
      if (--duration < 0) {
        clearInterval(interval);
        button.textContent = originalText;
        button.disabled = false;
      }
    }, 1000);
  }

  let mainTime = 600;
  const mainTimer = document.getElementById("main-timer");
  const mainInterval = setInterval(() => {
    const minutes = Math.floor(mainTime / 60);
    const seconds = mainTime % 60;
    mainTimer.textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    if (--mainTime < 0) clearInterval(mainInterval);
  }, 1000);
</script>

</body>
</html>
