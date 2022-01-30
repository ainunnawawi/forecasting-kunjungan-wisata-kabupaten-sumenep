<?php
//include "../../koneksi.php";

//mencari nilai alfa
$alfa = 0.01;
$beta = 0.99;
$gamma = 0.99;
while ($alfa < 1) {
    $no = 1;
    $smoting = 0;
    //inisialisasi level (AT)
    $data = mysqli_query($koneksi, "SELECT AVG(jumlah_pengunjung) AS a FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 1 AND 12;");
    $at = mysqli_fetch_array($data);
    //inisialisasi trend (TT)
    $data = mysqli_query($koneksi, "SELECT SUM(jumlah_pengunjung) AS jumlah_musim1 FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 1 AND 12");
    $jumlah_musim1 = mysqli_fetch_array($data);
    $data = mysqli_query($koneksi, "SELECT SUM(jumlah_pengunjung) AS jumlah_musim2 FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 13 AND 24");
    $jumlah_musim2 = mysqli_fetch_array($data);
    $selisih = $jumlah_musim2['jumlah_musim2'] - $jumlah_musim1['jumlah_musim1'];
    $data = mysqli_query($koneksi, "SELECT ($selisih) / POW (12, 2) AS tt");
    $tt = mysqli_fetch_array($data);
    //data pengunjung
    $data = mysqli_query($koneksi, "SELECT periode, (jumlah_pengunjung) AS st FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]' ORDER BY periode");
    $baris = mysqli_num_rows($data);
    while ($st = mysqli_fetch_array($data)) {
        //periode
        if ($st['periode'] <= 12) {
            //echo $no++;
        } else {
            $periode_ar[] = $no;
            //echo $no++;
        }
        //pengunjung
        if ($st['periode'] <= 12) {
            $st['st'];
            //echo number_format($st['st'], 2, ",", ".");
        } else {
            $pengunjung = $st['st'];
            //echo number_format($pengunjung = $st['st'], 2, ",", ".");
            $pengunjung_ar[] = $pengunjung;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_level = $at['a'];
            //echo number_format($i_level = $at['a'], 2, ",", ".");
            $level_ar[] = $i_level;
        } else {
            //smoting level (AT-A)
            $i_level = $alfa * ($st['st'] - $musim_ar[$smoting]) + (1 - $alfa) * ($level_ar[$smoting] + $trend_ar[$smoting]);
            //echo number_format($i_level = $alfa * ($st['st'] - $musim_ar[$smoting]) + (1 - $alfa) * ($level_ar[$smoting] + $trend_ar[$smoting]), 2, ",", ".");
            $level_ar[] = $i_level;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_trend = $tt['tt'];
            //echo number_format($i_trend = $tt['tt'], 2, ",", ".");
            $trend_ar[] = $i_trend;
        } else {
            //smoting trend (TT-A)
            $i_trend = $beta * ($i_level - $level_ar[$smoting]) + (1 - $beta) * $trend_ar[$smoting];
            //echo number_format($i_trend = $beta * ($i_level - $level_ar[$smoting]) + (1 - $beta) * $trend_ar[$smoting], 2, ",", ".");
            $trend_ar[] = $i_trend;
        }
        if ($st['periode'] <= 12) {
            //inisialisasi musim (ST-A)
            $i_musim = $st['st'] - $at['a'];
            //echo number_format($i_musim = $st['st'] - $at['a'], 2, ",", ".");
            $musim_ar[] = $i_musim;
        } else {
            //smoting musim (ST-A)
            $i_musim = $gamma * ($st['st'] - $i_level) + (1 - $gamma) * $musim_ar[$smoting];
            //echo number_format($i_musim = $gamma * ($st['st'] - $i_level) + (1 - $gamma) * $musim_ar[$smoting], 2, ",", ".");
            $musim_ar[] = $i_musim;
        }
        if ($st['periode'] > 12) {
            //prediksi-A
            $i_prediksi = intval($level_ar[$smoting] + $trend_ar[$smoting] + $musim_ar[$smoting]);
            //echo number_format($i_prediksi = $level_ar[$smoting] + $trend_ar[$smoting] + $musim_ar[$smoting], 2, ",", ".");
            $prediksi_ar[] = $i_prediksi;
        } else {
            //inisialisasi prediksi-A
            //echo number_format(0, 2, ",", ".");
        }
        //error-A
        if ($st['periode'] > 12) {
            $error = $st['st'] - $i_prediksi;
            //echo number_format($error = $st['st'] - $i_prediksi, 2, ",", ".");
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        //abs error-A
        if ($st['periode'] > 12) {
            $abs = abs($error) / ((abs($st['st']) + abs($i_prediksi)));
            //echo number_format($abs = abs($error) / ((abs($st['st']) + abs($i_prediksi)) / 2), 2, ",", ".");
            $jumlah_ar[] = $abs;
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_level_m = $at['a'];
            //echo number_format($i_level_m = $at['a'], 2, ",", ".");
            $level_m_ar[] = $i_level_m;
        } else {
            //smoting level (AT-M)
            $i_level_m = $alfa * ($st['st'] / $musim_m_ar[$smoting]) + (1 - $alfa) * ($level_m_ar[$smoting] + $trend_m_ar[$smoting]);
            //echo number_format($i_level_m = $alfa * ($st['st'] / $musim_m_ar[$smoting]) + (1 - $alfa) * ($level_m_ar[$smoting] + $trend_m_ar[$smoting]), 2, ",", ".");
            $level_m_ar[] = $i_level_m;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_trend_m = $tt['tt'];
            //echo number_format($i_trend_m = $tt['tt'], 2, ",", ".");
            $trend_m_ar[] = $i_trend_m;
        } else {
            //smoting trend (TT-M)
            $i_trend_m = $beta * ($i_level_m - $level_m_ar[$smoting]) + (1 - $beta) * $trend_m_ar[$smoting];
            //echo number_format($i_trend_m = $beta * ($i_level_m - $level_m_ar[$smoting]) + (1 - $beta) * $trend_m_ar[$smoting], 2, ",", ".");
            $trend_m_ar[] = $i_trend_m;
        }
        if ($st['periode'] <= 12) {
            //inisialisasi musim (ST-M)
            $i_musim_m = $st['st'] / $at['a'];
            //echo number_format($i_musim_m = $st['st'] / $at['a'], 2, ",", ".");
            $musim_m_ar[] = $i_musim_m;
        } else {
            //smoting musim (ST-M)
            $i_musim_m = $gamma * ($st['st'] / $i_level_m) + (1 - $gamma) * $musim_m_ar[$smoting];
            //echo number_format($i_musim_m = $gamma * ($st['st'] / $i_level_m) + (1 - $gamma) * $musim_m_ar[$smoting], 2, ",", ".");
            $musim_m_ar[] = $i_musim_m;
        }
        if ($st['periode'] > 12) {
            //prediksi-M
            $i_prediksi_m = intval(($level_m_ar[$smoting] + $trend_m_ar[$smoting]) * $musim_m_ar[$smoting]);
            //echo number_format($i_prediksi_m = ($level_m_ar[$smoting] + $trend_m_ar[$smoting]) * $musim_m_ar[$smoting], 2, ",", ".");
            $prediksi_m_ar[] = $i_prediksi_m;
            $smoting++;
        } else {
            //inisialisasi prediksi-M
            //echo number_format(0, 2, ",", ".");
        }
        //error-M
        if ($st['periode'] > 12) {
            $error_m = $st['st'] - $i_prediksi_m;
            //echo number_format($error_m = $st['st'] - $i_prediksi_m, 2, ",", ".");
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        //abs error-M
        if ($st['periode'] > 12) {
            $abs_m = abs($error_m) / ((abs($st['st']) + abs($i_prediksi_m)));
            //echo number_format($abs_m = abs($error_m) / ((abs($st['st']) + abs($i_prediksi_m)) / 2), 2, ",", ".");
            $jumlah_m_ar[] = $abs_m;
        } else {
            //echo number_format(0, 2, ",", ".");
        }
    }
    $mape = 100 / count($jumlah_ar) * array_sum($jumlah_ar);
    $mape_m = 100 / count($jumlah_m_ar) * array_sum($jumlah_m_ar);
    $alfa_ar[] = $alfa;
    $mape_ar[] = $mape;
    $mape_m_ar[] = $mape_m;
    unset($periode_ar);
    unset($pengunjung_ar);
    unset($level_ar);
    unset($trend_ar);
    unset($musim_ar);
    unset($prediksi_ar);
    unset($jumlah_ar);
    unset($level_m_ar);
    unset($trend_m_ar);
    unset($musim_m_ar);
    unset($prediksi_m_ar);
    unset($jumlah_m_ar);
    $alfa = $alfa + 0.01;
}
$parameter = min($mape_ar);
$parameter_key = array_keys($mape_ar, $parameter);
foreach ($parameter_key as $key) {
}
$alfa_a = $alfa_ar[$key];
//echo "nilai Alfa A : $alfa_a";
//echo "<br/>";
$parameter_m = min($mape_m_ar);
$parameter_m_key = array_keys($mape_m_ar, $parameter_m);
foreach ($parameter_m_key as $key_m) {
}
$alfa_m = $alfa_ar[$key_m];
//echo "nilai Alfa M : $alfa_m";
//echo "<br/>";
unset($mape_ar);
unset($mape_m_ar);
unset($alfa_ar);

//mencari nilai beta
$beta = 0.01;
$gamma = 0.99;
while ($beta < 1) {
    $no = 1;
    $smoting = 0;
    //inisialisasi level (AT)
    $data = mysqli_query($koneksi, "SELECT AVG(jumlah_pengunjung) AS a FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 1 AND 12;");
    $at = mysqli_fetch_array($data);
    //inisialisasi trend (TT)
    $data = mysqli_query($koneksi, "SELECT SUM(jumlah_pengunjung) AS jumlah_musim1 FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 1 AND 12");
    $jumlah_musim1 = mysqli_fetch_array($data);
    $data = mysqli_query($koneksi, "SELECT SUM(jumlah_pengunjung) AS jumlah_musim2 FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 13 AND 24");
    $jumlah_musim2 = mysqli_fetch_array($data);
    $selisih = $jumlah_musim2['jumlah_musim2'] - $jumlah_musim1['jumlah_musim1'];
    $data = mysqli_query($koneksi, "SELECT ($selisih) / POW (12, 2) AS tt");
    $tt = mysqli_fetch_array($data);
    //data pengunjung
    $data = mysqli_query($koneksi, "SELECT periode, (jumlah_pengunjung) AS st FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]' ORDER BY periode");
    $baris = mysqli_num_rows($data);
    while ($st = mysqli_fetch_array($data)) {
        //periode
        if ($st['periode'] <= 12) {
            //echo $no++;
        } else {
            $periode_ar[] = $no;
            //echo $no++;
        }
        //pengunjung
        if ($st['periode'] <= 12) {
            $st['st'];
            //echo number_format($st['st'], 2, ",", ".");
        } else {
            $pengunjung = $st['st'];
            //echo number_format($pengunjung = $st['st'], 2, ",", ".");
            $pengunjung_ar[] = $pengunjung;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_level = $at['a'];
            //echo number_format($i_level = $at['a'], 2, ",", ".");
            $level_ar[] = $i_level;
        } else {
            //smoting level (AT-A)
            $i_level = $alfa_a * ($st['st'] - $musim_ar[$smoting]) + (1 - $alfa_a) * ($level_ar[$smoting] + $trend_ar[$smoting]);
            //echo number_format($i_level = $alfa_a * ($st['st'] - $musim_ar[$smoting]) + (1 - $alfa_a) * ($level_ar[$smoting] + $trend_ar[$smoting]), 2, ",", ".");
            $level_ar[] = $i_level;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_trend = $tt['tt'];
            //echo number_format($i_trend = $tt['tt'], 2, ",", ".");
            $trend_ar[] = $i_trend;
        } else {
            //smoting trend (TT-A)
            $i_trend = $beta * ($i_level - $level_ar[$smoting]) + (1 - $beta) * $trend_ar[$smoting];
            //echo number_format($i_trend = $beta * ($i_level - $level_ar[$smoting]) + (1 - $beta) * $trend_ar[$smoting], 2, ",", ".");
            $trend_ar[] = $i_trend;
        }
        if ($st['periode'] <= 12) {
            //inisialisasi musim (ST-A)
            $i_musim = $st['st'] - $at['a'];
            //echo number_format($i_musim = $st['st'] - $at['a'], 2, ",", ".");
            $musim_ar[] = $i_musim;
        } else {
            //smoting musim (ST-A)
            $i_musim = $gamma * ($st['st'] - $i_level) + (1 - $gamma) * $musim_ar[$smoting];
            //echo number_format($i_musim = $gamma * ($st['st'] - $i_level) + (1 - $gamma) * $musim_ar[$smoting], 2, ",", ".");
            $musim_ar[] = $i_musim;
        }
        if ($st['periode'] > 12) {
            //prediksi-A
            $i_prediksi = intval($level_ar[$smoting] + $trend_ar[$smoting] + $musim_ar[$smoting]);
            //echo number_format($i_prediksi = $level_ar[$smoting] + $trend_ar[$smoting] + $musim_ar[$smoting], 2, ",", ".");
            $prediksi_ar[] = $i_prediksi;
        } else {
            //inisialisasi prediksi-A
            //echo number_format(0, 2, ",", ".");
        }
        //error-A
        if ($st['periode'] > 12) {
            $error = $st['st'] - $i_prediksi;
            //echo number_format($error = $st['st'] - $i_prediksi, 2, ",", ".");
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        //abs error-A
        if ($st['periode'] > 12) {
            $abs = abs($error) / ((abs($st['st']) + abs($i_prediksi)));
            //echo number_format($abs = abs($error) / ((abs($st['st']) + abs($i_prediksi)) / 2), 2, ",", ".");
            $jumlah_ar[] = $abs;
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_level_m = $at['a'];
            //echo number_format($i_level_m = $at['a'], 2, ",", ".");
            $level_m_ar[] = $i_level_m;
        } else {
            //smoting level (AT-M)
            $i_level_m = $alfa_m * ($st['st'] / $musim_m_ar[$smoting]) + (1 - $alfa_m) * ($level_m_ar[$smoting] + $trend_m_ar[$smoting]);
            //echo number_format($i_level_m = $alfa_m * ($st['st'] / $musim_m_ar[$smoting]) + (1 - $alfa_m) * ($level_m_ar[$smoting] + $trend_m_ar[$smoting]), 2, ",", ".");
            $level_m_ar[] = $i_level_m;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_trend_m = $tt['tt'];
            //echo number_format($i_trend_m = $tt['tt'], 2, ",", ".");
            $trend_m_ar[] = $i_trend_m;
        } else {
            //smoting trend (TT-M)
            $i_trend_m = $beta * ($i_level_m - $level_m_ar[$smoting]) + (1 - $beta) * $trend_m_ar[$smoting];
            //echo number_format($i_trend_m = $beta * ($i_level_m - $level_m_ar[$smoting]) + (1 - $beta) * $trend_m_ar[$smoting], 2, ",", ".");
            $trend_m_ar[] = $i_trend_m;
        }
        if ($st['periode'] <= 12) {
            //inisialisasi musim (ST-M)
            $i_musim_m = $st['st'] / $at['a'];
            //echo number_format($i_musim_m = $st['st'] / $at['a'], 2, ",", ".");
            $musim_m_ar[] = $i_musim_m;
        } else {
            //smoting musim (ST-M)
            $i_musim_m = $gamma * ($st['st'] / $i_level_m) + (1 - $gamma) * $musim_m_ar[$smoting];
            //echo number_format($i_musim_m = $gamma * ($st['st'] / $i_level_m) + (1 - $gamma) * $musim_m_ar[$smoting], 2, ",", ".");
            $musim_m_ar[] = $i_musim_m;
        }
        if ($st['periode'] > 12) {
            //prediksi-M
            $i_prediksi_m = intval(($level_m_ar[$smoting] + $trend_m_ar[$smoting]) * $musim_m_ar[$smoting]);
            //echo number_format($i_prediksi_m = ($level_m_ar[$smoting] + $trend_m_ar[$smoting]) * $musim_m_ar[$smoting], 2, ",", ".");
            $prediksi_m_ar[] = $i_prediksi_m;
            $smoting++;
        } else {
            //inisialisasi prediksi-M
            //echo number_format(0, 2, ",", ".");
        }
        //error-M
        if ($st['periode'] > 12) {
            $error_m = $st['st'] - $i_prediksi_m;
            //echo number_format($error_m = $st['st'] - $i_prediksi_m, 2, ",", ".");
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        //abs error-M
        if ($st['periode'] > 12) {
            $abs_m = abs($error_m) / ((abs($st['st']) + abs($i_prediksi_m)));
            //echo number_format($abs_m = abs($error_m) / ((abs($st['st']) + abs($i_prediksi_m)) / 2), 2, ",", ".");
            $jumlah_m_ar[] = $abs_m;
        } else {
            //echo number_format(0, 2, ",", ".");
        }
    }
    $mape = 100 / count($jumlah_ar) * array_sum($jumlah_ar);
    $mape_m = 100 / count($jumlah_m_ar) * array_sum($jumlah_m_ar);
    $beta_ar[] = $beta;
    $mape_ar[] = $mape;
    $mape_m_ar[] = $mape_m;
    unset($periode_ar);
    unset($pengunjung_ar);
    unset($level_ar);
    unset($trend_ar);
    unset($musim_ar);
    unset($prediksi_ar);
    unset($jumlah_ar);
    unset($level_m_ar);
    unset($trend_m_ar);
    unset($musim_m_ar);
    unset($prediksi_m_ar);
    unset($jumlah_m_ar);
    $beta = $beta + 0.01;
}
$parameter = min($mape_ar);
$parameter_key = array_keys($mape_ar, $parameter);
foreach ($parameter_key as $key) {
}
$beta_a = $beta_ar[$key];
//echo "nilai Beta A : $beta_a";
//echo "<br/>";
$parameter_m = min($mape_m_ar);
$parameter_m_key = array_keys($mape_m_ar, $parameter_m);
foreach ($parameter_m_key as $key_m) {
}
$beta_m = $beta_ar[$key_m];
//echo "nilai Beta M : $beta_m";
//echo "<br/>";
unset($beta_ar);
unset($mape_ar);
unset($mape_m_ar);

//mencari nilai gamma 
$gamma = 0.01;
while ($gamma < 1) {
    $no = 1;
    $smoting = 0;
    //inisialisasi level (AT)
    $data = mysqli_query($koneksi, "SELECT AVG(jumlah_pengunjung) AS a FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 1 AND 12;");
    $at = mysqli_fetch_array($data);
    //inisialisasi trend (TT)
    $data = mysqli_query($koneksi, "SELECT SUM(jumlah_pengunjung) AS jumlah_musim1 FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 1 AND 12");
    $jumlah_musim1 = mysqli_fetch_array($data);
    $data = mysqli_query($koneksi, "SELECT SUM(jumlah_pengunjung) AS jumlah_musim2 FROM (SELECT * FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]') AS kunjungan WHERE periode BETWEEN 13 AND 24");
    $jumlah_musim2 = mysqli_fetch_array($data);
    $selisih = $jumlah_musim2['jumlah_musim2'] - $jumlah_musim1['jumlah_musim1'];
    $data = mysqli_query($koneksi, "SELECT ($selisih) / POW (12, 2) AS tt");
    $tt = mysqli_fetch_array($data);
    //data pengunjung
    $data = mysqli_query($koneksi, "SELECT periode, (jumlah_pengunjung) AS st FROM tabel_kunjungan WHERE id_wisata = '$_GET[id_wisata]' ORDER BY periode");
    $baris = mysqli_num_rows($data);
    while ($st = mysqli_fetch_array($data)) {
        //periode
        if ($st['periode'] <= 12) {
            //echo $no++;
        } else {
            $periode_ar[] = $no;
            //echo $no++;
        }
        //pengunjung
        if ($st['periode'] <= 12) {
            $st['st'];
            //echo number_format($st['st'], 2, ",", ".");
        } else {
            $pengunjung = $st['st'];
            //echo number_format($pengunjung = $st['st'], 2, ",", ".");
            $pengunjung_ar[] = $pengunjung;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_level = $at['a'];
            //echo number_format($i_level = $at['a'], 2, ",", ".");
            $level_ar[] = $i_level;
        } else {
            //smoting level (AT-A)
            $i_level = $alfa_a * ($st['st'] - $musim_ar[$smoting]) + (1 - $alfa_a) * ($level_ar[$smoting] + $trend_ar[$smoting]);
            //echo number_format($i_level = $alfa_a * ($st['st'] - $musim_ar[$smoting]) + (1 - $alfa_a) * ($level_ar[$smoting] + $trend_ar[$smoting]), 2, ",", ".");
            $level_ar[] = $i_level;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_trend = $tt['tt'];
            //echo number_format($i_trend = $tt['tt'], 2, ",", ".");
            $trend_ar[] = $i_trend;
        } else {
            //smoting trend (TT-A)
            $i_trend = $beta_a * ($i_level - $level_ar[$smoting]) + (1 - $beta_a) * $trend_ar[$smoting];
            //echo number_format($i_trend = $beta_a * ($i_level - $level_ar[$smoting]) + (1 - $beta_a) * $trend_ar[$smoting], 2, ",", ".");
            $trend_ar[] = $i_trend;
        }
        if ($st['periode'] <= 12) {
            //inisialisasi musim (ST-A)
            $i_musim = $st['st'] - $at['a'];
            //echo number_format($i_musim = $st['st'] - $at['a'], 2, ",", ".");
            $musim_ar[] = $i_musim;
        } else {
            //smoting musim (ST-A)
            $i_musim = $gamma * ($st['st'] - $i_level) + (1 - $gamma) * $musim_ar[$smoting];
            //echo number_format($i_musim = $gamma * ($st['st'] - $i_level) + (1 - $gamma) * $musim_ar[$smoting], 2, ",", ".");
            $musim_ar[] = $i_musim;
        }
        if ($st['periode'] > 12) {
            //prediksi-A
            $i_prediksi = intval($level_ar[$smoting] + $trend_ar[$smoting] + $musim_ar[$smoting]);
            //echo number_format($i_prediksi = $level_ar[$smoting] + $trend_ar[$smoting] + $musim_ar[$smoting], 2, ",", ".");
            $prediksi_ar[] = $i_prediksi;
        } else {
            //inisialisasi prediksi-A
            //echo number_format(0, 2, ",", ".");
        }
        //error-A
        if ($st['periode'] > 12) {
            $error = $st['st'] - $i_prediksi;
            //echo number_format($error = $st['st'] - $i_prediksi, 2, ",", ".");
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        //abs error-A
        if ($st['periode'] > 12) {
            $abs = abs($error) / ((abs($st['st']) + abs($i_prediksi)));
            //echo number_format($abs = abs($error) / ((abs($st['st']) + abs($i_prediksi)) / 2), 2, ",", ".");
            $jumlah_ar[] = $abs;
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_level_m = $at['a'];
            //echo number_format($i_level_m = $at['a'], 2, ",", ".");
            $level_m_ar[] = $i_level_m;
        } else {
            //smoting level (AT-M)
            $i_level_m = $alfa_m * ($st['st'] / $musim_m_ar[$smoting]) + (1 - $alfa_m) * ($level_m_ar[$smoting] + $trend_m_ar[$smoting]);
            //echo number_format($i_level_m = $alfa_m * ($st['st'] / $musim_m_ar[$smoting]) + (1 - $alfa_m) * ($level_m_ar[$smoting] + $trend_m_ar[$smoting]), 2, ",", ".");
            $level_m_ar[] = $i_level_m;
        }
        if ($st['periode'] < 12) {
            //echo number_format(0, 2, ",", ".");
        } elseif ($st['periode'] == 12) {
            $i_trend_m = $tt['tt'];
            //echo number_format($i_trend_m = $tt['tt'], 2, ",", ".");
            $trend_m_ar[] = $i_trend_m;
        } else {
            //smoting trend (TT-M)
            $i_trend_m = $beta_m * ($i_level_m - $level_m_ar[$smoting]) + (1 - $beta_m) * $trend_m_ar[$smoting];
            //echo number_format($i_trend_m = $beta_m * ($i_level_m - $level_m_ar[$smoting]) + (1 - $beta_m) * $trend_m_ar[$smoting], 2, ",", ".");
            $trend_m_ar[] = $i_trend_m;
        }
        if ($st['periode'] <= 12) {
            //inisialisasi musim (ST-M)
            $i_musim_m = $st['st'] / $at['a'];
            //echo number_format($i_musim_m = $st['st'] / $at['a'], 2, ",", ".");
            $musim_m_ar[] = $i_musim_m;
        } else {
            //smoting musim (ST-M)
            $i_musim_m = $gamma * ($st['st'] / $i_level_m) + (1 - $gamma) * $musim_m_ar[$smoting];
            //echo number_format($i_musim_m = $gamma * ($st['st'] / $i_level_m) + (1 - $gamma) * $musim_m_ar[$smoting], 2, ",", ".");
            $musim_m_ar[] = $i_musim_m;
        }
        if ($st['periode'] > 12) {
            //prediksi-M
            $i_prediksi_m = intval(($level_m_ar[$smoting] + $trend_m_ar[$smoting]) * $musim_m_ar[$smoting]);
            //echo number_format($i_prediksi_m = ($level_m_ar[$smoting] + $trend_m_ar[$smoting]) * $musim_m_ar[$smoting], 2, ",", ".");
            $prediksi_m_ar[] = $i_prediksi_m;
            $smoting++;
        } else {
            //inisialisasi prediksi-M
            //echo number_format(0, 2, ",", ".");
        }
        //error-M
        if ($st['periode'] > 12) {
            $error_m = $st['st'] - $i_prediksi_m;
            //echo number_format($error_m = $st['st'] - $i_prediksi_m, 2, ",", ".");
        } else {
            //echo number_format(0, 2, ",", ".");
        }
        //abs error-M
        if ($st['periode'] > 12) {
            $abs_m = abs($error_m) / ((abs($st['st']) + abs($i_prediksi_m)));
            //echo number_format($abs_m = abs($error_m) / ((abs($st['st']) + abs($i_prediksi_m)) / 2), 2, ",", ".");
            $jumlah_m_ar[] = $abs_m;
        } else {
            //echo number_format(0, 2, ",", ".");
        }
    }
    $mape = 100 / count($jumlah_ar) * array_sum($jumlah_ar);
    $mape_m = 100 / count($jumlah_m_ar) * array_sum($jumlah_m_ar);
    $gamma_ar[] = $gamma;
    $mape_ar[] = $mape;
    $mape_m_ar[] = $mape_m;
    unset($periode_ar);
    unset($pengunjung_ar);
    unset($level_ar);
    unset($trend_ar);
    unset($musim_ar);
    unset($prediksi_ar);
    unset($jumlah_ar);
    unset($level_m_ar);
    unset($trend_m_ar);
    unset($musim_m_ar);
    unset($prediksi_m_ar);
    unset($jumlah_m_ar);
    $gamma = $gamma + 0.01;
}
$parameter = min($mape_ar);
$parameter_key = array_keys($mape_ar, $parameter);
foreach ($parameter_key as $key) {
}
$gamma_a = $gamma_ar[$key];
//echo "nilai Gamma A : $gamma_a";
//echo "<br/>";
$parameter_m = min($mape_m_ar);
$parameter_m_key = array_keys($mape_m_ar, $parameter_m);
foreach ($parameter_m_key as $key_m) {
}
$gamma_m = $gamma_ar[$key_m];
//echo "nilai Gamma M : $gamma_m";
//echo "<br/>";
unset($gamma_ar);
unset($mape_ar);
unset($mape_m_ar);
?>