<?php
require "koneksi.php";

// Set header sebagai JSON
header("Content-Type: application/json; charset=UTF-8");

// Mendapatkan ID kegiatan dari parameter GET
$id_kegiatan = $_GET['id_kegiatan'];

// Query untuk mengambil detail kegiatan
$sql = "SELECT * FROM kegiatan WHERE id_kegiatan = $id_kegiatan";
$result = $conn->query($sql);

// Memeriksa apakah hasil query menghasilkan data
if ($result->num_rows > 0) {
    // Mengambil data kegiatan
    $row = $result->fetch_assoc();
    
    // Mengonversi data kegiatan menjadi format JSON
    $response = array(
        'id_kegiatan' => $row['id_kegiatan'],
        'nama_kegiatan' => $row['nama_kegiatan'],
        'deskripsi_kegiatan' => $row['deskripsi_kegiatan'],
        'foto_kegiatan' => $row['foto_kegiatan']
    );
    
    // Mengirim response dalam format JSON
    echo json_encode($response);
} else {
    // Jika tidak ada kegiatan dengan ID tersebut, kirim pesan error
    echo "Kegiatan tidak ditemukan";
}

// Menutup koneksi
$conn->close();
?>