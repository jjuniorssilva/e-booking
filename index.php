<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Login</title>
</head>
<body>
	<div id="logo_login"><img src="imagens/logo.png"></div>
	<div id="corpologin">
		<form method="post" action="usuarios/validacoes/validar_login.php">
			<input type="text" name="usuario" placeholder="Login">
			<br>
			<br>
			<input type="password" name="senha" placeholder="Senha">
			<br>
			<br>
			<br>
			<input type="submit" value="Login">	
		</form>
	</div>	
</body>
</html>