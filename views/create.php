<?php
include '../configuration.php';
include '../objects/class.database.php';
include '../objects/class.url.php';
include '../common/class.longer.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Longer  URLs</title>
		<script type='text/javascript' src='../js/jquery-1.4.2.min.js'></script>
		<script type='text/javascript' src='../js/longer.js'></script>
		<script type='text/javascript' src='../js/init.js'></script>
		<link rel='stylesheet' type='text/css' href='../css/style.css' />
		    	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-72762-9']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</head>
    <body>
    	<div id="wrapper">
	    	<div id="about">
	    		<h1><a href="http://longerurls.com">Longer  Urls</a></h1>
	    		<h2>Because longer is always better</h2>
	    	</div>
	    	<div id="longurl">
	    		<form>
	    			<!--<div class="pixel" style="width:600px;text-align:right"><pre><- estimated length increase -></pre></div>-->
		    		<div class="row">
		    			
		    			<div class="actual">
		    			<label>Lengthen this  URL:</label> <input id="originalUrl" name="originalUrl" type="text"></input>
		    			</div>
		    		</div>
		    		<div id="result"></div>
		    		
		    		<div id="action">
		    			<a id="submit" class="cta" href="">Make it  longer</a> <img id="loading" src="/images/ajax-loader.gif" />
		    		</div>
		    		
		    		<div id='test' style='position:absolute;left:-999999999px;color:#fff;font-family:georgia,"trebuchet ms",Tahoma,"Lucida Sans Unicode",Verdana,sans-serif;font-size:15px;'>
		    			
		    		</div>
		    	</form>
	    	</div>
	    	<div id="ads">
					    	<script type="text/javascript"><!--
				google_ad_client = "pub-7832108692498114";
				/* longurl */
				google_ad_slot = "4526014490";
				google_ad_width = 234;
				google_ad_height = 60;
				//-->
				</script>
				<script type="text/javascript"
				src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>
	    	</div>
	    	
	    	<div id="footer">
	    		<span class="creds">
	    			<p style="font-size: 20px; padding: 0px; margin: 0px;">Made by <a href="http://twitter.com/joelwan">Joel Wan</a> and <a href="http://twitter.com/flipnode">Flipnode</a></p>
	    			<a href="http://longerfuckingURLs.com">NSFW Version</a> | Inspired by <a href="http://whatthefuckshouldimakefordinner.com">this</a>, <a href="http://www.whatthefuckismysocialmediastrategy.com/">this</a> and <a href="http://goodfuckingdesignadvice.com">this</a>
	    		</span>
	    	</div>
    	</div>
	</body>
</html>