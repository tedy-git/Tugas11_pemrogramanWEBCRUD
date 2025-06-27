<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tugas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 14px;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #000;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-complete {
            background-color: #28a745;
            color: #fff;
        }
        .disabled {
            opacity: 0.5;
            pointer-events: none;
        }
        .empty-message {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Daftar Tugas</h2>
        <div>
            <a href="tambah_tugas.php" style="background-color: #007bff; color: #fff; padding: 8px 15px; text-decoration: none; border-radius: 4px;">Tambah Tugas</a>
            <a href="kelola_kategori.php" style="background-color: #6c757d; color: #fff; padding: 8px 15px; text-decoration: none; border-radius: 4px; margin-left: 10px;">Kelola Kategori</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT t.task_id, t.title, t.description, c.name AS category_name, t.status 
                    FROM tasks t 
                    LEFT JOIN categories c ON t.category_id = c.category_id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 0) {
                echo '<tr><td colspan="5" style="background-color: #e7f1ff; color: #0a2463; text-align: left; padding: 20px;">Tidak ada tugas</td></tr>';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['title']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['category_name']) . '</td>';
                    echo '<td>' . ucfirst($row['status']) . '</td>';
                    echo '<td>';
                    
                    // Tombol Edit
                    if ($row['status'] == 'completed') {
                        echo '<a href="edit_tugas.php?id=' . $row['task_id'] . '" class="btn btn-edit disabled">Edit</a> ';
                    } else {
                        echo '<a href="edit_tugas.php?id=' . $row['task_id'] . '" class="btn btn-edit">Edit</a> ';
                    }
                    
                    // Tombol Hapus
                    echo '<a href="javascript:void(0);" onclick="confirmDelete(' . $row['task_id'] . ')" class="btn btn-delete">Hapus</a> ';
                    
                    // Tombol Selesai (hanya untuk status bukan completed)
                    if ($row['status'] != 'completed') {
                        echo '<a href="selesai_tugas.php?id=' . $row['task_id'] . '" class="btn btn-complete">Selesai</a>';
                    }
                    
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>

    <script>
        function confirmDelete(taskId) {
            if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                window.location.href = 'hapus_tugas.php?id=' + taskId;
            }
        }
    </script>
</body>
</html>