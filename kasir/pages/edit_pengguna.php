<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit();
}

include '../config/koneksi.php';

if (isset($_GET['userID'])) {
    $id = $_GET['userID'];
    $sql = "SELECT * FROM user WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE user SET username=?, password=?, role=? WHERE userID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $password, $role, $id);
    } else {
        $sql = "UPDATE user SET username=?, role=? WHERE userID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $role, $id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Pengguna berhasil diperbarui!'); window.location='kelola-user.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui pengguna!'); window.location='edit_pengguna.php?userID=$id';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Pengguna</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" 
                       value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" required 
                        <?php echo ($user['userID'] == 1) ? 'disabled' : ''; ?>>
                    <option value="admin" <?php echo ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="petugas" <?php echo ($user['role'] == 'petugas') ? 'selected' : ''; ?>>Petugas</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="data_pengguna.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
