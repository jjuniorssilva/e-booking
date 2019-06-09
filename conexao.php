<?php

$banco = "reserva_equip";
$usuarioDB = "root";
$senhaDB="";
$servidor = $_SERVER['HTTP_HOST'];
$conexao = mysqli_connect($servidor, $usuarioDB,$senhaDB, $banco);
	if (!$conexao) {
		die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
	}
?>