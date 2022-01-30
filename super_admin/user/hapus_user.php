<?php
include "../../koneksi.php";
$id_user = $_GET['id_user'];

$query = mysqli_query($koneksi,"DELETE FROM tabel_user WHERE id_user = '$id_user'");
if ($query){
    header("location:./data_user.php");
} else {
	echo "<script>alert('Data user gagal dihapus!'); window.location=history.go(-1)</script>";	
}
?>