<?php require_once("head.php");require_once("../koneksi.php");require_once("../fungsi_indotgl.php");  error_reporting(0); 

$action = isset($_GET['action']) ? $_GET['action'] : ''; 
switch($action){ default: $sql = mysqli_query($koneksi, "SELECT * FROM pemohon");
$id_pj_ush = $_GET['id_pj_ush'];
$pmhn = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_usaha ON pemohon.id_pm=pj_usaha.id_pm WHERE id_pj_ush = '$id_pj_ush' ");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengajuan Surat Keterangan Usaha</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Pengajuan Surat Keterangan Usaha</li>
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
            <h3>Detail Data Pengajuan Surat Keterangan Usaha</h3>
          </div>
          <div class="card-body">
          <form name="table" method="POST">
            <table id="table" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th>Nama</th>
                  <th>JK</th>
                  <th>Tempat TGL Lahir</th>
                  <th>NIK</th>
                  <th>Agama</th>
                  <th>Alamat</th>
                  <th>Jenis Usaha</th>
                  <th>Alamat Lengkap Usaha</th>
                  <th>Surat Pengantar RT</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                while($ayyo = mysqli_fetch_array($pmhn)){ ?>
                  <tr class="text-center">
                    <td><?= $ayyo['nama'] ?></td>
                    <td><?= $ayyo['jk_pmh'] ?></td>           
                    <td><?= $ayyo['tp_lahir'] ?> <?= tgl_indo($ayyo['tgl_lahir']) ?></td>
                    <td><?= $ayyo['nik'] ?></td> 
                    <td><?= $ayyo['agama'] ?></td> 
                    <td><?= $ayyo['alamat'] ?></td> 
                    <td><?= $ayyo['jenis_ush'] ?></td>  
                    <td><?= $ayyo['alamat_ush'] ?></td>   
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['pengantar_rt']; ?>"><img src="<?php echo '../foto/'.$ayyo['pengantar_rt'] ?>" width="85px;"></a></td>
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
                <h3 class="card-title">Data Pengajuan Surat Keterangan Usaha</h3>
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
                    <th>Pekerjaan</th>
                    <th>TGL Pembuatan Surat ini</th>
                    <th>Status Surat</th>
                    <th id="ikonbtn"><i class="fas fa-cogs"></i></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <tr>
                    <?php 
                    $no = 1;
                    $sql = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_usaha ON pemohon.id_pm=pj_usaha.id_pm");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td style="vertical-align: middle;"><a title="Detail ?" name="id_pj_ush" href="?action=detail&id_pj_ush=<?php echo $data['id_pj_ush']; ?>" class="btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></i></a></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?=$data['pekerjaan']?></td>
                    <td><?=tgl_indo($data['tgl_ush'])?></td>
                    <td><?=$data['status_ush']?></td>
                    <td id="ikonbtn2">
                      <a title="Edit Data?" name="id_pj_ush" href="?action=ubah&id_pj_ush=<?php echo $data['id_pj_ush']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                      <a name="hp_pjkt" href="all_hp.php?id_pj_ush=<?php echo $data['id_pj_ush']; ?>" class="btn btn-danger btn-circle" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fas fa-trash"></i></a>
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
              <li class="breadcrumb-item active">Input Data Pengajuan Surat Keterangan Usaha</li>
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
                <h3 class="card-title">Input Data Pengajuan Surat Keterangan Usaha</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Pekerjaan</label>
                    <input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan" required="">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Usaha</label>
                    <input type="text" name="jenis_ush" class="form-control" placeholder="Jenis Usaha">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Alamat Lengkap Usaha</label>
                    <input type="text" class="form-control" name="alamat_ush" placeholder="Alamat Lengkap Usaha" required="">
                  </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Foto Surat Pengantar RT</label>
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
$pekerjaan = $_REQUEST['pekerjaan'];
$jenis_ush = $_REQUEST['jenis_ush'];
$alamat_ush = $_REQUEST['alamat_ush'];

$namafoto1 = $_FILES['image1']['name'];
$file_tmp1 = $_FILES['image1']['tmp_name'];
$namabaru1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto1);   
move_uploaded_file($file_tmp1, '../foto/'.$namabaru1);

$tambah = mysqli_query($koneksi,"INSERT INTO pj_usaha (id_pm,pekerjaan,jenis_ush,alamat_ush,tgl_ush,pengantar_rt,status_ush) VALUES('$id_pm','$pekerjaan','$jenis_ush','$alamat_ush','$now','$namabaru1','Pengajuan Dalam Proses')");
if($tambah){
?> <script>alert('Berhasil Disimpan!'); window.location = 'pj_usaha.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pj_usaha.php';</script><?php
}
} ?>
<!-- END PROSES INPUT -->

