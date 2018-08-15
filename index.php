<?php
	include("common.inc.php");
	include("lib_wideimg/WideImage.php");
	$title = "Startseite";

	if(isset($_POST['submit'])){
		authenticateuser(cleanParam($_POST["benutzername"]), cleanParam($_POST["password"]));
	}
	if($_SESSION["logged-in-user"] != false){
		if(isset($_GET["i"])){
			$_SESSION["open-window"] = $_GET["i"];
		}
	}

	if(isset($_POST["submit_register"])){
		$file = NULL;
		$vn = cleanParam($_POST["vorname"]);
		$nn = cleanParam($_POST["nachname"]);
		$user = cleanParam($_POST["benutzername"]);
		$password = cleanParam($_POST["password"]);
		$email = cleanParam($_POST["email"]);
		
		if($vn != "" && $nn != "" && $user != "" && $password != "" && $email != ""){

			if ( $_FILES['file']['name']  != "" ){
			    $zugelassenedateitypen = array("image/png", "image/jpeg", "image/gif");	 
			    if (in_array( $_FILES['file']['type'] , $zugelassenedateitypen)){
			    	$ext = end(explode('.', $_FILES['file']['name']));
			    	$file = $user. "_profilbild.".$ext;
			        move_uploaded_file($_FILES['file']['tmp_name'], "img/profilbilder/".$file);
			        
			        $image = WideImage::load("img/profilbilder/".$file);
			        $image = $image->resize(50, 50,'inside');
			        $image->saveToFile("img/profilbilder/".$file);
			    }		    
			}

			$sql = "INSERT INTO `user` (vorname,nachname,username,pwd,email,picture)
					VALUES ('".$vn."','".$nn."','".$user."','".md5($password)."','".$email."','".$file."')";
			$mysqli->query($sql);
			unset($_SESSION["logged-in-user"]);
		}
	}

	if(isset($_POST["submit_password"])){
		$vn = cleanParam($_POST["vorname"]);
		$nn = cleanParam($_POST["nachname"]);
		$user = cleanParam($_POST["benutzername"]);

		$sql = "SELECT * FROM `user`
			WHERE 
			`username`='".$user."' AND
			`vorname`='".$vn."' AND
			`nachname`='".$nn."'";
		$result = mysqli_query($mysqli,$sql);
		if($result->num_rows > 0){ 
			$row = $result->fetch_assoc();						
			$new_pw = random_password(8);
			
			mail($row["email"], 'Neues Passwort', $new_pw);

			$sql = "UPDATE `user` 
				SET pwd = '".md5($new_pw)."'
				WHERE username = '".$user."'";
			mysqli_query($mysqli,$sql);

		?>
			<script>alert("Neues Passwort(<?php echo $new_pw ?>) zugeschickt!")</script>
		<?php } else { ?>
			<script>alert("Falsche Eingabe, Passwort konnte nicht generiert werden!")</script>
		<?php }
	}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<?php include("html.head.inc.php") ?>
</head>
<body>	
	<div class="background-image"></div>

	<div class="main">
		<?php 
		$_SESSION["logged-in-user"] = "admin";
			if( ($_SESSION["logged-in-user"] != "false" && isset($_SESSION["logged-in-user"])) || isset($_COOKIE["username"]) ){
				include("webtop.inc.php");		
			} else {
				include("login-form.inc.php");
			}
		 ?>	 
	</div>
	
	
</body>
</html>
