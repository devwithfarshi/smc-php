<?php include './components/header.php'; ?>


<?php
if (isset ($_GET['id'])) {

    include "db.php";
    $post_id = $_GET['id'];
    $sql = "SELECT * FROM posts WHERE id = '$post_id'";
    $results = mysqli_query($db_con, $sql);
    $data = mysqli_fetch_array($results);
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
} else {
    // Redirect to back
}


?>

<div class="container">

    <section class="blog__details__wrapper">
        <figure class="blog_details_image">
            <img src="<?php echo $data['image']; ?>" alt="blog">

        </figure>
        <div class="blog_details_author_info">
            <p>written by : <span class="blog_details_author_info_autor_name">
                    <?php echo $data['posted_by']; ?>
                </span>
            </p>
            <p>published on : <span class="blog_details_author_info_published_date">

                    <?php echo substr($data['createdAt'], 0, 10); ?>
                </span> </p>
        </div>

        <h2 class="blog_details_title">
            <?php echo $data['title']; ?>
        </h2>
        <p class="blog_details_desc">
            <?php echo $data['desctiption']; ?>
        </p>
    </section>
</div>



<?php include './components/footer.php'; ?>