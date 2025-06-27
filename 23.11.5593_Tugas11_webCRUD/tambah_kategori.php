<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama_kategori'])) {
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    
    $sql = "INSERT INTO categories (name) VALUES ('$nama_kategori')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: kelola_kategori.php?status=success");
    } else {
        header("Location: kelola_kategori.php?status=error");
    }
} else {
    header("Location: kelola_kategori.php");
}

mysqli_close($conn);
?>