<?php
require "koneksi.php";

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Ambil data dari form login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email_user'];
    $password = $_POST['password_user'];

    // Menyiapkan pernyataan SQL untuk mendapatkan data pengguna
    $sql = "SELECT id_user, email_user, nama_user, alamat_user, notelp_user, foto_user, level_user, password_user FROM user WHERE email_user = ?";

    // Menyiapkan pernyataan SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter ke pernyataan SQL
    $stmt->bind_param("s", $email);

    // Eksekusi pernyataan SQL
    $stmt->execute();

    // Simpan hasil query
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Ambil baris hasil query
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password_user'])) {
            // Pastikan pengguna adalah admin
            if ($row['level_user'] == "admin") {
                // Buat respons JSON dengan data pengguna
                $response = array(
                    "status" => "success",
                    "data" => array(
                        "id_user" => $row['id_user'],
                        "email_user" => $row['email_user'],
                        "nama_user" => $row['nama_user'],
                        "alamat_user" => $row['alamat_user'],
                        "notelp_user" => $row['notelp_user'],
                        "foto_user" => $row['foto_user'],
                        "level_user" => $row['level_user']
                    )
                );
            } else {
                $response = array("status" => "error", "message" => "Anda tidak memiliki akses sebagai admin");
            }
        } else {
            $response = array("status" => "error", "message" => "Password salah");
        }
    } else {
        $response = array("status" => "error", "message" => "Email tidak ditemukan");
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
