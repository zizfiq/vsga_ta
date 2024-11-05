<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "db_wisata";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { // cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$nama_paket     = "";
$gambar_url     = "";
$youtube_link   = "";
$deskripsi      = "";
$sukses         = "";
$error          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "DELETE FROM paket_wisata WHERE id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil menghapus data";
    } else {
        $error  = "Gagal menghapus data";
    }
}

if ($op == 'edit') {
    $id             = $_GET['id'];
    $sql1           = "SELECT * FROM paket_wisata WHERE id = '$id'";
    $q1             = mysqli_query($koneksi, $sql1);
    $r1             = mysqli_fetch_array($q1);
    $nama_paket     = $r1['nama_paket'];
    $gambar_url     = $r1['gambar_url'];
    $youtube_link   = $r1['youtube_link'];
    $deskripsi      = $r1['deskripsi'];

    if ($nama_paket == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { // untuk create dan update
    $nama_paket     = $_POST['nama_paket'];
    $gambar_url     = $_POST['gambar_url'];
    $youtube_link   = $_POST['youtube_link'];
    $deskripsi      = $_POST['deskripsi'];

    if ($nama_paket && $gambar_url && $youtube_link && $deskripsi) {
        if ($op == 'edit') { // untuk update
            $sql1   = "UPDATE paket_wisata SET nama_paket = '$nama_paket', gambar_url = '$gambar_url', youtube_link = '$youtube_link', deskripsi = '$deskripsi' WHERE id = '$id'";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { // untuk insert
            $sql1   = "INSERT INTO paket_wisata (nama_paket, gambar_url, youtube_link, deskripsi) VALUES ('$nama_paket', '$gambar_url', '$youtube_link', '$deskripsi')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error  = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Harap masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Paket Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1200px;
        }
        .card {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="mx-auto">
        <!-- Form untuk Create / Edit -->
<div class="card">
    <div class="card-header">
        Create / Edit Data
    </div>
    <div class="card-body">
        <?php if ($error) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
            </div>
        <?php header("refresh:5;url=kelola_paket.php"); } ?>
        <?php if ($sukses) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $sukses ?>
            </div>
        <?php header("refresh:5;url=kelola_paket.php"); } ?>
        <form action="" method="POST">
            <div class="mb-3 row">
                <label for="nama_paket" class="col-sm-2 col-form-label">Nama Paket</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_paket" name="nama_paket" value="<?php echo $nama_paket ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="gambar_url" class="col-sm-2 col-form-label">Gambar URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="gambar_url" name="gambar_url" value="<?php echo $gambar_url ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="youtube_link" class="col-sm-2 col-form-label">YouTube Link</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="youtube_link" name="youtube_link" value="<?php echo $youtube_link ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="deskripsi" name="deskripsi"><?php echo $deskripsi ?></textarea>
                </div>
            </div>
            <div class="col-12">
                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
            </div>
        </form>
    </div>
</div>

<!-- Tabel untuk Menampilkan Data -->
<div class="card">
    <div class="card-header text-white bg-secondary">
        Data Paket Wisata
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Paket</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Video</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2   = "SELECT * FROM paket_wisata ORDER BY id DESC";
                $q2     = mysqli_query($koneksi, $sql2);
                $urut   = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $id             = $r2['id'];
                    $nama_paket     = $r2['nama_paket'];
                    $gambar_url     = $r2['gambar_url'];
                    $youtube_link   = $r2['youtube_link'];
                    $deskripsi      = $r2['deskripsi'];

                    // Mendapatkan ID video dari URL YouTube
                    $youtube_id = '';
                    if (strpos($youtube_link, 'youtube.com') !== false) {
                        parse_str(parse_url($youtube_link, PHP_URL_QUERY), $youtube_params);
                        $youtube_id = $youtube_params['v'] ?? '';
                    } elseif (strpos($youtube_link, 'youtu.be') !== false) {
                        $youtube_id = trim(parse_url($youtube_link, PHP_URL_PATH), '/');
                    }

                    // Hanya tampilkan thumbnail jika ID YouTube ditemukan
                    if ($youtube_id) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $urut++ ?></th>
                        <td><?php echo $nama_paket ?></td>
                        <td>
                            <img src="<?php echo $gambar_url ?>" alt="Gambar" style="max-width: 100px; height: auto;" />
                        </td>
                        <td>
                            <a href="<?php echo $youtube_link ?>" target="_blank">
                                <img src="https://img.youtube.com/vi/<?php echo $youtube_id; ?>/0.jpg" alt="YouTube Thumbnail" style="max-width: 100px; height: auto;" />
                            </a>
                        </td>
                        <td><?php echo $deskripsi ?></td>
                        <td>
                            <a href="kelola_paket.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="kelola_paket.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau hapus data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <th scope="row"><?php echo $urut++ ?></th>
                        <td><?php echo $nama_paket ?></td>
                        <td>
                            <img src="<?php echo $gambar_url ?>" alt="Gambar" style="max-width: 100px; height: auto;" />
                        </td>
                        <td>Invalid YouTube link</td>
                        <td><?php echo $deskripsi ?></td>
                        <td>
                            <a href="kelola_paket.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="kelola_paket.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau hapus data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                <?php } ?>
                <?php } ?>
            </tbody>
        </table>

        <!-- Tombol Kembali -->
        <div class="col-12">
            <a href="index.php" class="btn btn-secondary">Kembali ke Halaman Utama</a>
        </div>
    </div>
</div>


    </div>
</body>
</html>
