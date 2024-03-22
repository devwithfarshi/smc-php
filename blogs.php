<?php include './components/header.php'; ?>
<main class="main">
    <div class="container">
        <h2 class="page_heading">
            <?php
            if (!isset ($_GET["search"])) {
                echo "Our Blogs";
            } else {
                $searchItem = $_GET["search"];
                echo "Search Results for '$searchItem'";
            }
            ?>
        </h2>
        <section class="blogs_wrapper">
            <?php
            $filter_blogs;
            include "db.php";
            $sql = "SELECT posts.* , users.full_name as full_name FROM `posts` , `users` WHERE posts.posted_by=users.id ";
            if (isset ($_GET["search"]) && $_GET["search"] != "") {
                $search = $_GET["search"];
                $sql .= "AND posts.title LIKE '%$search%'";
            }
            $sql .= " ORDER BY posts.createdAt DESC";
            $filter_blogs = mysqli_query($db_con, $sql);

            $num_row = mysqli_num_rows($filter_blogs);
            if ($num_row < 1) {
                echo "<h1>No Blogs Found !!!</h1>";
            } else {

                while ($data = mysqli_fetch_array($filter_blogs)) {
                    echo '
                <div class="blog__card">
                <a href="blog_details.php?id=' . $data['id'] . '">;
                    
                <figure>
                <img src="';
                    echo $data["image"];
                    echo '" alt="Category">
                
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
    </div>
</main>


<?php include './components/footer.php'; ?>