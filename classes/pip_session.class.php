<?php

	//========================================================================================
	//
	// SESSION
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//========================================================================================
	
	class pip_session {
	
		// ----------------------------------------------------------------------------------------
		// constructor
		// ----------------------------------------------------------------------------------------
		public function __construct() {
			$this->sessionStart(CONF_DB_PREFIX, CONF_SYS_SESSION_LIFETIME + time(), '/', CONF_SYS_URL);
		}

		// ----------------------------------------------------------------------------------------
		// sessionStart
		// This function starts, validates and secures a session.
		//
		// @param string $name The name of the session.
		// @param int $limit Expiration date of the session cookie, 0 for session only
		// @param string $path Used to restrict where the browser sends the cookie
		// @param string $domain Used to allow subdomains access to the cookie
		// @param bool $secure If true the browser only sends the cookie over https
		// ----------------------------------------------------------------------------------------
		public static function sessionStart($name, $limit = 0, $path = '/', $domain = null, $secure = null) {

			session_name($name . '_Session');
			$https = isset($secure) ? $secure : isset($_SERVER['HTTPS']);
			session_set_cookie_params($limit, $path, $domain, $https, true);
			session_start();

			if (self::validateSession()) {
				if (!self::preventHijacking()) {

					$_SESSION = array();
					$_SESSION['IPaddress'] = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
					$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
					self::regenerateSession();

					// Give a 5% chance of the session id changing on any request

				} elseif (rand(1, 100) <= 5) {
					self::regenerateSession();
				}
			} else {
				$_SESSION = array();
				session_destroy();
				session_start();
			}

			// -- 
			if (!isset($_SESSION['id'])) {
				if (isset($_COOKIE['id']) && isset($_COOKIE['username'])) {
			  		$_SESSION['id'] = $_COOKIE['id'];
			 		$_SESSION['username'] = $_COOKIE['username'];
				}
		  	}
  
		}

		// ----------------------------------------------------------------------------------------
		// regenerateSession
		// This function regenerates a new ID and invalidates the old session.
		// This should be called whenever permission levels for a user change.
		// ----------------------------------------------------------------------------------------
		public static function regenerateSession() {

			// If this session is obsolete it means there already is a new id

			if (isset($_SESSION['OBSOLETE']) || (isset($_SESSION['OBSOLETE']) && $_SESSION['OBSOLETE'] == true)) {
				return;
			}

			// Set current session to expire in 10 seconds

			$_SESSION['OBSOLETE'] = true;
			$_SESSION['EXPIRES'] = time() + 10;

			// Create new session without destroying the old one

			session_regenerate_id(false);

			// Grab current session ID and close both sessions to allow other scripts to use them

			$newSession = session_id();
			session_write_close();

			// Set session ID to the new one, and start it back up again

			session_id($newSession);
			session_start();

			// Now we unset the obsolete and expiration values for the session we want to keep

			unset($_SESSION['OBSOLETE']);
			unset($_SESSION['EXPIRES']);
		}

		// ----------------------------------------------------------------------------------------
		// validateSession
		// This function is used to see if a session has expired or not.
		// @return bool
		// ----------------------------------------------------------------------------------------
		protected static function validateSession() {
			if (isset($_SESSION['OBSOLETE']) && !isset($_SESSION['EXPIRES'])) {
				return false;
			}
			if (isset($_SESSION['EXPIRES']) && $_SESSION['EXPIRES'] < time()) {
				return false;
			}
			return true;
		}

		// ----------------------------------------------------------------------------------------
		// preventHijacking
		// This function checks to make sure a session exists and is coming from the proper host.
		// On new visits and hacking attempts this function will return false.
		// @return bool
		// ----------------------------------------------------------------------------------------
		protected static function preventHijacking() {
			if (!isset($_SESSION['IPaddress']) || !isset($_SESSION['userAgent'])) {
				return false;
			}
			if ($_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'] && !(strpos($_SESSION['userAgent'], 'Trident') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)) {
				return false;
			}

			$sessionIpSegment = substr($_SESSION['IPaddress'], 0, 7);
			$remoteIpHeader = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
			$remoteIpSegment = substr($remoteIpHeader, 0, 7);
			if ($_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']) {
				return false;
			}
			return true;
		}
	
	}

// =====================================================================================EOF