<?php
session_start();
// Obtener los datos del formulario de votación
$valoracion = $_GET('valoracion');
$articulo_id = $_GET('articulo_id');
$usuario_id = $_SESSION['usuario_id']; // Suponiendo que ya tienes el ID del usuario en una sesión

// Insertar la valoración en la tabla de valoraciones
$sent = $pdo->prepare("INSERT INTO valoraciones (valoracion, usuario_id, articulo_id) VALUES (:valoracion, :usuario_id, :articulo_id)");
$sent->execute([$valoracion, $usuario_id, $articulo_id]);

// Calcular la valoración promedio del artículo y actualizar la tabla de artículos
$sent = $pdo->prepare("SELECT AVG(valoracion) AS valoracion_media FROM valoraciones WHERE articulo_id = :articulo_id");
$sent->execute([$articulo_id]);
$resultado = $sent->fetch(PDO::FETCH_ASSOC);

$valoracion_media = $resultado['valoracion_media'];

$sent = $pdo->prepare("UPDATE articulos SET valoracion = :valoracion WHERE id = :id");
$sent->execute([$valoracion_media, $articulo_id]);

// Redirigir al usuario a la página del artículo
volver();

?>
