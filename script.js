// Fungsi untuk menampilkan snackbar
function showSnackbar(message) {
    const snackbar = document.getElementById("snackbar");
    snackbar.textContent = message;  // Mengubah teks snackbar
    snackbar.classList.remove("hidden");
    snackbar.classList.add("show");

    // Menghilangkan snackbar setelah beberapa detik
    setTimeout(() => {
        snackbar.classList.remove("show");
        snackbar.classList.add("hidden");
    }, 3000); // 3000 ms atau 3 detik
}

// Contoh penggunaan snackbar saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    showSnackbar("Welcome to PlantCare!");
});
