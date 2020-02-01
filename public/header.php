<?php
session_start();
if($_SESSION['login'] != null){
        $name = $_SESSION['login'];
}else{
        header("Location: login.php");
        exit;
}
?>

<!DOCTYPE HTML>
<html>
        <head>
                <meta charset=utf-8>
                <title>pofile変更</title>
        </head>
        <body>
        <form action="/header_setting.php" method="post" enctype="multipart/form-data">
                header:<input type="file" name="icon">
                <button>変更</button>
	</form>
        </body>
</html>
