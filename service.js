const form = document.getElementById('formService');
const modal = document.getElementById('modalPopup');
const closeBtn = document.querySelector('.close');
const okBtn = document.getElementById('okBtn');

// Fungsi menampilkan modal pop-up
function showModal() {
    modal.style.display = 'block';
}

// Menutup modal
function closeModal() {
    modal.style.display = 'none';
}

// Event listener untuk tombol OK dan close
okBtn.addEventListener('click', closeModal);
closeBtn.addEventListener('click', closeModal);

// Menampilkan modal ketika form disubmit
form.addEventListener('submit', function(event) {
    event.preventDefault();
    showModal();  // Menampilkan modal
});
