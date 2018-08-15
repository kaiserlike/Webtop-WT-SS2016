<?php 

	session_start();
	$mysqli = NULL;
	
	function authenticateuser($usr, $password_eingabe){
		$ldapserver = "ldap.technikum-wien.at";
		$searchbase = "dc=technikum-wien,dc=at";

	 	$ldap = ldap_connect($ldapserver);

		if ($ldap){
			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

			$dn = "uid=$usr,ou=People,$searchbase";
			$remote = @ldap_bind($ldap, $dn, $password_eingabe);
			
			if($remote) {
				$filter = "(&(uid=".$usr.")(objectClass=posixAccount))";
				$search = ldap_search($ldap, $searchbase, $filter);
				$result = ldap_get_entries($ldap, $search);
					
				@ldap_close($ldap);
					
				$vorname = $result[0]['givenname'][0];
				$nachname = $result[0]['sn'][0];
				$email = $result[0]['mail'][0];
				$_SESSION["logged-in-user"] = $usr;
				if($_POST['stay-logged-in' == true]) {
					setcookie("username",$user_eingabe,time()+600); // für 10 minuten automatisch eingeloggt bleiben
				}				
				return 0;
			}
		}

		//ldap didnt work/didnt found user, check in db
		$md5_pwd = md5($password_eingabe);
		global $mysqli;
		$sql = "SELECT * FROM user where 
				`username` ='".$usr."'
				and `pwd` = '".$md5_pwd."'";
		$result = $mysqli->query($sql);
		$row = $result->fetch_assoc();

		// echo $result['username'];

		if($result->num_rows > 0){
			$_SESSION["logged-in-user"] = $row["username"];
			if($row["picture"] != NULL) $_SESSION["profil_pic"] = $row["picture"];
			if($_POST['stay-logged-in' == true]) {
				setcookie("username",$user_eingabe,time()+600); // für 10 minuten automatisch eingeloggt bleiben				
			}
		} else {
			$_SESSION["logged-in-user"] = "false";
		}

	} 

	function connectDB() {
		global $mysqli;
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "sem2_wt";
		$mysqli = new mysqli($servername, $username, $password, $dbname);

		// Create connection
		$mysqli = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($mysqli->connect_error) {
		    die("Connection failed: ".$mysqli->connect_error);
		}

		if (!$mysqli->set_charset("utf8")) {
		  err_handle("db error({$mysqli->errno}).");
		}
	}	

	function random_password( $length = 8 ) {
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,?";
	    $password = substr( str_shuffle( $chars ), 0, $length );
	    return $password;
	}

	// Parameter säubern
	function cleanParam($string) {
		return trim(addslashes(stripslashes($string)));
	}	
	connectDB();
 ?>