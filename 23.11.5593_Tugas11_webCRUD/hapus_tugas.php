<?php include 'koneksi.php'; ?>
<?php
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $sql = "DELETE FROM tasks WHERE task_id = $task_id";
    mysqli_query($conn, $sql);
}

header('Location: index.php');
?>