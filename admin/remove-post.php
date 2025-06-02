<?php
include "includes/config.php";

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        header("Location: post.php?status=deleted");
        exit();
    } else {
        echo "خطا در حذف محصول";
    }
    $stmt->close();
} else {
    echo "شناسه محصول ارائه نشده است";
}
$conn->close();
?>