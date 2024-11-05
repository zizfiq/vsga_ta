<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nomor_hp = $_POST['nomor_hp'];
    $tempat = $_POST['tempat'];
    $durasi = $_POST['durasi'];
    $jumlah_peserta = $_POST['jumlah_peserta'];

    $penginapan = isset($_POST['penginapan']) ? "Ya" : "Tidak";
    $transportasi = isset($_POST['transportasi']) ? "Ya" : "Tidak";
    $makanan = isset($_POST['makanan']) ? "Ya" : "Tidak";
    
    $total_tagihan = intval($_POST['total_tagihan']);

    $sql = "INSERT INTO pendaftaran (nama, nomor_hp, tempat, durasi, jumlah_peserta, penginapan, transportasi, makanan, total_tagihan)
            VALUES ('$nama', '$nomor_hp', '$tempat', $durasi, $jumlah_peserta, '$penginapan', '$transportasi', '$makanan', $total_tagihan)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil!');</script>";
        echo "<script>window.location.href = 'daftar.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Paket Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f5f9;
        }
    </style>
    <script src="assets/js/hitung.js" defer></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header">
                <h1 class="mb-4 h4">Pendaftaran Paket Wisata</h1>
            </div>
            <div class="card-body">
                <form id="wisataForm" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP:</label>
                        <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp" required>
                    </div>

                    <div class="mb-3">
                        <label for="tempat" class="form-label">Tempat:</label>
                        <select class="form-select" id="tempat" name="tempat" required>
                            <option value="wisata rafflesia">Wisata Alam Rafflesia</option>
                            <option value="benteng marlborough">Tour Benteng Marlborough</option>
                            <option value="benteng marlborough">Wisata Alam Pantai Panjang</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi Wisata (hari):</label>
                        <input type="number" class="form-control" id="durasi" name="durasi" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_peserta" class="form-label">Jumlah Peserta:</label>
                        <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" min="1" required>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="penginapan" name="penginapan" value="1000000">
                        <label class="form-check-label" for="penginapan">Penginapan (1.000.000)</label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="transportasi" name="transportasi" value="1200000">
                        <label class="form-check-label" for="transportasi">Transportasi (1.200.000)</label>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="makanan" name="makanan" value="500000">
                        <label class="form-check-label" for="makanan">Makanan (500.000)</label>
                    </div>

                    <div class="mb-3">
                        <label for="total_tagihan" class="form-label">Total Tagihan:</label>
                        <input type="text" class="form-control" id="total_tagihan" name="total_tagihan" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Daftar</button>
                </form>
            </div>
            <div class="card-footer text-end">
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
</body>
</html>
