<?php
session_start();
include 'config.php';

$message = "";

// Proses form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Periksa apakah username atau email sudah ada di tb_admin
    $stmt = $conn->prepare("SELECT id FROM tb_admin WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = "Email atau Username sudah digunakan!";
    } else {
        // Simpan data ke tabel tb_admin
        $stmt = $conn->prepare("INSERT INTO tb_admin (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $username, $password);

        if ($stmt->execute()) {
            $message = "Registrasi berhasil! Silakan login.";
            header("Location: login.php");
            exit();
        } else {
            $message = "Registrasi gagal: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Registrasi JokiGame</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-900 text-white">

<div class="flex justify-center items-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Registrasi JokiGame</h2>
        <?php if ($message): ?>
            <div class="text-center text-red-600 mb-4"><?= $message; ?></div>
        <?php endif; ?>
        <form method="POST" action="register.php">
            <div class="mb-4">
                <input type="email" name="email" placeholder="Email" class="w-full p-2 border rounded bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded bg-gray-700 text-white" required>
            </div>
            <button type="submit" class="w-full bg-gray-600 text-white p-2 rounded hover:bg-gray-500">Daftar</button>
        </form>
        <div class="mt-4 text-center">
            <a href="login.php" class="text-green-600 hover:text-green-500">Sudah punya akun? Masuk</a>
        </div>
    </div>
</div>

</body>
</html>
