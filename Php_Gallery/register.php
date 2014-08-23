<?php
include 'pageParts.php';
$_SESSION['is_logged'] = false;
$error_array = array();

if (!$_SESSION['is_logged'] == true) {

    if (count($_POST) != 0) {

        if ($_POST['form_submit'] == 1) {
            $user = trim($_POST['user']);
            $password = trim($_POST['password']);
            $passwordConf = trim($_POST['confpassword']);
            $email = trim($_POST['mail']);

            if (strlen($user) < 3) {
                $error_array['user'] = 'User ID too short';
            }

            if (strlen($password) < 6) {
                $error_array['password'] = 'Password too short';
            }

            if ($password != $passwordConf) {
                $error_array['passwords_are_different'] = 'Passwords do not match';
            }

            if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/', $email)) {
                $error_array['email'] = 'Wrong e-mail';
            }

            if (!count($error_array) > 0) {
                db_init();
                $tbl_name = 'new_users'; // Table name
                $sql = 'SELECT COUNT(*) as cnt FROM ' . $tbl_name . 'WHERE id="' . addslashes($user) . '" OR email="' . addslashes($email) . '"';
//                echo $sql;
                $res = mysql_query($sql);
//                var_dump($res);
                $row = mysql_fetch_assoc($res);

                if ($row['cnt'] == 0) {
                    mysql_query('INSERT INTO ' . $tbl_name. ' (user,pass,email,date_register) VALUES("' . addslashes($user) .
                                '","' . md5($password) . '","' . addslashes($email) . '","' . time() . '")');

                    if (mysql_error()) {
                        echo '<h1>Error. Please try again</h1>';
                    }
                    else {
                        header('Location: index.php');
                        exit;
                    }
                }
                else {
                    $error_array['user'] = 'Name or e-mail already exist';
                    $error_array['email'] = 'Name or e-mail already exist';
                }
            }
        }
    }

    my_header('Register');
?>

    <?php

    ?>

<form method="post" action="register.php">
    <input type="text" name="user" id="user" required="" placeholder="USERNAME"/>
    <?php
    if (array_key_exists('user', $error_array)) {
        echo $error_array['user'];
    }
    ?>
    <br/>
    <input type="password" name="password" id="password" required="" placeholder="PASSWORD"/>
    <?php
    if (array_key_exists('password', $error_array)) {
        echo $error_array['password'];
    }
    ?>
    <br/>
    <input type="password" name="confpassword" id="confpassword" placeholder="REPEAT PASSWORD"/>
    <?php
    if (array_key_exists('passwords_are_different', $error_array)) {
        echo $error_array['passwords_are_different'];
    }
    ?>
    <br/>
    <input type="email" name="mail" id="mail" required="" placeholder="EMAIL"/>
    <?php
    if (array_key_exists('email', $error_array)) {
        echo $error_array['email'];
    }
    ?>
    <input type="submit" name="submit" id="submit" required=""/>
    <input type="hidden" name="form_submit" value="1">
</form>
<?php
    my_footer();
}
else {
    header('Location: index.php');
    exit;
}