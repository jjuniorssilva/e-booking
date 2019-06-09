<?php
include "../../Verificasessao.php";
include "../../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$date = date('d-m-Y');

$cod_item = $_REQUEST['codigo'];

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
<form method="POST" action="../validacoes/teste1.php">
	<table>
		<tr>
			<td> Código do Item: </td> <td> <input type="text" name= 'codigo' readonly="readonly" value=<?php echo $cod_item ?>> </td>
		</tr>
		<tr>
			<td> Data de Inicio: </td> <td> <input type="date" name="dataInicio" required="required"> </td>
		</tr>
		<tr>
			<td> Hora de Inicio: </td> <td> <input type="time" name="horaInicio" required="required"> </td>
		</tr>
		<tr>
			<td> Data de Fim: </td><td> <input type="date" name="dataFim" required="required"> </td>
		</tr>
		<tr>
			<td> Hora de Fim: </td><td> <input type="time" name="horaFim" required="required"> </td>
		</tr>
		<tr>
			<td> Descrição: </td><td> <textarea type="text" name="descricao" required="required"></textarea><br> </td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="reservar" >
				<input type="reset" value="limpar"></td>
			</tr>
		</table>
	</form>
	
	<?php
	$sql = "SELECT data_inicio, hora_inicio, data_fim, hora_fim FROM t_reserva WHERE t_item_cod_item = '$cod_item' AND cancela_reserva = '0'";
	$result = mysqli_query($conexao, $sql);

	if(!$result){
		echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA DAS RESERVAS!'); window.location.href='javascript:history.back()';</script>";
		mysqli_close($conexao);
	}else{
		$reservas = array(array("Data de Início", "Hora de Início", "Data de Fim", "Hora de Fim"));
		$i = 1;
		while (($linha = mysqli_fetch_array($result))==true) {
			$data_inicio=date('d-m-Y', strtotime($linha['data_inicio']));
			$hora_inicio=$linha['hora_inicio'];
			$data_fim=date('d-m-Y', strtotime($linha['data_fim']));
			$hora_fim=$linha['hora_fim'];

			do {
				
				$reservas[$i][0]=$data_inicio;
				$reservas[$i][1]=$hora_inicio;
				$reservas[$i][2]=$data_fim;
				$reservas[$i][3]=$hora_fim;
				$i++;
			} while ($i<0);
		}?>
		<h4> Horários já reservados </h4>
		<table>
			<?php
			if ($i!=1) {
				for ($j=0; $j < sizeof($reservas); $j++) {
					echo "<tr><td>".$reservas[$j][0]."</td><td>".$reservas[$j][1]."</td><td>".$reservas[$j][2]."</td><td>".$reservas[$j][3]."</td></tr><br>";		
				}
			}else{
				echo "NENHUMA RESERVA REALIZADA NO MOMENTO!";
			}
		}
		mysqli_close($conexao);
		?>
	</table>









	
