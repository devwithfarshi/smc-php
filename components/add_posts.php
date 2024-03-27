<?php

include "db.php";
if (isset ($_POST['create__post'])) {
    $title = mysqli_real_escape_string($db_con, $_POST['title']);
    $description = mysqli_real_escape_string($db_con, $_POST['description']);
    if (isset ($_FILES["image"])) {
        $image = $_FILES["image"];
        if ($description != "" && $title != "") {
            $user_id = $_SESSION["user_id"];
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0777, true)) {
                    header('Location: admin.php?tab=add_post&error=Error creating the directory.');
                }
            }
            $allowedExtensions = ["png", "jpg", "jpeg"];
            $fileName = $image["name"];
            $fileTemp = $image["tmp_name"];
            $fileSize = $image["size"];
            $fileExtension = explode(".", $fileName)[1];

            if (in_array($fileExtension, $allowedExtensions)) {
                $uniqueFilename = uniqid() . "." . $fileExtension;
                if (move_uploaded_file($fileTemp, "$uploadDir/$uniqueFilename")) {
                    $uniqueFilename = mysqli_real_escape_string($db_con, $uniqueFilename);
                    $sql = "INSERT INtO posts(posted_by,title,desctiption,image) VALUES ('$user_id', '$title','$description','$uniqueFilename')";
                    $run = mysqli_query($db_con, $sql);
                    if ($run) {
                        header("Location: admin.php?tab=manage_posts");
                    } else {
                        $imageToDelete = $uploadDir . $uniqueFilename;
                        if (file_exists($imageToDelete)) {
                            if (unlink($imageToDelete)) {
                                echo "Image deleted successfully.";
                            } else {
                                echo "Error deleting image.";
                            }
                        }
                        header('Location: admin.php?tab=add_post&error=Something went wrong!');
                    }
                } else {
                    header('Location: admin.php?tab=add_post&error=Error uploading file.');
                }
            } else {
                header('Location: admin.php?tab=add_post&error=Only PNG, JPG, and JPEG files are allowed.');
            }
        } else {
            header('Location: admin.php?tab=add_post&error=All Field Are Required!');
        }
    } else {
        header('Location: admin.php?tab=add_post&error=Provie an image!');

    }
}
?>

<main>

    <header class="manage_header">
        <h2 class="manage_heading">Create a new post</h2>
        <a href="./admin.php?tab=manage_posts" class="manage_add_post_btn">Go Back</a>
    </header>

    <section class="admin__section__wrapper">
        <?php
        if (isset ($_GET["error"])) {
            ?>
        <p class="admin_error_msg">
            <?php echo $_GET["error"]; ?>
        </p>
        <?php } ?>
        <form method="post" class="post_form" enctype="multipart/form-data">
            <input type=" text" placeholder="Title" name="title" autofocus>
            <textarea name="description" placeholder="Write Description here..."></textarea>
            <input type="file" name="image" accept=".jpg, .jpeg, .png">
            <button type="submit" class="addmin_post_btn" name="create__post">share</button>
        </form>
    </section>

</main>