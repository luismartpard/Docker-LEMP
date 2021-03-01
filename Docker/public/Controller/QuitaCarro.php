<?php
session_start();
if (isset($_GET['quitapro'])) {
    require_once '../Model/Producto.php';
    $prod = $_GET['quitapro'];
    if ($_SESSION['productos'][$prod]==1) {
        unset($_SESSION['productos'][$prod]);
    }else{
        $_SESSION['productos'][$prod]--;
    }
    $_SESSION['cantidad']--;
    $precio=Producto::getProductoById($prod)->getPrecio();
    $_SESSION['total'] -= $precio;
    setcookie('cantidad', $_SESSION['cantidad'], time() + 24 * 3600);
    setcookie('total', $_SESSION['total'], time() + 24 * 3600);
    setcookie($prod, $_SESSION['productos'][$prod], time() + 24 * 3600);
}
header('Location:Cesta.php');
