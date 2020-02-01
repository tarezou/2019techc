<?php
	session_start();

	if($_SESSION['login'] == null){
		header("Location: login.php");
		exit;
	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset=utf-8>
	<title>投稿</title>
</head>
<body>
	<form action="write.php" method="post" enctype="multipart/form-data">
	コメント:<input type="text" name="comment">
	画像:<input type="file" name="image">
	<button>投稿</button>
	</form>
</body>
</html>
