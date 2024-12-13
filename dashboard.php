<?php
// Mulai sesi untuk mengelola pengguna (opsional)
session_start();

// Contoh nama pengguna untuk ditampilkan (dapat diganti dengan data dari database)
$userName = "Pengguna";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Plant Care</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 w-64 p-4 flex flex-col justify-between">
            <div>
                <div class="text-white text-2xl font-bold mb-8">Plant Care</div>
                <nav>
                    <a href="dashboard.php" class="flex items-center text-white py-2 px-4 rounded hover:bg-gray-700">
                        <i class="fas fa-th-large mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="read_penitipan.php" class="flex items-center text-white py-2 px-4 rounded hover:bg-gray-700 mt-2">
                        <i class="fas fa-box mr-3"></i>
                        <span>Kategori</span>
                    </a>
                    <a href="services.php" class="flex items-center text-white py-2 px-4 rounded hover:bg-gray-700 mt-2">
                        <i class="fas fa-cogs mr-3"></i>
                        <span>Layanan</span>
                    </a>
                    <a href="logout.php" class="flex items-center text-white py-2 px-4 rounded hover:bg-gray-700 mt-2">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>
            <div class="mt-auto">
                <div class="text-white text-sm">Selamat datang, <?= htmlspecialchars($userName); ?>!</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Plant Care</h2>
                    <p>Kelola layanan tanaman Anda dengan mudah dan aman.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Kategori Tanaman</h2>
                    <p>Pilih berbagai kategori layanan yang tersedia untuk jenis tanaman.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-gray-700 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold mb-4">Laporan</h2>
                    <p>Melihat dan mengelola laporan transaksi dan layanan yang telah dilakukan.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
