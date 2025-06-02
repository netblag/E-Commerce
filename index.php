<?php
include_once('./includes/headerNav.php');

// تابع برای فرمت قیمت به تومان
function formatPrice($price) {
    return number_format($price, 0, '.', ',') . ' تومان';
}

// Get all banner products
$banner_products = get_banner_details();
if (!$banner_products) {
    die("خطا در دریافت اطلاعات بنرها.");
}

// Get all category bar products
$catgeory_bar_products = get_category_bar_products();
if (!$catgeory_bar_products) {
    die("خطا در دریافت اطلاعات دسته‌بندی‌ها.");
}

// Get categories
$categories = get_categories();
$outfits = get_outfits_category();
$bundles = get_bundles_category();

// Get all new arrivals
$new_arrivals1 = get_new_arrivals();
$new_arrivals2 = get_new_arrivals();

// Get trending products
$trending_products1 = get_trending_products();
$trending_products2 = get_trending_products();

// Get top rated products
$top_rated_products1 = get_top_rated_products();
$top_rated_products2 = get_top_rated_products();
?>

<div class="overlay" data-overlay></div>

<header>
    <?php require_once './includes/topheadactions.php'; ?>
    <?php require_once './includes/desktopnav.php' ?>
    <?php require_once './includes/mobilenav.php'; ?>
</header>

