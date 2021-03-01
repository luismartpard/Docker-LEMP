<?php
session_start();
require_once '../Model/Producto.php';
//El siguiente codigo anterior a la vista es para comprobar si en la bd hay stock suficiente y corresponde con lo que hay en memoria
foreach ($_SESSION['productos'] as $prod => $cantidad) {
    $producto=Producto::getProductoById($prod);
    if ($producto->getStock()<$cantidad) {
        echo "<script>alert (\"producto: ".$producto->getNombre().", sin stock suficiente, disponibles: ".$producto->getStock()." unidades\");</script>";
        if ($producto->getStock()>0) {
            $diferencia=$cantidad-$producto->getStock(); //cantidad que falta
            $_SESSION['productos'][$prod]-=$producto->getStock(); //se actualiza unidades de la cesta al stock disponible real
            $_SESSION['cantidad']-=$diferencia;
            $_SESSION['total']-=$diferencia*$producto->getPrecio();
        }else{
            $_SESSION['cantidad']-=$cantidad;
            $_SESSION['total']-=$cantidad*$producto->getPrecio();
            unset($_SESSION['productos'][$prod]);
        }
        setcookie('cantidad', $_SESSION['cantidad'], time() + 24 * 3600);
        setcookie('total', $_SESSION['total'], time() + 24 * 3600);
        setcookie('productos', serialize($_SESSION['productos']), time() + 24 * 3600);
    }
}
include_once '../View/contenidoCesta.php';
