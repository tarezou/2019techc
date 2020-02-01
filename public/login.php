<?php
	session_start();
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
                	$sql = 'select * from user where name = :name';
	                $stmt = $dbh->prepare($sql);
        	        $banana = $stmt->execute(array(':name' => $name));
                	//var_dump($stmt);
                	//header('Location: http://3.80.153.205/login.php');
			//exit;
			foreach($stmt as $row){
				$pass = $row['password'];
			}
			$banana = password_verify($password, $pass);
			if($banana == true){
				$_SESSION['login'] = $name;
				header('Location: /read.php');
                		exit;
			}
			
		}
        }
?>

	<!DOCTYPE html>
        <html>
        <head>
                <meta charset="utf-8">
                <title>掲示板</title>
        </head>
        <body>
		<h1>login</h1>
		<?php
			if($banana === false){
				echo '<p>idもしくはpassが間違っています</p>';
			}
		?>
                <form method="POST" action="login.php">
                user_id:<input type="text" name="name"><br>
                password:<input type="text" name="password"><br>
		<input type="submit" value="login">
		</form>
		<p><a href="/read.php">戻る</a></p>
        </body>
</html>

