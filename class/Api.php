<?php

class Api
{
	public static function Request($URL, $PostData = NULL)
	{
		if ($PostData == NULL)
		{
			// Execute as Get request
			$ch = curl_init($URL);
			curl_setopt($ch, CURLOPT_POST, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
			$response = curl_exec($ch);

			curl_close($ch);
		}
		else
		{
			// Execute as Post request
			$ch = curl_init($URL);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
	
			curl_close($ch);
		}
		
		return $response;
	}
}

?>