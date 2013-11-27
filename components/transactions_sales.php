<?php
	require_once("config.php");
	require_once("class/Api.php");
	require_once("class/Helper.php");

	$RequestURL = BASE_DOMAIN ."/api/trans_sum/result:(transactions,sales),filter:(";
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
	if (isset($_GET['productID']))
	{
		$RequestURL .= ",product:(id=". $_GET['productID'] .")";
	}
	$RequestURL .= ")";

	$Response = Api::Request($RequestURL);
	$ResponseXML = new SimpleXMLElement($Response);
	$Transactions = StringFormat::ShortNumber($ResponseXML->transactions, 0);
	$Sales = StringFormat::Currency($ResponseXML->dollars);

?>

<div class="ui-span-font-xs">TRANSACTIONS</div>
<div style="display: table; overflow: hidden;">
	<div style="display: table-cell; vertical-align: bottom;">
		<div><span class="ui-span-font-xxl" style="color: #1c89e3;"><?php echo $Transactions; ?></span></div>
		<div class="ui-separator"></div>
	</div>
</div>

<div class="ui-span-font-xs">SALES</div>
<div style="display: table; overflow: hidden;">
	<div style="display: table-cell; vertical-align: bottom;">
		<div><span class="ui-span-font-xl" style="color: #1c89e3;"><?php echo $Sales; ?></span></div>
		<div class="ui-separator"></div>
	</div>
</div>