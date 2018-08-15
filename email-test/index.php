<?php 
	function random_password( $length = 8 ) {
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,?";
	    $password = substr( str_shuffle( $chars ), 0, $length );
	    return $password;
	}

	$new_pw = random_password(8);

	mail("if15b059@technikum-wien.at", 'Neues Passwort', $new_pw);
 ?>