<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
	<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/jquery.mobile.structure-1.1.1.min.css" /> 
	<link rel="stylesheet" href="css/jquery.mobile-1.1.1.min.css" />
	<link rel="stylesheet" href="css/icons.css" />
	<link rel="stylesheet" href="css/theme.css" />
  <script src="js/jquery-1.7.1.min.js"></script> 
  <script src="css/jquery.mobile-1.1.1.min.js"></script>
  <script src="js/jquery.validation.js"></script>
  <base href="http://www.uventuregroup.com/" />

  <title>Uh oh, there&rsquo;s a problem.</title>

	<script>
		$(document).ready(function(){
		  $("form").validate();
		});
	</script>

</head>
	
<body>

<div data-role="page">

	<div data-role="header">
		<h1>Sorry, there&rsquo;s a problem.</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<div><?php echo $_GET['ErrorMsg'] ?></div>
		<div>&nbsp;</div>
		<div>Please try again later.</div>
	</div><!-- /content -->
	
</div><!-- /page -->
		
</body>
	
</html>
