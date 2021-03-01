<?php 
require_once 'M../odel/Producto.php';
  //$producto = new Producto($_POST['prod']); 
  //recuperamos el producto de la BD en vez de crearlo solo con el codigo porque necesitamos el campo imagen
  $producto = Producto::getProductoById($_POST['prod']);
  if (file_exists('../View/imagen/'.$producto->getImagen()) ) {
    unlink('../View/imagen/'.$producto->getImagen());
  }
  $producto->delete();
  header("Location: index.php");
