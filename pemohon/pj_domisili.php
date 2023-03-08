<?php require_once("head.php");require_once("../koneksi.php");require_once("../fungsi_indotgl.php");  error_reporting(0); 

$action = isset($_GET['action']) ? $_GET['action'] : ''; 
switch($action){ default: $sql = mysqli_query($koneksi, "SELECT * FROM pj_domisili");
$id_pj_dms = $_GET['id_pj_dms'];
$pmhn = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_domisili ON pemohon.id_pm=pj_domisili.id_pm WHERE id_pj_dms = '$id_pj_dms' ");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Surat Keterangan Domisili</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Surat Keterangan Domisili</li>
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
            <h3>Detail Data Surat Keterangan Domisili</h3>
          </div>
          <div class="card-body">
          <form name="table" method="POST">
            <table id="table" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Tempat & Tgl Lahir</th>
                  <th>JK</th>
                  <th>Pekerjaan</th>
                  <th>No HP</th>
                  <th>Alamat Domisili</th>
                  <th>Foto KTP</th>
                  <th>Foto KK</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                while($ayyo = mysqli_fetch_array($pmhn)){ ?>
                  <tr class="text-center">
                    <td><?= $ayyo['nama'] ?></td>
                    <td><?= $ayyo['nik'] ?></td>           
                    <td><?= $ayyo['tp_lahir'] ?> <?= tgl_indo($ayyo['tgl_lahir']) ?></td>
                    <td><?= $ayyo['jk_pmh'] ?></td>
                    <td><?= $ayyo['pekerjaan_dms'] ?></td>
                    <td><?= $ayyo['no_hp'] ?></td>
                    <td><?= $ayyo['alamat_dms'] ?></td>
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['ktp_dms']; ?>"><img src="<?php echo '../foto/'.$ayyo['ktp_dms'] ?>" width="85px;"></a></td>
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['kk_dms']; ?>"><img src="<?php echo '../foto/'.$ayyo['kk_dms'] ?>" width="85px;"></a></td>
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
                <h3 class="card-title">Data Surat Keterangan Domisili</h3>
                <a href="?action=tambah" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i> Tambah Data</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>Detail</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Pekerjaan</th>
                    <th>Alamat Domisili</th>
                    <th>Status Surat Pengajuan</th>
                    <th id="ikonbtn"><i class="fas fa-cogs"></i></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <tr>
                    <?php 
                    $no = 1;
                    $username_pm=$user_id['username_pm'];
                    $sql = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_domisili ON pemohon.id_pm=pj_domisili.id_pm WHERE username_pm='$username_pm'");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td style="vertical-align: middle;"><a title="Detail?" name="id_pj_dms" href="?action=detail&id_pj_dms=<?php echo $data['id_pj_dms']; ?>" class="btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></i></a></td>
                    <td><?php echo $data['nik'] ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['pekerjaan_dms'] ?></td>
                    <td><?php echo $data['alamat_dms'] ?></td>
                    <td><?php echo $data['status_dms'] ?></td>
                    <td id="ikonbtn2">
                      <a title="Edit Data?" name="id_pj_dms" href="?action=ubah&id_pj_dms=<?php echo $data['id_pj_dms']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                      <a href="?action=hps&id_pj_dms=<?php echo $data['id_pj_dms']; ?>" class="btn btn-danger btn-circle" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fas fa-trash"></i></a>
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
              <li class="breadcrumb-item active">Input Data Surat Keterangan Domisili</li>
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
                <h3 class="card-title">Input Data Surat Keterangan Domisili</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Pekerjaan</label>
                    <input type="text" class="form-control" name="pekerjaan_dms" id="exampleInputPassword1" placeholder="Pekerjaan">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Domisili</label>
                    <input type="text" name="alamat_dms" class="form-control" placeholder="Alamat Domisili">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Foto KTP Anda</label>
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
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Kartu Keluarga Anda</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image2" class="custom-file-input" required="">
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
$pekerjaan_dms = $_REQUEST['pekerjaan_dms'];
$alamat_dms = $_REQUEST['alamat_dms'];

$namafoto1 = $_FILES['image1']['name'];
$file_tmp1 = $_FILES['image1']['tmp_name'];
$namabaru1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto1);   
move_uploaded_file($file_tmp1, '../foto/'.$namabaru1);

$namafoto2 = $_FILES['image2']['name'];
$file_tmp2 = $_FILES['image2']['tmp_name'];
$namabaru2 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto2);   
move_uploaded_file($file_tmp2, '../foto/'.$namabaru2);

$tambah = mysqli_query($koneksi,"INSERT INTO pj_domisili (id_pm,pekerjaan_dms,alamat_dms,ktp_dms,kk_dms,tgl_dms,status_dms) VALUES('$id_pm','$pekerjaan_dms','$alamat_dms','$namabaru1','$namabaru2','$now','Pengajuan Dalam Proses')");
if($tambah){
?> <script>alert('Berhasil Disimpan!'); window.location = 'pj_domisili.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pj_domisili.php';</script><?php
}
} ?>
<!-- END PROSES INPUT -->

