<?php
include "../../Verificasessao.php";
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$date = date('d-m-Y');
?>
<!DOCTYPE html>
<html>
<head>
	<title>formulário</title>
</head>
<body>
	<table>
		<tr>
			<td> <?php echo "Seja bem vindo(a)! ".$_SESSION['nome_usuario']; ?></td>
			<td> <?php echo $date; ?> </td> 
			<td> <a href="../../inicio.php">Página Inicial</a></td>
			<td> <a href="../../sair.php">SAIR</a></td>
		</tr>
	</table>
	<a href="javascript:history.back()">VOLTAR</a>
	<h4>Cadastro de Itens</h4>
		<form method="post" action="../validacoes/validar_NovoCadastro_item.php">
			<table>
				<tr>
					<td> Código: </td> <td> <input type="number" required min="0" name="codigo" maxlength="20"></td>
				</tr>
				<tr>
					<td> Tipo: </td> <td><input type="text" name="tipo" maxlength="45"></td>
				</tr>
				<tr>
					<td>Descrição: </td><td><textarea name="descricao" maxlength="150" required></textarea></td>
				</tr>
				<tr>
					<td> Valor R$:</td><td> <input type="number" min="0" step="any" name="valor"></td>
				</tr>
				<tr>
					<td>Conteúdo: </td><td><textarea name="conteudo" maxlength="150"></textarea></td>
				</tr>
				<tr>
					<td>Observações: </td><td><textarea name="obs" maxlength="150"></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="cadastrar" >
						<input type="reset" value="limpar"></td>
				</tr>
			</table>	
		</form>
	</body>
</html>
