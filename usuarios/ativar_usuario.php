<?php
include "../Verificasessao.php";
include "../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
if (!empty($_POST['ativarInativo'])) {
	$_SESSION['$linha_ativar'] = $_POST['ativarInativo'];
	$linha = $_SESSION['$linha_ativar'];
	$alterar=$_SESSION['$usuariosInativos'];
	$login_usuario=$_SESSION['$usuariosInativos'][$linha][1];
}
if (!empty($_POST['ativarbuscaInativo'])) {
	$_SESSION['$linha_ativar'] = $_POST['ativarbuscaInativo'];
	$linha = $_SESSION['$linha_ativar'];
	$alterar=$_SESSION['$buscausuariosInativos'];
	$login_usuario=$_SESSION['$buscausuariosInativos'][$linha][1];
}
	$sql_ativar="UPDATE t_usuario SET ativo_usuario='1' WHERE login_usuario='$login_usuario'";
	$result_ativar = mysqli_query($conexao, $sql_ativar);
	if (!$result_ativar){
		mysqli_close($conexao);
		echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_usuario!'); window.location.href='javascript:history.back()'</script>";
	}else{
		echo "<script type='text/javascript'>alert ('Usuário ativado com sucesso!'); window.location.href='usuariosInativos.php'</script>";
	}
?>
