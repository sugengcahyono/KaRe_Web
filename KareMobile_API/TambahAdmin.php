<?php
require "koneksi.php";

// Lokasi folder untuk menyimpan gambar
$folderPath = 'Images/Foto/'; // Path menuju folder tempat menyimpan gambar

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Ambil data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email_user'];
    $password = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
    $nama_user = $_POST['nama_user'];
    $alamat_user = $_POST['alamat_user'];
    $notelp_user = $_POST['notelp_user'];
    
    // Ambil data foto user
    $foto_user = '';
    if ($_FILES['foto_user']['error'] === UPLOAD_ERR_OK) {
        // Membuat nama unik untuk gambar
        $namaFile = uniqid() . "_" . basename($_FILES["foto_user"]["name"]);
        $targetPath = $folderPath . $namaFile;

        // Memindahkan file yang diunggah ke lokasi yang ditentukan
        if (move_uploaded_file($_FILES["foto_user"]["tmp_name"], $targetPath)) {
            // Hanya menyimpan nama file (tanpa path folder) dalam variabel foto_user
            $foto_user = $namaFile;
        } else {
            // Buat respons JSON jika gagal memindahkan file
            $response = array("status" => "error", "message" => "Gagal mengunggah gambar");
            echo json_encode($response);
            exit();
        }
    } else {
        // Jika foto user kosong atau terjadi kesalahan pada upload
        $response = array("status" => "error", "message" => "Foto user tidak valid");
        echo json_encode($response);
        exit();
    }
   
    // Set level user sebagai admin
    $level_user = "admin";

    // Menyiapkan pernyataan SQL untuk dijalankan
    $sql = "INSERT INTO user (email_user, password_user, nama_user, alamat_user, notelp_user, foto_user, level_user) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Menyiapkan pernyataan SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter ke pernyataan SQL
    $stmt->bind_param("sssssss", $email, $password, $nama_user, $alamat_user, $notelp_user, $foto_user, $level_user);

    // Jalankan pernyataan SQL
    if ($stmt->execute()) {
        // Buat respons JSON
        $response = array("status" => "success", "message" => "Admin berhasil ditambahkan", "foto_user" => $foto_user); // Sertakan nama file gambar dalam respons JSON
    } else {
        // Buat respons JSON
        $response = array("status" => "error", "message" => "Gagal menambahkan Admin. Error: " . $conn->error);
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
