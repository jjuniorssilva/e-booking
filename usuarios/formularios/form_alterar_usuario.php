<?php
include "../../Verificasessao.php";
include "../../Verificasessao.php";
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$date = date('d-m-Y');
if (!empty($_POST['alterarAtivo'])) {
	$_SESSION['$linha_alterar'] = $_POST['alterarAtivo'];
	$linha = $_SESSION['$linha_alterar'];
	$alterar=$_SESSION['$usuariosAtivos'];
	$_SESSION['login_alterar']=$_SESSION['$usuariosAtivos'][$linha][1];
}
if (!empty($_POST['alterarbuscaAtivo'])) {
	$_SESSION['$linha_alterar'] = $_POST['alterarbuscaAtivo'];
	$linha = $_SESSION['$linha_alterar'];
	$alterar=$_SESSION['$buscausuariosAtivos'];
	$_SESSION['login_alterar']=$_SESSION['$buscausuariosAtivos'][$linha][1];
}
if (!empty($_POST['alterarInativo'])) {
	$_SESSION['$linha_alterar'] = $_POST['alterarInativo'];
	$linha = $_SESSION['$linha_alterar'];
	$alterar=$_SESSION['$usuariosInativos'];
	$_SESSION['login_alterar']=$_SESSION['$usuariosInativos'][$linha][1];
}
if (!empty($_POST['alterarbuscaInativo'])) {
	$_SESSION['$linha_alterar'] = $_POST['alterarbuscaInativo'];
	$linha = $_SESSION['$linha_alterar'];
	$alterar=$_SESSION['$buscausuariosInativos'];
	$_SESSION['login_alterar']=$_SESSION['$buscausuariosInativos'][$linha][1];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ALTERAR USUÁRIO</title>
	</head>
	<body>
		<table>
			<tr>
				<td> <?php echo "Seja bem vindo(a)! ".$_SESSION['nome_usuario']; ?></td>
				<td> <?php echo $date; ?> </td> 
				<td> <a href="../../inicio.php">Página Inicial</a></td>
				<td> <a href="../../sair.php">SAIR</a></td>
			</tr>
		</table>
		<a href="javascript:history.back()">VOLTAR</a>
		<form method="post" action="../validacoes/validar_alteracao_usuario.php">
			Nome:<input type="text" name="nome" value=<?php echo $alterar[$linha][0]; ?> required><br>
			Usuário:<input type="text" name="login" value=<?php echo $alterar[$linha][1]; ?> readonly="readonly"><br>
			Data Cadastro:<input type="text" name="data" value=<?php echo $alterar[$linha][2]; ?> readonly="readonly"><br>
			Usuário que cadastrou:<input type="text" name="nivel" value=<?php echo $alterar[$linha][3]; ?> readonly="readonly"><br>
			Nivel Usuario:<input type="text" name="nivel" value=<?php echo $alterar[$linha][4]; ?> readonly="readonly"><br>
			Nova Senha:<input type="password" name="nova_senha">Sim<input type="radio" name="alterar_senha" value="1" required> Não<input type="radio" name="alterar_senha" value="0" required><br>
			<input type="submit" value="ALTERAR">
		</form>
	</body>
</html>