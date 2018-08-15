<?php 
	$user = $_SESSION['logged-in-user'];
	if(isset($_POST["submit_edit_profile"])){
		$vn = cleanParam($_POST["vorname"]);
		$nn = cleanParam($_POST["nachname"]);
		$password = cleanParam($_POST["password"]);
		$email = cleanParam($_POST["email"]);

		if ( $_FILES['file']['name']  != "" ){
		    $zugelassenedateitypen = array("image/png", "image/jpeg", "image/gif");	 
		    if (in_array( $_FILES['file']['type'] , $zugelassenedateitypen)){
		    	$ext = end(explode('.', $_FILES['file']['name']));
		    	$file = $user."_profilbild.".$ext;
		        move_uploaded_file($_FILES['file']['tmp_name'], "img/profilbilder/".$file);
		        
		        $image = WideImage::load("img/profilbilder/".$file);
		        $image = $image->resize(50, 50,'inside');
		        $image->saveToFile("img/profilbilder/".$file);

		        $_SESSION["profil_pic"] = $file;
		    }
		    $sql = "UPDATE `user` 
				SET vorname = '".$vn."', nachname = '".$nn."', email='".$email."',picture='".$file."'
				WHERE username = '".$user."'";
		} else {
			$sql = "UPDATE `user` 
				SET vorname = '".$vn."', nachname = '".$nn."', email='".$email."'
				WHERE username = '".$user."'";
		}

		mysqli_query($mysqli,$sql);
	}

	$sql = "SELECT * FROM `user`
		WHERE `username`='".$_SESSION["logged-in-user"]."'";
	$result = mysqli_query($mysqli,$sql);
	$row = mysqli_fetch_array($result);
?>

 <form action="index.php" enctype="multipart/form-data" method="post" class="edit-profile">
 	Benutzername: <?=$row["username"]?> <br>
	Vorname: <input type="text" value="<?=$row["vorname"]?>" name="vorname"> <br>
	Nachname: <input type="text" value="<?=$row["nachname"]?>" name="nachname"> <br>
	E-Mail: <input type="text" value="<?=$row["email"]?>" name="email"> <br>
	<img src="img/profilbilder/<?=$row["picture"]?>" alt=""> <br>
	Profilbild: <input type="file" name="file"> <br>	
	<input type="submit" value="Änderungen speichern" name="submit_edit_profile">	
 </form>