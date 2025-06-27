<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']);
    
    // Update status tugas menjadi 'completed'
    $sql = "UPDATE tasks SET status = 'completed' WHERE task_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $task_id);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=error");
    }
    
    mysqli_stmt_close($stmt);
} else {
    header("Location: index.php");
}

mysqli_close($conn);
exit();
?>