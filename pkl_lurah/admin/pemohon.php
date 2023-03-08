<?php require_once("head.php");require_once("../koneksi.php");  error_reporting(0); 

$action = isset($_GET['action']) ? $_GET['action'] : ''; 
switch($action){ default: $sql = mysqli_query($koneksi, "SELECT * FROM pemohon");
$id_pm = $_GET['id_pm'];
$pmhn = mysqli_query($koneksi, "SELECT * FROM pemohon WHERE id_pm = '$id_pm' ");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pemohon</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Pemohon</li>
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
            <h3>Detail Data Pemohon</h3>
          </div>
          <div class="card-body">
          <form name="table" method="POST">
            <table id="table" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Username</th>
                  <th>Nomor HP</th>
                  <th>Alamat</th>
                  <th>JK</th>
                  <th>Agama</th>
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
                    <td><?= $ayyo['username_pm'] ?></td>
                    <td><?= $ayyo['no_hp'] ?></td>
                    <td><?= $ayyo['alamat'] ?></td>
                    <td><?= $ayyo['jk_pmh'] ?></td>
                    <td><?= $ayyo['agama'] ?></td>
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['ktp']; ?>"><img src="<?php echo '../foto/'.$ayyo['ktp'] ?>" width="85px;"></a></td>
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['kk']; ?>"><img src="<?php echo '../foto/'.$ayyo['kk'] ?>" width="85px;"></a></td>
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
                <h3 class="card-title">Data Pemohon</h3>
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
                    <th>No Hp</th>
                    <th>Alamat</th>
                    <th>KTP (Click Image)</th>
                    <th id="ikonbtn"><i class="fas fa-cogs"></i></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <tr>
                    <?php 
                    $no = 1;
                    $sql = mysqli_query($koneksi,"SELECT * FROM pemohon");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td style="vertical-align: middle;"><a title="Detail ?" name="id_pm" href="?action=detail&id_pm=<?php echo $data['id_pm']; ?>" class="btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></i></a></td>
                    <td><?php echo $data['nik'] ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['no_hp'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $data['ktp']; ?>"><img src="<?php echo '../foto/'.$data['ktp'] ?>" width="85px;"></a></td>
                    <td id="ikonbtn2">
                      <a title="Edit Data?" name="id_pm" href="?action=ubah&id_pm=<?php echo $data['id_pm']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                      <a href="?action=hps&id_pm=<?php echo $data['id_pm']; ?>" class="btn btn-danger btn-circle" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fas fa-trash"></i></a>
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
              <li class="breadcrumb-item active">Input Data Pemohon</li>
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
                <h3 class="card-title">Input Data Pemohon</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="exampleInputPassword1" placeholder="Nama Lengkap">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username_pm" class="form-control" placeholder="Username">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="password_pm" class="form-control" placeholder="Password">
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">NIK</label>
                      <input type="text" name="nik" class="form-control" placeholder="NIK">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tempat Lahir</label>
                      <input type="text" name="tp_lahir" class="form-control" placeholder="Tempat Lahir">
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Lahir</label>
                      <input type="date" name="tgl_lahir" class="form-control">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Hp</label>
                    <input type="text" name="no_hp" class="form-control" placeholder="Nomor Hp">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                    <select name="jk_pmh" class="form-control">
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Agama</label>
                    <input type="text" name="agama" class="form-control" placeholder="Agama">
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
if (isset($_POST['input'])) {
$nama = $_REQUEST['nama'];
$username_pm = $_REQUEST['username_pm'];
$password_pm = $_REQUEST['password_pm'];
$nik = $_REQUEST['nik'];
$no_hp = $_REQUEST['no_hp'];
$alamat = $_REQUEST['alamat'];
$jk_pmh = $_REQUEST['jk_pmh'];
$agama = $_REQUEST['agama'];
$tp_lahir = $_REQUEST['tp_lahir'];
$tgl_lahir = $_REQUEST['tgl_lahir'];

$namafoto1 = $_FILES['image1']['name'];
$file_tmp1 = $_FILES['image1']['tmp_name'];
$namabaru1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto1);   
move_uploaded_file($file_tmp1, '../foto/'.$namabaru1);

$namafoto2 = $_FILES['image2']['name'];
$file_tmp2 = $_FILES['image2']['tmp_name'];
$namabaru2 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto2);   
move_uploaded_file($file_tmp2, '../foto/'.$namabaru2);

$tambah = mysqli_query($koneksi,"INSERT INTO pemohon (nama,username_pm,password_pm,tp_lahir,tgl_lahir,nik,no_hp,alamat,jk_pmh,agama,ktp,kk,level) VALUES('$nama','$username_pm','$password_pm','$tp_lahir','$tgl_lahir','$tgl_lahir','$no_hp','$alamat','$jk_pmh','$agama','$namabaru1','$namabaru2','pemohon')");
if($tambah){
?> <script>alert('Berhasil Disimpan!'); window.location = 'pemohon.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pemohon.php';</script><?php
}
} ?>
<!-- END PROSES INPUT -->

