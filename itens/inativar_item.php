<?php
include "../Verificasessao.php";
include "../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
if (!empty($_POST['inativarAtivo'])) {
	$_SESSION['$linha_inativar'] = $_POST['inativarAtivo'];
	$linha = $_SESSION['$linha_inativar'];
	$alterar=$_SESSION['$itensAtivos'];
	$cod_item=$_SESSION['$itensAtivos'][$linha][0];
}
if (!empty($_POST['inativarBuscaAtivo'])) {
	$_SESSION['$linha_inativar'] = $_POST['inativarBuscaAtivo'];
	$linha = $_SESSION['$linha_inativar'];
	$alterar=$_SESSION['$buscaitensAtivos'];
	$cod_item=$_SESSION['$buscaitensAtivos'][$linha][0];
}

$sql_inativar="UPDATE t_item SET ativo_item='0' WHERE cod_item='$cod_item'";
$result_inativar = mysqli_query($conexao, $sql_inativar);
if (!$result_inativar){
	mysqli_close($conexao);
	echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_item!'); window.location.href='javascript:history.back()'</script>";
}else{
	echo "<script type='text/javascript'>alert ('Item Inativado com sucesso!'); window.location.href='itens.php'</script>";
}
?>
