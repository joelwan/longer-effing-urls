<?php
include '../configuration.php';
include '../objects/class.database.php';
include '../objects/class.url.php';
include '../common/class.longer.php';

$key = $_POST['key'];
$dbid = Longer::getIdFromHash($key);
$url = new url();
$url->Get($dbid);
$url->flagged = 1;
$url->Save();
?>