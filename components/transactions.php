<?php
	require_once("config.php");
	require_once("class/Api.php");
	require_once("class/Helper.php");

	if (isset($_GET['time']))
	{
		$Time = $_GET['time'];
	}
	else
	{
		$Time = "last30";
	}

	$RequestURL = BASE_DOMAIN ."/api/trans_sum/result:(transactions),filter:(";
	if (isset($_GET['storeID']))
	{
		if ($_GET['storeID'] !== "all")
		{
			$RequestURL .= "store:(id=". $_GET['storeID'] ."),";
		}
	}
	$RequestURL .= "time:(". $Time .")";

	if (isset($_GET['productID']))
	{
		$RequestURL .= ",product:(id=". $_GET['productID'] .")";
	}
	$RequestURL .= ")";

	$Response = Api::Request($RequestURL);
	$ResponseXML = new SimpleXMLElement($Response);
	$TWTransactions = $ResponseXML->transactions;
	$Transactions = StringFormat::ShortNumber($TWTransactions);

	if ($Time == "last30")
	{
		$RequestURL = BASE_DOMAIN ."/api/trans_sum/result:(transactions),filter:(";
		if (isset($_GET['storeID']))
		{
			if ($_GET['storeID'] !== "all")
			{
				$RequestURL .= "store:(id=". $_GET['storeID'] .")";
			}
		}
		$RequestURL .= ",time:(l". $Time ."))";

		$Response = Api::Request($RequestURL);
		$ResponseXML = new SimpleXMLElement($Response);
		$LWTransactions = $ResponseXML->transactions;
	
		$ChgTransactions = StringFormat::Percent(($TWTransactions - $LWTransactions) / $LWTransactions);
		
		if (floatval($TWTransactions) > floatval($LWTransactions))
		{
			$ChgColor = "#589E19";
		}
		else
		{
			$ChgColor = "#C0504D";
		}
	}
?>

<div class="ui-span-font-xs">TRANSACTIONS</div>
<div style="display: table; overflow: hidden;">
	<div style="display: table-cell; vertical-align: bottom;">
		<div><span class="ui-span-font-xxl" style="color: #1c89e3;"><?php echo $Transactions; ?></span></div>
		<?php	if ($Time == "last30") { ?>
		<span class="ui-span-font-xl" style="color: <?php echo $ChgColor; ?>;"><?php echo $ChgTransactions?></span><span class="ui-span-font-l" style="color: <?php echo $ChgColor; ?>;">% </span>
		<span class="ui-span-font-s" style="color: <?php echo $ChgColor; ?>;">VS LM</span>
		<?php	} ?>
		<div class="ui-separator"></div>
	</div>
</div>