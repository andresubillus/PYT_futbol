
<?php
include 'db.php';
$result = $conn->query("SELECT nombre, distrito, rango, jugadores, celular FROM equipos");
$equipos = array();
while ($row = $result->fetch_assoc()) {
    $equipos[] = $row;
}
header('Content-Type: application/json');
echo json_encode($equipos);
?>
