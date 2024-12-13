<?php
session_start();
include 'config.php';

$message = "";

// Proses form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    // Query untuk cek username dan password
    $stmt = $conn->prepare("SELECT id, username, password FROM tb_admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $db_username, $db_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Verifikasi password
        if (password_verify($password, $db_password)) {
            // Jika berhasil, set session dan redirect
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $db_username;
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Password salah!";
        }
    } else {
        $message = "Username tidak ditemukan!";
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
    <title>Login JokiGame</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-900 text-white">

<div class="flex justify-center items-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Masuk ke JokiGame</h2>
        <?php if ($message): ?>
            <div class="text-center text-red-600 mb-4"><?= $message; ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="mb-4">
                <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded bg-gray-700 text-white" required>
            </div>
            <button type="submit" class="w-full bg-gray-600 text-white p-2 rounded hover:bg-gray-500">Masuk</button>
        </form>
        <div class="mt-4 text-center">
            <a href="register.php" class="text-green-600 hover:text-green-500">Belum punya akun? Daftar</a>
        </div>
    </div>
</div>

</body>
</html>
