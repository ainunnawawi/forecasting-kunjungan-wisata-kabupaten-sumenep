<?php
include "../../koneksi.php";
$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$query = mysqli_query($koneksi,"UPDATE tabel_user SET nama_user = '$nama', email = '$email', passwrd = '$pass' WHERE tabel_user.id_user = '$id_user'");
if ($query){
	echo "<script>alert('Profil berhasil di-update!'); window.location=history.go(-1)</script>";
} else {
	echo "<script>alert('Profil gagal diubah!'); window.location=history.go(-1)</script>";	
}
?>