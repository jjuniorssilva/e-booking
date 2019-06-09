<?php
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
<?php
$cod_usuario = $_SESSION['cod_usuario'];

$sql = "SELECT * FROM t_reserva WHERE t_usuario_cod_usuario = '$cod_usuario' AND cancela_reserva = '0' and t_check_cod_check = '0'"; 
$result = mysqli_query($conexao, $sql);

if(!$result){
	echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA DAS RESERVAS!'); window.location.href='javascript:history.back()';</script>";
	mysqli_close($conexao);
}else{
	$reservas_feitas = array(array("Data da Reserva", "Data de Inicio", "Hora de Inicio", "Data de Fim", "Hora de Fim", "Descrição", "Código do Item", "Código do Usuário","Opção"));
	$i=1;
	while (($linha = mysqli_fetch_array($result))==true) {
			$data_reserva=date('d-m-Y', strtotime($linha['data_reserva']));
			$data_inicio=date('d-m-Y', strtotime($linha['data_inicio']));
			$hora_inicio=$linha['hora_inicio'];
			$data_fim=date('d-m-Y', strtotime($linha['data_fim']));
			$hora_fim=$linha['hora_fim'];
			$descricao=$linha['desc_reserva'];
			$cod_item=$linha['t_item_cod_item'];
			$cod_usuario=$linha['t_usuario_cod_usuario'];
			$cod_reserva=$linha['cod_reserva'];

			do {
				$reservas_feitas[$i][0]=$data_reserva;
				$reservas_feitas[$i][1]=$data_inicio;
				$reservas_feitas[$i][2]=$hora_inicio;
				$reservas_feitas[$i][3]=$data_fim;
				$reservas_feitas[$i][4]=$hora_fim;
				$reservas_feitas[$i][5]=$descricao;
				$reservas_feitas[$i][6]=$cod_item;
				$reservas_feitas[$i][7]=$cod_usuario;
				$reservas_feitas[$i][8]="<form method='POST' action='cancelar_reserva.php'><button type='submit' name='cancelarReserva' value='$cod_reserva'>Cancelar Reserva</button></form>";
				$i++;
			} while ($i<0);
		}?>
		<h4> Minhas Reservas </h4>
		<table>
			<?php
			if ($i!=1) {
				for ($j=0; $j < sizeof($reservas_feitas); $j++) {
					echo "<tr><td>".$reservas_feitas[$j][0]."</td><td>".$reservas_feitas[$j][1]."</td><td>".$reservas_feitas[$j][2]."</td><td>".$reservas_feitas[$j][3]."</td><td>".$reservas_feitas[$j][4]."</td><td>".$reservas_feitas[$j][5]."</td><td>".$reservas_feitas[$j][6]."</td><td>".$reservas_feitas[$j][7]."</td><td>".$reservas_feitas[$j][8]."</td></tr><br>";		
				}
			}else{
				?> <p> Não existe reservas</p><?php
			}
		}
		mysqli_close($conexao);
		?>
	</table>
