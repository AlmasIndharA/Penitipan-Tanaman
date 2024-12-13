<?php
// Periksa apakah formulir di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan lakukan validasi sederhana
    $nama = htmlspecialchars($_POST['nama']);
    $jenis_tanaman = htmlspecialchars($_POST['jenis_tanaman']);
    $durasi = intval($_POST['durasi']);

    // Contoh pemrosesan data (misalnya, simpan ke database)
    // Di sini, hanya mencetak data untuk demo
    $message = "Pendaftaran berhasil untuk $nama dengan jenis tanaman $jenis_tanaman selama $durasi hari.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlantCare Services</title>
    <link rel="stylesheet" href="service.css">
</head>
<body>
    <div class="service-container">
        <h2>Layanan Penitipan Tanaman</h2>
        <p>Silakan isi detail untuk layanan penitipan tanaman:</p>
        
        <?php if (!empty($message)): ?>
            <div class="success-message"><?= $message; ?></div>
        <?php endif; ?>
        
        <form id="formService" action="service.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Anda:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="jenis_tanaman">Jenis Tanaman:</label>
                <input type="text" id="jenis_tanaman" name="jenis_tanaman" required>
            </div>
            <div class="form-group">
                <label for="durasi">Durasi Penitipan (hari):</label>
                <input type="number" id="durasi" name="durasi" required>
            </div>
            <div class="form-group">
                <button type="submit" id="submitBtn">Daftar Penitipan</button>
            </div>
        </form>

        <div class="back-link">
            <a href="index.php">Kembali ke Home</a>
        </div>
    </div>

    <!-- Modal Pop-up (JavaScript untuk klien-side) -->
    <div id="modalPopup" class="modal" style="display: <?= isset($message) ? 'block' : 'none'; ?>;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p><?= isset($message) ? htmlspecialchars($message) : 'Pendaftaran Berhasil!'; ?></p>
            <button id="okBtn" onclick="closeModal()">OK</button>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('modalPopup').style.display = 'none';
        }
    </script>
</body>
</html>
