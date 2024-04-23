<?php
require "koneksi.php";

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Ambil semua data kegiatan
$sql = "SELECT id_kegiatan, nama_kegiatan, deskripsi_kegiatan, foto_kegiatan, id_user FROM kegiatan";

// Eksekusi query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $kegiatans = array(); // Array untuk menyimpan data kegiatan
    while ($row = $result->fetch_assoc()) {
        // Masukkan data kegiatan ke dalam array
        $kegiatans[] = array(
            "id_kegiatan" => $row["id_kegiatan"],
            "nama_kegiatan" => $row["nama_kegiatan"],
            "deskripsi_kegiatan" => $row["deskripsi_kegiatan"],
            "foto_kegiatan" => $row["foto_kegiatan"],
            "id_user" => $row["id_user"]
        );
    }
    // Buat respons JSON
    $response = array("status" => "success", "kegiatans" => $kegiatans);
} else {
    // Jika tidak ada data kegiatan yang ditemukan
    $response = array("status" => "error", "message" => "Tidak ada kegiatan yang ditemukan");
}

// Tutup koneksi
$conn->close();

// Tampilkan respons JSON
echo json_encode($response);
?>
