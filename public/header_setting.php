<?php
        session_start();
        if($_SESSION['login'] != null){
                $name = $_SESSION['login'];
        }else{
                header('Location: /login.php');
                exit;
	}

	$dsh = 'mysql:dbname=banana;host=bananabase.cyfimjtmtifb.us-east-1.rds.amazonaws.com';
        $user = 'admin';
        $pass = 'Password';
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);

        $dbh = new PDO($dsh, $user, $pass, $options);

        $sql = 'select * from user where name = :name';
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':name' => $name));
        foreach($stmt as $user){
                $id = $user['id'];
	}

	$upfile = $_FILES['icon']['tmp_name'];
        $updir = './static/images/header';
        $type = NULL;

	if($upfile != NULL){
                if(exif_imagetype($upfile) != false){
			$type = $_FILES['icon']['type'];
			#var_dump($type);
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
	if($type != NULL){

                $imagename = 'h'.$id.$type;
                move_uploaded_file($upfile, "$updir/$imagename");
                $sql = "update user SET header =:header WHERE name =:name;";
                $stmt = $dbh->prepare($sql);
                $stmt->execute(array(':header' => $imagename, ':name' => $name));
	}else{
		header("Location: header.php");
		exit();
	}
	header("Location: read.php");
	exit();
?>
