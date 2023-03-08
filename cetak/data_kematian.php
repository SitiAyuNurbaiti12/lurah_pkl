<?php 
	require_once("../koneksi.php");
	require_once("../fungsi_indotgl.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Surat Keterangan Kematian</title>
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap.min.css.map">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-grid.min.css.map">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-reboot.min.css.map">

	<style>
    .text-content{
      text-indent: 50px;
    }
    #isi{
      line-height: 1.7;
    }
    img{
      width: 85px;
    }
    hr{
      border: solid;
    }
    .wew{
      margin-right: 7%;
    }
    .tujuan{
      margin-left: 70%;
      margin-top:  -6%;
    }

    .heheehe{
      margin-top: -5%;
    }
      .kanan{
      margin-top: -10%;
    }
    .ttd{
      margin-left: 72%;
    }
    .ttd2{
      margin-right: 75%;
      margin-top: -21%;
    }

  </style>
</head>


<div class="container" style="font-family: time;">
		
	<h4 class="text-center">PEMERINTAH KABUPATEN BANJAR</h4>
	<img src="../images/banjar.png" class="float-left"><h2 class="text-center wew"><b>KECAMATAN MARTAPURA</b>
	<p><b>DESA TUNGKARAN</b></p></h2>
	<h5 class="text-center" style="margin-right: 5%;"><i>JL. Keramat RT.003 RW.002 Tungkaran Telepon (0511)7588603 Kode Pos 70651</i></h5>
	<hr>
	<br>
  <br>
	<br>
	<br>

	<div class="tujuan">
		<h5><p>Banjarbaru <?php echo tgl_indo(date('Y-m-d')); ?></p>
		<p>
			Kepada&ensp;&ensp;&ensp;:
		<p>
			Yth. Lurah, Desa Tungkaran 
			<p>
			Di&ensp;-
			<p>
				&ensp;&ensp;&ensp;Tempat
			</p>	
			</p>
		</p>
		</p>
	</h5>
	</div>
	<br>
	<br>


	<div class="container">
	<h2 class="text-center"> DATA REGISTER</h2>
	<h2 class="text-center"> Surat Keterangan Kematian</h2><br>
	<table class="table table-bordered table-hover table-sm" style="margin: 0 auto">
			<thead class="">
				<tr class="text-center">
					<th style="vertical-align: middle;">NO</th>
					<th>Pembuat Surat</th>
					<th>Tgl Register</th>
					<th>Nama (Meninggal)</th>
					<th>JK</th>
					<th>Tempat TGL Lahir</th>
					<th>Alamat</th>
					<th>Hari/Tgl Meninggal/Jam</th>
					<th>Tempat Meninggal</th>
					<th>Makam</th>
				</tr>
				<tbody>	
			</thead>	

				<?php session_start(); 

				if (isset($_POST['cetak'])) {
					$bulan = $_REQUEST['bulan'];
					$tahun = $_REQUEST['tahun'];
					$result = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_kematian ON pemohon.id_pm=pj_kematian.id_pm INNER JOIN rg_kematian ON pj_kematian.id_pjkt=rg_kematian.id_pjkt INNER JOIN pegawai ON pegawai.id_pg=rg_kematian.id_pg WHERE rg_kematian.tgl_rg_kt LIKE '%$bulan%' AND rg_kematian.tgl_rg_kt LIKE '%$tahun%'");
				}else{
					$result = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_kematian ON pemohon.id_pm=pj_kematian.id_pm INNER JOIN rg_kematian ON pj_kematian.id_pjkt=rg_kematian.id_pjkt INNER JOIN pegawai ON pegawai.id_pg=rg_kematian.id_pg");
				}
				if(mysqli_num_rows($result)==0) {
					echo "<script>alert('Data Tidak Ada!.'); window.location = '../admin/rg_kematian.php';</script>";; 	
				}
				$i=1;
				while($row = mysqli_fetch_array($result)) { ?>
					<tr class="text-center">
						<td style="vertical-align: middle;"><?=$i++;?></td>
						<td><?= $row['nama'] ?></td>
						<td><?= tgl_indo($row['tgl_rg_kt']) ?></td>
						<td><?= $row['nm_mgl'] ?></td>
						<td><?= $row['jk_mgl'] ?></td>           
						<td><?= $row['tmpt_lhr'] ?> <?= tgl_indo($row['tgl_lhr']) ?></td>
						<td><?= $row['alamat'] ?></td>
						<td><?= $row['hari_mgl'] ?> / <?= tgl_indo($row['tgl_mgl']) ?> / <?= $row['jam_mgl']?> <?= $row['jamwilayah'] ?></td>
						<td><?= $row['tmpt_mgl'] ?></td> 
						<td><?= $row['makam'] ?></td> 
					</tr>
				<?php } ?>
			</tbody>
		</thead>
	</table>
</div>
</div>

<br>
<br>
<br>
<br>

<table class="text-center ttd">
  <tbody>
    <tr>
      <td><h5><b>Tungkaran, <?php echo tgl_indo(date('Y-m-d')); ?></b></h5></td>
    </tr>
    <tr>
      <td><h5><b>Pambakal Tungkaran</b></h5></td>
    </tr>
<tr></tr>
<tr></tr>
<tr></tr>
  </tbody>
</table>
<script>window.print();</script>