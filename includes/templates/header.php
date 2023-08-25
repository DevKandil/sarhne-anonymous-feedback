<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Emoji&display=swap" rel="stylesheet">
    <title><?php getTitle(); ?></title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/icofont.min.css" />
    <link rel="stylesheet" href="assets/css/index.css" />
    <meta name="keywords" content="sarahah,saraha,sarahaa,صراحة,صراحه" />
    <meta name="description" content="صراحة يساعدك في الحصول على نقد بناء مع المحافظة على سرية هوية الناقد - صارحني الأن">
    <style>
        .input-username::after {
            color: transparent;
            border-right: none !important;
        }
    </style>
</head>

<body>

<?php 
                function activeNav() {
                    preg_match("/\/(\w+\.php)$/", $_SERVER['SCRIPT_NAME'],$matches);
                    return $matches[1];
                }
            ?>

    <?php
    if (isset($_SESSION['user'])) { ?>


        <div class="tabs">

            <div class="tab">
                <a href="messages.php" ">
                    الرسائل
                </a>
            </div>

            <div class="tab">
                <a href="profile.php" ">
                    <span class="active"> حسابي </span>
                </a>
            </div>

            <div class="tab">
                <a href="#" ">
                    مجتمع
                </a>
            </div>

            <div class="tab">
                <a href="search.php" ">
                    بحث
                </a>
            </div>

            <div class="tab">
                <a href="help.php" ">
                    مساعدة
                </a>
            </div>

            <div class="tab">
                <a href="logout.php" ">
                    الخروج
                </a>
            </div>

        </div>


        <div class="nav" dir="rtl">
            <div class="nav-header">
                <div class="nav-title">
                    <a href="index.php">
                        <img src="assets/img/sarhne-nav.png" height="40" alt="Sarhne">
                    </a>              
                </div>
            </div>
            <div class="nav-btn">
                <label for="nav-check">
                    <section></section>
                    <section></section>
                    <section></section>
                </label>
            </div>
            <input type="checkbox" id="nav-check">

           
            <div class="nav-links">
                <a href="messages.php"><?= (activeNav()=="messages.php") ? '<span class="active"> الرسائل </span>' : "الرسائل" ; ?></a>
                <a href="profile.php"><?= (activeNav()=="profile.php") ? '<span class="active"> حسابي </span>' : " حسابي " ; ?></a>
                <a href="search.php"><?= (activeNav()=="search.php") ? '<span class="active"> بحث </span>' : " بحث " ; ?></a>
                <a href="help.php"><?= (activeNav()=="help.php") ? '<span class="active"> مساعدة </span>' : " مساعدة " ; ?></a>
                <a href="logout.php">خروج</a>
            </div>
        </div>

    <?php } else { ?>


        <div class="navbar navbar--extended">
            <nav class="nav__mobile"></nav>
            <div class="container">
                <div class="navbar__inner">
                    <a href="index.php" class="navbar__logo"> <img src="assets/img/sarhne-nav.png" height="40" alt="Sarhne" style="margin-top:15px;"> </a>
                    <nav class="navbar__menu">
                        <ul>
                            <li><a href="index.php"><?= (activeNav()=="index.php") ? '<span class="active"> الرئيسية </span>' : " الرئيسية " ; ?></a></li>
                            <li><a href="register.php"><?= (activeNav()=="register.php") ? '<span class="active"> أشتراك </span>' : " أشتراك " ; ?></a></li>
                            <li><a href="login.php"><?= (activeNav()=="login.php") ? '<span class="active"> دخول </span>' : " دخول " ; ?></a></li>
                            <li><a href="help.php"><?= (activeNav()=="help.php") ? '<span class="active"> المساعدة </span>' : " المساعدة " ; ?></a></li>
                            <li><a href="contact.php"><?= (activeNav()=="contact.php") ? '<span class="active"> اتصل بنا </span>' : " اتصل بنا " ; ?></a></li>
                        </ul>
                    </nav>
                    <div class="navbar__menu-mob"><a href id="toggle"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 448 512">
                                <path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class></path>
                            </svg></a></div>
                </div>
            </div>
        </div>

    <?php } ?>