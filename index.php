<?php
$title = "Start Page";
include("yav_header.php");

session_start();
//if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']===true) {
//    header("location: yav_logged.php");
//}
?>

<p>Wellcome!</p>
<form action="yav_register.php" method="post">
    <fieldset>
        <legend>Register</legend>
        <label for="regrName">User name:</label><br/>
        <input type="text" name="regName" placeholder="Name"/><br/>
        <label for="regPass">Password:</label><br/>
        <input type="password" name="regPass" placeholder="Pass"/><br/>
        <input type="submit" value="Register"/>
    </fieldset>
</form>
<hr/>
<form action="yav_login.php" method="post">
    <fieldset>
        <legend>Log in</legend>
        <label for="userName">User name:</label><br/>
        <input type="text" name="logName" placeholder="Name"/><br/>
        <label for="userPass">Password:</label><br/>
        <input type="password" name="logPass" placeholder="Pass"/><br/>
        <input type="submit" value="login"/>
    </fieldset>
</form>
<?php
include("yav_footer.php");
?>



