<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $category_id = intval($_GET['id']);
    
    // Pertama, periksa apakah ada tugas yang menggunakan kategori ini
    $check_sql = "SELECT COUNT(*) as total FROM tasks WHERE category_id = ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    if ($row['total'] > 0) {
        // Jika ada tugas yang menggunakan kategori ini
        header("Location: kelola_kategori.php?status=error&message=Kategori tidak bisa dihapus karena masih digunakan oleh tugas");
    } else {
        // Jika tidak ada tugas yang menggunakan kategori ini
        $delete_sql = "DELETE FROM categories WHERE category_id = ?";
        $stmt = mysqli_prepare($conn, $delete_sql);
        mysqli_stmt_bind_param($stmt, "i", $category_id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: kelola_kategori.php?status=success");
        } else {
            header("Location: kelola_kategori.php?status=error");
        }
    }
    
    mysqli_stmt_close($stmt);
} else {
    header("Location: kelola_kategori.php");
}

mysqli_close($conn);
exit();
?>