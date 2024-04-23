<?php
require "koneksi.php";

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Ambil data admin dengan kriteria level_user 'admin'
$sql = "SELECT nama_user, email_user FROM user WHERE level_user = 'admin'";

// Eksekusi query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $admins = array(); // Array untuk menyimpan data admin
    while ($row = $result->fetch_assoc()) {
        // Masukkan data admin ke dalam array
        $admins[] = array(
            "nama_user" => $row["nama_user"],
            "email_user" => $row["email_user"]
        );
    }
    // Buat respons JSON
    $response = array("status" => "success", "admins" => $admins);
} else {
    // Jika tidak ada data admin yang ditemukan
    $response = array("status" => "error", "message" => "Tidak ada admin yang ditemukan");
}

// Tutup koneksi
$conn->close();

// Tampilkan respons JSON
echo json_encode($response);
?>
