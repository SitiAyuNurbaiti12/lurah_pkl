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
      margin-top:  -23%;
    }

    .heheehe{
      margin-top: -5%;
    }
      .kanan{
      margin-top: -10%;
    }
    .ttd{
      margin-left: 75%;
    }
    .ttd2{
      margin-right: 75%;
      margin-top: -19%;
    }

  </style>
</head>

<?php 

$id_rg_kt = $_GET['id_rg_kt'];

$result = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_kematian ON pemohon.id_pm=pj_kematian.id_pm INNER JOIN rg_kematian ON pj_kematian.id_pjkt=rg_kematian.id_pjkt INNER JOIN pegawai ON pegawai.id_pg=rg_kematian.id_pg WHERE id_rg_kt = '$id_rg_kt'");


while( $row = mysqli_fetch_array($result) ) :

?>




	<div class="container" style="font-family: time;">
		
	<h4 class="text-center">PEMERINTAH KABUPATEN BANJAR </h4>
	<img src="../images/banjar.png" class="float-left"><h2 class="text-center wew"><b>KECAMATAN MARTAPURA</b>
	<p><b>DESA TUNGKARAN</b></p></h2>
	<h5 class="text-center" style="margin-right: 5%;"><i>JL. Keramat RT.003 RW.002 Tungkaran Telepon (0511)7588603 Kode Pos 70651</i></h5>
	<hr>
	<br>




	<h3 class="text-center"><b><u>SURAT KETERANGAN KEMATIAN</u></b></h3>
	<h4 class="text-center"> No. : <?php echo $row['no_rg_kt'] ?> / PAM-TKR/SKM/X/<?=tgl_indo($row['tgl_rg_kt'])?></h4>
	<br>



	<h5 id="isi" class="text-content">Yang bertanda tangan di bawah ini Pambakal Tungkaran Kecamatan Martapura Kabupaten Banjar dengan ini menerangkan bahwa :</h5>
	<br>

	<div style="font-family: time;"><h5>
				<table class="jarak text-content">
					<tr>
						<td>Nama</td>
						<td>: <?php echo $row['nm_mgl']; ?></td>
					</tr>
					<tr>
						<td>Tempat/Tanggal Lahir</td>
						<td>: <?php echo $row["tmpt_mgl"];  echo ", "; echo tgl_indo($row["tgl_mgl"]);?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>: <?php echo $row['jk_mgl']; ?></td>
					</tr>
					<tr>
						<td>Alamat Rumah</td>
						<td>: <?php echo $row['alamat_mgl']; ?></td>
					</tr>
			</table></h5>
			</div>
			<br>

			<h5 class="text-center">Nama Tersebut diatas adalah benar Warga Desa Tungkaran Kecamatan Martapura kabupaten Banjar dan telah meninggal dunia pada :</h5>
			<br>

			<div style="font-family: time;"><h5>
				<table class="jarak text-content">
					<tr>
						<td>Hari</td>
						<td>:  <?php echo $row['hari_mgl']; ?></td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>: <?php echo tgl_indo($row["tgl_mgl"]);?></td>
					</tr>
					<tr>
						<td>Jam</td>
						<td>: <?php echo $row['jam_mgl']; ?></td>
					</tr>
					<tr>
						<td>Tempat Meninggal</td>
						<td>: <?php echo $row['tmpt_mgl']; ?></td>
					</tr>
					<tr>
						<td>Tempat Pemakaman</td>
						<td>: <?php echo $row['makam']; ?></td>
					</tr>
			</table></h5>
			</div>
			<br><br>
	<h5 id="isi"><p class="jarak text-content">
			Demikian Surat Keterangan ini dibuat dan diberikan kepada yang bersangkutan untuk dapat dipergunakan sebagaimana mestinya.</p></h5>





<br>
<br>
<br>


<table class="text-center ttd">
  <tbody>
    <tr>
      <td><h5>Guntung Manggis, <?php echo tgl_indo(date('Y-m-d')); ?></h5></td>
    </tr>
    <tr>
      <td><h5 style="text-transform: uppercase;" class="text-center" style="margin-right: 14%;"><b><?php echo $row['jabatan'] ?></b></h5></td>
    </tr>

<tr>
  <td><br><br></td>
</tr>

    <tr>
      <td><h5><b><u><?php echo $row['nama_pg']; ?></u></b></h5></td>
    </tr>

    <tr>
      <td><h5><b><?php echo $row['nip']; ?></b></h5></td>
    </tr>
  </tbody>
</table>

<table class="text-center ttd2">
  <tbody>
    <tr>
      <td><h5 style="text-transform: uppercase;" class="text-center" style="margin-right: 14%;"><b>Pemohon</b></h5></td>
    </tr>
    <tr>
      <td><h5><b><u><?php echo $row['nama']; ?></u></b></h5></td>
    </tr>
    <tr>
    	<td><br>
    	<br><br></td>
    </tr>
    <tr>
      <td><h5><b><?php echo $row['nik']; ?></b></h5></td>
    </tr>
  </tbody>
</table>











	<?php endwhile; ?>

	<script type="text/javascript">
		window.print();
	</script>
	</div> <!-- akhir container -->
	
</div>
</html>
