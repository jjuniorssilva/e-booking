<?php
include "../../Verificasessao.php";
include '../../conexao.php';
if (!isset($_SESSION)) {
	session_start();
}
date_default_timezone_set('America/Fortaleza');
$descricao = $_POST['descricao'];
$cod_reserva = $_REQUEST['codigo'];
$data_check = date('Y-m-d');
$cod_usuario = $_SESSION['cod_usuario'];

if ((empty($data_check)) || (empty($cod_usuario)) || (empty($cod_reserva)) || (empty($descricao)) ){
	 "<script type='text/javascript'> alert ('DADOS INVÁLIDOS!'); window.location.href='javascript:history.back()'; </script>";
}else{
	$sql = "INSERT INTO t_check (info_check, data_check, t_reserva_cod_reserva, t_usuario_cod_usuario, realiza_check) VALUES ('$descricao', '$data_check', '$cod_reserva', '$cod_usuario', '1')";
	$result = mysqli_query($conexao, $sql);
	$sql0= "UPDATE t_reserva SET reserva_checada='1' WHERE t_reserva_cod_reserva = $cod_reserva";
	$result0 = mysqli_query($conexao, $sql0);
	if (!$result and !$result0) {
		echo "<script type='text/javascript'> alert ('Não foi possível cadastrar check na tabela t_check!'); window.location.href='../itens.php'; </script>";
	}else{
		$sql1 = "SELECT cod_check FROM t_check  WHERE t_reserva_cod_reserva = '$cod_reserva' AND t_usuario_cod_usuario ='$cod_usuario'";
		$result1 = mysqli_query($conexao, $sql1);
		$buscar = mysqli_fetch_array($result1);
		$cod = $buscar['cod_check'];
		if (!$result1) {
			echo "<script type='text/javascript'> alert ('Não foi possível realizar consulta na tabela t_check!'); window.location.href='../itens.php'; </script>";
		}else{
			$sql2 = "UPDATE t_reserva SET t_check_cod_check = '$cod'";
			$result2 = mysqli_query($conexao, $sql2);
			if (!$result2) {

				$sql3= "DELETE * FROM t_check WHERE cod_check = '$cod'";
				$result3 = mysqli_query($conexao, $sql3);
				if (!$result3) {
					echo "<script type='text/javascript'> alert ('Não foi possível realizar consulta na tabela t_check!'); window.location.href='../itens.php'; </script>";
				}else{
					echo "<script type='text/javascript'> alert ('Não foi possível realizar check!'); window.location.href='../itens.php'; </script>";
				}
			}else{
				echo "<script type='text/javascript'> alert ('Check realizado com sucesso!'); window.location.href='../itens.php'; </script>";
			}
		}
	}
}
?>
