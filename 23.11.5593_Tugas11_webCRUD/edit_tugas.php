<?php include 'koneksi.php'; ?>
<?php
$task_id = $_GET['id'];

// Ambil data tugas
$sql = "SELECT * FROM tasks WHERE task_id = $task_id";
$result = mysqli_query($conn, $sql);
$task = mysqli_fetch_assoc($result);

// Ambil data kategori untuk dropdown
$sqlCategories = "SELECT * FROM categories";
$categories = mysqli_query($conn, $sqlCategories);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET 
            title = '$title', 
            description = '$description', 
            category_id = '$category_id', 
            status = '$status' 
            WHERE task_id = $task_id";
    mysqli_query($conn, $sql);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Tugas</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $task['title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $task['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <?php while ($row = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?php echo $row['category_id']; ?>" <?php if ($row['category_id'] == $task['category_id']) echo 'selected'; ?>>
                            <?php echo $row['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending" <?php if ($task['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                    <option value="onprogress" <?php if ($task['status'] == 'onprogress') echo 'selected'; ?>>Sedang Dikerjakan</option>
                    <option value="completed" <?php if ($task['status'] == 'completed') echo 'selected'; ?>>Selesai</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>