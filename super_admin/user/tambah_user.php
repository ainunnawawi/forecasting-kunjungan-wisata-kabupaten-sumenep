<?php
include "../../koneksi.php";
$nama = $_POST['nama'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$id_jabatan = $_POST['id_jabatan'];

$query = mysqli_query($koneksi,"INSERT INTO `tabel_user` (`id_user`, `nama_user`, `email`, `passwrd`, `id_jabatan`) VALUES (NULL, '$nama', '$email', '$pass', '$id_jabatan')");
if ($query){
    header("location:./data_user.php");
} else {
	//echo "<script>alert('Data user gagal ditambah!'); window.location=history.go(-1)</script>";	
}
?>