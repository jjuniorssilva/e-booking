<?php
include "../../Verificasessao.php";
include '../../conexao.php';
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$data_inicio = $_POST['dataInicio'];
$temp_c = $_POST['horaInicio'];
$data_fim = $_POST['dataFim'];
$temp_f = $_POST['horaFim'];
$descricao = $_POST['descricao'];
$cod_item = $_REQUEST['codigo'];
$data_hoje = date('Y-m-d');
$cod_usuario = $_SESSION['cod_usuario'];

if ((empty(strtotime($data_inicio))) || (empty(strtotime($temp_c))) || (empty(strtotime($data_fim))) || (empty(strtotime($temp_f))) || (empty($descricao)) || (empty($cod_item))) {
	 "<script type='text/javascript'> alert ('DADOS INVÁLIDOS!'); window.location.href='javascript:history.back()'; </script>";
}else{
		$timestamp_data_inicio = explode("-", $data_inicio);
		$timestamp_hora_inicio = explode(":", $temp_c);
		$time_inicio = mktime($timestamp_hora_inicio[0],$timestamp_hora_inicio[1],0,$timestamp_data_inicio[1],$timestamp_data_inicio[2],$timestamp_data_inicio[0]);

		$timestamp_data_fim = explode("-", $data_fim);
		$timestamp_hora_fim = explode(":", $temp_f);
		$time_fim = mktime($timestamp_hora_fim[0],$timestamp_hora_fim[1],0,$timestamp_data_fim[1],$timestamp_data_fim[2],$timestamp_data_fim[0]);

		if ($time_inicio > $time_fim){
			echo "<script type='text/javascript'> alert ('Data de fim inválida!'); window.location.href='../itens.php'; </script>";
		}else{

			$sql1 = "SELECT * FROM t_reserva WHERE t_item_cod_item = $cod_item";
			$result1 = mysqli_query($conexao, $sql1);
			if ($result1) {
				if (mysqli_num_rows($result1)>0) {
					$sql = "SELECT timestamp_inicio, timestamp_fim FROM t_reserva WHERE cancela_reserva = '0' AND t_item_cod_item = $cod_item";
					$result = mysqli_query($conexao, $sql);
					if(!$result){	
						echo "<script type='text/javascript'> alert ('ERRO AO REALIZAR CONSULTA'); window.location.href='../itens.php'; </script>";
					}else{
						$busca = mysqli_fetch_array($result);
						$num_rows = mysqli_num_rows($result);
						while($num_rows>0){
							$Time_inicio_banco = $busca['timestamp_inicio'];
							$Time_fim_banco = $busca['timestamp_fim'];
							$num_rows --;
							if((($Time_inicio_banco < $time_inicio) AND ($Time_fim_banco < $time_inicio )) OR (($Time_inicio_banco > $time_fim) AND ($Time_fim_banco > $time_fim))){
								$sql_reservar1= "INSERT INTO t_reserva (data_reserva, data_inicio, hora_inicio, data_fim, hora_fim, desc_reserva, t_item_cod_item, t_usuario_cod_usuario, timestamp_inicio, timestamp_fim) VALUES ('$data_hoje', '$data_inicio', '$temp_c', '$data_fim', '$temp_f', '$descricao','$cod_item','$cod_usuario', '$time_inicio', '$time_fim')";
								$result_reservar1 = mysqli_query($conexao, $sql_reservar1);
								if ($result_reservar1) {
									mysqli_commit($conexao);
									mysqli_close($conexao);
									echo "<script type='text/javascript'> alert ('RESERVA REALIZADA COM SUCESSO!'); window.location.href='../itens.php'; </script>";
								}else{
									mysqli_close($conexao);
									echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL REALIZAR RESERVA!'); window.location.href='javascript:history.back()'; </script>";
								}
							}else{
								echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL REALIZAR RESERVA NESSE HORÁRIO!'); window.location.href='javascript:history.back()'; </script>";
							}
						}
					}	
				}else{
					$sql_reservar= "INSERT INTO t_reserva (data_reserva, data_inicio, hora_inicio, data_fim, hora_fim, desc_reserva, t_item_cod_item, t_usuario_cod_usuario, timestamp_inicio, timestamp_fim) VALUES ('$data_hoje', '$data_inicio', '$temp_c', '$data_fim', '$temp_f', '$descricao','$cod_item','$cod_usuario', '$time_inicio', '$time_fim')";
					$result_reservar = mysqli_query($conexao, $sql_reservar);
					if ($result_reservar) {
						mysqli_commit($conexao);
						mysqli_close($conexao);
						echo "<script type='text/javascript'> alert ('RESERVA REALIZADA COM SUCESSO!'); window.location.href='../itens.php'; </script>";
					}else{
						mysqli_close($conexao);
						echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL REALIZAR RESERVA!'); window.location.href='javascript:history.back()'; </script>";
					}
				}
			}else{
				mysqli_close($conexao);
				echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL REALIZAR CONSULTA NA TABELA'); window.location.href='javascript:history.back()'; </script>";
			}
	}	
}
?>