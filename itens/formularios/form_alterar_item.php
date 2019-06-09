<?php
include "../../Verificasessao.php";
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$date = date('d-m-Y');

if (!empty($_POST['alterarAtivo'])) {
	$_SESSION['$linha_alterar'] = $_POST['alterarAtivo'];
	$linha = $_SESSION['$linha_alterar'];
	$alterar=$_SESSION['$itensAtivos'];
	$_SESSION['codigo_alterar']=$_SESSION['$itensAtivos'][$linha][0];
}
if (!empty($_POST['alterarBuscaAtivo'])) {
	$_SESSION['$linha_alterar'] = $_POST['alterarBuscaAtivo'];
	$linha = $_SESSION['$linha_alterar'];
	$alterar=$_SESSION['$buscaitensAtivos'];
	$_SESSION['codigo_alterar']=$_SESSION['$buscaitensAtivos'][$linha][0];
}
if (!empty($_POST['alterarInativo'])) {
	$_SESSION['$linha_alterar'] = $_POST['alterarInativo'];
	$linha = $_SESSION['$linha_alterar'];
	$alterar=$_SESSION['$itensInativos'];
	$_SESSION['codigo_alterar']=$_SESSION['$itensInativos'][$linha][0];
}
if (!empty($_POST['alterarBuscaInativo'])) {
	$_SESSION['$linha_alterar'] = $_POST['alterarBuscaInativo'];
	$linha = $_SESSION['$linha_alterar'];
	$alterar=$_SESSION['$buscaitensInativos'];
	$_SESSION['codigo_alterar']=$_SESSION['$buscaitensInativos'][$linha][0];
}
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
<form method="post" action="../validacoes/validar_alteracao_item.php">
	Codigo:
	<input type="number" min="0" name="codigo" value=<?php echo $alterar[$linha][0]; ?> readonly="readonly" ><br>
	Tipo:
	<input type="text" name="tipo" value=<?php echo $alterar[$linha][1]; ?>><br>
	Descrição:
	<textarea type="text" name="descricao" required="required"><?php echo $alterar[$linha][2]; ?></textarea><br>
	Valor:
	<input type="number" min="0" step="any" name="valor" value=<?php echo $alterar[$linha][3]; ?>><br>
	Conteúdo:
	<textarea type="text" name="conteudo"><?php echo $alterar[$linha][4]; ?></textarea><br>
	Observações:
	<textarea type="text" name="obs"><?php echo $alterar[$linha][7]; ?></textarea><br>
	Data Cadastro:
	<input type="date" name="data" value=<?php echo $alterar[$linha][5]; ?> readonly="readonly"><br>
	Usuário que cadastrou:
	<input type="text" name="nivel" value=<?php echo $alterar[$linha][6]; ?> readonly="readonly"><br>
	<input type="submit" value="ALTERAR">
</form>
</body>
</html>