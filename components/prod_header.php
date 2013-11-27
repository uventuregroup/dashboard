<?php
	require_once("config.php");
	require_once("class/Api.php");
	require_once("class/Helper.php");

	$RequestURL = BASE_DOMAIN ."/api/product/filter:(product:(id=". $_GET['productID'] ."))";

	$Response = Api::Request($RequestURL);
	$ResponseXML = new SimpleXMLElement($Response);
	$ProductName = $ResponseXML->product->description;
	$ProductColour = $ResponseXML->product->colour;
	$ProductUPC = $ResponseXML->product->upc;
	$ProductPrice = StringFormat::Price($ResponseXML->product->price);
?>
<h2><span style="color: #1c89e3;"><?php echo $ProductName; ?> - <?php echo $ProductColour; ?></span>&nbsp;&nbsp;<span class="ui-span-font-xs">UPC: <?php echo $ProductUPC; ?></span>&nbsp;&nbsp;<span class="ui-span-font-xs"><?php echo $ProductPrice; ?></span></h2>