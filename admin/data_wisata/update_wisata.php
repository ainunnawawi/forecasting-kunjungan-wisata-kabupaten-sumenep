<?php
include "../../koneksi.php";
$id_wisata = $_POST['id_wisata'];
$nama_wisata = $_POST['nama_wisata'];

$query = mysqli_query($koneksi,"UPDATE tabel_wisata SET nama_wisata = '$nama_wisata' WHERE id_wisata = '$id_wisata'");
if ($query){
    header("location:./data_wisata.php");
} else {
	echo "<script>alert('Data wisata gagal di-update!'); window.location=history.go(-1)</script>";	
}
?>
