<?php

	$dsh = "mysql:dbname=banana;host=bananabase.cyfimjtmtifb.us-east-1.rds.amazonaws.com";
	$user = 'admin';
	$pass = 'Password';

	$dbh = new PDO($dsh, $user, $pass);

	$sql = 'CREATE TABLE follow(id int auto increment primary key,name int, follow int)';

	$stmt = $dbh->prepare($sql);


