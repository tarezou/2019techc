<?php

	$dsh = 'mysql:dbname=banana;host=bananabase.cyfimjtmtifb.us-east-1.rds.amazonaws.com';
        $user = 'admin';
        $pass = 'Password';
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',);

        $dbh = new PDO($dsh, $user, $pass, $options);

        $sql = 'truncate table board';

        $stmt = $dbh->prepare($sql);
        $stmt->execute();

