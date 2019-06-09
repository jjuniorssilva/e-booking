<?php
include "../Verificasessao.php";
include "../conexao.php";
if (!isset($_SESSION)) {
	session_start();
}
$cod_reserva = $_POST['cancelarReserva'];

$sql_cancelar = "UPDATE t_reserva SET cancela_reserva='1' WHERE cod_reserva = '$cod_reserva'";
$result_cancelar = mysqli_query($conexao, $sql_cancelar);

if(!$result_cancelar){
	echo "<script type='text/javascript'>alert ('NÃO FOI POSSIVEL EFETUAR CONSULTA!'); window.location.href='javascript:history.back()'</script>";
}else{
	mysqli_commit($conexao);
	mysqli_close($conexao);
	echo "<script type='text/javascript'> alert ('RESERVA CANCELADA!'); window.location.href='reservas_feitas.php'</script>";
}

?>