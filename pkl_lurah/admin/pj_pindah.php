<?php require_once("head.php");require_once("../koneksi.php");require_once("../fungsi_indotgl.php");  error_reporting(0); 

$action = isset($_GET['action']) ? $_GET['action'] : ''; 
switch($action){ default: $sql = mysqli_query($koneksi, "SELECT * FROM pemohon");
$id_pj_pindah = $_GET['id_pj_pindah'];
$pmhn = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm WHERE id_pj_pindah = '$id_pj_pindah' ");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengajuan Surat Keterangan Pindah</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Pengajuan Surat Keterangan Pindah</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 
if(mysqli_num_rows($pmhn)> 0){ ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>Detail Data Pengajuan Surat Keterangan Pindah</h3>
          </div>
          <div class="card-body">
          <form name="table" method="POST">
            <table id="table" class="table table-bordered table-striped">
              <thead>
                <tr class="text-center">
                  <th>NIK & Nama</th>
                  <th>Tempat TGL Lahir</th>
                  <th>JK</th>
                  <th>Status Perkawinan</th>
                  <th>Pendidikan</th>
                  <th>Alamat Lama</th>
                  <th>Alamat Pindah (Baru)</th>
                  <th>Alasan Pindah</th>
                  <th>Jumlah Pengikut</th>
                  <th>Foto Surat Pengantar RT</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                while($ayyo = mysqli_fetch_array($pmhn)){ ?>
                  <tr class="text-center">
                    <td><?= $ayyo['nik'] ?> <?= $ayyo['nama'] ?></td>        
                    <td><?= $ayyo['tp_lahir'] ?> <?= tgl_indo($ayyo['tgl_lahir']) ?></td>
                    <td><?= $ayyo['jk_pmh'] ?></td>
                    <td><?= $ayyo['status_kawin'] ?></td>
                    <td><?= $ayyo['pendidikan_pdh'] ?></td>
                    <td><?= $ayyo['alamat'] ?></td>
                    <td><?= $ayyo['alamat_pdh'] ?></td>
                    <td><?= $ayyo['alasan_pdh'] ?></td>
                    <td><?= $ayyo['pengikut_pdh'] ?></td>
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['pengantar_pdh']; ?>"><img src="<?php echo '../foto/'.$ayyo['pengantar_pdh'] ?>" width="85px;"></a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pengajuan Surat Keterangan Pindah</h3>
                <a href="?action=tambah" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i> Tambah Data</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>Detail</th>
                    <th>Nama Pembuat Surat</th>
                    <th>Alasan Pindah</th>
                    <th>Tanggal Pembuatan Pengajuan</th>
                    <th>Status Pengajuan</th>
                    <th id="ikonbtn"><i class="fas fa-cogs"></i></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <tr>
                    <?php 
                    $no = 1;
                    $sql = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td style="vertical-align: middle;"><a title="Detail ?" name="id_pj_pindah" href="?action=detail&id_pj_pindah=<?php echo $data['id_pj_pindah']; ?>" class="btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></i></a></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['alasan_pdh'] ?></td>
                    <td><?php echo tgl_indo($data['tgl_pdh']) ?></td>
                    <td><?=$data['status_pdh']?></td>
                    <td id="ikonbtn2">
                      <a title="Edit Data?" name="id_pj_pindah" href="?action=ubah&id_pj_pindah=<?php echo $data['id_pj_pindah']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                      <a name="hp_pdh" href="?action=hps&id_pj_pindah=<?php echo $data['id_pj_pindah']; ?>" class="btn btn-danger btn-circle" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php } ?>
                  
                  </tfoot>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ============= -->

<?php break; case "tambah": ?>
  <div class="content-wrapper">
   <!-- INPUT DATA -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>FORM INPUT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Input Data Pengajuan Surat Keterangan Pindah</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">

<!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Input Data Pengajuan Surat Keterangan Pindah</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Kewarganegaraan</label>
                    <input type="text" class="form-control" name="negara" placeholder="Kewarganegaraan" required="">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Status Perkawinan</label>
                      <input type="text" class="form-control" name="status_kawin" placeholder="Status Perkawinan" required="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                      <input type="text" name="pendidikan_pdh" class="form-control" placeholder="Pendidikan Terakhir" required="">
                        </div>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Alamat Lengkap Pindah</label>
                      <textarea class="form-control" name="alamat_pdh" id="" cols="30" rows="5">Alamat Lengkap</textarea>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Alasan Pindah</label>
                    <input type="text" name="alasan_pdh" class="form-control" placeholder="Alasan Pindah" required="">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Pengikut</label>
                        <input type="number" name="pengikut_pdh" class="form-control" placeholder="Jumlah Pengikut" required="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Foto Pengantar RT</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image1" class="custom-file-input" required="">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col"><p style="color: red">EKSTENSI YANG DIPERBOLEHKAN HANYA DALAM BENTUK .PNG | .JPG | .JPEG (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p></div>
                  </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-secondary" title="Kembali"><a style="color: white;" id="log" onclick="history.back()"><i class="fas fa-arrow-left"></i><i class="fas fa-fast-backward"></i></a></button>
                  <button type="reset" class="btn btn-danger" title="Reset"><i class="fas fa-window-restore"></i></button>
                  <button type="submit" name="input" class="btn btn-primary float-sm-right" title="Simpan"><i class="fas fa-save"></i></button>
                </div>
              </form>
            </div>
            <!-- /.card -->
           </div>
       </div>
   </div>
</section>
</div>

<!-- PROSES INPUT -->
<?php 
$now = date('y-m-d');
if (isset($_POST['input'])) {
$id_pm=$user_id['id_pm'];
$negara = $_REQUEST['negara'];
$status_kawin = $_REQUEST['status_kawin'];
$pendidikan_pdh = $_REQUEST['pendidikan_pdh'];
$alamat_pdh = $_REQUEST['alamat_pdh'];
$alasan_pdh = $_REQUEST['alasan_pdh'];
$pengikut_pdh = $_REQUEST['pengikut_pdh'];

$namafoto1 = $_FILES['image1']['name'];
$file_tmp1 = $_FILES['image1']['tmp_name'];
$namabaru1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto1);   
move_uploaded_file($file_tmp1, '../foto/'.$namabaru1);

$tambah = mysqli_query($koneksi,"INSERT INTO pj_pindah (id_pm,negara,status_kawin,pendidikan_pdh,alamat_pdh,alasan_pdh,pengikut_pdh,tgl_pdh,pengantar_pdh,status_pdh) VALUES('$id_pm','$negara','$status_kawin','$pendidikan_pdh','$alamat_pdh','$alasan_pdh','$pengikut_pdh','$now','$namabaru1','Pengajuan Dalam Proses')");
if($tambah){
?> <script>alert('Berhasil Disimpan!'); window.location = 'pj_pindah.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pj_pindah.php';</script><?php
}
} ?>
<!-- END PROSES INPUT -->

<?php break; case "ubah": 
 $id_pj_pindah  = $_GET['id_pj_pindah'];
  $tb_dt = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm WHERE id_pj_pindah = '$id_pj_pindah'");
  
  $ed = mysqli_fetch_array($tb_dt);{?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>FORM EDIT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Data Pengajuan Surat Keterangan Pindah</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">

<!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Data Pengajuan Surat Keterangan Pindah</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/from-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Kewarganegaraan</label>
                    <input type="text" class="form-control" name="negara" value="<?=$ed['negara']?>" required="">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Status Perkawinan</label>
                      <input type="text" class="form-control" name="status_kawin" value="<?=$ed['status_kawin']?>" required="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Pendidikan Terakhir</label>
                      <input type="text" name="pendidikan_pdh" class="form-control" value="<?=$ed['pendidikan_pdh']?>" required="">
                        </div>
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Alamat Lengkap Pindah</label>
                      <textarea class="form-control" name="alamat_pdh" id="" cols="30" rows="5"><?=$ed['alamat_pdh']?></textarea>
                        </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Alasan Pindah</label>
                    <input type="text" name="alasan_pdh" class="form-control" value="<?=$ed['alasan_pdh']?>" required="">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Pengikut</label>
                        <input type="number" name="pengikut_pdh" class="form-control" value="<?=$ed['pengikut_pdh']?>" required="">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="id_pj_pindah" value="<?=$ed['id_pj_pindah']?>">

                <!-- /.card-body -->
              <?php } ?>
                <div class="card-footer">
                  <button type="button" class="btn btn-secondary" title="Kembali"><a style="color: white;" id="log" onclick="history.back()"><i class="fas fa-arrow-left"></i><i class="fas fa-fast-backward"></i></a></button>
                  <button type="reset" class="btn btn-danger" title="Reset"><i class="fas fa-window-restore"></i></button>
                  <button type="submit" name="edit" class="btn btn-warning float-sm-right" title="Ubah"><i class="fas fa-pencil-alt"></i></button>
                </div>
              </form>
            </div>
            <!-- /.card 1-->
           </div>

            <!-- CARD 2 -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Foto Pengantar RT</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <img src="<?php echo '../foto/'.$ed["pengantar_pdh"]; ?>" width="120;">
                        <input type="file" name="pengantarnew" class="form-control">
                        <input type="hidden" name="fotosebelum" value="<?=$ed['pengantar_pdh']?>">
                      </div>
                    </div>
                    <p style="color: red">Ekstensi yang diperbolehkan dalam bentuk .png | .jpg | .jpeg (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p>
                  </div>
                <input type="hidden" name="id_pj_pindah" value="<?=$ed['id_pj_pindah']?>">
                <div class="card-footer">
                  <button type="button" class="btn btn-secondary" title="Kembali"><a style="color: white;" id="log" onclick="history.back()"><i class="fas fa-arrow-left"></i><i class="fas fa-fast-backward"></i></a></button>
                  <button type="submit" name="simpanpengantar" class="btn btn-warning float-sm-right" title="Ubah"><i class="fas fa-pencil-alt"></i></button>
                </div>
              </form>
            </div>
            <!-- CARD 2 -->
       </div>
   </div>
</section>
</div>
<!-- PROSES UBAH DATA -->
<?php
$now = date('y-m-d');
if (isset($_POST['edit'])) {
$id_pj_pindah    = $_POST['id_pj_pindah'];
$negara = $_REQUEST['negara'];
$status_kawin = $_REQUEST['status_kawin'];
$pendidikan_pdh = $_REQUEST['pendidikan_pdh'];
$alamat_pdh = $_REQUEST['alamat_pdh'];
$alasan_pdh = $_REQUEST['alasan_pdh'];
$pengikut_pdh = $_REQUEST['pengikut_pdh'];
$ubahsppd = mysqli_query($koneksi,"UPDATE pj_pindah SET negara = '$negara', status_kawin = '$status_kawin', pendidikan_pdh = '$pendidikan_pdh', alamat_pdh = '$alamat_pdh', alasan_pdh = '$alasan_pdh', pengikut_pdh = '$pengikut_pdh', tgl_pdh = '$now' WHERE id_pj_pindah = '$id_pj_pindah'");

if($ubahsppd){
?> <script>alert('Data Berhasil Diubah!'); window.location = 'pj_pindah.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pj_pindah.php';</script><?php
}

}
if (isset($_POST['simpanpengantar'])) {
  $id_pj_pindah    = $_POST['id_pj_pindah'];
$nama1 = $_FILES['pengantarnew']['name'];
$file_tmp1 = $_FILES['pengantarnew']['tmp_name'];
$fotosebelum = $_REQUEST['fotosebelum'];
$new1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama1);   
move_uploaded_file($file_tmp1, '../foto/'.$new1);
unlink('../foto/'.$fotosebelum);

$ubah = mysqli_query($koneksi,"UPDATE pj_pindah SET pengantar_pdh ='$new1' WHERE id_pj_pindah = '$id_pj_pindah'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_pindah.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pj_pindah.php';</script> <?php
}
}
?>
 <!-- END UBAH DATA -->

 <!-- PROSES HAPUS -->
<?php break; case "hps": 
  $id_pj_pindah = $_REQUEST['id_pj_pindah'];
  mysqli_query($koneksi, "DELETE FROM pj_pindah WHERE id_pj_pindah='$id_pj_pindah'") or die(mysqli_error());
  echo "<script>alert('Berhasil Dihapus!'); window.location = 'pj_pindah.php';</script>";
?>
<!-- END PROSES HAPUS -->

<?php break; } ?>
  <?php require_once("foot.php"); ?>