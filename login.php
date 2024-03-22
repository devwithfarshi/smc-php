<?php include './components/header.php'; ?>
<?php
session_start();
// unset($_SESSION["status"]);
$msg = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email != "" && $password != "") {
        include "db.php";
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        //FIXME: check the query and do login
        echo $query;
        $results = mysqli_query($db_con, $query);
        if (mysqli_num_rows($results) == 1) {
            // $_SESSION['user_id'] = ;
            // print_r(mysqli_fetch_array($results));
            echo "succes";
            $msg = "You are now logged in";
            header('location: index.php');
        } else {
            $msg = "Invalied Email or Password!";
        }
    } else {

        $msg = "Required Email and Password";
    }
    $_SESSION["status"] = $msg;
}

?>




<main class="login-container">
    <div class="container">
        <section class="login__section">
            <h2>Login</h2>
            <?php
            if (isset ($_SESSION["status"])) {
                ?>
                <p>
                    <?php echo $_SESSION["status"]; ?>
                </p>
                <?php
                unset($_SESSION["status"]);
            }
            ?>


            <form class="auth_form" method="post">
                <input type="email" placeholder="email" name="email">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" class="login__btn" name="">Login</button>
            </form>
            <p>No account? <a href="register.php">create one!</a></p>
        </section>
    </div>

</main>

<?php include './components/footer.php'; ?>