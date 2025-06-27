<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        h2 {
            color: #444;
            margin-top: 30px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 5px 10px;
        }
        .btn-group {
            margin-top: 10px;
        }
        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <h1>Kelola Kategori</h1>
    
    <?php if (isset($_GET['status'])): ?>
        <div style="padding: 10px; margin-bottom: 15px; background-color: <?= $_GET['status'] == 'success' ? '#d4edda' : '#f8d7da' ?>; 
                    color: <?= $_GET['status'] == 'success' ? '#155724' : '#721c24' ?>; border-radius: 4px;">
            <?= $_GET['status'] == 'success' ? 'Operasi berhasil dilakukan!' : 'Terjadi kesalahan saat memproses permintaan' ?>
        </div>
    <?php endif; ?>
    
    <h2>Daftar Kategori</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM categories";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['category_id'] . '</td>';
                    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                    echo '<td class="actions">';
                    echo '<a href="javascript:void(0);" onclick="confirmDelete(' . $row['category_id'] . ')" class="btn btn-danger">Hapus</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="3">Tidak ada kategori</td></tr>';
            }
            ?>
        </tbody>
    </table>
    
    <h2>Tambah Kategori Baru</h2>
    <form method="POST" action="tambah_kategori.php">
        <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" required>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

    <script>
        function confirmDelete(categoryId) {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?\n\nCatatan: Menghapus kategori akan mempengaruhi tugas yang terkait.')) {
                window.location.href = 'hapus_kategori.php?id=' + categoryId;
            }
        }
    </script>
</body>
</html>