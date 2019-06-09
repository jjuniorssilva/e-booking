<?php
include "../../Verificasessao.php";
include "../../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$date = date('d-m-Y');
?>
<table>
	<tr>
		<td> <?php echo "Seja bem vindo(a)! ".$_SESSION['nome_usuario']; ?></td>
		<td> <?php echo $date; ?> </td> 
		<td> <a href="../../inicio.php">Página Inicial</a></td>
		<td> <a href="../../sair.php">SAIR</a></td>
	</tr>
</table>
<a href="javascript:history.back()">VOLTAR</a>
<h4>Usuários encontrados</h4>
<?php

$usuario=$_POST['buscarUsuario'];

$sql="SELECT u.nome_usuario, u.login_usuario, u.data_cadastro, u.usu_cadastro, n.cod_nivel, n.nome_nivel FROM t_usuario u JOIN t_nivel n ON (u.t_nivel_cod_nivel = n.cod_nivel) WHERE u.nome_usuario LIKE '$usuario%' AND u.ativo_usuario ='0'";
$result = mysqli_query($conexao,$sql);
if (!$result) {
	echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA NA TABELA t_usuario!!'); window.location.href='javascript:history.back()';</script>";
	mysqli_close($conexao);
}else{
	$usuarios = array(array("Nome", "Login", "Data do Cadastro", "Usuário que Cadastrou", "Nivel de Acesso", "OPÇÕES","","" ));
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
				$usuarios[$i][5]="<form method='POST' action='../ativar_usuario.php'><button type='submit' name='ativarbuscaInativo' value='$i'>ATIVAR</button></form>";
				$usuarios[$i][6]="<form method='POST' action='../formularios/form_alterar_usuario.php'><button type='submit' name='alterarbuscaInativo' value='$i'>ALTERAR</button></form>";
				$usuarios[$i][7]="<form method='POST' action='../excluir_usuario.php'><button type='submit' name='excluirbuscaInativo' value='$i'>EXCLUIR</button></form>";
				$i++;
			} while ($i<0);
		}if ($i==1) {
			echo "<script type='text/javascript'>alert ('NENHUM USUÁRIO ENCONTRADO!'); window.location.href='../usuariosInativos.php';</script>";
		}
		$_SESSION['$buscausuariosInativos']=$usuarios;
	?>
	<table>
		<?php
		for ($j=0; $j < sizeof($usuarios) ; $j++) { 
			?>	
			<tr>
				<?php echo "<td>".$usuarios[$j][0]."</td><td>".$usuarios[$j][1]."</td><td>".$usuarios[$j][2]."</td><td>".$usuarios[$j][3]."</td><td>".$usuarios[$j][4]."</td><td>".$usuarios[$j][5]."</td><td>".$usuarios[$j][6]."</td><td>".$usuarios[$j][7]."</td><br>";?>
			</tr>
			<?php
		}
		mysqli_close($conexao);
	} 
	?>
</table>