<?php break; case "ubah": 
 $id_pm  = $_GET['id_pm'];
  $tb_dt = mysqli_query($koneksi,"SELECT * FROM pemohon WHERE id_pm = '$id_pm'");
  
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
              <li class="breadcrumb-item active">Edit Data Pemohon</li>
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
                <h3 class="card-title">Edit Data Pemohon</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/from-data">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="<?=$data['nama']?>">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username_pm" class="form-control" value="<?=$data['username_pm']?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="password_pm" class="form-control" value="<?=$data['password_pm']?>">
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">NIK</label>
                      <input type="text" name="nik" class="form-control" value="<?=$data['nik']?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tempat Lahir</label>
                      <input type="text" name="tp_lahir" class="form-control" value="<?=$data['tp_lahir']?>">
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Lahir</label>
                      <input type="date" name="tgl_lahir" class="form-control" value="<?=$data['tgl_lahir']?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Hp</label>
                    <input type="text" name="no_hp" class="form-control" value="<?=$data['no_hp']?>">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="<?=$data['alamat']?>">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                    <select name="jk_pmh" class="form-control">
                      <option value="<?=$data['jk_pmh']?>"><?=$data['jk_pmh']?></option>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Agama</label>
                    <input type="text" name="agama" class="form-control" value="<?=$data['agama']?>">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="id_pm" value="<?=$data['id_pm']?>">

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
                        <img src="<?php echo '../foto/'.$data["ktp"]; ?>" width="120;">
                        <input type="file" name="ktpbaru" class="form-control">
                        <input type="hidden" name="fotosebelum" value="<?=$data['ktp']?>">
                      </div>
                    </div>
                    <p style="color: red">Ekstensi yang diperbolehkan dalam bentuk .png | .jpg | .jpeg (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p>
                  </div>
                <input type="hidden" name="id_pm" value="<?=$data['id_pm']?>">
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
                        <img src="<?php echo '../foto/'.$data["kk"]; ?>" width="120;">
                        <input type="file" name="kkbaru" class="form-control">
                        <input type="hidden" name="fotosebelum" value="<?=$data['kk']?>">
                      </div>
                    </div>
                    <p style="color: red">Ekstensi yang diperbolehkan dalam bentuk .png | .jpg | .jpeg (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p>
                  </div>
                <input type="hidden" name="id_pm" value="<?=$data['id_pm']?>">
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
if (isset($_POST['edit'])) {
$id_pm    = $_POST['id_pm'];
$nama = $_REQUEST['nama'];
$username_pm = $_REQUEST['username_pm'];
$password_pm = $_REQUEST['password_pm'];
$nik = $_REQUEST['nik'];
$no_hp = $_REQUEST['no_hp'];
$alamat = $_REQUEST['alamat'];
$jk_pmh = $_REQUEST['jk_pmh'];
$agama = $_REQUEST['agama'];
$tp_lahir = $_REQUEST['tp_lahir'];
$tgl_lahir = $_REQUEST['tgl_lahir'];
$ubahsppd = mysqli_query($koneksi,"UPDATE pemohon SET nama = '$nama', nik = '$nik', username_pm = '$username_pm', password_pm = '$password_pm',tp_lahir = '$tp_lahir',tgl_lahir = '$tgl_lahir', no_hp = '$no_hp', alamat = '$alamat', jk_pmh = '$jk_pmh', agama = '$agama' WHERE id_pm = '$id_pm'");

if($ubahsppd){
?> <script>alert('Data Berhasil Diubah!'); window.location = 'pemohon.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pemohon.php';</script><?php
}

}
if (isset($_POST['simpanktp'])) {
  $id_pm    = $_POST['id_pm'];
$nama1 = $_FILES['ktpbaru']['name'];
$file_tmp1 = $_FILES['ktpbaru']['tmp_name'];
$fotosebelum = $_REQUEST['fotosebelum'];
$new1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama1);   
move_uploaded_file($file_tmp1, '../foto/'.$new1);
unlink('../foto/'.$fotosebelum);

$ubah = mysqli_query($koneksi,"UPDATE pemohon SET ktp ='$new1' WHERE id_pm = '$id_pm'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pemohon.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pemohon.php';</script> <?php
}
}

if (isset($_POST['simpankk'])) {
  $id_pm    = $_POST['id_pm'];
$nama2 = $_FILES['kkbaru']['name'];
$file_tmp2 = $_FILES['kkbaru']['tmp_name'];
$fotosebelum2 = $_REQUEST['fotosebelum2'];
$new2 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama2);   
move_uploaded_file($file_tmp2, '../foto/'.$new2);
unlink('../foto/'.$fotosebelum2);

$ubah = mysqli_query($koneksi,"UPDATE pemohon SET kk ='$new2' WHERE id_pm = '$id_pm'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pemohon.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pemohon.php';</script> <?php
}
}
?>
 <!-- END UBAH DATA -->

<!-- PROSES HAPUS -->
<?php break; case "hps": 
  $id_pm = $_REQUEST['id_pm'];
  mysqli_query($koneksi, "DELETE FROM pemohon WHERE id_pm='$id_pm'") or die(mysqli_error());
  echo "<script>alert('Berhasil Dihapus!'); window.location = 'pemohon.php';</script>";
?>
<!-- END PROSES HAPUS -->
<?php break; } ?>
  <?php require_once("foot.php"); ?>