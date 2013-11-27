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

	$RequestURL = BASE_DOMAIN ."/api/trans_avg/result:(sales),filter:(";
	if (isset($_GET['storeID']))
	{
		if ($_GET['storeID'] !== "all")
		{
			$RequestURL .= "store:(id=". $_GET['storeID'] .")";
		}
	}
	$RequestURL .= ",time:(". $Time ."))";

	$Response = Api::Request($RequestURL);
	$ResponseXML = new SimpleXMLElement($Response);
	$TWBasket = $ResponseXML->dollars;
	$Basket = StringFormat::Currency($TWBasket);

	if ($Time == "last30")
	{
		$RequestURL = BASE_DOMAIN ."/api/trans_avg/result:(sales),filter:(";
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
		$LWBasket = $ResponseXML->dollars;
		$ChgBasket = StringFormat::Percent(($TWBasket - $LWBasket) / $LWBasket);
	
		if (floatval($TWBasket) > floatval($LWBasket))
		{
			$ChgColor = "#7FC63F";
		}
		else
		{
			$ChgColor = "#C0504D";
		}
	}
?>

<div class="ui-span-font-xs">AVERAGE BASKET BY SALES</div>
<div style="display: table; overflow: hidden;">
	<div style="display: table-cell; vertical-align: bottom;">
		<div><span class="ui-span-font-xxl" style="color: #1c89e3;"><?php echo $Basket; ?></span></div>
		<?php	if ($Time == "last30") { ?>
		<span class="ui-span-font-xl" style="color: <?php echo $ChgColor; ?>;"><?php echo $ChgBasket; ?></span><span class="ui-span-font-l" style="color: <?php echo $ChgColor; ?>;">% </span>
		<span class="ui-span-font-s" style="color: <?php echo $ChgColor; ?>;">VS LM</span>
		<?php	} ?>
		<div class="ui-separator"></div>
	</div>
</div>