<?php break; case "ubah": 
 $id_pj_ush  = $_GET['id_pj_ush'];
  $tb_dt = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_usaha ON pemohon.id_pm=pj_usaha.id_pm WHERE id_pj_ush = '$id_pj_ush'");
  
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
              <li class="breadcrumb-item active">Edit Data Pengajuan Surat Keterangan Usaha</li>
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
                <h3 class="card-title">Edit Data Pengajuan Surat Keterangan Usaha</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/from-data">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Pekerjaan</label>
                    <input type="text" class="form-control" name="pekerjaan" value="<?=$ed['pekerjaan']?>" required="">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Usaha</label>
                    <input type="text" name="jenis_ush" class="form-control" value="<?=$ed['jenis_ush']?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Alamat Lengkap Usaha</label>
                    <input type="text" class="form-control" name="alamat_ush" value="<?=$ed['alamat_ush']?>" required="">
                  </div>
                    </div>
                  </div>
                  <input type="hidden" name="id_pj_ush" value="<?=$ed['id_pj_ush']?>">

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
                        <img src="<?php echo '../foto/'.$ed["pengantar_rt"]; ?>" width="120;">
                        <input type="file" name="pengantarbaru" class="form-control">
                        <input type="hidden" name="fotosebelum" value="<?=$ed['pengantar_rt']?>">
                      </div>
                    </div>
                    <p style="color: red">Ekstensi yang diperbolehkan dalam bentuk .png | .jpg | .jpeg (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p>
                  </div>
                <input type="hidden" name="id_pj_ush" value="<?=$ed['id_pj_ush']?>">
                <div class="card-footer">
                  <button type="button" class="btn btn-secondary" title="Kembali"><a style="color: white;" id="log" onclick="history.back()"><i class="fas fa-arrow-left"></i><i class="fas fa-fast-backward"></i></a></button>
                  <button type="submit" name="simpanpngntr" class="btn btn-warning float-sm-right" title="Ubah"><i class="fas fa-pencil-alt"></i></button>
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
$id_pj_ush    = $_POST['id_pj_ush'];
$pekerjaan = $_REQUEST['pekerjaan'];
$jenis_ush = $_REQUEST['jenis_ush'];
$alamat_ush = $_REQUEST['alamat_ush'];
$ubahsppd = mysqli_query($koneksi,"UPDATE pj_usaha SET pekerjaan = '$pekerjaan', jenis_ush = '$jenis_ush', alamat_ush = '$alamat_ush', tgl_ush = '$now' WHERE id_pj_ush = '$id_pj_ush'");

if($ubahsppd){
?> <script>alert('Data Berhasil Diubah!'); window.location = 'pj_usaha.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pj_usaha.php';</script><?php
}

}
if (isset($_POST['simpanpngntr'])) {
$id_pj_ush    = $_POST['id_pj_ush'];
$nama1 = $_FILES['pengantarbaru']['name'];
$file_tmp1 = $_FILES['pengantarbaru']['tmp_name'];
$fotosebelum = $_REQUEST['fotosebelum'];
$new1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama1);   
move_uploaded_file($file_tmp1, '../foto/'.$new1);
unlink('../foto/'.$fotosebelum);
$ubah = mysqli_query($koneksi,"UPDATE pj_usaha SET pengantar_rt ='$new1' WHERE id_pj_ush = '$id_pj_ush'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_usaha.php';</script> <?php
}
}
?>
 <!-- END UBAH DATA -->

  <!-- PROSES HAPUS -->
<?php break; case "hps": 
  $id_pj_ush = $_REQUEST['id_pj_ush'];
  mysqli_query($koneksi, "DELETE FROM pj_usaha WHERE id_pj_ush='$id_pj_ush'") or die(mysqli_error());
  echo "<script>alert('Berhasil Dihapus!'); window.location = 'pj_usaha.php';</script>";
?>
<!-- END PROSES HAPUS -->



<?php break; } ?>
  <?php require_once("foot.php"); ?>