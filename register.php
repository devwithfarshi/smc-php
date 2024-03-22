<?php include './components/header.php'; ?>


<?php
session_start();
unset($_SESSION["status"]);
$msg = "";

include "db.php";
if (isset ($_POST['reg_user'])) {
    $full_name = mysqli_real_escape_string($db_con, $_POST['full_name']);
    $email = mysqli_real_escape_string($db_con, $_POST['email']);
    if ($email != "") {
        $password = mysqli_real_escape_string($db_con, $_POST['password']);
        $re_password = mysqli_real_escape_string($db_con, $_POST['re_password']);
        $sql = "SELECT * FROM users WHERE email='$email'";
        $run = mysqli_query($db_con, $sql);
        $num_row = mysqli_num_rows($run);
        if ($num_row < 1) {
            if ($password == $re_password) {
                $password = md5($password);
                $sql = "INSERT INTO users(full_name,email,password) 
VALUES ('$full_name','$email','$password')";
                mysqli_query($db_con, $sql);
                $msg = "Registered Successfully Login to continue!";
                header('location: login.php');
            } else {
                $msg = "Password Mismatch!!!";
            }
        } else {
            $msg = "Email Already Taken";
        }
    } else {
        $msg = "Required Email";
    }
    $_SESSION['status'] = $msg;
}
?>
<main class="login-container">
    <div class="container">
        <section class="login__section">
            <h2>Register</h2>
            <p>
                <?php
                if (isset ($_SESSION["status"])) {
                    echo $_SESSION["status"];
                }
                ?>
            </p>
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