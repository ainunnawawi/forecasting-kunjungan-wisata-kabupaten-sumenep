<?php
$koneksi = mysqli_connect("localhost","root","","skripsi_forecasting");
//mysqli_select_db("penggajian");

//fungsi format rupiah 
function format_rupiah($rp) {
	$hasil = "Rp." . number_format($rp, 0, "", ".") . ",00";
	return $hasil;
}
?>
