<?php
include 'pageParts.php';

my_header("Main page");

$_SESSION['is_logged'] = false;

echo '
<section>
    <h1>Neon Gallery</h1>
    <nav class="user_interface">
        <header>LOGIN</header>
        <form method="post" action="login.php">
            <input type="text" name="user_login" id="user" required="" placeholder="USERNAME">
            <input type="password" name="user_password" id="password" required="" placeholder="PASSWORD">
            <a href="#" name="forget_password">FORGET PASSWORD ?</a>
            <input type="submit" name="login" id="login" required="" value="LOGIN">
        </form>
        <a href="register.php">Register</a>
    </nav>
</section>
';

my_footer();