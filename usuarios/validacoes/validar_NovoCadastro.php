<?php
include "../../Verificasessao.php";
include "../../conexao.php";

$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$nivel = $_POST['nivel'];

if (!isset($_SESSION)) {
	session_start();
}

if (!empty($nome) && !empty($usuario) && !empty($senha)) {
	$csenha = md5($senha);
	$sql_consulta_login="SELECT * FROM t_usuario WHERE login_usuario = '$usuario';";
	mysqli_autocommit($conexao, false);
	$result_consulta_login = mysqli_query($conexao, $sql_consulta_login);

	if (!$result_consulta_login){
		msqli_commit($conexao);
		mysqli_close($conexao);
		echo "<script type='text/javascript'>alert ('não foi possivel efetuar consulta na tabela t_usuario!'); window.location.href='javascript:history.back()'</script>";
	}else{
		
		if (mysqli_num_rows($result_consulta_login)>0) {

			echo "<script type='text/javascript'>alert ('ESTE NOME DE USUÁRIO JÁ EXISTE, TENTE OUTRO!'); window.location.href='javascript:history.back()'</script>";

		}else{

			$usuario_cadastro = $_SESSION['nome_usuario'];
			$data_cadastro= date('Y-m-d'); 

			$sql_cadastro_usuario="INSERT INTO t_usuario(nome_usuario, login_usuario, senha_usuario, data_cadastro, usu_cadastro, t_nivel_cod_nivel) VALUES('$nome', '$usuario','$csenha','$data_cadastro', '$usuario_cadastro', '$nivel');";
			mysqli_autocommit($conexao, false);

			$result_cadastro_usuario = mysqli_query($conexao, $sql_cadastro_usuario);

			if (!$result_cadastro_usuario){
				mysqli_close($conexao);
				echo "<script type='text/javascript'>alert ('NÃO FOI POSSÍVEL REALIZAR O CADASTRO!'); window.location.href='javascript:history.back()'; </script>";

			}else{						
				mysqli_commit($conexao);
				mysqli_close($conexao);
				echo "<script type='text/javascript'> alert ('USUÁRIO CADASTRADO COM SUCESSO!'); window.location.href='../usuarios.php'; </script>";
			}
		}
	}
}else{
	echo "<script type='text/javascript'> alert('Dados invalidos'); window.location.href='javascript:history.back()';</script>";
	exit;
}
?>
