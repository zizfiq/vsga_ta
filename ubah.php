<?php
include 'db.php'; // Include the database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pendaftaran WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}

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

    $sql = "UPDATE pendaftaran SET 
            nama='$nama', 
            nomor_hp='$nomor_hp', 
            tempat='$tempat', 
            durasi=$durasi, 
            jumlah_peserta=$jumlah_peserta, 
            penginapan='$penginapan', 
            transportasi='$transportasi', 
            makanan='$makanan', 
            total_tagihan=$total_tagihan 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diubah!');</script>";
        echo "<script>window.location.href = 'kelola.php';</script>";
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
    <title>Ubah Pendaftaran Paket Wisata</title>
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
                <h1 class="h4 mb-4">Ubah Pendaftaran Paket Wisata</h1>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP:</label>
                        <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp" value="<?php echo $row['nomor_hp']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="tempat" class="form-label">Tempat:</label>
                        <select class="form-select" id="tempat" name="tempat" required>
                            <option value="wisata rafflesia" <?php if($row['tempat'] == "wisata rafflesia") echo "selected"; ?>>Wisata Rafflesia</option>
                            <option value="benteng marlborough" <?php if($row['tempat'] == "benteng marlborough") echo "selected"; ?>>Benteng Marlborough</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi Wisata (hari):</label>
                        <input type="number" class="form-control" id="durasi" name="durasi" value="<?php echo $row['durasi']; ?>" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_peserta" class="form-label">Jumlah Peserta:</label>
                        <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" value="<?php echo $row['jumlah_peserta']; ?>" min="1" required>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="penginapan" name="penginapan" value="1000000" <?php if($row['penginapan'] == "Ya") echo "checked"; ?>>
                        <label class="form-check-label" for="penginapan">Penginapan (1.000.000)</label>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="transportasi" name="transportasi" value="1200000" <?php if($row['transportasi'] == "Ya") echo "checked"; ?>>
                        <label class="form-check-label" for="transportasi">Transportasi (1.200.000)</label>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="makanan" name="makanan" value="500000" <?php if($row['makanan'] == "Ya") echo "checked"; ?>>
                        <label class="form-check-label" for="makanan">Makanan (500.000)</label>
                    </div>

                    <div class="mb-3">
                        <label for="total_tagihan" class="form-label">Total Tagihan:</label>
                        <input type="text" class="form-control" id="total_tagihan" name="total_tagihan" value="<?php echo $row['total_tagihan'];  ?>" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <a href="kelola.php" class="btn btn-danger ms-2">Batal</a>
                </form>
            </div>
            <div class="card-footer text-end">
                <a href="kelola.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
