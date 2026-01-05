<?php
$title = "Panduan";
$custom_css = "panduan.css";

include 'includes/config.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

<section class="panduan-container">
  <div class="panduan-wrapper">

    <div class="panduan-image">
      <img src="crousent.jpeg" alt="Panduan PSAT" id="openPanduan">
    </div>

    <div class="panduan-text">
      <h2>Petunjuk Pengemasan & Pelabelan PSAT</h2>
      <p>
        Panduan ini membantu pelaku usaha PSAT memahami standar pengemasan
        dan pelabelan yang aman, higienis, dan sesuai ketentuan pemerintah.
        Disajikan secara visual dan interaktif agar mudah dipahami.
      </p>

      <button class="btn-buka-panduan" id="openPanduanBtn">
        📖 Buka Panduan Lengkap
      </button>
    </div>

  </div>
</section>

<!-- MODAL -->
<div class="panduan-modal" id="panduanModal">
  <div class="panduan-modal-content">
    <span class="panduan-close" id="closePanduan">&times;</span>

    <h3 class="modal-title">Panduan Pengemasan & Pelabelan PSAT</h3>

    <div id="flipbook">
      <p class="flipbook-placeholder">
        📄 Flipbook / PDF Panduan akan ditampilkan di sini
      </p>
    </div>
  </div>
</div>

<script>
const modal = document.getElementById('panduanModal');
const openBtn = document.getElementById('openPanduanBtn');
const openImg = document.getElementById('openPanduan');
const closeBtn = document.getElementById('closePanduan');

function openModal() {
  modal.classList.add('show');
}

function closeModal() {
  modal.classList.remove('show');
}

openBtn.onclick = openModal;
openImg.onclick = openModal;
closeBtn.onclick = closeModal;

window.onclick = function(e) {
  if (e.target === modal) closeModal();
};
</script>

<?php include 'includes/footer.php'; ?>
