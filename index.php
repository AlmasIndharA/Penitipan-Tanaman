<?php
session_start();
include 'config.php';

$snackbarMessage = "Selamat datang di JokiGame!";
$message = "";

// Proses pengiriman formulir untuk layanan joki akun game
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_account = htmlspecialchars($_POST['game_account']);
    $service_type = htmlspecialchars($_POST['service_type']);
    $duration = (int) $_POST['duration'];
    $status = "Sedang Diproses"; // Status default

    // Menyisipkan data ke dalam tb_joki_services
    $stmt = $conn->prepare("INSERT INTO tb_joki_services (game_account, service_type, duration, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $game_account, $service_type, $duration, $status);

    if ($stmt->execute()) {
        $message = "Permintaan layanan berhasil dikirim!";
    } else {
        $message = "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JokiGame</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">

    <!-- Snackbar -->
    <div id="snackbar" class="hidden fixed bottom-4 right-4 bg-gray-700 text-white py-3 px-6 rounded-lg shadow-lg">
        <?= htmlspecialchars($snackbarMessage); ?>
    </div>

    <header class="bg-gray-800 shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img alt="Logo JokiGame" class="h-10 w-10" src="c:\laragon\www\KOTREKSTORENEW\Gambar\logo.jpg"/>
                <span class="ml-2 text-xl font-bold text-white">JokiGame</span>
            </div>
            <nav class="flex space-x-4 ml-auto">
                <a class="text-gray-300 hover:text-white" href="#">Layanan</a>
                <a class="text-gray-300 hover:text-white" href="#">Harga</a>
                <a class="text-gray-300 hover:text-white" href="#">Beranda</a>
                <a class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600" href="login.php">Masuk</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-6">
        <section class="bg-gray-700 text-white rounded-lg p-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-4">Selamat datang di JokiGame</h1>
                <p class="mb-6">
                    JokiGame menawarkan layanan joki akun game profesional. Apakah Anda perlu naik level, mencapai peringkat lebih tinggi, atau menyelesaikan tantangan sulit? Tim ahli kami siap membantu!
                </p>
                <a class="bg-gray-800 text-white px-4 py-2 rounded font-bold hover:bg-gray-600" href="#">Mulai Sekarang</a>
            </div>
            <img alt="Layanan Joki Game" class="rounded-lg" src="https://example.com/game-boosting-image.jpg" width="200"/>
        </section>

        <section class="mt-12">
            <h2 class="text-2xl font-bold text-center mb-8">Layanan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Kartu Layanan 1 -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img alt="Peningkatan Peringkat" class="rounded-lg mb-4" src="" width="300"/>
                    <h3 class="text-xl font-bold mb-2">Peningkatan Peringkat</h3>
                    <p>Dapatkan akun game Anda ditingkatkan ke peringkat lebih tinggi dengan cepat dan aman bersama joki profesional kami.</p>
                </div>

                <!-- Kartu Layanan 2 -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img alt="Leveling" class="rounded-lg mb-4" src="https://example.com/leveling.jpg" width="300"/>
                    <h3 class="text-xl font-bold mb-2">Leveling</h3>
                    <p>Perlu menaikkan level akun Anda? Biarkan kami membantu Anda mencapai level maksimal tanpa perlu repot.</p>
                </div>

                <!-- Kartu Layanan 3 -->
                <div class="bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <img alt="Penyelesaian Tantangan" class="rounded-lg mb-4" src="https://example.com/challenge-completion.jpg" width="300"/>
                    <h3 class="text-xl font-bold mb-2">Penyelesaian Tantangan</h3>
                    <p>Selesaikan tantangan dan pencapaian dalam game yang sulit dengan bantuan kami.</p>
                </div>
            </div>
        </section>

        <!-- Formulir Permintaan Layanan Joki Game -->
        <section class="mt-12">
            <h2 class="text-2xl font-bold text-center mb-6">Permintaan Layanan Joki Game</h2>
            <?php if ($message): ?>
                <div class="text-center text-gray-300 mb-4"><?= $message; ?></div>
            <?php endif; ?>
            <div class="flex justify-center">
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96">
                    <form method="POST" action="">
                        <div class="mb-4">
                            <input type="text" name="game_account" placeholder="Nama Akun Game" class="w-full p-2 border rounded bg-gray-900 text-white" required>
                        </div>
                        <div class="mb-4">
                            <select name="service_type" class="w-full p-2 border rounded bg-gray-900 text-white" required>
                                <option value="Peningkatan Peringkat">Peningkatan Peringkat</option>
                                <option value="Leveling">Leveling</option>
                                <option value="Penyelesaian Tantangan">Penyelesaian Tantangan</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <input type="number" name="duration" placeholder="Durasi (dalam hari)" class="w-full p-2 border rounded bg-gray-900 text-white" required>
                        </div>
                        <button type="submit" class="w-full bg-gray-700 text-white p-2 rounded hover:bg-gray-600">Permintaan Layanan</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- JavaScript -->
    <script>
        // Menampilkan snackbar
        document.addEventListener("DOMContentLoaded", () => {
            const snackbar = document.getElementById("snackbar");
            snackbar.classList.remove("hidden");
            setTimeout(() => snackbar.classList.add("hidden"), 3000);
        });
    </script>
</body>
</html>
