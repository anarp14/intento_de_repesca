<?php
session_start();
require '../vendor/autoload.php';
// Obtener los datos del formulario de votación
$valoracion = $_GET['valoracion'];
$articulo_id = $_GET['articulo_id'];
$usuario_id = $_GET['usuario_id']; // Suponiendo que ya tienes el ID del usuario en una sesión

var_dump($valoracion);
var_dump($articulo_id);
var_dump($usuario_id);

$pdo = conectar();
// Insertar la valoración en la tabla de valoraciones
$sent = $pdo->prepare("INSERT INTO valoraciones (valoracion, usuario_id, articulo_id) VALUES (:valoracion, :usuario_id, :articulo_id)");
$sent->execute([$valoracion, $usuario_id, $articulo_id]);


$sent = $pdo->prepare("UPDATE articulos SET valoracion = :valoracion WHERE id = :id");
$sent->execute([$valoracion, $articulo_id]);

// Redirigir al usuario a la página del artículo
volver();

?>
