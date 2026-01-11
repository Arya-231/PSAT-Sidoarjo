<?php
$title = "Daftar Pelaku Usaha / Produk";
$custom_css = "data.css";

include "../includes/config.php";
include 'header.php';
include 'sidebar.php';

/* ===============================
   AMBIL FILTER & SEARCH
================================ */
$search = '';
$statusFilter = '';
$where = [];

if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $where[] = "(nama_unit LIKE '%$search%' OR nama_komoditas LIKE '%$search%')";
}

if (!empty($_GET['status'])) {
    $statusFilter = mysqli_real_escape_string($conn, $_GET['status']);
    $where[] = "status = '$statusFilter'";
}

$whereSQL = '';
if (!empty($where)) {
    $whereSQL = "WHERE " . implode(" AND ", $where);
}

/* ===============================
   QUERY DATA
================================ */
$q = mysqli_query(
    $conn,
    "SELECT * FROM registrasi_psat $whereSQL ORDER BY created_at DESC"
);
?>

<div class="content-wrapper">
<div class="page-container">

    <!-- SEARCH + FILTER -->
    <form method="GET" class="toolbar">
        <input
            type="text"
            name="search"
            class="search-box"
            placeholder="Cari pelaku usaha / produk..."
            value="<?= htmlspecialchars($search) ?>"
        >

        <select name="status" class="filter-status" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="aktif" <?= ($statusFilter === 'aktif') ? 'selected' : '' ?>>Aktif</option>
            <option value="kadaluarsa" <?= ($statusFilter === 'kadaluarsa') ? 'selected' : '' ?>>Kadaluarsa</option>
            <option value="menunggu" <?= ($statusFilter === 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
        </select>
    </form>

    <!-- TABEL -->
    <div class="table-wrapper">
        <table class="main-table">
            <thead>
                <tr>
                    <th>Pelaku Usaha</th>
                    <th>Produk</th>
                    <th>Label</th>
                    <th>Tgl Terbit</th>
                    <th>Tgl Berakhir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (mysqli_num_rows($q) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($q)): ?>

                        <?php
                        /* ===============================
                           LABEL VISUAL
                        ================================ */
                        $label = strtolower($row['label']);
                        $labelClass = 'badge-default';

                        if ($label === 'hijau') {
                            $labelClass = 'badge-hijau';
                        } elseif ($label === 'putih') {
                            $labelClass = 'badge-putih';
                        }

                        /* ===============================
                           STATUS
                        ================================ */
                        $status = $row['status'] ?? 'menunggu';
                        ?>

                        <tr>
                            <td><?= htmlspecialchars($row['nama_unit']) ?></td>
                            <td><?= htmlspecialchars($row['nama_komoditas']) ?></td>

                            <td>
                                <span class="badge <?= $labelClass ?>">
                                    <?= strtoupper(htmlspecialchars($row['label'])) ?>
                                </span>
                            </td>

                            <td><?= date('d-m-Y', strtotime($row['tgl_terbit'])) ?></td>

                            <td>
                                <?= !empty($row['tgl_berakhir'])
                                    ? date('d-m-Y', strtotime($row['tgl_berakhir']))
                                    : '-' ?>
                            </td>

                            <td>
                                <span class="badge badge-<?= $status ?>">
                                    <?= ucfirst($status) ?>
                                </span>
                            </td>

                            <td class="actions">
                                <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-detail">Detail</a>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="delete.php?id=<?= $row['id'] ?>"
                                   class="btn btn-delete"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>

                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center;">
                            Data tidak ditemukan
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

</div>
</div>

<?php include "footer.php"; ?>
