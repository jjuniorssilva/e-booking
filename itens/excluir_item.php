<?php
include "../Verificasessao.php";
include "../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
if (!empty($_POST['excluirInativo'])) {
	$_SESSION['$linha_excluir'] = $_POST['excluirInativo'];
	$linha = $_SESSION['$linha_excluir'];
	$alterar=$_SESSION['$itensInativos'];
	$cod_item=$_SESSION['$itensInativos'][$linha][0];
}
if (!empty($_POST['excluirBuscaInativo'])) {
	$_SESSION['$linha_excluir'] = $_POST['excluirBuscaInativo'];
	$linha = $_SESSION['$linha_excluir'];
	$alterar=$_SESSION['$buscaitensInativos'];
	$cod_item=$_SESSION['$buscaitensInativos'][$linha][0];
}
if (!empty($_POST['excluirAtivo'])) {
	$_SESSION['$linha_excluir'] = $_POST['excluirAtivo'];
	$linha = $_SESSION['$linha_excluir'];
	$alterar=$_SESSION['$itensAtivos'];
	$cod_item=$_SESSION['$itensAtivos'][$linha][0];
}
if (!empty($_POST['excluirBuscaAtivo'])) {
	$_SESSION['$linha_excluir'] = $_POST['excluirBuscaAtivo'];
	$linha = $_SESSION['$linha_excluir'];
	$alterar=$_SESSION['$buscaitensAtivos'];
	$cod_item=$_SESSION['$buscaitensAtivos'][$linha][0];
}

$sql_excluir="DELETE FROM t_item WHERE cod_item = '$cod_item'";
mysqli_autocommit($conexao, false);
$result_excluir = mysqli_query($conexao, $sql_excluir);
if (!$result_excluir){
	mysqli_close($conexao);
	echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_item!'); window.location.href='javascript:history.back()'</script>";
}else{
	mysqli_commit($conexao);
	mysqli_close($conexao);
	echo "<script type='text/javascript'> alert ('ITEM EXCLUÍDO COM SUCESSO!'); window.location.href='itens.php'</script>";
}
?>