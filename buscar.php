<?php
include 'db.php';

$distrito = isset($_GET['distrito']) ? trim($_GET['distrito']) : '';
$rango = isset($_GET['rango']) ? trim($_GET['rango']) : '';

// Construir consulta base
$sql = "SELECT * FROM equipos WHERE 1";

// Filtro distrito
if (!empty($distrito)) {
    $sql .= " AND distrito LIKE '%$distrito%'";
}

// Filtro rango edad (ej: 17-20)
if (!empty($rango) && strpos($rango, '-') !== false) {
    list($min, $max) = explode('-', $rango);
    $min = intval($min);
    $max = intval($max);
    $sql .= " AND edad_min >= $min AND edad_max <= $max";
}

$result = $conn->query($sql);

$equipos = [];
while ($row = $result->fetch_assoc()) {
    $equipos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($equipos);

$conn->close();
?>
