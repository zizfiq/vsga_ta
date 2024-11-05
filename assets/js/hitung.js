document.addEventListener("DOMContentLoaded", function () {
  // Mendapatkan elemen-elemen form dan input yang diperlukan
  const form = document.getElementById("wisataForm");
  const totalTagihanInput = document.getElementById("total_tagihan");
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  const durasiInput = document.getElementById("durasi");
  const jumlahPesertaInput = document.getElementById("jumlah_peserta");

  // Fungsi untuk menghitung total biaya wisata
  function hitungTotal() {
    let total = 0;

    // Menambahkan nilai dari setiap checkbox yang dipilih
    checkboxes.forEach((checkbox) => {
      if (checkbox.checked) {
        total += parseInt(checkbox.value) || 0;
      }
    });

    // Mendapatkan durasi dan jumlah peserta, dengan nilai default 1 jika kosong
    const durasi = parseInt(durasiInput.value) || 1;
    const jumlahPeserta = parseInt(jumlahPesertaInput.value) || 1;

    // Menghitung total dasar sebelum diskon
    total *= durasi * jumlahPeserta;

    // Menghitung diskon berdasarkan aturan
    let diskon = 0;

    if (jumlahPeserta >= 5) diskon = 5;
    if (jumlahPeserta >= 10) diskon = 10;
    if (jumlahPeserta >= 20) diskon = 15;
    if (jumlahPeserta >= 30) diskon = 20;

    if (durasi >= 3) diskon += 5;
    if (durasi >= 5) diskon += 7;
    if (durasi >= 7) diskon += 9;
    if (durasi >= 10) diskon += 12;

    // Menghitung jumlah diskon
    const jumlahDiskon = (total * diskon) / 100;

    // Mengurangi total dengan jumlah diskon
    total -= jumlahDiskon;

    // Mengisi nilai total yang sudah dihitung ke input 'total_tagihan'
    totalTagihanInput.value = total;
  }

  // Menambahkan event listener untuk menghitung ulang total ketika checkbox berubah
  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", hitungTotal);
  });

  // Menambahkan event listener untuk menghitung ulang total ketika durasi atau jumlah peserta berubah
  durasiInput.addEventListener("input", hitungTotal);
  jumlahPesertaInput.addEventListener("input", hitungTotal);

  // Memanggil fungsi hitungTotal untuk inisialisasi nilai saat halaman dimuat
  hitungTotal();
});
