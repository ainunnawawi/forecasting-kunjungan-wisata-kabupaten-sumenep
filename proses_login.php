<?php
include "koneksi.php";
$email = $_POST['email'];
$password = $_POST['pass'];

//$query = mysqli_query("SELECT COUNT(username) AS jumlah FROM tb_user WHERE username='$username' AND password='".md5( $password )."'");
$query = mysqli_query($koneksi,"select nama_user, email, passwrd, id_jabatan from tabel_user where email ='$email' and passwrd ='$password'");
$cek = mysqli_num_rows($query);
if ($cek == 1){
	$data = mysqli_fetch_assoc($query);
	if($data['id_jabatan']==1){
		// buat session login dan username
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		$_SESSION['id_jabatan'] = 1;
		$email = $_SESSION['email'];	
		// alihkan ke halaman dashboard admin
		header('location:admin/data_wisata/data_wisata.php');	
	// cek jika user login sebagai pegawai
	}else if($data['id_jabatan']==2){
		// buat session login dan username
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		$_SESSION['id_jabatan'] = 2;
		$email = $_SESSION['email'];
		// alihkan ke halaman dashboard pegawai
		header("location:super_admin/user/data_user.php");
	// cek jika user login sebagai pegawai
	}else if($data['id_jabatan']==3){
		// buat session login dan username
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
		$_SESSION['id_jabatan'] = 3;
		$email = $_SESSION['email'];
		// alihkan ke halaman dashboard pegawai
		header("location:kepala_dinas/data_wisata/data_wisata.php");
	}else {
		//header('location:index.html');
		echo "<script>alert('Username atau Password Salah!'); window.location = 'index.php'</script>";
	}
} else {
	//header('location:index.html');
	echo "<script>alert('Username atau Password Salah!'); window.location = 'index.php'</script>";
}
?>