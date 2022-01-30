<?php
include "../../koneksi.php";
$id_kunjungan = $_POST['id_kunjungan'];
$id_wisata = $_POST['id_wisata'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$jumlah_pengunjung = $_POST['jumlah_pengunjung'];

$query = mysqli_query($koneksi,"UPDATE tabel_kunjungan SET bulan = '$bulan',  tahun = '$tahun', jumlah_pengunjung = '$jumlah_pengunjung' WHERE id_kunjungan = '$id_kunjungan'");
if ($query){
    header("location:./data_pengunjung.php?id_wisata=$id_wisata");
} else {
	echo "<script>alert('Data kunjungan gagal di-update!'); window.location=history.go(-1)</script>";	
}
?>
