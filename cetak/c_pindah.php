<?php 
	require_once("../koneksi.php");
	require_once("../fungsi_indotgl.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Surat Keterangan Usaha</title>
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap.min.css.map">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-grid.min.css.map">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="../bootstrap4/dist/css/bootstrap-reboot.min.css.map">

	<style>
    .{
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
      margin-left: 70%;
    }
    .ttd2{
      margin-right: 75%;
      margin-top: -21%;
    }

  </style>
</head>

<?php 

$id_rg_pindah = $_GET['id_rg_pindah'];

$result = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm INNER JOIN rg_pindah ON pj_pindah.id_pj_pindah=rg_pindah.id_pj_pindah INNER JOIN pegawai ON pegawai.id_pg=rg_pindah.id_pg WHERE id_rg_pindah = '$id_rg_pindah'");
while( $row = mysqli_fetch_array($result) ) :?>
	
  <div class="container" style="font-family: time;">
	<h4 class="text-center">PEMERINTAH KABUPATEN BANJAR</h4>
  <img src="../images/banjar.png" class="float-left"><h2 class="text-center wew"><b>KECAMATAN MARTAPURA</b>
  <p><b>DESA TUNGKARAN</b></p></h2>
  <h5 class="text-center" style="margin-right: 5%;"><i>JL. Keramat RT.003 RW.002 Tungkaran Telepon (0511)7588603 Kode Pos 70651</i></h5>
	<hr>
	<br>
	<h3 class="text-center"><b><u>SURAT KETERANGAN PINDAH</u></b></h3>
	<h4 class="text-center"> Nomor : <?php echo $row['no_rg_pindah'] ?> / SK / TKR-MTP / XI / 2022</h4>
	<br>



	<h5 id="isi" class="">Yang bertanda tangan di bawah ini,menerangkan bahwa :</h5>
<br>
	<div style="font-family: time;"><h5>
        <table class="jarak ">
          <tr>
            <td>Nama Lengkap</td>
            <td>: <b><?php echo $row['nama']; ?></b> </td>
          </tr>
          <tr>
            <td>NIK</td>
            <td>: <?php echo $row['nik']; ?></td>
          </tr>
          <tr>
            <td>Tempat/TGL</td>
            <td>: <?php echo $row["tp_lahir"];  echo ", "; echo tgl_indo($row["tgl_lahir"]);?></td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td>: <?php echo $row['jk']; ?></td>
          </tr>
          <tr>
            <td>Kewarganegaraan</td>
            <td>: <?php echo $row["negara"];?></td>
          </tr>
          <tr>
            <td>Agama</td>
            <td>: <?php echo $row['agama']; ?></td>
          </tr>
          <tr>
            <td>Status Kawin</td>
            <td>: <?php echo $row['status_kawin']; ?></td>
          </tr>
          <tr>
            <td>Pendidikan</td>
            <td>: <?php echo $row['pendidikan_pdh']; ?></td>
          </tr>
          <tr>
            <td>Alamat Lama</td>
            <td>: <?php echo $row['alamat']; ?></td>
          </tr>
          <tr>
            <td>Alamat Pindah</td>
            <td>: <?php echo $row['alamat_pdh']; ?></td>
          </tr>
          <tr>
            <td>Alasan Pindah</td>
            <td>: <?php echo $row['alasan_pdh']; ?></td>
          </tr>
          <tr>
            <td>Jumlah Pengikut</td>
            <td>: <?php echo $row['pengikut_pdh']; ?></td>
          </tr>
      </table></h5>
      </div>
      <br>
      <br>
      <h5 id="isi"><p class="jarak ">
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
  <td>
    <br>
    <br>
    <br>
  </td>
</tr>

    <tr>
      <td><h5><b><u><?php echo $row['nama_pg']; ?></u></b></h5></td>
    </tr>

    <tr>
      <td><h5><b><?php echo $row['nip']; ?></b></h5></td>
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
