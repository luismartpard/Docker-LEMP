<?php
session_start();
require_once '../Model/Producto.php';
if (isset($_POST['prod'])) {
    $prod = $_POST['prod'];
    $producto=Producto::getProductoById($prod);
    if ($producto->getStock()-$_SESSION['productos'][$prod]>0) {
        if (isset($_SESSION['productos'][$prod])) {
            $_SESSION['productos'][$prod]++;
        }else{
            $_SESSION['productos'][$prod]=1;
        }
        $_SESSION['cantidad']++;
        $_SESSION['total'] += $producto->getPrecio();
        setcookie('cantidad', $_SESSION['cantidad'], time() + 24 * 3600);
        setcookie('total', $_SESSION['total'], time() + 24 * 3600);
        setcookie('productos', serialize($_SESSION['productos']), time() + 24 * 3600);
    }
}
header('Location:index.php');
