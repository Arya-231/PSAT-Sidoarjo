</div> <!-- END CONTENT -->

<footer class="footer">
    © <?= date("Y") ?> OKKP / PSAT Kabupaten Sidoarjo — Sistem Informasi
</footer>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartSertifikat');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Aktif', 'Kadaluarsa', 'Akan Habis'],
        datasets: [{
            data: [27, 2, 4],
        }]
    }
});
</script>
<script>
function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("active");
    document.querySelector(".sidebar-overlay").classList.toggle("active");
}
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const currentPage = window.location.pathname.split("/").pop();
    const menuItems = document.querySelectorAll(".sidebar a");

    menuItems.forEach(item => {
        const linkPage = item.getAttribute("href");

        if (currentPage === linkPage) {
            item.classList.add("active");
        } else {
            item.classList.remove("active");
        }
    });
});
</script>

</body>
</html>
