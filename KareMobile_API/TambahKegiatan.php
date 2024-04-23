<?php
require "koneksi.php";

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Periksa apakah semua data yang dibutuhkan tersedia dalam request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nama_kegiatan']) && isset($_POST['deskripsi_kegiatan']) && isset($_FILES['foto_kegiatan']) && isset($_POST['id_user'])) {
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
    $id_user = $_POST['id_user'];
    
    // Ambil data foto kegiatan
    $foto_kegiatan = '';
    if ($_FILES['foto_kegiatan']['error'] === UPLOAD_ERR_OK) {
        // Membuat nama unik untuk gambar
        $namaFile = uniqid() . "_" . basename($_FILES["foto_kegiatan"]["name"]);
        $targetPath = 'Images/Kegiatan/' . $namaFile;

        // Memindahkan file yang diunggah ke lokasi yang ditentukan
        if (move_uploaded_file($_FILES["foto_kegiatan"]["tmp_name"], $targetPath)) {
            $foto_kegiatan = $namaFile;
        } else {
            // Buat respons JSON jika gagal memindahkan file
            $response = array("status" => "error", "message" => "Gagal mengunggah gambar kegiatan");
            echo json_encode($response);
            exit();
        }
    } else {
        // Jika terjadi kesalahan saat mengunggah foto kegiatan
        $response = array("status" => "error", "message" => "Terjadi kesalahan saat mengunggah foto kegiatan");
        echo json_encode($response);
        exit();
    }

    // Menyiapkan pernyataan SQL untuk dijalankan
    $sql = "INSERT INTO kegiatan (nama_kegiatan, deskripsi_kegiatan, foto_kegiatan, id_user) VALUES (?, ?, ?, ?)";

    // Menyiapkan pernyataan SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter ke pernyataan SQL
    $stmt->bind_param("ssss", $nama_kegiatan, $deskripsi_kegiatan, $foto_kegiatan, $id_user);

    // Jalankan pernyataan SQL
    if ($stmt->execute()) {
        // Buat respons JSON
        $response = array("status" => "success", "message" => "Kegiatan berhasil diunggah");
    } else {
        // Jika gagal menambahkan kegiatan ke database
        $response = array("status" => "error", "message" => "Gagal menambahkan kegiatan. Error: " . $conn->error);
    }

    // Tutup pernyataan SQL
    $stmt->close();
} else {
    // Jika request tidak lengkap atau bukan metode POST
    $response = array("status" => "error", "message" => "Data kegiatan tidak lengkap atau metode permintaan bukan POST");
}

// Tutup koneksi
$conn->close();

// Tampilkan respons JSON
echo json_encode($response);
?>
