<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

include '../config/koneksi.php';

$sql = "SELECT userID, username, password, role FROM user";
$result = $conn->query($sql);

if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" href="../asset/favicon-16x16.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="row">
        <?php include 'sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data Pengguna</h1>
            </div>

            <div class="container mt-4">
                <a href="tambah_data_pengguna.php" class="btn btn-primary mb-3">Tambah Pengguna</a>
                <a href="dashboard.php" class="btn btn-secondary mb-3">Kembali</a>

                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $no++ . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>********</td>";
                                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                                    echo "<td>
                                            <a href='edit_pengguna.php?userID=" . $row['userID'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href='hapus_pengguna.php?userID=" . $row['userID'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus pengguna ini?\")'>Hapus</a>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Tidak ada data pengguna.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
