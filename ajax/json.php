<?php
include '../configuration.php';
include '../objects/class.database.php';
include '../objects/class.url.php';
include '../common/class.longer.php';

$originUrl = $_POST['originalUrl'];
$longUrl = Longer::elongate($originUrl);
$urlObj = new url($originUrl);
$dbid = $urlObj->Save();
$key = Longer::generateHash($dbid);
$longUrl['hash'] = $key;
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
print(json_encode($longUrl));
?>