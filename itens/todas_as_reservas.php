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

$sql = "SELECT * FROM t_reserva WHERE cancela_reserva = '0' and reserva_checada='0'"; 
//$sql="SELECT r.data_reserva, r.data_inicio, r.hora_inicio, r.data_fim, r.hora_fim, r.desc_reserva, r.t_item_cod_item, r.t_usuario_cod_usuario, r.cod_reserva, c.cod_check, c.realiza_check FROM t_reserva r right JOIN t_check c ON (r.t_check_cod_check == c.cod_check) WHERE r.cancela_reserva = '0'";

$result = mysqli_query($conexao, $sql);

if(!$result){
	echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA DAS RESERVAS!'); window.location.href='javascript:history.back()';</script>";
	mysqli_close($conexao);
}else{
	$reservas = array(array("Data da Reserva", "Data de Inicio", "Hora de Inicio", "Data de Fim", "Hora de Fim", "Descrição", "Código do Item", "Código do Usuário","Opção"));
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
				$reservas[$i][0]=$data_reserva;
				$reservas[$i][1]=$data_inicio;
				$reservas[$i][2]=$hora_inicio;
				$reservas[$i][3]=$data_fim;
				$reservas[$i][4]=$hora_fim;
				$reservas[$i][5]=$descricao;
				$reservas[$i][6]=$cod_item;
				$reservas[$i][7]=$cod_usuario;
				$reservas[$i][8]="<form method='POST' action='formularios/form_check.php'><button type='submit' name='codigo' value='$cod_reserva'>Check</button></form>";
				$i++;
			} while ($i<0);
		}?>
		<h4> Reservas </h4>
		<table>
			<?php
			if ($i!=1) {
				for ($j=0; $j < sizeof($reservas); $j++) {
					echo "<tr><td>".$reservas[$j][0]."</td><td>".$reservas[$j][1]."</td><td>".$reservas[$j][2]."</td><td>".$reservas[$j][3]."</td><td>".$reservas[$j][4]."</td><td>".$reservas[$j][5]."</td><td>".$reservas[$j][6]."</td><td>".$reservas[$j][7]."</td><td>".$reservas[$j][8]."</td></tr><br>";		
				}
			}else{
				echo "<script type='text/javascript'>alert ('Não há Reservas!'); window.location.href='../inicio.php'</script>";
			}
			mysqli_close($conexao);
		}
		
		?>
	</table>