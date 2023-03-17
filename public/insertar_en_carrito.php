<?php

use App\Tablas\Articulo;

session_start();

require '../vendor/autoload.php';

$etiqueta = obtener_get('etiqueta');

try {
    $id = obtener_get('id');

    if ($id === null) {
        return volver();
    }

    $articulo = Articulo::obtener($id);

    if ($articulo === null) {
        return volver();
    }

    if ($articulo->getStock() <= 0) {
        $_SESSION['error'] = 'No hay existencias suficientes.';
        return volver();
    }

    $carrito = unserialize(carrito());
    $carrito->insertar($id);
    $_SESSION['carrito'] = serialize($carrito);

    $params = "";
    if ($etiqueta !== null) {
        $params .= '&etiqueta=' . hh($etiqueta);
    }

} catch (ValueError $e) {
    // TODO: mostrar mensaje de error en un Alert
}


header("Location: /index.php?$params");
