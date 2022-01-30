<!DOCTYPE html>
<html>
<?php
session_start();
if (empty($_SESSION['id_jabatan'])) {
    echo "<script>alert('Anda tidak memiliki hak akses.'); window.location.href = '../../index.php'</script>";
} elseif ($_SESSION['id_jabatan'] == 2) {
    if (empty($_SESSION['email'])) {
        header('location:../../index.php');
    } else {
        include "../../koneksi.php";
    }
} else {
    echo "<script>alert('Anda tidak memiliki hak akses.'); window.location.href = '../../index.php'</script>";
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Forecasting Wisata Kabupaten Sumenep</title>
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/argon-dashboard-pro" />
    <!--  Social tags      -->
    <meta name="keywords" content="dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, argon, argon ui kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, argon dashboard">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim">
    <meta itemprop="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim">
    <meta name="twitter:description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Argon - Premium Dashboard for Bootstrap 4 by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://demos.creative-tim.com/argon-dashboard/index.html" />
    <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/137/original/opt_adp_thumbnail.jpg" />
    <meta property="og:description" content="Start your development with a Dashboard for Bootstrap 4." />
    <meta property="og:site_name" content="Creative Tim" />
    <!-- Favicon -->
    <link rel="icon" href="../../assets/img/brand/logo_sumenep.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <link rel="stylesheet" href="../../assets/vendor/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="../../assets/vendor/quill/dist/quill.core.css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../../assets/css/argon.min.css?v=1.2.0" type="text/css">
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  d-flex  align-items-center">
                <a class="navbar-brand" href="./data_user.php">
                    <img src="../../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
                </a>
                <div class=" ml-auto ">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./data_user.php">
                                <i class="fas fa-users text-primary"></i>
                                <span class="nav-link-text">Data User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./form_user.php">
                                <i class="fas fa-user-plus text-info"></i>
                                <span class="nav-link-text">Tambah User</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder" src="../../assets/img/theme/profil.png">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM tabel_user WHERE email='$_SESSION[email]'");
                                            $data  = mysqli_fetch_array($query);
                                            echo $data['nama_user'];
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Selamat datang!</h6>
                                </div>
                                <a href="./form_user.php?id_user=<?php echo $data['id_user']?>&id_jabatan=<?php echo $data['id_jabatan']?>" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>Profil</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="../../logout.php" onclick="return confirm('Apakah anda akan keluar?');" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Keluar</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">Form User</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item"><a href="./data_user.php"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="./data_user.php">Data User</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Form User</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <div class="card mb-4">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Form User</h3>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Form groups used in grid -->
                    <form action="<?php if (isset($_GET['id_user'])) {
                                        echo "update_user.php";
                                    } else {
                                        echo "tambah_user.php";
                                    } ?>" method="post" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col">
                                <?php
                                if (isset($_GET['id_user'])) {
                                    $data = mysqli_query($koneksi, "SELECT * FROM tabel_user WHERE id_user = $_GET[id_user]");
                                    $user = mysqli_fetch_array($data);
                                ?>
                                    <input name="id_user" id="id_user" class="form-control" placeholder="Nama" type="hidden" value="<?php echo $user['id_user'] ?>" required>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input name="nama" id="nama" class="form-control" placeholder="Nama" type="text" value="<?php echo $user['nama_user'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input name="email" id="email" class="form-control" placeholder="Email" type="email" value="<?php echo $user['email'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input name="pass" id="pass" class="form-control" placeholder="Sandi" type="password" value="<?php echo $user['passwrd'] ?>" required>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input name="nama" id="nama" class="form-control" placeholder="Nama" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input name="email" id="email" class="form-control" placeholder="Email" type="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input name="pass" id="pass" class="form-control" placeholder="Sandi" type="password" required>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="form-control-label" for="exampleFormControlSelect1">Jabatan</label>
                                    <?php
                                    if (isset($_GET['id_user'])) { ?>
                                        <select name="id_jabatan" id="id_jabatan" class="form-control" data-toggle="select" required>
                                            <option disabled>Pilih Jabatan</option>
                                            <?php
                                            $data = mysqli_query($koneksi, "SELECT * FROM tabel_jabatan");
                                            $baris = mysqli_num_rows($data);
                                            while ($user = mysqli_fetch_array($data)) {
                                            ?>
                                                <option value="<?php echo $user['id_jabatan'] ?>" <?php if ($user['id_jabatan'] == $_GET['id_jabatan']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?php echo $user['nama_jabatan'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } else { ?>
                                        <select name="id_jabatan" id="id_jabatan" class="form-control" data-toggle="select" required>
                                            <option disabled>Pilih Jabatan</option>
                                            <?php
                                            $data = mysqli_query($koneksi, "SELECT * FROM tabel_jabatan");
                                            $baris = mysqli_num_rows($data);
                                            while ($user = mysqli_fetch_array($data)) {
                                            ?>
                                                <option value="<?php echo $user['id_jabatan'] ?>"><?php echo $user['nama_jabatan'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <?php if (isset($_GET['id_user'])) { ?>
                                    <input name="Update" type="submit" value="Update" class="btn btn-primary" />
                                    <a href="./data_user.php" onclick="return confirm('Apakah anda akan keluar?');">
                                        <input name="Kembali" type="button" value="Kembali" class="btn btn-danger" />
                                    </a>
                                <?php } else { ?>
                                    <input name="Simpan" type="submit" value="Simpan" class="btn btn-primary" />
                                    <a href="./data_user.php" onclick="return confirm('Apakah anda akan keluar?');">
                                        <input name="Kembali" type="button" value="Kembali" class="btn btn-danger" />
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Footer -->
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="../../assets/vendor/select2/dist/js/select2.min.js"></script>
    <script src="../../assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../../assets/vendor/moment.min.js"></script>
    <script src="../../assets/vendor/bootstrap-datetimepicker.js"></script>
    <script src="../../assets/vendor/nouislider/distribute/nouislider.min.js"></script>
    <script src="../../assets/vendor/quill/dist/quill.min.js"></script>
    <script src="../../assets/vendor/dropzone/dist/min/dropzone.min.js"></script>
    <script src="../../assets/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script type="text/javascript">
        $(function() {
            $('#datetimepicker1').datetimepicker({
                icons: {
                    time: "fa fa-clock",
                    date: "fa fa-calendar-day",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
        });
    </script>
    <!-- Argon JS -->
    <script src="../../assets/js/argon.min.js?v=1.2.1"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="../../assets/js/demo.min.js"></script>
    <script>
        // Facebook Pixel Code Don't Delete
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', '//connect.facebook.net/en_US/fbevents.js');

        try {
            fbq('init', '111649226022273');
            fbq('track', "PageView");

        } catch (err) {
            console.log('Facebook Track Error:', err);
        }
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
    </noscript>
</body>

</html>