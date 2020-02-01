<?php
	session_start();
	$dsh = 'mysql:dbname=banana;host=bananabase.cyfimjtmtifb.us-east-1.rds.amazonaws.com';
        $user = 'admin';
        $pass = 'Password';
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);

	$dbh = new PDO($dsh, $user, $pass, $options);
	
	$icon = '';
	if($_SESSION['login'] != null){
		$login = $_SESSION['login'];

		$sql = 'select * from user where name = :name';
       		$user = $dbh->prepare($sql);
		$user->execute(array(':name' => $login));
	}else{
		$login = null;
	}
	if($_GET['name'] != null){
		$name = $_GET['name'];
	}else{
		$name = $login;
	}

	$sql = 'select board.* ,user.icon, user.profile, user.header from board inner join user ON board.name = user.name where board.name = :name';
        $board = $dbh->prepare($sql);
	$board->execute(array(':name' => $name));
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset=utf-8>
		<title>掲示板</title>
		<link rel='stylesheet' type='text/css' href='/static/css/style.css'>
	</head>
	<body>
		<ul id ="header">
		<li>
			<form action="search.php" method="post">
			user検索<input type="text" name="name">
			<button>検索</button>
			</form>
		</li>
		<?php
		if($login == null){
			echo '<li><a href=login.php>ログイン</a></li>';
			echo '<li><a href=usersadd.php>新規登録</a></li>';
			echo '</ul>';
		}else{
			foreach($user as $banana){
				echo "<li><img src =/static/images/icon/{$banana['icon']} height=30 wigth=30> {$banana['name']}さん</li>";
				echo "<li><a href=profile.php>profileの変更</a></li>";
				echo "<li><a href=header.php>header画像の変更</a></li>";
				echo "<li><a href=logout.php>ログアウト</a></li>";
				echo "<li><a href=post.php>新しい投稿</a></li>";
				echo "</ul>";
			}
		}
	$count = 0;
	foreach($board as $banana){
		if($count == 0){
			echo "<div id=profile>";
			echo "<p>profile:{$banana['profile']}</p>";
			echo "<img id =pro src=/static/images/header/{$banana['header']}>";
			echo "</div>";
			$count = 1;
		}
		echo "<p><img src =/static/images/icon/{$banana['icon']} height=30 wigth=30><a href=read.php?name={$banana['name']}>{$banana['name']}</a>{$banana['date']}</p>";
		echo "<p>{$banana['body']}</p>";
		if($banana['image'] != null){
			echo "<img src=static/images/{$banana['image']} height=100px>";
	}
}
?>

	</body>
</html>

