<?php
include 'config.php';

$message = "";
$id = $_GET['id']; // Ambil ID dari URL

// Ambil data penitipan berdasarkan ID
$sql = "SELECT * FROM tb_penitipan WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$penitipan = $result->fetch_assoc();

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis_tanaman = htmlspecialchars($_POST['jenis_tanaman']);
    $durasi = (int) $_POST['durasi'];
    $status = htmlspecialchars($_POST['status']);

    $sql = "UPDATE tb_penitipan SET jenis_tanaman = ?, durasi = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisi", $jenis_tanaman, $durasi, $status, $id);

    if ($stmt->execute()) {
        $message = "Data penitipan berhasil diperbarui!";
        header("Location: read_penitipan.php");
        exit();
    } else {
        $message = "Terjadi kesalahan: " . $stmt->error;
    }
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Update Penitipan Tanaman</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Penitipan Tanaman</h2>
        <?php if ($message): ?>
            <div class="text-center text-green-600 mb-4"><?= $message; ?></div>
        <?php endif; ?>
        <form method="POST" action="update_penitipan.php?id=<?= $penitipan['id']; ?>">
            <div class="mb-4">
                <input type="text" name="jenis_tanaman" value="<?= $penitipan['jenis_tanaman']; ?>" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <input type="number" name="durasi" value="<?= $penitipan['durasi']; ?>" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <input type="text" name="status" value="<?= $penitipan['status']; ?>" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white p-2 rounded">Update Penitipan</button>
        </form>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
