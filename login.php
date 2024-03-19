<?php include './components/header.php'; ?>



<main class="login-container">
    <div class="container">
        <section class="login__section">
            <h2>Login</h2>
            <form class="auth_form">
                <input type="text" placeholder="email">
                <input type="password" placeholder="Password">
                <button type="submit" class="login__btn">Login</button>
            </form>
            <p>No account? <a href="register.php">create one!</a></p>
        </section>
    </div>

</main>

<?php include './components/footer.php';?>