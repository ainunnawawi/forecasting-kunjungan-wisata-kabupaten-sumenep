<!-- import excel ke mysql -->
<?php
  include "../../koneksi.php";
 if (isset($_POST['upload'])) {

  require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
  require('spreadsheet-reader-master/SpreadsheetReader.php');

  //upload data excel kedalam folder uploads
  $target_dir = "uploads/".basename($_FILES['dataforecasting']['name']);
  
  move_uploaded_file($_FILES['dataforecasting']['tmp_name'],$target_dir);

  $Reader = new SpreadsheetReader($target_dir);

  foreach ($Reader as $Key => $Row)
  {
   // import data excel mulai baris ke-2 (karena ada header pada baris 1)
   if ($Key < 1) continue;   
   $query=mysqli_query($koneksi,"INSERT INTO tabel_kunjungan (id_kunjungan, id_wisata, periode, bulan, tahun, jumlah_pengunjung) VALUES ('','$Row[0]','$Row[1]','$Row[2]','$Row[3]','$Row[4]')");
  }
  if ($query) {
    echo "Import data berhasil";
   }else{
    echo mysqli_error($koneksi);
   }
 }
 ?>
<?php
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['dataforecasting']['name']);

// alihkan halaman ke index.php
header("location:../../admin/data_wisata/data_wisata.php");
?>