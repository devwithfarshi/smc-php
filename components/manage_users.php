<?php

include "db.php";
if (isset($_GET["id"])) {
    $userID = $_GET["id"];
    if (isset($_GET["opt"])) {
        $sql = "";
        if ($_GET["opt"] == "mnp") {
            $sql .= "UPDATE `users` SET `isPremium` = '0' WHERE `users`.`id` = '$userID'";
        }
        if ($_GET["opt"] == "mp") {
            $sql .= "UPDATE `users` SET `isPremium` = '1' WHERE `users`.`id` = '$userID'";
        }

        if ($_GET["opt"] == "a") {
            $sql .= "UPDATE `users` SET `admin` = '1' WHERE `users`.`id` = '$userID'";
        }
        $results = mysqli_query($db_con, $sql);
        if ($results) {
            header("Location: admin.php?tab=manage_users&sussess=User Updated Successfully");
        } else {
            header("Location: admin.php?tab=manage_users&error=Something went wrong");

        }

    }
}
?>
<main>

    <header class="manage_header">
        <h2 class="manage_heading">manage users</h2>
        <form class="search__box">
            <input name="u_search" type="text" placeholder="Search user by email">
            <button class="search_btn" type="submit">
                <img src="assets/icons/search.png" alt="search">
            </button>
        </form>
    </header>

    <sectoin class="admin__section__wrapper">
        <?php
        $filter_users;
        include "db.php";
        $sql = "SELECT * FROM `users` ";
        if (isset($_GET["u_search"]) && $_GET["u_search"] != "") {
            $search = $_GET["u_search"];
            $sql .= "WHERE users.email LIKE '%$search%' ";
        }
        $sql .= "ORDER BY `users`.`full_name` ASC";
        $filter_users = mysqli_query($db_con, $sql);
        $num_row = mysqli_num_rows($filter_users);
        if ($num_row < 1) {
            echo "<h2 class='no__blogs__found__text' >No Users Found !!!</h2>";
        } else { ?>
            <?php
            if (isset($_GET["error"])) {
                ?>
                <p class="user_update_error_msg">
                    <?php echo $_GET["error"]; ?>
                </p>
            <?php } ?>
            <?php
            if (isset($_GET["sussess"])) {
                ?>
                <p class="user_update_success_msg">
                    <?php echo $_GET["sussess"]; ?>
                </p>
            <?php } ?>
            <ul class="admin_view_user_list">
                <?php while ($data = mysqli_fetch_array($filter_users)) { ?>
                    <li class="admin_view_user_card">
                        <figure>
                            <img src="uploads/6602a6498b159.jpg" alt="user">
                        </figure>
                        <div class="user_info">

                            <h2>
                                <?php echo $data['full_name'] ?>
                            </h2>
                            <p>
                                <?php echo $data["email"] ?>
                            </p>
                        </div>
                        <form method="post" class="admin_user_action">
                            <?php
                            if (!$data["admin"]) {

                                if ($data["isPremium"]) {
                                    echo '<a href="admin.php?tab=manage_users&id=' . $data["id"] . '&opt=mnp"  class="admin_user_action_premium_btn" >Make Non-premium</a>';
                                } else {
                                    echo '<a  href="admin.php?tab=manage_users&id=' . $data["id"] . '&opt=mp" class="admin_user_action_premium_btn" >Make Premium</a>';
                                }
                            } else {
                                echo '<p class="admin_badge" >Admin</p>';
                            }
                            ?>

                            <?php
                            if (!$data["admin"]) {
                                echo '<a  href="admin.php?tab=manage_users&id=' . $data["id"] . '&opt=a" class="admin_user_action_admin_btn" >Make Admin</a>';
                            }
                            ?>
                            <!-- mnp == make non Premium? -->
                            <!-- mp == make Premium? -->
                            <!-- a == make admin? -->
                        </form>
                    </li>
                    <?php
                }
                ; ?>
            </ul>

            <?php
        }
        ; ?>


    </sectoin>

</main>