<main>
    <div class="banner">
        <div class="container">
            <div class="slider-container has-scrollbar">
                <?php
                if (mysqli_num_rows($banner_products) > 0) {
                    while ($row = mysqli_fetch_assoc($banner_products)) {
                        $imagePath = "images/carousel/" . $row['banner_image'];
                        if (file_exists($imagePath)) {
                ?>
                            <div class="slider-item">
                                <img src="<?php echo $imagePath; ?>" alt="جدیدترین پکیج‌های گیمینگ" class="banner-img" />
                            </div>
                <?php
                        } else {
                            echo "تصویر بنر یافت نشد: " . $imagePath;
                        }
                    }
                } else {
                    echo "هیچ بنری یافت نشد.";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="category">
        <div class="container">
            <div class="category-item-container has-scrollbar">
                <?php
                while ($row = mysqli_fetch_assoc($catgeory_bar_products)) {
                ?>
                    <div class="category-item">
                        <div class="category-img-box">
                            <img src="./images/icons/<?php echo $row['img'] ?>" alt="لوگوی بازی" width="30" />
                        </div>
                        <div class="category-content-box">
                            <div class="category-content-flex">
                                <h3 class="category-item-title"><?php echo $row['name'] ?></h3>
                                <p class="category-item-amount">(<?php echo $row['category_quantity'] ?>)</p>
                            </div>
                            <form class="search-form" method="get" action="./search.php">
                                <input type="hidden" name="category_id" value="<?php echo $row['id'] ?>" />
                                <button type="submit" class="sidebar-submenu-title">
                                    <p class="category-btn">مشاهده پکیج‌ها</p>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div class="product-container">
        <div class="container">
            <?php require_once './includes/categorysidebar.php' ?>
            <div class="product-box">
                <div class="product-minimal">
                    <div class="product-showcase">
                        <h2 class="title">پکیج‌های جدید</h2>
                        <div class="showcase-wrapper has-scrollbar">
                            <div class="showcase-container">
                                <?php
                                $itemID;
                                $counter = 0;
                                while ($row1 = mysqli_fetch_assoc($new_arrivals1)) {
                                    if ($counter == 4) {
                                        break;
                                    }
                                ?>
                                    <div class="showcase">
                                        <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-img-box">
                                            <img src="./admin/upload/<?php echo $row1['product_img']; ?>" alt="پکیج جم کلش آو کلنز" width="70" class="showcase-img" />
                                        </a>
                                        <div class="showcase-content">
                                            <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>">
                                                <h4 class="showcase-title"><?php echo $row1['product_title']; ?></h4>
                                            </a>
                                            <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-category">جدید!</a>
                                            <div class="price-box">
                                                <p class="price"><?php echo formatPrice($row1['discounted_price']); ?></p>
                                                <del><?php echo formatPrice($row1['product_price']); ?></del>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $itemID = $row1['product_id'];
                                    $counter += 1;
                                }
                                ?>
                            </div>
                            <div class="showcase-container">
                                <?php
                                $counter = 0;
                                while ($row2 = mysqli_fetch_assoc($new_arrivals2)) {
                                    if ($counter == 4) {
                                        break;
                                    }
                                    if ($row2['product_id'] > $itemID) {
                                ?>
                                    <div class="showcase">
                                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-img-box">
                                            <img src="./admin/upload/<?php echo $row2['product_img']; ?>" alt="پکیج یوسی پابجی" class="showcase-img" width="70" />
                                        </a>
                                        <div class="showcase-content">
                                            <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>">
                                                <h4 class="showcase-title"><?php echo $row2['product_title']; ?></h4>
                                            </a>
                                            <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-category">جدید!</a>
                                            <div class="price-box">
                                                <p class="price"><?php echo formatPrice($row2['discounted_price']); ?></p>
                                                <del><?php echo formatPrice($row2['product_price']); ?></del>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                        $counter += 1;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="product-showcase">
                        <h2 class="title">پرطرفدار</h2>
                        <div class="showcase-wrapper has-scrollbar">
                            <div class="showcase-container">
                                <?php
                                $itemID;
                                $counter = 0;
                                while ($row1 = mysqli_fetch_assoc($trending_products1)) {
                                    if ($counter == 4) {
                                        break;
                                    }
                                ?>
                                    <div class="showcase">
                                        <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-img-box">
                                            <img src="./admin/upload/<?php echo $row1['product_img']; ?>" alt="پکیج سی‌پی کالاف دیوتی" width="70" class="showcase-img" />
                                        </a>
                                        <div class="showcase-content">
                                            <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>">
                                                <h4 class="showcase-title"><?php echo $row1['product_title']; ?></h4>
                                            </a>
                                            <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-category">پرطرفدار!</a>
                                            <div class="price-box">
                                                <p class="price"><?php echo formatPrice($row1['discounted_price']); ?></p>
                                                <del><?php echo formatPrice($row1['product_price']); ?></del>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $itemID = $row1['product_id'];
                                    $counter += 1;
                                }
                                ?>
                            </div>
                            <div class="showcase-container">
                                <?php
                                $counter = 0;
                                while ($row2 = mysqli_fetch_assoc($trending_products2)) {
                                    if ($counter == 4) {
                                        break;
                                    }
                                    if ($row2['product_id'] > $itemID) {
                                ?>
                                    <div class="showcase">
                                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-img-box">
                                            <img src="./admin/upload/<?php echo $row2['product_img']; ?>" alt="پکیج جم فری فایر" class="showcase-img" width="70" />
                                        </a>
                                        <div class="showcase-content">
                                            <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>">
                                                <h4 class="showcase-title"><?php echo $row2['product_title']; ?></h4>
                                            </a>
                                            <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-category">پرطرفدار!</a>
                                            <div class="price-box">
                                                <p class="price"><?php echo formatPrice($row2['discounted_price']); ?></p>
                                                <del><?php echo formatPrice($row2['product_price']); ?></del>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                        $counter += 1;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="product-showcase">
                        <h2 class="title">برترین پکیج‌ها</h2>
                        <div class="showcase-wrapper has-scrollbar">
                            <div class="showcase-container">
                                <?php
                                $itemID;
                                $counter = 0;
                                while ($row1 = mysqli_fetch_assoc($top_rated_products1)) {
                                    if ($counter == 4) {
                                        break;
                                    }
                                ?>
                                    <div class="showcase">
                                        <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-img-box">
                                            <img src="./admin/upload/<?php echo $row1['product_img']; ?>" alt="پکیج والورانت پوینت" width="70" class="showcase-img" />
                                        </a>
                                        <div class="showcase-content">
                                            <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>">
                                                <h4 class="showcase-title"><?php echo $row1['product_title']; ?></h4>
                                            </a>
                                            <a href="./viewdetail.php?id=<?php echo $row1['product_id'] ?>&category=<?php echo $row1['category_id'] ?>" class="showcase-category">برترین!</a>
                                            <div class="price-box">
                                                <p class="price"><?php echo formatPrice($row1['discounted_price']); ?></p>
                                                <del><?php echo formatPrice($row1['product_price']); ?></del>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $itemID = $row1['product_id'];
                                    $counter += 1;
                                }
                                ?>
                            </div>
                            <div class="showcase-container">
                                <?php
                                $counter = 0;
                                while ($row2 = mysqli_fetch_assoc($top_rated_products2)) {
                                    if ($counter == 4) {
                                        break;
                                    }
                                    if ($row2['product_id'] > $itemID) {
                                ?>
                                    <div class="showcase">
                                        <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-img-box">
                                            <img src="./admin/upload/<?php echo $row2['product_img']; ?>" alt="پکیج جم براول استارز" class="showcase-img" width="70" />
                                        </a>
                                        <div class="showcase-content">
                                            <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>">
                                                <h4 class="showcase-title"><?php echo $row2['product_title']; ?></h4>
                                            </a>
                                            <a href="./viewdetail.php?id=<?php echo $row2['product_id'] ?>&category=<?php echo $row2['category_id'] ?>" class="showcase-category">برترین!</a>
                                            <div class="price-box">
                                                <p class="price"><?php echo formatPrice($row2['discounted_price']); ?></p>
                                                <del><?php echo formatPrice($row2['product_price']); ?></del>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                        $counter += 1;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php require_once './includes/dealoftheday.php' ?>

                <div class="product-main">
                    <h2 class="title">پکیج‌های جدید</h2>
                    <div class="product-grid">
                        <?php
                        $limit = 8;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;

                        $product_left = array();
                        $new_product_counter = 1;

                        $new_products_result = get_new_products($offset, $limit);
                        if ($new_products_result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($new_products_result)) {
                        ?>
                            <div class="showcase">
                                <div class="showcase-banner">
                                    <img src="./admin/upload/<?php echo $row['product_img'] ?>" alt="پکیج ۱۰۰۰ جم کلش آو کلنز" width="300" class="product-img default" />
                                    <img src="./admin/upload/<?php echo $row['product_img'] ?>" alt="پکیج ۱۰۰۰ جم کلش آو کلنز" width="300" class="product-img hover" />
                                    <?php
                                    if ($new_product_counter == 1) {
                                    ?>
                                        <p class="showcase-badge">۲۰٪</p>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($new_product_counter == 3) {
                                    ?>
                                        <p class="showcase-badge angle black">تخفیف ویژه</p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="showcase-content">
                                    <a href="./viewdetail.php?id=<?php echo $row['product_id'] ?>&category=<?php echo $row['category_id'] ?>" class="showcase-category"><?php echo $row['product_title'] ?></a>
                                    <a href="./viewdetail.php?id=<?php echo $row['product_id'] ?>&category=<?php echo $row['category_id'] ?>">
                                        <h3 class="showcase-title"><?php echo $row['product_desc'] ?></h3>
                                    </a>
                                    <div class="showcase-rating">
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                        <ion-icon name="star"></ion-icon>
                                    </div>
                                    <div class="price-box">
                                        <p class="price"><?php echo formatPrice($row['discounted_price']); ?></p>
                                        <del><?php echo formatPrice($row['product_price']); ?></del>
                                    </div>
                                </div>
                            </div>
                        <?php
                                $new_product_counter = $new_product_counter + 1;
                            }
                        } else {
                            echo "هیچ پکیجی یافت نشد";
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>

                <?php
                include "includes/config.php";
                $sql1 = "SELECT * FROM products";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if (mysqli_num_rows($result1) > 0) {
                    $total_products = mysqli_num_rows($result1);
                    $total_page = ceil($total_products / $limit);
                ?>
                    <nav class="main-pagination" style="margin-left: 10px;">
                        <ul class="pagination-ul">
                            <?php
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($page == $i) {
                                    $active = "page-active";
                                } else {
                                    $active = "";
                                }
                            ?>
                                <li class="page-item-number <?php echo $active; ?>">
                                    <a class="page-number-link" href="index.php?page=<?php echo $i; ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </nav>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <div class="testimonials-box">
                <div class="testimonial">
                    <h2 class="title">نظرات گیمرها</h2>
                    <div class="testimonial-card">
                        <img src="./images/testimonial-1.jpg" alt="امیر گیمر" class="testimonial-banner" width="80" height="80" />
                        <p class="testimonial-name">امیر گیمر</p>
                        <p class="testimonial-title">گیمر حرفه‌ای کلش آو کلنز</p>
                        <!-- <img src="./images/icons/quotes.svg" alt="نقل‌قول" class="quotation-img" width="26" /> -->
                        <p class="testimonial-desc">خرید جم خیلی سریع بود، پشتیبانی هم عالی بود!</p>
                    </div>
                </div>
                <div class="cta-container">
                    <img src="./images/cta-banner-sale.jpg" alt="پکیج ویژه گیمینگ" class="cta-banner" />
                    <a href="#" class="cta-content">
                        <p class="discount">تخفیف ۲۵٪</p>
                        <h2 class="cta-title">پکیج ویژه گیمینگ</h2>
                        <p class="cta-text">شروع از <?php echo formatPrice(50000); ?></p>
                        <button class="cta-btn">همین حالا خرید کنید</button>
                    </a>
                </div>
                <div class="service">
                    <h2 class="title">خدمات ما</h2>
                    <div class="service-container">
                        <a href="#" class="service-item">
                            <div class="service-icon">
                                <ion-icon name="flash-outline"></ion-icon>
                            </div>
                            <div class="service-content">
                                <h3 class="service-title" style="direction: rtl; text-align: right;">شارژ آنی</h3>
                                <p class="service-desc" style="direction: rtl; text-align: right;">تحویل فوری جم و یوسی پس از پرداخت</p>
                            </div>
                        </a>
                        <a href="#" class="service-item">
                            <div class="service-icon">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </div>
                            <div class="service-content">
                                <h3 class="service-title" style="direction: rtl; text-align: right;">پرداخت امن</h3>
                                <p class="service-desc" style="direction: rtl; text-align: right;">اتصال به درگاه‌های معتبر ایرانی</p>
                            </div>
                        </a>
                        <a href="#" class="service-item">
                            <div class="service-icon">
                                <ion-icon name="call-outline"></ion-icon>
                            </div>
                            <div class="service-content">
                                <h3 class="service-title" style="direction: rtl; text-align: right;">پشتیبانی ۲۴/۷</h3>
                                <p class="service-desc" style="direction: rtl; text-align: right;">تماس از ۸ صبح تا ۱۲ شب</p>
                            </div>
                        </a>
                        <a href="#" class="service-item">
                            <div class="service-icon">
                                <ion-icon name="ticket-outline"></ion-icon>
                            </div>
                            <div class="service-content">
                                <h3 class="service-title" style="direction: rtl; text-align: right;">تخفیف‌های ویژه</h3>
                                <p class="service-desc" style="direction: rtl; text-align: right;">برای خریدهای بالای <?php echo formatPrice(500000); ?></p>
                            </div>
                        </a>
                        <a href="#" class="service-item">
                            <div class="service-icon">
                                <ion-icon name="gift-outline"></ion-icon>
                            </div>
                            <div class="service-content">
                                <h3 class="service-title" style="direction: rtl; text-align: right;">جوایز گیمینگ</h3>
                                <p class="service-desc" style="direction: rtl; text-align: right;">شانس برنده شدن آیتم‌های ویژه</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog">
        <div class="container">
            <div class="blog-container has-scrollbar">
                <div class="blog-card">
                    <a href="https://igame.ir/blog/180/">
                        <img src="./images/blog/blog-1.jpg" alt="آموزش اتصال کالاف موبایل به اکتیویژن و فیسبوک[آپدیت 2025]" width="300" class="blog-banner" />
                    </a>
                    <div class="blog-content">
                        <a href="https://igame.ir/blog/180/" class="blog-category">کالاف موبایل</a>
                        <a href="https://igame.ir/blog/180/">
                            <h3 class="blog-title">آموزش اتصال کالاف موبایل به اکتیویژن و فیسبوک[آپدیت 2025]</h3>
                        </a>
                        <p class="blog-meta">
                            توسط <cite>محمد گیمر</cite> /
                            <time datetime="1403-01-15">۱۵ فروردین ۱۴۰۳</time>
                        </p>
                    </div>
                </div>
                <div class="blog-card">
                    <a href="https://igame.ir/blog/225/">
                        <img src="./images/blog/blog-2.jpg" alt="بازی کالاف دیوتی وارزون موبایل؛ از شایعه تا واقعیت" class="blog-banner" width="300" />
                    </a>
                    <div class="blog-content">
                        <a href="https://igame.ir/blog/225/" class="blog-category">کالاف موبایل</a>
                        <h3>
                            <a href="https://igame.ir/blog/225/" class="blog-title">بازی کالاف دیوتی وارزون موبایل؛ از شایعه تا واقعیت</a>
                        </h3>
                        <p class="blog-meta">
                            توسط <cite>سارا پلیر</cite> /
                            <time datetime="1403-02-10">۱۰ اردیبهشت ۱۴۰۳</time>
                        </p>
                    </div>
                </div>
                <div class="blog-card">
                    <a href="https://igame.ir/blog/345/">
                        <img src="./images/blog/blog-3.jpg" alt="آموزش چیت زدن و معرفی انواع چیت های بازی کالاف دیوتی موبایل" class="blog-banner" width="300" />
                    </a>
                    <div class="blog-content">
                        <a href="https://igame.ir/blog/345/" class="blog-category">کالاف موبایل</a>
                        <h3>
                            <a href="https://igame.ir/blog/345/" class="blog-title">آموزش چیت زدن و معرفی انواع چیت های بازی کالاف دیوتی موبایل</a>
                        </h3>
                        <p class="blog-meta">
                            توسط <cite>رضا شوتر</cite> /
                            <time datetime="1403-03-20">۲۰ خرداد ۱۴۰۳</time>
                        </p>
                    </div>
                </div>
                <div class="blog-card">
                    <a href="https://igame.ir/blog/286/">
                        <img src="./images/blog/blog-4.jpg" alt="با خرید سی پی در گردونه کالاف شرکت کنید" class="blog-banner" width="300" />
                    </a>
                    <div class="blog-content">
                        <a href="https://igame.ir/blog/286/" class="blog-category">کالاف موبایل</a>
                        <h3>
                            <a href="https://igame.ir/blog/286/" class="blog-title">با خرید سی پی در گردونه کالاف شرکت کنید</a>
                        </h3>
                        <p class="blog-meta">
                            توسط <cite>نگار گیمر</cite> /
                            <time datetime="1403-04-05">۵ تیر ۱۴۰۳</time>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once './includes/footer.php'; ?>
