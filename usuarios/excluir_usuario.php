<?php
include "../Verificasessao.php";
include "../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
if (!empty($_POST['excluirInativo'])) {
	$_SESSION['$linha_excluir'] = $_POST['excluirInativo'];
	$linha = $_SESSION['$linha_excluir'];
	$alterar=$_SESSION['$usuariosInativos'];
	$login_usuario=$_SESSION['$usuariosInativos'][$linha][1];
}
if (!empty($_POST['excluirbuscaInativo'])) {
	$_SESSION['$linha_excluir'] = $_POST['excluirbuscaInativo'];
	$linha = $_SESSION['$linha_excluir'];
	$alterar=$_SESSION['$buscausuariosInativos'];
	$login_usuario=$_SESSION['$buscausuariosInativos'][$linha][1];
}
if (!empty($_POST['excluirAtivo'])) {
	$_SESSION['$linha_excluir'] = $_POST['excluirAtivo'];
	$linha = $_SESSION['$linha_excluir'];
	$alterar=$_SESSION['$usuariosAtivos'];
	$login_usuario=$_SESSION['$usuariosAtivos'][$linha][1];
}
if (!empty($_POST['excluirbuscaAtivo'])) {
	$_SESSION['$linha_excluir'] = $_POST['excluirbuscaAtivo'];
	$linha = $_SESSION['$linha_excluir'];
	$alterar=$_SESSION['$buscausuariosAtivos'];
	$login_usuario=$_SESSION['$buscausuariosAtivos'][$linha][1];
}


	$sql_excluir="DELETE FROM t_usuario WHERE login_usuario='$login_usuario'";
	mysqli_autocommit($conexao, false);
	$result_excluir = mysqli_query($conexao, $sql_excluir);
	if (!$result_excluir){
		mysqli_close($conexao);
		echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_usuario!'); window.location.href='javascript:history.back()'</script>";
	}else{
		mysqli_commit($conexao);
		mysqli_close($conexao);
		echo "<script type='text/javascript'> alert ('USUÁRIO EXCLUÍDO !'); window.location.href='usuarios.php'</script>";
	}
?>