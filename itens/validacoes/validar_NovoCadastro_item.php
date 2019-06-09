<?php
include "../../Verificasessao.php";
include "../../conexao.php";

$codigo = $_POST['codigo'];
$tipo = $_POST['tipo'];
$descricao=$_POST['descricao'];
$valor = $_POST['valor'];
$conteudo = $_POST['conteudo'];
$obs = $_POST['obs'];

if (!isset($_SESSION)) {
	session_start();
}

if (!empty($codigo) && !empty($descricao)) {
	$usuario_cadastro = $_SESSION['nome_usuario'];
	$data_cadastro= date('Y-m-d'); 

	$sql="INSERT INTO t_item(cod_item, t_tipo, valor_item, conteudo_item, data_cadastro, usuario_cadastro, obs_item, descricao_item) VALUES('$codigo', '$tipo', '$valor', '$conteudo', '$data_cadastro', '$usuario_cadastro','$obs','$descricao');";
	mysqli_autocommit($conexao, false);
	$result= mysqli_query($conexao, $sql);

	if (!$result){
		mysqli_close($conexao);
		echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL CADASTRAR NA TABELA t_item!!'); window.location.href='javascript:history.back()'; </script>";

	}else{						
		mysqli_commit($conexao);
		mysqli_close($conexao);
		echo "<script type='text/javascript'> alert ('ITEM CADASTRADO COM SUCESSO!'); window.location.href='../itens.php'; </script>";
	}

}else{
	echo "<script type='text/javascript'> alert('Dados invalidos'); window.location.href='javascript:history.back()';</script>";
}
?>
