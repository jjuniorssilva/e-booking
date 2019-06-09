<?php
include "../../Verificasessao.php";
include "../../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
$novo_tipo = $_POST['tipo'];
$nova_descricao=$_POST['descricao'];
$novo_valor= $_POST['valor'];
$novo_conteudo = $_POST['conteudo'];
$nova_obs = $_POST['obs'];
$linha = $_SESSION['$linha_alterar'];
$codigo=$_SESSION['codigo_alterar'];

$sql="UPDATE t_item SET t_tipo='$novo_tipo', descricao_item='$nova_descricao', valor_item='$novo_valor', conteudo_item='$novo_conteudo', obs_item='$nova_obs' WHERE cod_item='$codigo'";
$result= mysqli_query($conexao, $sql);
if (!$result){
	mysqli_close($conexao);
	echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_item!'); window.location.href='javascript:history.back()'</script>";
}else{
	echo "<script type='text/javascript'>alert ('ITEM ALTERADO COM SUCESSO!'); window.location.href='../itens.php'</script>";
}
?>