<?php
	if($_POST != null){
		$dsh = 'mysql:dbname=banana;host=bananabase.cyfimjtmtifb.us-east-1.rds.amazonaws.com';
	        $user = 'admin';
	        $pass = 'Password';
		$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);
		$dbh = new PDO($dsh, $user, $pass, $options);

		if($_POST['name'] != null && $_POST['password'] != null){
			$name = $_POST['name'];
			$password = $_POST['password'];
			//echo $name;
			//echo $password;
		}else{
			header('Location: /usersadd.php?input=false');
			exit();
		}

		$sql = "select name from user where name = :name";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':name' => $name));
		foreach($stmt as $row){
			header('Location: /usersadd.php?unique=false');
			exit;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);
		$sql = 'insert into user (name, password) values (:name, :password)';
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':name' => $name, ':password' => $password));

		//var_dump($stmt);
		header('Location: /login.php');
                exit();
	}
?>
	<!DOCTYPE html>
	<html>
        <head>
                <meta charset="utf-8">
                <title>掲示板</title>
        </head>
        <body>
		<h1>user登録</h1>
		<?php
		if($_GET['unique'] == 'false'){
			echo '<p>そのユーザーIDはもう使われています</p>';
		}
		if($_GET['input'] == 'false'){
			echo '<p>userID,passwordが入力されていません</p>';
		}
	
		?>
                <form method="POST" action="usersadd.php">
                user_id:<input type="text" name="name"><br>
                password:<input type="text" name="password"><br>
		<input type="submit" value="送信">
		</form>
		<p><a href="read.php">戻る</a></p>
        </body>
</html>

