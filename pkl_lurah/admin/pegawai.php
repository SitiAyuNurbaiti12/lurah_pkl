<?php require_once("head.php");require_once("../koneksi.php");  error_reporting(0); 

$action = isset($_GET['action']) ? $_GET['action'] : ''; 
switch($action){ default: $sql = mysqli_query($koneksi, "SELECT * FROM pegawai");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Pegawai</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pegawai</h3>
                <a href="?action=tambah" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i> Tambah Data</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>Nip</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Jabatan</th>
                    <th id="ikonbtn"><i class="fas fa-cogs"></i></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <tr>
                    <?php 
                    $no = 1;
                    $sql = mysqli_query($koneksi,"SELECT * FROM pegawai");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nip'] ?></td>
                    <td><?php echo $data['nama_pg'] ?></td>
                    <td><?php echo $data['jk'] ?></td>
                    <td><?php echo $data['jabatan'] ?></td>
                    <td id="ikonbtn2">
                      <a title="Edit Data?" name="id_pg" href="?action=ubah&id_pg=<?php echo $data['id_pg']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                      <a href="?action=hps&id_pg=<?php echo $data['id_pg']; ?>" class="btn btn-danger btn-circle" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fas fa-trash"></i></a>
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
   <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>FORM INPUT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Input Data Pegawai</li>
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
                <h3 class="card-title">Input Data Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">NIP</label>
                    <input type="text" name="nip" class="form-control" id="exampleInputEmail1" placeholder="NIP" required="">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_pg" id="exampleInputPassword1" placeholder="Nama Lengkap">
                  </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" placeholder="Jabatan">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                          <select class="form-control" name="jk">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                          </select>
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
                    <input type="text" name="alamat_pg" class="form-control" placeholder="Alamat">
                      </div>
                    </div>
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
$nip = $_REQUEST['nip'];
$nama_pg = $_REQUEST['nama_pg'];
$jabatan = $_REQUEST['jabatan'];
$jk = $_REQUEST['jk'];
$no_hp = $_REQUEST['no_hp'];
$alamat_pg = $_REQUEST['alamat_pg'];
$tambah = mysqli_query($koneksi,"INSERT INTO pegawai (nip,nama_pg,jabatan,jk,no_hp,alamat_pg) VALUES('$nip','$nama_pg','$jabatan','$jk','$no_hp','$alamat_pg')");
if($tambah){
?> <script>alert('Berhasil Disimpan!'); window.location = 'pegawai.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pegawai.php';</script><?php
}
} ?>
<!-- END PROSES INPUT -->

<?php break; case "ubah": 
 $id_pg  = $_GET['id_pg'];
  $tb_dt = mysqli_query($koneksi,"SELECT * FROM pegawai WHERE id_pg = '$id_pg'");
  
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
              <li class="breadcrumb-item active">Edit Data Pegawai</li>
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
                <h3 class="card-title">Edit Data Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/from-data">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">NIP</label>
                    <input type="text" name="nip" value="<?=$data['nip']?>" class="form-control" id="exampleInputEmail1" placeholder="NIP" required="">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Nama Lengkap</label>
                    <input type="text" class="form-control" value="<?=$data['nama_pg']?>" name="nama_pg" id="exampleInputPassword1" placeholder="Nama Lengkap">
                  </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jabatan</label>
                    <input type="text" name="jabatan" class="form-control" value="<?=$data['jabatan']?>" placeholder="Jabatan">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                        <select class="form-control" name="jk">
                          <option value="<?=$data['jk']?>"><?=$data['jk']?></option>
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Hp</label>
                    <input type="text" name="no_hp" value="<?=$data['no_hp']?>" class="form-control" id="exampleInputEmail1" placeholder="Nomor Hp" required="">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Alamat</label>
                    <input type="text" class="form-control" value="<?=$data['alamat_pg']?>" name="alamat_pg" id="exampleInputPassword1" placeholder="Alamat">
                  </div>
                    </div>
                  </div>
                  <input type="hidden" name="id_pg" value="<?=$data['id_pg']?>">

                <!-- /.card-body -->
              <?php } ?>
                <div class="card-footer">
                  <button type="button" class="btn btn-secondary" title="Kembali"><a style="color: white;" id="log" onclick="history.back()"><i class="fas fa-arrow-left"></i><i class="fas fa-fast-backward"></i></a></button>
                  <button type="reset" class="btn btn-danger" title="Reset"><i class="fas fa-window-restore"></i></button>
                  <button type="submit" name="edit" class="btn btn-warning float-sm-right" title="Ubah"><i class="fas fa-pencil-alt"></i></button>
                </div>
              </form>
            </div>
            <!-- /.card -->
           </div>
       </div>
   </div>
</section>
</div>
<!-- PROSES UBAH DATA -->
<?php
if (isset($_POST['edit'])) {
$id_pg    = $_POST['id_pg'];
$nip = $_REQUEST['nip'];
$nama_pg = $_REQUEST['nama_pg'];
$jabatan = $_REQUEST['jabatan'];
$jk = $_REQUEST['jk'];
$no_hp = $_REQUEST['no_hp'];
$alamat_pg = $_REQUEST['alamat_pg'];
$ubahsppd = mysqli_query($koneksi,"UPDATE pegawai SET nip = '$nip', nama_pg = '$nama_pg', jabatan = '$jabatan', jk = '$jk', no_hp = '$no_hp', alamat_pg = '$alamat_pg' WHERE id_pg = '$id_pg'");

if($ubahsppd){
?> <script>alert('Data Berhasil Diubah!'); window.location = 'pegawai.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pegawai.php';</script><?php
}

}
?>
 <!-- END UBAH DATA -->

 <!-- PROSES HAPUS -->
<?php break; case "hps": 
  $id_pg = $_REQUEST['id_pg'];
  mysqli_query($koneksi, "DELETE FROM pegawai WHERE id_pg='$id_pg'") or die(mysqli_error());
  echo "<script>alert('Berhasil Dihapus!'); window.location = 'pegawai.php';</script>";
?>
<!-- END PROSES HAPUS -->

<?php break; } ?>
  <?php require_once("foot.php"); ?>