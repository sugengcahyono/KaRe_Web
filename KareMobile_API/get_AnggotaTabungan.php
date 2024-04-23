<?php
require "koneksi.php";

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Ambil data admin dengan kriteria level_user 'admin' atau 'user', diurutkan berdasarkan nama_user
$sql = "SELECT nama_user, email_user, level_user FROM user WHERE level_user IN ('admin', 'user') ORDER BY nama_user";

// Eksekusi query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = array(); // Array untuk menyimpan data admin dan user
    while ($row = $result->fetch_assoc()) {
        // Masukkan data admin atau user ke dalam array
        $users[] = array(
            "nama_user" => $row["nama_user"],
            "email_user" => $row["email_user"],
            "level_user" => $row["level_user"]
        );
    }
    // Buat respons JSON
    $response = array("status" => "success", "users" => $users);
} else {
    // Jika tidak ada data admin atau user yang ditemukan
    $response = array("status" => "error", "message" => "Tidak ada admin atau user yang ditemukan");
}

// Tutup koneksi
$conn->close();

// Tampilkan respons JSON
echo json_encode($response);
?>
