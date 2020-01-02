<h2>Registrieren</h2>
<p>W&auml;hlen Sie einen Benutzernamen und ein Passwort, um sich f&uuml;r Beispiel zu registrieren.</p>

<form method="post" action="index.php?action=register">

	<label for="username">Benutzername:</label>
	<input type="text" name="ids_username" />
  
	<label for="email">E-Mail:</label>
	<input type="text" id="email" name="ids_email" />
   
	<label for="passwort1">Passwort:</label>
	<input type="password" name="ids_password" />
  
	<label for="passwort2">Passwort (Wiederholung):</label>
	<input type="password" name="ids_passwordrpt" />
  
	<input type="submit" value="Anmelden" name="action_submit" />

</form>