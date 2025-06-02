<?php
include "includes/config.php";
include_once('./includes/restriction.php'); // بررسی دسترسی

// بررسی اینکه کاربر وارد شده است یا خیر
if (!(isset($_SESSION['logged-in']))) {
    header("Location: login.php?دسترسی_غیرمجاز");
    exit();
}

// بررسی وجود ID در URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // استفاده از prepared statement برای امنیت
    $sql = "DELETE FROM customer WHERE customer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // ریدایرکت با پیام موفقیت
        header("Location: users.php?message=کاربر_با_موفقیت_حذف_شد");
    } else {
        // ریدایرکت با پیام خطا
        header("Location: users.php?error=خطا_در_حذف_کاربر");
    }

    $stmt->close();
} else {
    // اگر ID معتبر نباشد
    header("Location: users.php?error=شناسه_کاربر_نامعتبر");
}

$conn->close();
?>