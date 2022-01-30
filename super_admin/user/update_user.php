<?php
include "../../koneksi.php";
$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$id_jabatan = $_POST['id_jabatan'];

$query = mysqli_query($koneksi,"UPDATE `tabel_user` SET `nama_user` = '$nama', `email` = '$email', `passwrd` = '$pass', `id_jabatan` = '$id_jabatan' WHERE `tabel_user`.`id_user` = $id_user");
if ($query){
    header("location:./data_user.php");
} else {
	echo "<script>alert('Data user gagal diubah!'); window.location=history.go(-1)</script>";	
}
?>