<?php include './components/header.php'; ?>

<?php
if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] == 0) {
    header('Location: index.php');
}
?>

<div class="container">

    <main class="admin__wrapper">

        <section class="admin__sidebar">
            <ul class="admin__sidebar__list">
                <li><a href="./admin.php?tab=manage_posts" class="<?php if (isset($_GET["tab"]) && ($_GET["tab"] == "manage_posts" || $_GET["tab"] == "add_post"))
                    echo 'active_tab' ?>">manage
                            posts</a></li>
                    <li><a href="./admin.php?tab=manage_users" class="<?php if (isset($_GET["tab"]) && $_GET["tab"] == "manage_users")
                    echo 'active_tab' ?>">manage
                            usres</a></li>
                </ul>
            </section>
            <section class="admin_dashboard">


                <?php
                if (isset($_GET["tab"])) {
                    if ($_GET["tab"] == "manage_posts") {
                        include "./components/manage_post.php";
                    } elseif ($_GET["tab"] == "manage_users") {
                        include "./components/manage_users.php";
                    } elseif ($_GET["tab"] == "add_post") {
                        include "./components/add_posts.php";
                    }
                }

                ?>

        </section>

    </main>
</div>


<?php include './components/footer.php'; ?>