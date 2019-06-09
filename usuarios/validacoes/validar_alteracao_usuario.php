<?php
include "../../Verificasessao.php";
include "../../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}

$novo_nome = $_POST['nome'];
$alterar_senha=$_POST['alterar_senha'];
$linha = $_SESSION['$linha_alterar'];
$login_usuario=$_SESSION['login_alterar'];

	if ($alterar_senha==0) {
		$sql="UPDATE t_usuario SET nome_usuario='$novo_nome' WHERE login_usuario='$login_usuario'";
		$result= mysqli_query($conexao, $sql);
		if (!$result){
			mysqli_close($conexao);
			echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_usuario!'); window.location.href='javascript:history.back()'</script>";
		}else{
			echo "<script type='text/javascript'>alert ('USUÁRIO ALTERADO COM SUCESSO!'); window.location.href='../usuarios.php'</script>";
		}
	}else{
		if (!empty($_POST['nova_senha'])) {
			$csenha = md5($_POST['nova_senha']);
			$sql="UPDATE t_usuario SET nome_usuario='$novo_nome', senha_usuario='$csenha' WHERE login_usuario='$login_usuario'";
			$result= mysqli_query($conexao, $sql);
			if (!$result){
				mysqli_close($conexao);
				echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_usuario!'); window.location.href='javascript:history.back()'</script>";
			}else{
				echo "<script type='text/javascript'>alert ('USUÁRIO ALTERADO COM SUCESSO!'); window.location.href='../usuarios.php'</script>";
			}
		}else{
			echo "<script type='text/javascript'>alert ('Atualize a página e Insira Nova senha!'); window.location.href='javascript:history.back()'</script>";
		}
	}
?>