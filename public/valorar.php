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

// Verificar si el usuario ya ha votado en la tabla de valoraciones
$sent = $pdo->prepare("SELECT * FROM valoraciones WHERE usuario_id = :usuario_id AND articulo_id = :articulo_id");
$sent->execute(['usuario_id' => $usuario_id, 'articulo_id' => $articulo_id]);

if ($sent->rowCount() > 0) {
  // Si el usuario ya ha votado, actualizar su votación en la tabla de valoraciones
  $sent = $pdo->prepare("UPDATE valoraciones SET valoracion = :valoracion WHERE usuario_id = :usuario_id AND articulo_id = :articulo_id");
  $sent->execute(['valoracion' => $valoracion, 'usuario_id' => $usuario_id, 'articulo_id' => $articulo_id]);
} else {
  // Si el usuario no ha votado todavía, insertar su votación en la tabla de valoraciones
  $sent = $pdo->prepare("INSERT INTO valoraciones (valoracion, usuario_id, articulo_id) VALUES (:valoracion, :usuario_id, :articulo_id)");
  $sent->execute(['valoracion' => $valoracion, 'usuario_id' => $usuario_id, 'articulo_id' => $articulo_id]);
}

// Redirigir al usuario a la página del artículo
volver();
