<h2>Browsergame Framework</h2>
<h3>PHP, HTML5, CSS3, Ajax, mySQL, Mobile First, Web-Application</h3>

<br>

<h2>Login</h2>

<form method="post" action="index.php?action=login">

	<label for="username">Benutzername:</label>
	<input type="text" id="username" name="ids_username" />
	
	<label for="password">Passwort:</label>
	<input type="password" id="password" name="ids_password" />
	
	<input type="submit" value="Login" name="action_submit" />
	
</form>


<h2>Registrieren</h2>

<form method="post" action="index.php?action=register">

	<label for="username">Benutzername:</label>
	<input type="text" name="ids_username" />

	<label for="email">E-Mail:</label>
	<input type="email" name="ids_email" />

	<label for="passwort1">Passwort:</label>
	<input type="password" name="ids_password" />

	<label for="passwort2">Passwort (Wiederholung):</label>
	<input type="password" name="ids_passwordrpt" />

	<input type="submit" value="Anmelden" name="action_submit" />

</form>