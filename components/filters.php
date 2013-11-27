<?php
	if (isset($_GET['time']))
	{
		$TimeParm = $_GET['time'];
	}
	else
	{
		$TimeParm = "last30";
	}
	if ($TimeParm == "last30") { $TimeSelection = "LAST 30 DAYS"; }
	elseif ($TimeParm == "wtd") { $TimeSelection = "WEEK TO DATE"; }
	elseif ($TimeParm == "mtd") { $TimeSelection = "MONTH TO DATE"; }
	elseif ($TimeParm == "ytd") { $TimeSelection = "YEAR TO DATE"; }

	if (isset($_GET['storeID']))
	{
		$StoreParm = $_GET['storeID'];
	}
	else
	{
		$StoreParm = "all";
	}
	if ($StoreParm == "all") { $StoreSelection = "ALL STORES"; }
	elseif ($StoreParm == "1") { $StoreSelection = "QUEBEC CITY"; }
	elseif ($StoreParm == "2") { $StoreSelection = "MONTREAL"; }
	elseif ($StoreParm == "3") { $StoreSelection = "TORONTO (DOWNTOWN)"; }
	elseif ($StoreParm == "4") { $StoreSelection = "TORONTO (NORTH)"; }
	elseif ($StoreParm == "5") { $StoreSelection = "TORONTO (WEST)"; }
	elseif ($StoreParm == "6") { $StoreSelection = "OTTAWA"; }
	elseif ($StoreParm == "7") { $StoreSelection = "CALGARY"; }
	elseif ($StoreParm == "8") { $StoreSelection = "EDMONTON"; }
	elseif ($StoreParm == "9") { $StoreSelection = "VANCOUVER"; }
	
?>

<script type="text/javascript">
	function GetTimePeriodSelection()
	{
		var e = document.getElementById("select-time-period");
		return e.options[e.selectedIndex].value;
	}

	function GetStoreSelection()
	{
		var e = document.getElementById("select-stores");
		return e.options[e.selectedIndex].value;
	}

	function RedirectReload()
	{
		var RedirectURL = "<?php echo $_SERVER['PHP_SELF']; ?>?time=" + GetTimePeriodSelection() + "&storeID=" + GetStoreSelection();
		<?php
			if (isset($_GET['productID']))
			{
				echo 'RedirectURL = RedirectURL + "&productID='. $_GET['productID'] .'";';
			}
		?>
		window.location = RedirectURL;
	}
</script>

<form>
	<div data-role="collapsible-set" data-theme="c" data-content-theme="c" data-iconpos="right">
		<div data-role="collapsible">
			<h3>Filters: <span class="ui-span-font-xxs"><?php echo $TimeSelection; ?>, <?php echo $StoreSelection; ?></span></h3>
			<div style="display: table;">
				<div style="display: table-row;">
					<div style="display: table-cell; width: 150px;">
		    		<label for="select-time-period" class="select">TIME PERIOD</label>
		    	</div>
					<div style="display: table-cell;">
				    <select name="select-stores" data-mini="true" data-theme="a" id="select-time-period" onchange="RedirectReload()">
				        <option value="last30" <?php if ($TimeParm == "last30") { echo "selected='selected'"; } ?>>LAST 30 DAYS</option>
				        <option value="wtd" <?php if ($TimeParm == "wtd") { echo "selected='selected'"; } ?>>WEEK TO DATE</option>
				        <option value="mtd" <?php if ($TimeParm == "mtd") { echo "selected='selected'"; } ?>>MONTH TO DATE</option>
				        <option value="ytd" <?php if ($TimeParm == "ytd") { echo "selected='selected'"; } ?>>YEAR TO DATE</option>
				    </select>
		    	</div>
	    	</div>
				<div style="display: table-row;">
					<div style="display: table-cell;">
				    <label for="select-stores" class="select">STORES</label>
				  </div>
					<div style="display: table-cell;">
				    <select name="select-stores" data-mini="true" data-theme="a" id="select-stores" onChange='RedirectReload()'>
				        <option value="all" <?php if ($StoreParm == "all") { echo "selected='selected'"; } ?>>ALL STORES</option>
				        <option value="7" <?php if ($StoreParm == "7") { echo "selected='selected'"; } ?>>CALGARY</option>
				        <option value="8" <?php if ($StoreParm == "8") { echo "selected='selected'"; } ?>>EDMONTON</option>
				        <option value="2" <?php if ($StoreParm == "2") { echo "selected='selected'"; } ?>>MONTREAL</option>
				        <option value="6" <?php if ($StoreParm == "6") { echo "selected='selected'"; } ?>>OTTAWA</option>
				        <option value="1" <?php if ($StoreParm == "1") { echo "selected='selected'"; } ?>>QUEBEC CITY</option>
				        <option value="3" <?php if ($StoreParm == "3") { echo "selected='selected'"; } ?>>TORONTO (DOWNTOWN)</option>
				        <option value="4" <?php if ($StoreParm == "4") { echo "selected='selected'"; } ?>>TORONTO (NORTH)</option>
				        <option value="5" <?php if ($StoreParm == "5") { echo "selected='selected'"; } ?>>TORONTO (WEST)</option>
				        <option value="9" <?php if ($StoreParm == "9") { echo "selected='selected'"; } ?>>VANCOUVER</option>
				    </select>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>