<?php require_once ('../koneksi.php');
 session_start(); 
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['id_pm']) || (trim($_SESSION['id_pm']) == '')) { ?>
<script>
window.location = "../";
</script>
<?php 
}
$session_id=$_SESSION['id_pm'];

$user_query = mysqli_query($koneksi, "SELECT * FROM pemohon WHERE id_pm = '$session_id'")or die(mysqli_error($koneksi));
$user_id = mysqli_fetch_array($user_query);

$_SESSION['message'] = "Hallo";
$_SESSION['msg_type'] = "berhasil";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Website Desa Tungkaran</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='../images/banjar.png' rel='icon' type='image/x-icon'/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../Chartjs/dist/Chart.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <style>
    td{
      vertical-align: middle;
    }
  </style>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <a class="dropdown-item" style="color: white;" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
      </a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <br>
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pegawai.php" class="nav-link">
                  <i class="fas fa-user-secret nav-icon"></i>
                  <p>Daftar Pegawai Kelurahan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pemohon.php" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Akun Anda</p>
                </a>
              </li>
            </ul>
          </li> -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                Buat Pengajuan Surat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pj_kematian.php" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>  
                  <p>Keterangan Kematian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pj_usaha.php" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>  
                  <p>Keterangan Usaha</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pj_domisili.php" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <p>Keterangan Domisili</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pj_tmampu.php" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>
                  <p>Keterangan Tidak Mampu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pj_pindah.php" class="nav-link">
                  <i class="fas fa-file-alt nav-icon"></i>  
                  <p>Keterangan Pindah</p>
                </a>
              </li>
            </ul>
          </li>

          <hr>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Print Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cpendamping.php" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>  
                  <p>Keterangan Kematian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ccard.php" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Keterangan Usaha</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cposyandu.php" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Keterangan Domisili</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cposbindu.php" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>
                  <p>Keterangan Tidak Mampu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cadat.php" class="nav-link">
                  <i class="fas fa-clipboard-list nav-icon"></i>  
                  <p>Keterangan pindah</p>
                </a>
              </li>
            </ul>
          </li> -->
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>