<?php date_default_timezone_set('America/New_York'); ?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="apple-mobile-web-app-capable" content="yes">

  <title>Demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/uventuregroup.css" />
	<link rel="stylesheet" href="css/jquery.mobile.structure-1.3.2.min.css" />
	<link rel="stylesheet" href="css/theme-override.css" />
	<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
	<script src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript">
	$(document).bind("mobileinit", function () {
	    $.mobile.ajaxEnabled = false;
	});
	</script>
	<script src="js/jquery.mobile-1.3.2.min.js"></script>
</head>
	
<body>
	<div data-role="page" data-theme="a">

		<div data-role="content" data-theme="a">
			<div class="ui-grid-a">
				<div class="ui-block-a" style="width: 33%">
					<?php require_once("components/clock.php"); ?>
				</div>
				<div class="ui-block-b" style="width: 66%">
					<?php require_once("components/filters.php"); ?>
				</div>
			</div>
			<div class="ui-separator"></div>
			<div class="ui-grid-a">
				<div class="ui-block-a" style="width: 33%;">
					<?php require_once("components/transactions.php"); ?>					
				</div>
				<div class="ui-block-b" style="width: 66%">
					<?php require_once("components/top_trans.php"); ?>
				</div>
			</div>
			<div class="ui-separator"></div>
			<div class="ui-grid-a">
				<div class="ui-block-a" style="width: 33%;">
					<?php require_once("components/ave_baskets.php"); ?>					
				</div>
				<div class="ui-block-b" style="width: 66%">
					<?php require_once("components/top_addons.php"); ?>
				</div>
			</div>

	</div>

</body>
	
</html>
