<?php

session_start();
if($_SESSION['login'] !== null){
	session_destroy();
}

header("Location: read.php");
exit();
