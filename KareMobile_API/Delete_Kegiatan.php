<?php
// Ambil koneksi ke database
require_once 'koneksi.php';

// Periksa metode permintaan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari permintaan POST
    $data = json_decode(file_get_contents('php://input'));

    // Pastikan ID kegiatan telah diterima
    if (isset($data->id_kegiatan) && !empty($data->id_kegiatan)) {
        // Memeriksa apakah id_kegiatan tidak kosong
        $id_kegiatan = $data->id_kegiatan;

        // Buat query untuk menghapus kegiatan
        $query = "DELETE FROM kegiatan WHERE id_kegiatan = $id_kegiatan";

        if (mysqli_query($conn, $query)) {
            // Jika berhasil dihapus, kirim respons sukses
            http_response_code(200);
            echo json_encode(array("message" => "Kegiatan berhasil dihapus."));
        } else {
            // Jika gagal menghapus, kirim respons error
            http_response_code(500);
            echo json_encode(array("message" => "Gagal menghapus kegiatan: " . mysqli_error($conn)));
        }
    } else {
        // Jika data tidak lengkap, kirim respons bad request
        http_response_code(400);
        echo json_encode(array("message" => "Data tidak lengkap."));
    }
} else {
    // Jika bukan metode POST, kirim respons not allowed
    http_response_code(405);
    echo json_encode(array("message" => "Metode permintaan tidak diizinkan."));
}
?>
