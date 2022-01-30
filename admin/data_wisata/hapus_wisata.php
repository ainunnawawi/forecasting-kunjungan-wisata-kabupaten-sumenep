<?php
include "../../koneksi.php";
$id_wisata = $_GET['id_wisata'];

$query = mysqli_query($koneksi,"DELETE FROM tabel_kunjungan WHERE id_wisata = '$id_wisata'");
$query1 = mysqli_query($koneksi,"DELETE FROM tabel_wisata WHERE id_wisata = '$id_wisata'");
if ($query and $query1){
    header("location:../../admin/data_wisata/data_wisata.php");
} else {
	echo "<script>alert('Data wisata gagal dihapus!'); window.location=history.go(-1)</script>";	
}
?>