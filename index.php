<?php
include 'db.php';
$query = "SELECT * FROM paket_wisata";
$result = mysqli_query($conn, $query);

// Membaca file biodata.txt
$biodata = file_get_contents('biodata.txt');
$biodata_lines = explode("\n", $biodata);

$nama = trim(str_replace('Nama:', '', $biodata_lines[0]));
$institusi = trim(str_replace('Institusi:', '', $biodata_lines[1]));
$phone = trim(str_replace('Phone:', '', $biodata_lines[2]));
$email = trim(str_replace('Email:', '', $biodata_lines[3]));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Wisata Bengkulu</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />
  </head>

  <body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
          <h1 class="sitename">Wisata</h1>
          <span>Bengkulu</span>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li>
              <a href="#hero" class="active">Beranda<br /></a>
            </li>
            <li><a href="#portfolio">Paket Wisata</a></li>
            <li><a href="kelola_paket.php">Kelola Paket</a></li>
            <li><a href="kelola.php">Kelola Pemesanan</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="daftar.php">Daftar Sekarang</a>
      </div>
    </header>

    <main class="main">
      <!-- Hero Section -->
      <section id="hero" class="hero section dark-background">
        <img src="assets/img/banner.png" alt="" data-aos="fade-in" />

        <div class="container">
          <div class="row justify-content-center text-center"  >
            <div class="col-xl-6 col-lg-8">
              <h2>Dapatkan Pengalaman Menarik Bersama Wisata<span>Bengkulu</span></h2>
              <p>Daftar Sekarang</p>
            </div>
          </div>

          
          </div>
        </div>
      </section>
      <!-- /Hero Section -->

<!-- Paket Wisata Section -->
<section id="portfolio" class="portfolio section">
    <!-- Section Title -->
    <div class="container section-title">
        <h2>Paket Wisata</h2>
        <p>Cek Paket Wisata Tersedia</p>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <div class="row gy-4 isotope-container">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
                    <img src="<?php echo $row['gambar_url']; ?>" class="img-fluid" alt="" />
                    <div class="portfolio-info">
                        <h4><?php echo $row['nama_paket']; ?></h4>
                        <a href="<?php echo $row['gambar_url']; ?>" title="<?php echo $row['deskripsi']; ?>" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                        <a href="<?php echo $row['youtube_link']; ?>" title="Tonton Video" class="details-link"><i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
                <!-- End Paket Wisata Item -->
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

    </main>

    <footer id="footer" class="footer dark-background">
      <div class="footer-top">
        <div class="container">
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
              <a href="index.html" class="logo d-flex align-items-center">
                <span class="sitename">VSGA-JWD</span>
              </a>
              <div class="footer-contact pt-3">
                <p><?php echo $nama; ?></p>
                <p><?php echo $institusi; ?></p>
                <p class="mt-3"><strong>Phone:</strong> <span><?php echo $phone; ?></span></p>
                <p><strong>Email:</strong> <span><?php echo $email; ?></span></p>
              </div>
              <div class="social-links d-flex mt-4">
                <a href="https://www.instagram.com/fiqri.aaziz/"><i class="bi bi-instagram"></i></a>
                <a href="https://www.linkedin.com/in/fiqri-abdul-aziz-314283269/"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/js/hitung.js" defer></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
  </body>
</html>
