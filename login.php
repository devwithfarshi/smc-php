<?php include './components/header.php'; ?>




<main class="login-container">
    <div class="container">
        <section class="login__section">
            <h2>Login</h2>
            <form class="auth_form" method="post">
                <input type="email" placeholder="email" name="email">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" class="login__btn" name="">Login</button>
            </form>
            <p>No account? <a href="register.php">create one!</a></p>
        </section>
    </div>

</main>

<?php include './components/footer.php';?>

<?php
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
          array_push($errors, "Username is required");
    }
    if (empty($password)) {
          array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
          $password = md5($password);
          $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
          $results = mysqli_query($db, $query);
          if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
          }else {
                  array_push($errors, "Wrong username/password combination");
          }
    }
  }
  
  ?>