<?php break; case "ubah": 
 $id_pj_dms  = $_GET['id_pj_dms'];
  $tb_dt = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_domisili ON pemohon.id_pm=pj_domisili.id_pm WHERE id_pj_dms = '$id_pj_dms'");
  
  $data = mysqli_fetch_array($tb_dt);{?>
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
              <li class="breadcrumb-item active">Edit Data Surat Keterangan Domisili</li>
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
                <h3 class="card-title">Edit Data Surat Keterangan Domisili</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/from-data">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Pekerjaan</label>
                    <input type="text" class="form-control" name="pekerjaan_dms" value="<?=$data['pekerjaan_dms']?>">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Alamat Domisili</label>
                    <input type="text" name="alamat_dms" class="form-control" value="<?=$data['alamat_dms']?>">
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="id_pj_dms" value="<?=$data['id_pj_dms']?>">

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
                <h3 class="card-title">Edit Foto KTP</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <img src="<?php echo '../foto/'.$data["ktp_dms"]; ?>" width="120;">
                        <input type="file" name="ktpbaru" class="form-control">
                        <input type="hidden" name="fotosebelum" value="<?=$data['ktp_dms']?>">
                      </div>
                    </div>
                    <p style="color: red">Ekstensi yang diperbolehkan dalam bentuk .png | .jpg | .jpeg (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p>
                  </div>
                <input type="hidden" name="id_pj_dms" value="<?=$data['id_pj_dms']?>">
                <div class="card-footer">
                  <button type="button" class="btn btn-secondary" title="Kembali"><a style="color: white;" id="log" onclick="history.back()"><i class="fas fa-arrow-left"></i><i class="fas fa-fast-backward"></i></a></button>
                  <button type="submit" name="simpanktp" class="btn btn-warning float-sm-right" title="Ubah"><i class="fas fa-pencil-alt"></i></button>
                </div>
              </form>
            </div>
            <!-- CARD 2 -->

            <!-- CARD 3 -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Foto KK</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <img src="<?php echo '../foto/'.$data["kk_dms"]; ?>" width="120;">
                        <input type="file" name="kkbaru" class="form-control">
                        <input type="hidden" name="fotosebelum" value="<?=$data['kk_dms']?>">
                      </div>
                    </div>
                    <p style="color: red">Ekstensi yang diperbolehkan dalam bentuk .png | .jpg | .jpeg (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p>
                  </div>
                <input type="hidden" name="id_pj_dms" value="<?=$data['id_pj_dms']?>">
                <div class="card-footer">
                  <button type="button" class="btn btn-secondary" title="Kembali"><a style="color: white;" id="log" onclick="history.back()"><i class="fas fa-arrow-left"></i><i class="fas fa-fast-backward"></i></a></button>
                  <button type="submit" name="simpankk" class="btn btn-warning float-sm-right" title="Ubah"><i class="fas fa-pencil-alt"></i></button>
                </div>
              </form>
            </div>
            <!-- CARD 3 -->

       </div>
   </div>
</section>
</div>
<!-- PROSES UBAH DATA -->
<?php
$now = date('y-m-d');
if (isset($_POST['edit'])) {
$id_pj_dms    = $_POST['id_pj_dms'];
$pekerjaan_dms = $_REQUEST['pekerjaan_dms'];
$alamat_dms = $_REQUEST['alamat_dms'];
$ubahsppd = mysqli_query($koneksi,"UPDATE pj_domisili SET pekerjaan_dms = '$pekerjaan_dms', alamat_dms = '$alamat_dms', tgl_dms = '$now' WHERE id_pj_dms = '$id_pj_dms'");

if($ubahsppd){
?> <script>alert('Data Berhasil Diubah!'); window.location = 'pj_domisili.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pj_domisili.php';</script><?php
}

}
if (isset($_POST['simpanktp'])) {
  $id_pj_dms    = $_POST['id_pj_dms'];
$nama1 = $_FILES['ktpbaru']['name'];
$file_tmp1 = $_FILES['ktpbaru']['tmp_name'];
$fotosebelum = $_REQUEST['fotosebelum'];
$new1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama1);   
move_uploaded_file($file_tmp1, '../foto/'.$new1);
unlink('../foto/'.$fotosebelum);

$ubah = mysqli_query($koneksi,"UPDATE pj_domisili SET ktp_dms ='$new1' WHERE id_pj_dms = '$id_pj_dms'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_domisili.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pj_domisili.php';</script> <?php
}
}

if (isset($_POST['simpankk'])) {
  $id_pj_dms    = $_POST['id_pj_dms'];
$nama2 = $_FILES['kkbaru']['name'];
$file_tmp2 = $_FILES['kkbaru']['tmp_name'];
$fotosebelum2 = $_REQUEST['fotosebelum2'];
$new2 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama2);   
move_uploaded_file($file_tmp2, '../foto/'.$new2);
unlink('../foto/'.$fotosebelum2);

$ubah = mysqli_query($koneksi,"UPDATE pj_domisili SET kk_dms ='$new2' WHERE id_pj_dms = '$id_pj_dms'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_domisili.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pj_domisili.php';</script> <?php
}
}
?>
 <!-- END UBAH DATA -->

<!-- PROSES HAPUS -->
<?php break; case "hps": 
  $id_pj_dms = $_REQUEST['id_pj_dms'];
  mysqli_query($koneksi, "DELETE FROM pj_domisili WHERE id_pj_dms='$id_pj_dms'") or die(mysqli_error());
  echo "<script>alert('Berhasil Dihapus!'); window.location = 'pj_domisili.php';</script>";
?>
<!-- END PROSES HAPUS -->
<?php break; } ?>
  <?php require_once("foot.php"); ?>