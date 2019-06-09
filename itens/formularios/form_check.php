<?php
include "../../Verificasessao.php";
include "../../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$date = date('d-m-Y');

$cod_reserva = $_REQUEST['codigo'];

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
<br><br><br>
<h4>Reserva de Equipamentos</h4>	
<form method="POST" action="../validacoes/check_reserva.php">
	<table>
		<tr>
			<td> Código da Reserva: </td> <td> <input type="text" name= 'codigo' readonly="readonly" value=<?php echo $cod_reserva ?>> </td>
		</tr>
		<tr>
			<td> Descrição Check: </td><td> <textarea type="text" name="descricao" required="required"></textarea><br> </td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" value="Finalizar" >
			<input type="reset" value="limpar"></td>
		</tr>
	</table>
</form>