<?php
include '../configuration.php';
include '../objects/class.database.php';
include '../objects/class.url.php';
include '../common/class.longer.php';

$originUrl = $_POST['originalUrl'];
$longUrl = Longer::lengthen($originUrl);
$urlObj = new url($originUrl);
$dbid = $urlObj->Save();
$key = Longer::generateHash($dbid);

echo '<div class="actual" style="width:760px;margin-top:30px;padding-bottom:10px;"><label>Here\'s your long URL:</label> <input id="result" class="click_select" type="text" style="width:750px;" value="http://'.$configuration['server_host']."/".$key.'/'.$longUrl.'" />
<div id="report"><a href="http://'.$configuration['server_host']."/".$key.'/'.$longUrl.'" id="report-link">It didn\'t work? Report</a></div>
</div>';
?>