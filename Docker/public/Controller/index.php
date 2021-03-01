<?php
session_start();
require_once '../Model/Producto.php';
// Obtiene todos los articulos
$data['productos'] = Producto::getProductos();
//comprueba si hay productos en la cesta almacenados en cookies
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
    $_SESSION['total']     = 0;
    $_SESSION['cantidad']  = 0;
    if (isset($_COOKIE['cantidad'])) {
        $_SESSION['productos']=unserialize($_COOKIE['productos']);
        $_SESSION['total']    = $_COOKIE['total'];
        $_SESSION['cantidad'] = $_COOKIE['cantidad'];
    } else {
        setcookie('cantidad', 0, time() + 24 * 3600);
        setcookie('total', 0, time() + 24 * 3600);
        setcookie('productos', serialize($_SESSION['productos']), time() + 24 * 3600);
    }
}
//carga la vista con el listado de productos
include '../View/Carrito.php';

