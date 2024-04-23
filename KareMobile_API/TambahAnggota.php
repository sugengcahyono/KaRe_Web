<?php
require "koneksi.php";

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Ambil data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email_user'];
    $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
    $nama_user = $_POST['nama_user'];
    $alamat_user = $_POST['alamat_user'];
    $notelp_user = $_POST['notelp_user'];
    $foto_user = isset($_POST['foto_user']) ? $_POST['foto_user'] : null;
   
    // Set level user sebagai admin
    $level_user = "user";

    // Menyiapkan pernyataan SQL untuk dijalankan
    $sql = "INSERT INTO user (email_user, password_user, nama_user, alamat_user, notelp_user, foto_user, level_user) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Menyiapkan pernyataan SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter ke pernyataan SQL
    $stmt->bind_param("sssssss", $email, $password, $nama_user, $alamat_user, $notelp_user, $foto_user, $level_user);

    // Jalankan pernyataan SQL
    if ($stmt->execute()) {
        // Buat respons JSON
        $response = array("status" => "success", "message" => "Anggota berhasil ditambahkan");
    } else {
        // Buat respons JSON
        $response = array("status" => "error", "message" => "Gagal menambahkan Anggota. Error: " . $conn->error);
    }

    // Tutup pernyataan SQL
    $stmt->close();
} else {
    $response = array("status" => "error", "message" => "Metode permintaan bukan POST");
}

// Tutup koneksi
$conn->close();

// Tampilkan respons JSON
echo json_encode($response);
?>
