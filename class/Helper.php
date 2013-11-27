<?php
	class StringFormat
	{
		public static function ShortNumber($Number, $DecimalPlaces = false)
		{
			if ($DecimalPlaces === false)
			{
				$DecimalPlaces = 2;
			}
			
			$Number = floatval($Number);
			
			if ($Number > 1000000)
			{
				$Number = $Number / 1000000;
				$NumberString = number_format($Number, $DecimalPlaces) ."M";
			}
			elseif ($Number > 1000)
			{
				$Number = $Number / 1000;
				$NumberString = number_format($Number, $DecimalPlaces) ."K";
			}
			else
			{
				$NumberString = number_format($Number, $DecimalPlaces);
			}
			
			return $NumberString;
		}

		public static function Price($Number)
		{
			$Number = floatval($Number);
			
			$NumberString = "$". number_format($Number, 2);
			
			return $NumberString;
		}

		public static function Currency($Number)
		{
			$Number = floatval($Number);
			
			if ($Number > 999)
			{
				$Number = $Number / 1000;
				$NumberString = "$". number_format($Number, 2) ."K";
			}
			elseif ($Number > 99)
			{
				$NumberString = "$". number_format($Number, 0);
			}
			else
			{
				$NumberString = "$". number_format($Number, 2);
			}
			
			return $NumberString;
		}

		public static function Percent($Number)
		{
			$Number = floatval($Number);
			$Number = $Number * 100;
			
			if ($Number > 100)
			{
				$NumberString = number_format($Number, 0);
			}
			else
			{
				$NumberString = number_format($Number, 2);
			}
			
			return $NumberString;
		}
	}
?>