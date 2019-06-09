<?php
include "../Verificasessao.php";
include "../conexao.php";
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
		<td> <a href="../inicio.php">Página Inicial</a></td>
		<td> <a href="../sair.php">SAIR</a></td>
	</tr>
</table>
<a href="javascript:history.back()">VOLTAR</a>
<form method="POST" action="validacoes/validar_busca_Item_ativo.php">
	Buscar pela descrição:
	<input type = 'text' name = 'buscarItem' title = 'Buscar Itens' required>
	<input type = 'Submit' value = 'Enviar'>
	<a href="formularios/NovoItem.php"> cadastrar novo item</a>
</form>
<h4>ITENS ATIVOS</h4>
<?php
$sql="SELECT * FROM t_item WHERE ativo_item='1'";
$result = mysqli_query($conexao,$sql);
if (!$result) {
	echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA NA TABELA t_item!!'); window.location.href='javascript:history.back()';</script>";
	mysqli_close($conexao);
}else{
	$itens = array(array("Código", "Tipo", "Descrição", "Valor", "Conteúdo", "Data do Cadastro", "Usuário que Cadastrou", "Observações", "OPÇÕES","","", ""));
	$i=1;
	while (($linha = mysqli_fetch_array($result))==true) {
		$cod_item=$linha['cod_item'];
		$tipo_item=$linha['t_tipo'];
		$descricao_item=$linha['descricao_item'];
		$valor_item=$linha['valor_item'];
		$conteudo_item=$linha['conteudo_item'];
		$data_cadastro=$linha['data_cadastro'];
		$usuario_cadastro=$linha['usuario_cadastro'];
		$obs_item=$linha['obs_item'];

		do {
			$itens[$i][0]=$cod_item;
			$itens[$i][1]=$tipo_item;
			$itens[$i][2]=$descricao_item;
			$itens[$i][3]=$valor_item;
			$itens[$i][4]=$conteudo_item;
			$itens[$i][5]=$data_cadastro;
			$itens[$i][6]=$usuario_cadastro;
			$itens[$i][7]=$obs_item;
			$itens[$i][8]="<form method='POST' action='inativar_item.php'><button type='submit' name='inativarAtivo' value='$i'>INATIVAR</button></form>";
			$itens[$i][9]="<form method='POST' action='formularios/form_alterar_item.php'><button type='submit' name='alterarAtivo' value='$i'>ALTERAR</button></form>";
			$itens[$i][10]="<form method='POST' action='excluir_item.php'><button type='submit' name='excluirAtivo' value='$i'>EXCLUIR</button></form>";
			$itens[$i][11]="<form method='POST' action='formularios/reservar_item.php?codigo=$cod_item'><button type='submit' name='reservarItem' value='$i'>RESERVAR</button></form>";
			$i++;
		} while ($i<0);

	}	$_SESSION['$itensAtivos']=$itens; ?>
	<table>
		<?php
		if ($i!=1) {
			for ($j=0; $j < sizeof($itens); $j++) {
				echo "<tr><td>".$itens[$j][0]."</td><td>".$itens[$j][1]."</td><td>".$itens[$j][2]."</td><td>".$itens[$j][3]."</td><td>".$itens[$j][4]."</td><td>".$itens[$j][5]."</td><td>".$itens[$j][6]."</td><td>".$itens[$j][7]."</td><td>".$itens[$j][8]."</td><td>".$itens[$j][9]."</td><td>".$itens[$j][10]."</td><td>".$itens[$j][11]."</td></tr><br>";		
			}
		}else{
			echo "NENHUM ITEM ATIVO NO MOMENTO!";
		}
	}
	mysqli_close($conexao);
	?>
</table>
<a href="itensInativos.php">Ver Itens Inativos</a>