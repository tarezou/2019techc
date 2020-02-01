<?php
session_start();
if($_SESSION['login'] != null){
	$name = $_SESSION['login'];
}else{
	header("Location: login.php");
        exit;
}
$dsh = 'mysql:dbname=banana;host=bananabase.cyfimjtmtifb.us-east-1.rds.amazonaws.com';
        $user = 'admin';
        $pass = 'Password';
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);

	$dbh = new PDO($dsh, $user, $pass, $options);

	$sql = 'select profile from user where name = :name';
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(':name' => $name));
	foreach($stmt as $banana){
		$profile = $banana['profile'];
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset=utf-8>
		<title>pofile変更</title>
	</head>
	<body>
	<form action="/setting.php" method="post" enctype="multipart/form-data">
	profile:<textarea name="profile" rows="5" cols="50" value="<?php echo $profile ?>"></textarea>
		icon:<input type="file" name="icon">
		<button>変更</button>
		</form>
	</body>
</html>
