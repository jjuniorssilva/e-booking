<?php
include "../../Verificasessao.php";
include "../../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$date = date('d-m-Y');

$item=$_POST['buscarItem'];
$sql="SELECT * FROM t_item WHERE descricao_item LIKE '$item%' AND ativo_item ='0'";
$result = mysqli_query($conexao,$sql);
if (!$result) {
	echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA NA TABELA t_item!!'); window.location.href='javascript:history.back()';</script>";
	mysqli_close($conexao);
}else{
	$itens = array(array("Código", "Tipo", "Descrição", "Valor", "Conteúdo", "Data do Cadastro", "Usuário que Cadastrou", "Observações", "OPÇÕES","","" ));
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
			$itens[$i][8]="<form method='POST' action='../ativar_item.php'><button type='submit' name='ativarBuscaInativo' value='$i'>ATIVAR</button></form>";
			$itens[$i][9]="<form method='POST' action='../formularios/form_alterar_item.php'><button type='submit' name='alterarBuscaInativo' value='$i'>ALTERAR</button></form>";
			$itens[$i][10]="<form method='POST' action='../excluir_item.php'><button type='submit' name='excluirBuscaInativo' value='$i'>EXCLUIR</button></form>";
			$i++;
		} while ($i<0);
	}
} 
$_SESSION['$buscaitensInativos']=$itens;
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
<h4>Itens encontrados</h4>
<table>
	<?php 
	if ($i!=1) {
		for ($j=0; $j < sizeof($itens) ; $j++) {
			echo "<tr><td>".$itens[$j][0]."</td><td>".$itens[$j][1]."</td><td>".$itens[$j][2]."</td><td>".$itens[$j][3]."</td><td>".$itens[$j][4]."</td><td>".$itens[$j][5]."</td><td>".$itens[$j][6]."</td><td>".$itens[$j][7]."</td><td>".$itens[$j][8]."</td><td>".$itens[$j][9]."</td><td>".$itens[$j][10]."</td></tr><br>";		
		}
	}else{
		echo "<script type='text/javascript'>alert ('NENHUM ITEM ENCONTRADO!'); window.location.href='../itensInativos.php';</script>";
	}
	mysqli_close($conexao);
	?>
</table>