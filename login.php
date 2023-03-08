<?php 
  session_start();
  require "koneksi.php";
  error_reporting(0);
  $username  = $_REQUEST['username'];
  $password = $_REQUEST['password'];

  if(isset($_POST['login'])){

  $pemohon = mysqli_query($koneksi, "SELECT * FROM pemohon WHERE username_pm='$username' AND password_pm='$password'") or die(mysqli_error($koneksi));
  $cek2  = mysqli_fetch_array($pemohon);
if($cek2['level'] == 'pemohon'){
      $_SESSION['id_pm'] = $cek2['id_pm'];
      $_SESSION['level']       =$cek2['level'];
      ?> <script>window.location='pemohon/index.php'</script> <?php
    }else{
      ?><script>alert('Gagal Login');window.location="index.html"; </script><?php
    }
  }
  $access = $_REQUEST['access'];
  if(isset($_POST['run'])){

if($access == 'xrlsert125'){
      ?> <script>window.location='adminlog.html'</script> <?php
    }else{
      ?><script>alert('Wrong Access :(');window.location="index.html"; </script><?php
    }
  }
?>