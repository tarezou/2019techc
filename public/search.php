<?php
	if($_POST['name'] != null){
		$name = '%'.$_POST['name'].'%';
	}else{
		
	}

	$dsh = 'mysql:dbname=banana;host=bananabase.cyfimjtmtifb.us-east-1.rds.amazonaws.com';
        $user = 'admin';
        $pass = 'Password';
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);

	$dbh = new PDO($dsh, $user, $pass, $options);

	$sql = 'select * from user where name like :name';
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(':name' => $name));

?>

<!DOCTYPE HTML>
<html>
<head>
	<title>ユーザー検索</title>
	<meta charset=utf-8>
</head>

<?php
	foreach($stmt as $banana){
		if($banana['icon'] != null){
			echo "<p><img src=static/images/icon/{$banana['icon']} height=30 width=30>  <a href=read.php?name={$banana['name']}>{$banana['name']}</a></p>";
		}else{
			echo "<p><a href=read.php?name={$banana['name']}>{$banana['name']}</a></p>";
		}
		echo "<p>{$banana['profile']}</p>";
		echo "<p>----------</p>";
	}
?>
