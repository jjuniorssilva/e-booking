<?php
include "../Verificasessao.php";
include "../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
if (!empty($_POST['inativarAtivo'])) {
	$_SESSION['$linha_inativar'] = $_POST['inativarAtivo'];
	$linha = $_SESSION['$linha_inativar'];
	$alterar=$_SESSION['$usuariosAtivos'];
	$login_usuario=$_SESSION['$usuariosAtivos'][$linha][1];
}
if (!empty($_POST['inativarbuscaAtivo'])) {
	$_SESSION['$linha_inativar'] = $_POST['inativarbuscaAtivo'];
	$linha = $_SESSION['$linha_inativar'];
	$alterar=$_SESSION['$buscausuariosAtivos'];
	$login_usuario=$_SESSION['$buscausuariosAtivos'][$linha][1];
}

	$sql_inativar="UPDATE t_usuario SET ativo_usuario = '0' WHERE login_usuario = '$login_usuario'";
	$result_inativar = mysqli_query($conexao, $sql_inativar);
	if (!$result_inativar){
		mysqli_close($conexao);
		echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_usuario!'); window.location.href='javascript:history.back()'</script>";
	}else{
		echo "<script type='text/javascript'>alert ('Usuário Inativado com sucesso!'); window.location.href='usuarios.php'</script>";
	}
?>
