<?php
include "../Verificasessao.php";
include "../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
if (!empty($_POST['ativarInativo'])) {
	$_SESSION['$linha_ativar'] = $_POST['ativarInativo'];
	$linha = $_SESSION['$linha_ativar'];
	$alterar=$_SESSION['$itensInativos'];
	$cod_item=$_SESSION['$itensInativos'][$linha][0];
}
if (!empty($_POST['ativarBuscaInativo'])) {
	$_SESSION['$linha_ativar'] = $_POST['ativarBuscaInativo'];
	$linha = $_SESSION['$linha_ativar'];
	$alterar=$_SESSION['$buscaitensInativos'];
	$cod_item=$_SESSION['$buscaitensInativos'][$linha][0];
}

$sql_inativar="UPDATE t_item SET ativo_item = '1' WHERE cod_item='$cod_item'";
$result_inativar = mysqli_query($conexao, $sql_inativar);
if (!$result_inativar){
	mysqli_close($conexao);
	echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_item!'); window.location.href='javascript:history.back()'</script>";
}else{
	echo "<script type='text/javascript'>alert ('Item ativado com sucesso!'); window.location.href='itens.php'</script>";
}
?>
