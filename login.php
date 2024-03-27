<?php include './components/header.php';
include "db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    if ($email != "" && $pass != "") {
        $pass = md5($pass);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
        $results = mysqli_query($db_con, $query);
        if (mysqli_num_rows($results) == 1) {
            $data = mysqli_fetch_array($results);
            $_SESSION["user_id"] = $data["id"];
            $_SESSION["isAdmin"] = $data["admin"];
            $_SESSION["isPremium"] = $data["isPremium"];
            $_SESSION["email"] = $data["email"];
            $_SESSION['log_fail'] = 0;
            header('location: index.php');
        } else {
            header('Location: logfail.php');
        }
    } else {
        header('Location: login.php?error=Required Email and Password');
    }
}

?>




<main class="login-container">
    <div class="container">
        <section class="login__section">
            <h2>Login</h2>


            <?php
            if (isset($_GET["error"])) {
                ?>
                <p class="error_msg">
                    <?php echo $_GET["error"]; ?>
                </p>
            <?php } ?>
            <?php
            if (isset($_GET["success"])) {
                ?>
                <p class="success_msg">
                    <?php echo $_GET["success"]; ?>
                </p>
            <?php } ?>

            <form class="auth_form" method="POST">
                <input type="email" placeholder="email" name="email">
                <input type="password" placeholder="Password" name="password">
                <?php if (isset($_SESSION["login_fail"])) {
                    if ($_SESSION["login_fail"] < 3) {

                        echo '
                        <button type="submit" class="login__btn" name="">Login</button>
                        ';
                    } else {
                        echo "wait for sometime to login...";
                    }
                } else {
                    echo '
                    <button type="submit" class="login__btn" name="">Login</button>
                    ';
                }
                ?>
            </form>
            <p>No account? <a href="register.php">create one!</a></p>
        </section>
    </div>

</main>

<?php include './components/footer.php'; ?>