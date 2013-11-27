<?php
	require_once("config.php");
	require_once("class/Api.php");
	require_once("class/Helper.php");

	$RequestURL = BASE_DOMAIN ."/api/top_trans/filter:(";
	if (isset($_GET['storeID']))
	{
		if ($_GET['storeID'] !== "all")
		{
			$RequestURL .= "store:(id=". $_GET['storeID'] ."),";
		}
	}
	if (isset($_GET['time']))
	{
		$RequestURL .= "time:(". $_GET['time'] .")";
	}
	else
	{
		$RequestURL .= "time:(last30)";
	}
	$RequestURL .= ",range:(1,3))";

	$Response = Api::Request($RequestURL);
	$ResponseXML = new SimpleXMLElement($Response);
?>

<div class="ui-span-font-xs">TOP TRANSACTING PRODUCTS</div>
<ol data-role="listview" data-inset="true">
	<?php $ProductNum = 0; foreach ($ResponseXML->product as $NextProduct) { $ProductNum++; ?>
		<?php $ProductDesc = $NextProduct->description; ?>
		<?php if (isset($NextProduct->colour)) { $ProductDesc .= " - ". $NextProduct->colour; } ?>
		<?php if (isset($NextProduct->price)) { $ProductDesc .= "&nbsp;&nbsp;$". $NextProduct->price; } ?>
		<li><a href="<?php echo "product-dashboard.php?productID=". $NextProduct->id; ?>"><h2><?php echo $ProductDesc; ?></h2> <span class="ui-li-count"><?php echo $NextProduct->transactions ." transactions"; ?></span></a></li>
	<?php } ?>
</ol>
