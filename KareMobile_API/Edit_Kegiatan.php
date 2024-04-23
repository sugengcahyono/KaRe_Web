<?php
require "koneksi.php";

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Periksa apakah semua data yang dibutuhkan tersedia dalam request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_kegiatan']) && isset($_POST['id_user'])) {
    // Tangkap input dari form
    $id_kegiatan = $_POST['id_kegiatan'];
    $id_user = $_POST['id_user'];

    // Menyiapkan array untuk menyimpan query SQL
    $updateFields = array();

    // Periksa apakah ada input untuk nama kegiatan
    if (isset($_POST['nama_kegiatan']) && !empty($_POST['nama_kegiatan'])) {
        $nama_kegiatan = $_POST['nama_kegiatan'];
        $updateFields[] = "nama_kegiatan = '$nama_kegiatan'";
    }

    // Periksa apakah ada input untuk deskripsi kegiatan
    if (isset($_POST['deskripsi_kegiatan']) && !empty($_POST['deskripsi_kegiatan'])) {
        $deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
        $updateFields[] = "deskripsi_kegiatan = '$deskripsi_kegiatan'";
    }

    // Periksa apakah ada input untuk foto kegiatan
    if ($_FILES['foto_kegiatan']['error'] === UPLOAD_ERR_OK) {
        // Membuat nama unik untuk gambar
        $namaFile = uniqid() . "_" . basename($_FILES["foto_kegiatan"]["name"]);
        $foto_kegiatan = $namaFile; // Hanya nama file

        // Lokasi folder untuk menyimpan gambar kegiatan
        $folderPath = 'Images/Kegiatan/';

        // Memindahkan file yang diunggah ke lokasi yang ditentukan
        $targetPath = $folderPath . $namaFile;
        if (move_uploaded_file($_FILES["foto_kegiatan"]["tmp_name"], $targetPath)) {
            $updateFields[] = "foto_kegiatan = '$foto_kegiatan'";
        } else {
            // Buat respons JSON jika gagal memindahkan file
            $response = array("status" => "error", "message" => "Gagal mengunggah gambar kegiatan");
            echo json_encode($response);
            exit();
        }
    }

    // Bangun query SQL berdasarkan field yang akan diperbarui
    if (!empty($updateFields)) {
        $updateQuery = implode(", ", $updateFields);
        $sql = "UPDATE kegiatan SET $updateQuery WHERE id_kegiatan = $id_kegiatan";

        // Eksekusi query
        if ($conn->query($sql) === TRUE) {
            // Buat respons JSON
            $response = array("status" => "success", "message" => "Data kegiatan berhasil diperbarui");
        } else {
            // Jika gagal memperbarui data kegiatan di database
            $response = array("status" => "error", "message" => "Gagal memperbarui data kegiatan. Error: " . $conn->error);
        }
    } else {
        // Jika tidak ada perubahan yang dilakukan
        $response = array("status" => "warning", "message" => "Tidak ada perubahan yang dilakukan");
    }
} else {
    // Jika request tidak lengkap atau bukan metode POST
    $response = array("status" => "error", "message" => "Data kegiatan tidak lengkap atau metode permintaan bukan POST");
}

// Tutup koneksi
$conn->close();

// Tampilkan respons JSON
echo json_encode($response);
?>
