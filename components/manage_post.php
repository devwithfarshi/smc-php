<?php

if (isset($_GET["post_id"]) & isset($_GET["opt"])) {
    $post_id = $_GET["post_id"];
    $opt = $_GET["opt"];
    if ($opt == "d") {
        include "db.php";
        $sql = "DELETE FROM posts WHERE id = '$post_id'";
        $results = mysqli_query($db_con, $sql);
        if ($results) {
            echo "<script>alert('Post deleted successfully');</script>";
        } else {
            echo "<script>alert('Something went wrong');</script>";
        }
    }
}

?>


<main>

    <header class="manage_header">
        <h2 class="manage_heading">manage post</h2>
        <a href="./admin.php?tab=add_post" class="manage_add_post_btn">Add Post</a>
    </header>


    <section class="blogs_wrapper admin__section__wrapper">
        <?php
        $filter_blogs;
        include "db.php";
        $sql = "SELECT posts.* , users.full_name as full_name FROM `posts` , `users` WHERE posts.posted_by=users.id ";
        if (isset($_GET["search"]) && $_GET["search"] != "") {
            $search = $_GET["search"];
            $sql .= "AND posts.title LIKE '%$search%'";
        }
        $sql .= " ORDER BY posts.createdAt DESC";
        $filter_blogs = mysqli_query($db_con, $sql);
        $num_row = mysqli_num_rows($filter_blogs);
        if ($num_row < 1) {
            echo "<h2 class='no__blogs__found__text' >No Posts Found !!!</h2>";
        } else {
            while ($data = mysqli_fetch_array($filter_blogs)) {
                echo '
                <div class="blog__card admin__blog__card">
                <a href="blog_details.php?id=' . $data['id'] . '">
                    
                <figure>
                <img src="';
                echo 'uploads/' . $data["image"];
                echo '" alt="Category">
                <figcaption class="admin_delete_post_btn">
                <a href="admin.php?tab=manage_posts&post_id=' . $data["id"] . '&opt=d">Delete</a></figcaption>

                </figure>
                <h2>';
                echo substr($data['title'], 0, 30) . '...';
                echo ' </h2> <p class="blog__desc" > ' . substr($data['desctiption'], 0, 115) . '... </p>
                </a>
                <div class="blog__infos">
                <p> written by <span class="autor_name">';
                echo $data['full_name'];
                echo '</span> </p>
                <p>published on <span class="published_date">';
                echo substr($data['createdAt'], 0, 10);
                ;
                echo '</span> </p>
                </div>
                </div>';
            }


        }
        ?>



    </section>



</main>