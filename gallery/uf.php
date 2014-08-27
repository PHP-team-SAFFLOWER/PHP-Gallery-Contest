<html>
<head >
	<meta http-equiv="content-type" content="text/html; encoding=utf-8" />
	<title>Upload file to server demo</title>
</head>
<body >
	<div style="background-color:lightgray; border-width:1px; border-style:dashed; padding:20px;"
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
	</div>
</body>
</html>