<?php
include "../Verificasessao.php";
include "../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$date = date('d/m/Y');
$hora = date('H:m');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../style.css">
	<title></title>
</head>
<body >
	
	<div id="dominio">Exibir Usuários</div>
	<div id="logo_usuario"><a href="../inicio.php"><img src="../imagens/logo.png"></a></div>
	<div id="busca">
		<form method="POST" action="validacoes/validar_busca_usuario_ativo.php">
			Buscar pelo Nome:
			<input type = 'text' name = 'buscarUsuarioAtivo' title = 'Buscar Usuário' required>
			<input type = 'Submit' value = 'Enviar'>
		</form>
	</div>	

	<?php

	$sql="SELECT u.nome_usuario, u.login_usuario, u.data_cadastro, u.usu_cadastro, n.cod_nivel, n.nome_nivel FROM t_usuario u JOIN t_nivel n ON (u.t_nivel_cod_nivel = n.cod_nivel) WHERE u.ativo_usuario='1'";
	$result = mysqli_query($conexao,$sql);
	if (!$result) {
		echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA NA TABELA t_usuario!!'); window.location.href='javascript:history.back()';</script>";
		mysqli_close($conexao);
	}else{
		$usuarios = array(array("Nome", "Login", "Data do Cadastro", "Usuário que Cadastrou", "Nivel de Acesso", "","OPÇÕES","" ));
		$i=1;
		while (($linha = mysqli_fetch_array($result))==true) {
			$nome_usuario_busca=$linha['nome_usuario'];
			$login_usuario_busca=$linha['login_usuario'];
			$data_cadastro_busca=$linha['data_cadastro'];
			$usuario_cadastro_busca=$linha['usu_cadastro'];
			$nivel_usuario_busca=$linha['nome_nivel'];

			do {
				$usuarios[$i][0]=$nome_usuario_busca;
				$usuarios[$i][1]=$login_usuario_busca;
				$usuarios[$i][2]=$data_cadastro_busca;
				$usuarios[$i][3]=$usuario_cadastro_busca;
				$usuarios[$i][4]=$nivel_usuario_busca;
				$usuarios[$i][5]="<form method='POST' action='inativar_usuario.php'><button type='submit' name='inativarAtivo' value='$i'>INATIVAR</button></form>";
				$usuarios[$i][6]="<form method='POST' action='formularios/form_alterar_usuario.php'><button type='submit' name='alterarAtivo' value='$i'>ALTERAR</button></form>";
				$usuarios[$i][7]="<form method='POST' action='excluir_usuario.php'><button type='submit' name='excluirAtivo' value='$i'>EXCLUIR</button></form>";
				$i++;
			} while ($i<0);

		}	$_SESSION['$usuariosAtivos']=$usuarios; ?>
		<div id="tabela">
			<table border="1" width="100%" ">
				<?php
				if ($i!=1) {
					for ($j=0; $j < sizeof($usuarios) ; $j++) { 
						echo "<tr> 
								<td>".$usuarios[$j][0]."</td>
								<td>".$usuarios[$j][1]."</td>
								<td>".$usuarios[$j][2]."</td>
								<td>".$usuarios[$j][3]."</td>
								<td>".$usuarios[$j][4]."</td>
								<td>".$usuarios[$j][5]."</td>
								<td>".$usuarios[$j][6]."</td>
								<td>".$usuarios[$j][7]."</td>
							</tr>
							<br>";	
					}
				}else{
				echo "NENHUM USUÁRIO ATIVO NO MOMENTO!";
				}
				mysqli_close($conexao); 
				?>
			</table>
		</div>	
	<?php	
	}
	?>
	<div id="novousuario"> <a href="formularios/NovoUsuario.php"> + Novo Usuário</a></div>
	<div id="mostar"><a href="usuariosInativos.php">Ver Usuarios Inativos</a></div>

	<div id="usuario_rodape">Usuário:</div>
	<div id="usuario"> <?php echo $_SESSION['nome_usuario'] ?> </div>
	<div id="hora"> <?php echo $hora; ?></div> 
	<div id="data"> <?php echo $date; ?></div>
	<div id="sair"> <a href="../sair.php">Sair</a></div> 
	<div id="voltar"> <a href="../inicio.php">Voltar</a></div> 
	
</body>
</html>


