<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM pendaftaran WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

echo "<script>window.location.href = 'kelola.php';</script>";
?>
