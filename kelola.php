<?php
include 'db.php';

$sql = "SELECT * FROM pendaftaran";
$result = $conn->query($sql);

function formatRupiah($angka){
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pendaftaran Paket Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f5f9;
        }
        .table {
            font-size: 12px;
        }
        th, td {
            padding: 4px;
        }
        .table thead th {
            white-space: nowrap;
        }
        .table tbody td {
            white-space: nowrap;
        }
        .btn-sm {
            padding: 2px 6px;
            font-size: 10px;
        }
        .card-header h1 {
            font-size: 18px;
        }
        .card-body {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-4">Kelola Pendaftaran Paket Wisata</h1>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Nomor HP</th>
                            <th>Tempat</th>
                            <th>Durasi</th>
                            <th>Jumlah Peserta</th>
                            <th>Penginapan</th>
                            <th>Transportasi</th>
                            <th>Makanan</th>
                            <th>Total Tagihan</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php $nomor = 1; ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['nomor_hp'] ?></td>
                                    <td><?= $row['tempat'] ?></td>
                                    <td><?= $row['durasi'] ?></td>
                                    <td><?= $row['jumlah_peserta'] ?></td>
                                    <td><?= $row['penginapan'] ?></td>
                                    <td><?= $row['transportasi'] ?></td>
                                    <td><?= $row['makanan'] ?></td>
                                    <td><?= formatRupiah($row['total_tagihan']) ?></td>
                                    <td><?= $row['tanggal_daftar'] ?></td>
                                    <td>
                                        <div class="d-inline-block">
                                            <a href="ubah.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Ubah</a>
                                        </div>
                                        <div class="d-inline-block">
                                            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="12" class="text-center">Tidak ada data yang tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
