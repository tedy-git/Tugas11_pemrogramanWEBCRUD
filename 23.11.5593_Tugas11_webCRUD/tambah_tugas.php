<?php include 'koneksi.php'; ?>
<?php
// Ambil data kategori untuk dropdown
$sql = "SELECT * FROM categories";
$categories = mysqli_query($conn, $sql);

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (title, description, category_id, status) 
            VALUES ('$title', '$description', '$category_id', '$status')";
    mysqli_query($conn, $sql);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tambah Tugas</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Pilih Kategori</option>
                    <?php while ($row = mysqli_fetch_assoc($categories)): ?>
                        <option value="<?php echo $row['category_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="onprogress">Sedang Dikerjakan</option>
                    <option value="completed">Selesai</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>