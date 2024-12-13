<?php
include 'config.php';

$id = $_GET['id']; // Ambil ID dari URL

// Hapus data penitipan berdasarkan ID
$sql = "DELETE FROM tb_penitipan WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: read_penitipan.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
