<?php
session_start();
require_once '../Model/Producto.php';
foreach ($_SESSION['productos'] as $prod => $cantidad) {
	$producto=Producto::getProductoById($prod);

	$diferencia=$producto->getStock()-$cantidad;
	if ($diferencia>=0) {
		$producto->vender($cantidad);
	}else if ($producto->getStock()>0){
		$producto->vender($producto->getStock());
		echo "<script>alert (\"Unidades insuficientes del producto: ".$producto->getNombre().", seran vendidas solo ".$producto->getStock()." unidades\");</script>";
	}else{
		echo "<script>alert (\"No hay unidades del producto: ".$producto->getNombre().", así que no será vendido\");</script>";
	}  
}
session_destroy();
setcookie("total", NULL, -1);
setcookie("cantidad", NULL, -1);
setcookie("productos", NULL, -1);
include '../View/compraFinalizada.php';
