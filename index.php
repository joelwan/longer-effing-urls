<?php
include 'configuration.php';
include 'objects/class.database.php';
include 'objects/class.url.php';
include 'common/class.longer.php';
if (isset($_GET['key'])) {
	$key = $_GET['key'];
	$dbid = Longer::getIdFromHash($key);
	$url = new url();
	
	$url->Get($dbid);
	header("HTTP/1.1 301 Moved Permanently");
	header("Location:".$url->originalurl);
} else {
	header("Location:/index/");
}
?>
