<?php

require_once("config.php");
require_once("Session.php");

class Logger
{
	protected static $MyLogger = NULL;
	
	private function __construct()
	{
	}

	private function __clone()
	{
	}

	public static function GetLogger()
	{
		if (!isset(self::$MyLogger))
		{
			self::$MyLogger = new Logger();
		}
		
		return self::$MyLogger;
	}

	public function WriteLog($Message, $UserID, $SessionID, $IPAddress, $AccessToken, $Page)
	{
		$MyDB = Session::GetSession()->GetDB();
		$stmt = $MyDB->prepare("insert into Log(Time, LogMessage, UserID, SessionID, IPAddress, AccessToken, Page) VALUES (?, ?, ?, ?, ?, ?, ?)");

		$Time = date('Y-m-d H:i:s');

		$stmt->bind_param('sssssss', $Time, $Message, $UserID, $SessionID, $IPAddress, $AccessToken, $Page);
		$stmt->execute();
		$stmt->close();
	}
	
	public function GetLogStrings($NumLogs = 30)
	{
		$MySession = Session::GetSession();
		$MyDB = $MySession->GetDB();

		$Result = $MyDB->query("SELECT Time, LogMessage, UserID FROM Log ORDER BY ID DESC");
		if ($NumLogs > $Result->num_rows)
		{
			$NumLogs = $Result->num_rows;
		}
		
		$LogArray = array();
		for ($RowNum = 0; $RowNum < $NumLogs; $RowNum++)
		{
			$Result->data_seek($RowNum);
			$Row = $Result->fetch_assoc();
			$LogArray[] = "(". $Row['Time'] .") '". $Row['LogMessage'] ."' UserID = ". $Row['UserID']; 
		}
		return $LogArray;
	}

	public function GetLogArray($NumLogs = 30)
	{
		$MySession = Session::GetSession();
		$MyDB = $MySession->GetDB();

		$Result = $MyDB->query("SELECT Time, LogMessage, UserID, SessionID, IPAddress, AccessToken, Page FROM Log ORDER BY ID DESC");
		if ($NumLogs > $Result->num_rows)
		{
			$NumLogs = $Result->num_rows;
		}
		
		$LogArray = array();
		for ($RowNum = 0; $RowNum < $NumLogs; $RowNum++)
		{
			$Result->data_seek($RowNum);
			$Row = $Result->fetch_assoc();
			$LogArray[] = $Row; 
		}
		return $LogArray;
	}
}

?>