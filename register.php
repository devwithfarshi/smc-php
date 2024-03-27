<?php include './components/header.php'; ?>


<?php
include "db.php";
if (isset($_POST['reg_user'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    if ($email != "") {
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];
        $sql = "SELECT * FROM users WHERE email='$email'";
        $run = mysqli_query($db_con, $sql);
        $num_row = mysqli_num_rows($run);
        if ($num_row < 1) {
            if ($password == $re_password) {
                $password = md5($password);
                $sql = "INSERT INTO users(full_name,email,password) 
VALUES ('$full_name','$email','$password')";
                mysqli_query($db_con, $sql);
                header('Location: login.php?success=Registered Successfully Login to continue!');
            } else {
                header('Location: register.php?error=Password Mismatch!!!');
            }
        } else {
            header('Location: register.php?error=Email Already Taken');
        }
    } else {
        header('Location: register.php?error=ALl Filed Are Required!');
    }
}
?>
<main class="login-container">
    <div class="container">
        <section class="login__section">
            <h2>Register</h2>
            <?php
            if (isset($_GET["error"])) {
                ?>
                <p class="error_msg">
                    <?php echo $_GET["error"]; ?>
                </p>
            <?php } ?>
            <form class="auth_form" method="post">
                <input name="full_name" type="text" placeholder="Name">
                <input type="email" placeholder="email" name="email" autocomplete="false">
                <input type="password" placeholder="Password" name="password" autocomplete="false">
                <input type="password" placeholder="Confrim Password" name="re_password">
                <button type="submit" class="login__btn" name="reg_user">Create</button>

            </form>
            <p>All ready have an account? <a href="login.php">Log in!</a></p>
        </section>
    </div>
</main>

<?php include './components/footer.php'; ?>