<?php

//========================================================================================
//
// DB
//
// @author    Weaver (Fhizban)
// @copyright 2016+ www.critical-hit.biz
// @version   1.0
//
//========================================================================================

class db extends singleton {

	private $mysqli;
	
	//----------------------------------------------------------------------------------------
	// Constructor
	//----------------------------------------------------------------------------------------
	protected function __construct() {
		
		$this->mysqli = @ new mysqli (	CONF_DB_HOST,
										CONF_DB_USER,
										CONF_DB_PASS,
										CONF_DB_NAME,
										null,
										CONF_DB_SOCKET );
		
		if (mysqli_connect_errno()) {
            throw new Exception('Database error.');
        }
		
		$this->mysqli->select_db(CONF_DB_NAME);
        $this->mysqli->set_charset("utf8");
		
		$this->setTimezone();
	}
	
	//----------------------------------------------------------------------------------------
	// setTimezone
	// synchronize the mysql database timezone to the current php timezone
	//----------------------------------------------------------------------------------------
	private function setTimezone() {
		$now = new DateTime();
		$mins = $now->getOffset() / 60;
		$sgn = ($mins < 0 ? -1 : 1);
		$mins = abs($mins);
		$hrs = floor($mins / 60);
		$mins -= $hrs * 60;
		$offset = sprintf('%+d:%02d', $hrs*$sgn, $mins);
		self::executeQuery("SET time_zone = '$offset';");
	}

	//----------------------------------------------------------------------------------------
	// connection
	//----------------------------------------------------------------------------------------
	private function connection() {
		
		$this->mysqli = @ new mysqli (	CONF_DB_HOST,
										CONF_DB_USER,
										CONF_DB_PASS,
										CONF_DB_NAME,
										null,
										CONF_DB_SOCKET );
		
		if (mysqli_connect_errno()) {
            throw new Exception('Database error.');
        }
		
		$this->mysqli->select_db(CONF_DB_NAME);
        $this->mysqli->set_charset("utf8");
		
	}

	//----------------------------------------------------------------------------------------
	// executeQuery
	//----------------------------------------------------------------------------------------
	public static function executeQuery($query) {
		$sqlquery = NULL;
		if (!empty($query)) {
			$query = preg_replace("/<<([a-zA-Z0-9_\-]+)>>/", CONF_DB_PREFIX."_$1", $query);
			$sqlquery = self::$instance->mysqli->query($query);
			if (!$sqlquery) {
				echo "!!! Error on MySQL query: " . $query . " !!!";
			}
		}
		return $sqlquery;
	}

	//----------------------------------------------------------------------------------------
	// executeScalar
	//----------------------------------------------------------------------------------------
	public static function executeScalar($sqlquery) {
		$sqlresult = self::$instance->executeQuery($sqlquery);
		return self::$instance->mysqli->fetch_array($sqlresult);
	}

	//----------------------------------------------------------------------------------------
	// executeReader
	//----------------------------------------------------------------------------------------
	public static function executeReader($sqlquery) {
		$sqlresult = pip_db_query($sqlquery);
		for ($set = array (); $row = mysqli_fetch_array($sqlresult); $set[] = $row);
		return $set;
	}

}

//=====================================================================================EOF

?>