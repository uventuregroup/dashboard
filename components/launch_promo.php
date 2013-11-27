<?php
	require_once("config.php");
	require_once("class/Api.php");
	require_once("class/Helper.php");
	
	$RequestURL = BASE_DOMAIN ."/api/top_addons/filter:(";
	if (isset($_GET['storeID']))
	{
		if ($_GET['storeID'] !== "all")
		{
			$RequestURL .= "store:(id=". $_GET['storeID'] ."),";
		}
	}
	if (isset($_GET['productID']))
	{
		$RequestURL .= "product:(id=". $_GET['productID'] .")";
	}
	if (isset($_GET['time']))
	{
		$RequestURL .= "time:(". $_GET['time'] .")";
	}
	else
	{
		$RequestURL .= ",time:(last30)";
	}
	$RequestURL .= ",range:(1,3))";

	$Response = Api::Request($RequestURL);
	$ResponseXML = new SimpleXMLElement($Response);
?>

<div class="ui-span-font-xs">LAUNCH PROMOTION</div>
<ul data-role="listview" style="width:80%" data-inset="true">
	<?php $ProductNum = 0; foreach ($ResponseXML->product as $NextProduct) { $ProductNum++; ?>
		<?php $ProductDesc = $NextProduct->description; ?>
		<?php if (isset($NextProduct->colour)) { $ProductDesc .= " - ". $NextProduct->colour; } ?>
		<li data-theme="a" data-icon="plus" data-iconpos="left"><a href="#">20% off with<br /><span class="ui-span-font-xxs"><?php echo $ProductDesc; ?></span></a></li>
	<?php } ?>
	<li data-theme="a" data-icon="plus" data-iconpos="left"><a href="#"><h2>Create custom promotion</h2></a></li>
</ul>
