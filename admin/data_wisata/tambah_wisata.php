<?php
include "../../koneksi.php";
$id_wisata = $_POST['id_wisata'];
$nama_wisata = $_POST['nama_wisata'];

$query = mysqli_query($koneksi,"INSERT INTO tabel_wisata (id_wisata, nama_wisata) VALUES ('$id_wisata', '$nama_wisata')");
if ($query){
    header("location:./data_wisata.php");
} else {
	echo "<script>alert('Data wisata gagal ditambah!'); window.location=history.go(-1)</script>";	
}
?>
