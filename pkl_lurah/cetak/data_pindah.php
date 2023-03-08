<?php 
	require_once("../koneksi.php");
	require_once("../fungsi_indotgl.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Surat Keterangan Pindah</title>
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
	<h2 class="text-center"> Surat Keterangan Pindah</h2><br>
	<table class="table table-bordered table-hover table-sm" style="margin: 0 auto">
			<thead class="">
				<tr class="text-center">
					<th style="vertical-align: middle;">NO</th>
					<th>NIK & Nama</th>
					<th>Tempat TGL Lahir</th>
					<th>JK</th>
					<th>Status Perkawinan</th>
					<th>Pendidikan</th>
					<th>Alamat Lama</th>
					<th>Alamat Pindah (Baru)</th>
					<th>Alasan Pindah</th>
					<th>Jumlah Pengikut</th>
					<th>TGL Register</th>
				</tr>
				<tbody>	
			</thead>	

				<?php session_start(); 

				if (isset($_POST['cetak'])) {
					$bulan = $_REQUEST['bulan'];
					$tahun = $_REQUEST['tahun'];
					$result = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm INNER JOIN rg_pindah ON pj_pindah.id_pj_pindah=rg_pindah.id_pj_pindah INNER JOIN pegawai ON pegawai.id_pg=rg_pindah.id_pg WHERE rg_pindah.tgl_rg_pindah LIKE '%$bulan%' AND rg_pindah.tgl_rg_pindah LIKE '%$tahun%'");
				}else{
					$result = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm INNER JOIN rg_pindah ON pj_pindah.id_pj_pindah=rg_pindah.id_pj_pindah INNER JOIN pegawai ON pegawai.id_pg=rg_pindah.id_pg");
				}
				if(mysqli_num_rows($result)==0) {
					echo "<script>alert('Data Tidak Ada!.'); window.location = '../admin/rg_pindah.php';</script>";; 	
				}
				$i=1;
				while($row = mysqli_fetch_array($result)) { ?>
					<tr class="text-center">
						<td style="vertical-align: middle;"><?=$i++;?></td>
						<td><?= $row['nik'] ?> <?= $row['nama'] ?></td>        
						<td><?= $row['tp_lahir'] ?> <?= tgl_indo($row['tgl_lahir']) ?></td>
						<td><?= $row['jk_pmh'] ?></td>
						<td><?= $row['status_kawin'] ?></td>
						<td><?= $row['pendidikan_pdh'] ?></td>
						<td><?= $row['alamat'] ?></td>
						<td><?= $row['alamat_pdh'] ?></td>
						<td><?= $row['alasan_pdh'] ?></td>
						<td><?= $row['pengikut_pdh'] ?></td>
						<td><?= tgl_indo($row['tgl_rg_pindah']) ?></td> 
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