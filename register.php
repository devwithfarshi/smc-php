<?php include './components/header.php'; ?>



<main class="login-container">
    <div class="container">
        <section class="login__section">
            <h2>Crete your own account</h2>
            <form class="auth_form" method="post">
                <input name="full_name" type="text" placeholder="Name">
                <input type="text" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <input type="password" placeholder="Password" name="re_password">
                <button type="submit" class="login__btn" name="reg_user">Create</button>
            </form>
            <p>All ready have an account? <a href="login.php">Log in!</a></p>
        </section>
    </div>
</main>

<?php include './components/footer.php';?>

<?php
include "db.php";
if (isset($_POST['reg_user'])) {
    $full_name = mysqli_real_escape_string($db_con, $_POST['full_name']);
    $email = mysqli_real_escape_string($db_con, $_POST['email']);
    $password = mysqli_real_escape_string($db_con, $_POST['password']);
    $re_password = mysqli_real_escape_string($db_con, $_POST['re_password']);
    $sql="SELECT * FROM users WHERE email='$email'";
    $run=mysqli_query($db_con,$sql);
    $num_row=mysqli_num_rows($run);
    if($num_row<1){
        if($password==$re_password){
            $password=md5($password);
            $sql="INSERT INTO users(full_name,email,password) 
VALUES ('$full_name','$email','$password')";
mysqli_query($db_con,$sql);
}else{
    echo "Password Mismatch!!!";
}
}else{
	echo "Email Already Taken";
}
}