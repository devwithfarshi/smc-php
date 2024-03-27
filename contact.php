<?php include './components/header.php'; ?>
<?php
if (!isset($_SESSION["user_id"])) {
    header('Location: login.php?error=You must login first.');
    return;

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "db.php";
    $u_id = $_SESSION["user_id"];
    $u_email = $_SESSION["email"];
    $u_name = mysqli_real_escape_string($db_con, $_POST["u_name"]);
    $subject = mysqli_real_escape_string($db_con, $_POST["subject"]);
    $message = mysqli_real_escape_string($db_con, $_POST["message"]);


    if ($subject != "" && $message != "") {
        $sql = "INSERT INTO `contact` (`u_id`, `u_name`, `email` ,`subject`, `message`) VALUES ('$u_id', '$u_name', '$u_email' ,'$subject', '$message')";
        $result = mysqli_query($db_con, $sql);
        if ($result) {
            header('Location: contact.php?success=Your contact has been successfully sent.Wait for 24 hours to review your application.');
        } else {
            header('Location: contact.php?error=Something went wrong.Please try again later.');
        }
    } else {
        header('Location: contact.php?error=Required subject and message');

    }
}

?>

<div class="container">

    <main class="contact_wrapper">

        <h2 class="contact_heading">
            Get in touch
        </h2>
        <section class="contact_form">
            <?php
            if (isset($_GET["error"])) {
                ?>
                <p class="contact_error_msg">
                    <?php echo $_GET["error"]; ?>
                </p>
            <?php } ?>
            <?php
            if (isset($_GET["success"])) {
                ?>
                <p class="contact_success_msg">
                    <?php echo $_GET["success"]; ?>
                </p>
            <?php } ?>
            <form method="POST">
                <input type="text" placeholder="Name:" name="u_name" value="<?php echo $_SESSION["full_name"] ?>">
                <input type="text" placeholder="Subject:" name="subject" autofocus>
                <textarea name="message" placeholder="Write Message here..."></textarea>
                <button type="submit" class="contact_post_btn">send</button>
            </form>
        </section>


        <section class="contact_map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.8598497568173!2d90.379005375965!3d23.752376688699268!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8afb693ff75%3A0x32051f5a37ac6420!2z4Kah4KeN4Kav4Ka-4Kar4KeL4Kah4Ka_4KayIOCmh-CmqOCnjeCmn-CmvuCmsOCmqOCnjeCmr-CmvuCmtuCmqOCmvuCmsiDgpo_gppXgpr7gpqHgp4fgpq7gpr8gKOCmoeCmvyDgpobgpocg4KaPKQ!5e0!3m2!1sbn!2sbd!4v1711566195630!5m2!1sbn!2sbd"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
    </main>
</div>

<?php include './components/footer.php'; ?>