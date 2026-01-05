<footer class="site-footer bg-dark-green text-white pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row gy-4">

            <!-- IDENTITAS RESMI -->
            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold mb-3">PSAT Kabupaten Sidoarjo</h5>
                <p class="mb-2">
                    Layanan informasi resmi Pangan Segar Asal Tumbuhan (PSAT)  
                    di bawah naungan Dinas Pangan dan Pertanian Kabupaten Sidoarjo.
                </p>
                <p class="mb-0">
                    Mendukung keamanan pangan dan peningkatan mutu produk lokal.
                </p>
            </div>

            <!-- MENU -->
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3">Menu</h6>
                <ul class="footer-list">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="informasi.php">Informasi PSAT</a></li>
                    <li><a href="alur.php">Alur Sertifikat</a></li>
                    <li><a href="hak-kewajiban.php">Hak & Kewajiban</a></li>
                </ul>
            </div>

            <!-- HUBUNGI KAMI -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">Kontak</h6>
                <ul class="footer-contact">
                    <li><i class="bi bi-geo-alt"></i> Sidoarjo Jl. Pahlawan KM.2 Sidoarjo</li>
                    <li><i class="bi bi-telephone"></i> 031-8941252</li>
                    <li><i class="bi bi-envelope"></i> panperta@sidoarjokab.go.id</li>
                </ul>
            </div>

            <!-- SOSIAL MEDIA -->
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3">Ikuti Kami</h6>
                <div class="social-links">
                    <a href="https://www.facebook.com/people/Dinas-Pertanian-Kab-Sidoarjo/pfbid02Z2hcUkxKQAsxfP1kdcXiBwbt2ELzfGQ2U8AtuTNmoYYJ1UAn2CTPdyFJ38N5y4gzl/"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/dispangtan.sidoarjo/"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/@dispangtansidoarjo/featured"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

        </div>

        <hr class="my-4">

        <div class="text-center small">
            &copy; <?= date('Y'); ?> PSAT Kabupaten Sidoarjo — Semua Hak Dilindungi.
        </div>
    </div>
</footer>

<script>
  const navToggle = document.getElementById("navToggle");
  const leftMenu = document.querySelector(".nav-left");
  const rightMenu = document.querySelector(".nav-right");

  navToggle.addEventListener("click", () => {
    leftMenu.classList.toggle("show");
    rightMenu.classList.toggle("show");
  });
</script>

<script src="assets/js/panduan.js"></script>

<script>
  const menuToggle = document.getElementById("menuToggle");
  const mobileMenu = document.getElementById("mobileMenu");

  menuToggle.onclick = () => {
    mobileMenu.classList.toggle("open");
  };
</script>

</body>
</html>
