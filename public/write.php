<?php

session_start();

if($_SESSION['login'] != NULL){
	$name = $_SESSION['login'];
}else{
	header("Location: login.php");
        exit;
}

if($_POST["comment"] != NULL){
	$comment = htmlspecialchars($_POST["comment"]);
}else{
	header("Location: post.php");
        exit;
}

	$dsh = 'mysql:dbname=banana;host=bananabase.cyfimjtmtifb.us-east-1.rds.amazonaws.com';
	$user = 'admin';
	$pass = 'Password';
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);

	$dbh = new PDO($dsh, $user, $pass, $options);

	$sql = 'select * from board';
	$stmt = $dbh->prepare($sql);
	$stmt->execute();
	foreach($stmt as $num){
		$number = $num['id'] + 1;
	}

	$upfile = $_FILES['image']['tmp_name'];
	$updir = './static/images';
	$type = NULL;



	if($upfile != NULL){
		if(exif_imagetype($upfile) != false){
			$type = $_FILES['image']['type'];
			switch($type){
				case 'image/jpeg':
					$type = '.jpeg';
					break;
				case 'image/png':
					$type = '.png';
					break;
				case 'image/bmp':
					$type = '.bmp';
					break;
				case 'image/svg+xml':
					$type = '.svg';
					break;
				case 'image/gif':
					$type = '.gif';
					break;
				default:
					$type = NULL;
			}
		}
	}
//	var_dump($upfile);
//	var_dump($updir);

	$date = date("Y/m/d/H/i/s");

	if($type != NULL){

		$size = getimagesize($upfile);

		$imagename = $number.$type;
		move_uploaded_file($upfile, "$updir/$imagename");
		$sql = "insert into board (body, name, image, date) value (:comment, :name, :image, :date)";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':comment' => $comment, ':name' => $name, ':image' => $number.$type, ':date' => $date));
	}else{


	$sql = 'insert into board (name, body, date) values (:name, :body, :date)';
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(':name' => $name, ':body' => $comment, ':date' => $date));
	}
	
		
	//$size = getimagesize($updir.'/'.$imagename);
	//var_dump($size);
	
	//$filesize = filesize($updir.'/'.$imagename);
	//var_dump($filesize);

	header("HTTP/1.1 303 See Other");
	header("Location: read.php");
	exit();

