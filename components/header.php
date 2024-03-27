<?php
session_start();
include "db.php";
$isPrimium = 0;
$isAdmin = 0;
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT isPremium,admin FROM `users` WHERE id='$user_id'";
    $results = mysqli_query($db_con, $sql);
    $data = mysqli_fetch_array($results);
    $isPrimium = $data["isPremium"];
    $isAdmin = $data["admin"];
}
$_SESSION["isPremium"] = $isPrimium;
$_SESSION["isAdmin"] = $isAdmin;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMC Blogs</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/responsive.css">
    <?php
    if (isset($_SESSION["isAdmin"])) {
        if ($_SESSION['isAdmin']) {
            echo '<link rel="stylesheet" href="css/admin.css">';
        }
    }
    ?>
</head>

<body>

    <header class="navbar_header">
        <div class="container">
            <nav class="navbar ">
                <a href="
                /">
                    <h2 class="logo">SMc</h2>
                </a>
                <ul class="nav_list">
                    <li class="nav__list__items"><a href="./blogs.php">Blogs</a></li>
                    <li class="nav__list__items">
                        <a href="#">Information</a>

                        <ul class="drop_down">
                            <li class="drop__down__nav__list__items"><a href="#">Apps</a></li>
                            <li class="drop__down__nav__list__items"><a href="#">Livestreaming</a></li>
                            <li class="drop__down__nav__list__items"><a href="#">Help</a></li>
                            <li class="drop__down__nav__list__items"><a href="#">Legislation</a></li>
                        </ul>

                    </li>

                    <li class="nav__list__items"><a href="./contact.php">Contact</a></li>
                    <?php
                    if (isset($_SESSION["isAdmin"])) {
                        if ($_SESSION['isAdmin']) {

                            echo '    
                            <li class="nav__list__items"><a href="./admin.php?tab=manage_posts">Admin</a></li>
                            ';
                        }
                    }
                    ?>
                    <?php
                    if (!isset($_SESSION["user_id"])) {

                        echo '
    <li class="nav__list__items"><a href="./login.php">Sign in</a></li>
    <li class="nav__list__items"><a href="./register.php">Register</a></li>
    ';
                    } else {
                        echo '
                        <li class="nav__list__items"><a href="./logout.php">Log out</a></li>
                        ';

                    }
                    ?>

                </ul>

                <!-- mobile navlist -->

                <ul class="nav_list_mobile">
                    <button class="menu__cross__icon" id="menuBtnCross">
                        <img src="assets/icons/cross.svg" alt="menu_close">
                    </button>
                    <li class="nav__list__items"><a href="./blogs.php">Blogs</a></li>
                    <li class="nav__list__items"><a href="#">Information</a></li>
                    <li class="nav__list__items"><a href="#">Apps</a></li>
                    <li class="nav__list__items"><a href="#">Livestreaming</a></li>
                    <li class="nav__list__items"><a href="#">Help</a></li>
                    <li class="nav__list__items"><a href="#">Legislation</a></li>
                    <li class="nav__list__items"><a href="#">Contact</a></li>
                    <li class="nav__list__items"><a href="./admin.php?tab=manage_posts">Admin</a></li>
                    <?php
                    if (!isset($_SESSION["user_id"])) {

                        echo '
    <li class="nav__list__items"><a href="./login.php">Sign in</a></li>
    <li class="nav__list__items"><a href="./register.php">Register</a></li>
    ';
                    } else {
                        echo '
                        <li class="nav__list__items"><a href="./logout.php">Log out</a></li>
                        ';

                    }
                    ?>
                </ul>
                <?php
                // $path = basename($_SERVER['REQUEST_URI']);
                $path = explode("?", explode("/", $_SERVER["REQUEST_URI"])[2])[0];
                if ($path == "blogs.php") {

                    echo '
                    <div class="navbar__actions">
                    <form class="search__box">
                    <input name="search" type="text" placeholder="Search">
                    
                    <button class="search_btn" type="submit">
                    <img src="assets/icons/search.png" alt="search">
                    </button>
                    </form>
                    
                    </div>';
                }
                ?>
                <button class="menu__icon" id="menuBtn">
                    <img src="assets/icons/menu.svg" alt="menu">
                </button>
            </nav>
        </div>
    </header>