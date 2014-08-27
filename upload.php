<?php
include("functions.php");
session_start();
if (!areSet($_SESSION, ['userName', 'isLogged'])) {
    session_destroy();
    header("location: index.php");
    die;
}
$userName = $_SESSION['userName'];
$title = "upload";
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="./CSS/header.css">
    <link rel="stylesheet" type="text/css" href="./CSS/upload.css">
    <link rel="stylesheet" type="text/css" href="./font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./CSS/footer.css">

</head>
<body>
<div class="container">
    <header>
        <div id="wrapper">
            <div id="logo" >
                <a href="#" id="logo_main">SAFFLOWER</a>
            </div>
            <div id="user">
                <p class="fa fa-user" ><a href="">User</a></p>
                <p class="fa fa-sign-out"><a href="">Log Out</a></p>
            </div>
        </div>
        <nav>
            <hr class="neon_lines">
            <ul class="menu">
                <li><a href="info.html">INFO</a></li>
                <li><a href="gallery.html">GALLERY</a></li>
            </ul>
            <hr class="neon_lines">
        </nav>
    </header>



    <main class="gallery">
        <div class="upload_container">
            <h2>Choose file to upload</h2>
            <form id="f1" enctype="multipart/form-data" method="post" action="uf.php">
                <input type="file" name="upfile">
                <input type="submit" value="Upload selected file">
            </form>
        </div>

    </main>

    <?php
    require("uf_cfg.php");

    function raise_upload_error($error_msg) {
        die("Error: ".$error_msg);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        sleep(1);

        if (!isset($_FILES["upfile"]["error"]))
            raise_upload_error("Upload error");
        if ($_FILES["upfile"]["error"] > 0)
            raise_upload_error($_FILES["upfile"]["error"]);

        if (is_uploaded_file($_FILES['upfile']['tmp_name'])) {
            move_uploaded_file($_FILES['upfile']['tmp_name'], $upload_path.$upload_slash.$_FILES['upfile']['name']);

            echo "&nbsp; <br/>";
            $filesize = $_FILES['upfile']['size'];
            if($filesize == 0 || $filesize > ($max_file_size*1024) ) {
                raise_upload_error( "File size must be under ".($max_file_size)." KB !!! <br/>".
                    "Current filesize = ".round($filesize/1024)." KB  <br/>");
            }

            echo "File <b>". $_FILES['upfile']['name'] ."</b> uploaded successfully.\n<br>";
            echo "Type: ".$_FILES['upfile']['type']."<br/>";
            echo "Filesize:  ".$filesize." bytes / ".round($filesize/1024)." KB / ".round(($filesize/1024)/1024)." MB \n<br>";
            header("refresh:2; url=gallery.php");
        }
        else {
            raise_upload_error("Error uploading file: <b>". $_FILES['upfile']['tmp_name'] . "</b>");
        }

    }
    else {
        echo "<font style='color:red'>";
        echo "Unauthorized access to this page.";
    }
    ?>

    <hr class="neon_lines_footer">
    <footer class="footer">
        <div class="contacts">
            <p>Contacts</p>
            <ul>
                <li class="fa fa-facebook-square"><a href="">Facebook page</a></li>
                <li class="fa fa-github-alt"><a href="https://github.com/PHP-team-SAFFLOWER/PHP-Gallery-Contest"> Git Hub</a> </li>
                <li class="fa fa-users"><a href="contacts.html"> Team Members</a> </li>
            </ul>

        </div>
    </footer>
</div>
</body>
</html>