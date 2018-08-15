<div class="login-overlay">
	<a href="#" class="show-login">Einloggen</a>
	<a href="#" class="show-register">Registrieren</a>
	<a href="#" class="show-password">Passwort vergessen?</a>
	<form action="index.php" method="post" class="login-form">
		Benutzername: <br> <input type="text" name="benutzername"> <br>
		Passwort: <br> <input type="password" name="password">
		<input type="checkbox" name="stay-logged-in" id="checkbox"> <label for="checkbox">angemeldet bleiben!</label> <br>
		<input type="submit" value="Einloggen!" name="submit">			
	</form>

	<form action="index.php" method="post" class="register-form" enctype="multipart/form-data">
		Vorname: <br> <input type="text" name="vorname"> <br>
		Nachname: <br> <input type="text" name="nachname"> <br>		
		Benutzername: <br> <input type="text" name="benutzername"> <br>
		Passwort: <br> <input type="password" name="password">
		E-mail: <br> <input type="text" name="email"> <br>	
		Profilbild: <br> <input type="file" name="file">	
		<input type="submit" value="Registrieren!" name="submit_register">
	</form>

	<form action="index.php" method="post" class="password-form" enctype="multipart/form-data">
		Vorname: <br> <input type="text" name="vorname"> <br>
		Nachname: <br> <input type="text" name="nachname"> <br>		
		Benutzername: <br> <input type="text" name="benutzername"> <br>	
		<input type="submit" value="Neues Passwort!" name="submit_password">
	</form>
</div>	
<?php 
	if ($_SESSION["logged-in-user"] == true){
		echo "<script>alert('Falsche Login Daten!')</script>";
	}
?>