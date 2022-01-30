<?php
include "../../koneksi.php";
$id_wisata = $_POST['id_wisata'];
$periode = $_POST['periode'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$jumlah_pengunjung = $_POST['jumlah_pengunjung'];

$query = mysqli_query($koneksi,"INSERT INTO tabel_kunjungan (id_kunjungan, id_wisata, periode, bulan, tahun, jumlah_pengunjung) VALUES (NULL, '$id_wisata', '$periode', '$bulan', '$tahun', '$jumlah_pengunjung')");
if ($query){
    header("location:./data_pengunjung.php?id_wisata=$id_wisata");
} else {
	echo "<script>alert('Data kunjungan Gagal ditambah!'); window.location=history.go(-1)</script>";	
}
?>
