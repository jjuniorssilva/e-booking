<?php
if (!isset($_SESSION)) {
	 session_start();
}
 if (!isset($_SESSION['nome_usuario']) && (!isset($_SESSION['cod_usuario']))) {
 	header('location: index.php');
 }
?>