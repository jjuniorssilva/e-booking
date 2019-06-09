<?php

include "../../conexao.php";
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

if (!empty($senha) && !empty($usuario)) {
	$csenha = md5($senha);
	
	$sql="SELECT u.cod_usuario, u.nome_usuario, n.cod_nivel, u.ativo_usuario, n.ativo_nivel FROM t_usuario u JOIN t_nivel n ON (u.t_nivel_cod_nivel=n.cod_nivel) WHERE login_usuario='$usuario' AND senha_usuario='$csenha'";
	$result = mysqli_query($conexao, $sql);
	if (!$result) {
		echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA NA TABELA t_usuario!!'); </script>";
		mysqli_close($conexao);
	}else{
		if (mysqli_num_rows($result)==1) {
			$linha = mysqli_fetch_assoc($result);
			if (($linha['ativo_usuario']==1) AND ($linha['ativo_nivel']==1)) {
				if (!isset($_SESSION)) {
					session_start();
					$_SESSION['cod_usuario'] = $linha['cod_usuario'];
					$_SESSION['nome_usuario'] = $linha['nome_usuario'];
					$_SESSION['nivel_usuario'] = $linha['t_nivel_cod_nivel'];
					header("Location:../../inicio.php");
				}
			}else{
				echo "<script type='text/javascript'> alert ('USUÁRIO OU NÍVEL INATIVO!'); window.location.href='javascript:history.back()'</script>";
			}
			
		}else{
			echo "<script type='text/javascript'> alert ('SENHA OU USUÁRIO INVÁLIDOS!'); window.location.href='javascript:history.back()'</script>";
		}
	}
}else{
	echo "<script type='text/javascript'>alert ('DADOS INVÁLIDOS!!'); window.location.href='javascript:history.back()';</script>";
}

?>	