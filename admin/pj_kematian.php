<?php require_once("head.php");require_once("../koneksi.php");require_once("../fungsi_indotgl.php");  error_reporting(0); 

$action = isset($_GET['action']) ? $_GET['action'] : ''; 
switch($action){ default: $sql = mysqli_query($koneksi, "SELECT * FROM pemohon");
$id_pjkt = $_GET['id_pjkt'];
$pmhn = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_kematian ON pemohon.id_pm=pj_kematian.id_pm WHERE id_pjkt = '$id_pjkt' ");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengajuan Surat Keterangan Kematian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Pengajuan Surat Keterangan Kematian</li>
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
            <h3>Detail Data Pengajuan Surat Keterangan Kematian</h3>
          </div>
          <div class="card-body">
          <form name="table" method="POST">
            <table id="table" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th>Nama</th>
                  <th>JK</th>
                  <th>Tempat TGL Lahir</th>
                  <th>Alamat</th>
                  <th>Hari/Tgl Meninggal/Jam</th>
                  <th>Tempat Meninggal</th>
                  <th>Makam</th>
                  <th>KTP (Yg Meniggal)</th>
                  <th>KK (Yg Meniggal)</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                while($ayyo = mysqli_fetch_array($pmhn)){ ?>
                  <tr class="text-center">
                    <td><?= $ayyo['nm_mgl'] ?></td>
                    <td><?= $ayyo['jk_mgl'] ?></td>           
                    <td><?= $ayyo['tmpt_lhr'] ?> <?= tgl_indo($ayyo['tgl_lhr']) ?></td>
                    <td><?= $ayyo['alamat'] ?></td>
                    <td><?= $ayyo['hari_mgl'] ?> / <?= tgl_indo($ayyo['tgl_mgl']) ?> / <?= $ayyo['jam_mgl']?> <?= $ayyo['jamwilayah'] ?></td>
                    <td><?= $ayyo['tmpt_mgl'] ?></td> 
                    <td><?= $ayyo['makam'] ?></td>   
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['ktp_mgl']; ?>"><img src="<?php echo '../foto/'.$ayyo['ktp_mgl'] ?>" width="85px;"></a></td>
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['kk_mgl']; ?>"><img src="<?php echo '../foto/'.$ayyo['kk_mgl'] ?>" width="85px;"></a></td>
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
                <h3 class="card-title">Data Pengajuan Surat Keterangan Kematian</h3>
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
                    <th>Yang Meninggal</th>
                    <th>Tanggal Pembuatan Pengajuan</th>
                    <th>Status Pengajuan</th>
                    <th id="ikonbtn"><i class="fas fa-cogs"></i></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <tr>
                    <?php 
                    $no = 1;
                    $sql = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_kematian ON pemohon.id_pm=pj_kematian.id_pm");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td style="vertical-align: middle;"><a title="Detail ?" name="id_pjkt" href="?action=detail&id_pjkt=<?php echo $data['id_pjkt']; ?>" class="btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></i></a></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['nm_mgl'] ?></td>
                    <td><?php echo tgl_indo($data['tgl_skk']) ?></td>
                    <td><?=$data['status']?></td>
                    <td id="ikonbtn2">
                      <a title="Edit Data?" name="id_pjkt" href="?action=ubah&id_pjkt=<?php echo $data['id_pjkt']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                      <a name="hp_pjkt" href="?action=hps&id_pjkt=<?php echo $data['id_pjkt']; ?>" class="btn btn-danger btn-circle" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fas fa-trash"></i></a>
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
              <li class="breadcrumb-item active">Input Data Pengajuan Surat Keterangan Kematian</li>
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
                <h3 class="card-title">Input Data Pengajuan Surat Keterangan Kematian</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Nama Warga Meniggal</label>
                    <input type="text" class="form-control" name="nm_mgl" placeholder="Nama Warga Meniggal" required="">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                    <select name="jk_mgl" class="form-control" id="" required="">
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tempat Lahir</label>
                      <input type="text" name="tmpt_lhr" class="form-control" placeholder="Tempat Lahir" required="">
                        </div>
                      </div>
                    <div class="col-3">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Lahir</label>
                      <input type="date" name="tgl_lhr" class="form-control" required="">
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" name="alamat_mgl" class="form-control" placeholder="Alamat" required="">
                        </div>
                      </div>
                    </div>

                  <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Hari</label>
                    <select name="hari_mgl" class="form-control" id="" required="">
                      <option value="Senin">Senin</option>
                      <option value="Selasa">Selasa</option>
                      <option value="Rabu">Rabu</option>
                      <option value="Kamis">Kamis</option>
                      <option value="Jumat">Jumat</option>
                      <option value="Sabtu">Sabtu</option>
                      <option value="Minggu">Minggu</option>
                    </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Meninggal</label>
                    <input type="date" name="tgl_mgl" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Jam</label>
                      <input type="time" name="jam_mgl" class="form-control" required="">
                        </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Waktu Wilayah</label>
                      <select name="jamwilayah" class="form-control" id="" required="">
                      <option value="WIB">WIB</option>
                      <option value="WITA">WITA</option>
                      <option value="WIT">WIT</option>
                    </select>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Tempat Meniggal</label>
                    <input type="text" class="form-control" name="tmpt_mgl" placeholder="Tempat Meniggal" required="">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Tempat Pemakaman</label>
                    <input type="text" class="form-control" name="makam" placeholder="Tempat Meniggal" required="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputFile">Foto KTP Yang Meniggal</label>
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
                        <label for="exampleInputFile">Kartu Keluarga Yang Meniggal</label>
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
$nm_mgl = $_REQUEST['nm_mgl'];
$jk_mgl = $_REQUEST['jk_mgl'];
$tmpt_lhr = $_REQUEST['tmpt_lhr'];
$tgl_lhr = $_REQUEST['tgl_lhr'];
$alamat_mgl = $_REQUEST['alamat_mgl'];
$hari_mgl = $_REQUEST['hari_mgl'];
$tgl_mgl = $_REQUEST['tgl_mgl'];
$jam_mgl = $_REQUEST['jam_mgl'];
$jamwilayah = $_REQUEST['jamwilayah'];
$tmpt_mgl = $_REQUEST['tmpt_mgl'];
$makam = $_REQUEST['makam'];

$namafoto1 = $_FILES['image1']['name'];
$file_tmp1 = $_FILES['image1']['tmp_name'];
$namabaru1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto1);   
move_uploaded_file($file_tmp1, '../foto/'.$namabaru1);

$namafoto2 = $_FILES['image2']['name'];
$file_tmp2 = $_FILES['image2']['tmp_name'];
$namabaru2 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $namafoto2);   
move_uploaded_file($file_tmp2, '../foto/'.$namabaru2);

$tambah = mysqli_query($koneksi,"INSERT INTO pj_kematian (id_pm,nm_mgl,jk_mgl,tmpt_lhr,tgl_lhr,alamat_mgl,hari_mgl,tgl_mgl,jam_mgl,jamwilayah,tmpt_mgl,makam,ktp_mgl,kk_mgl,tgl_skk,status) VALUES('$id_pm','$nm_mgl','$jk_mgl','$tmpt_lhr','$tgl_lhr','$alamat_mgl','$hari_mgl','$tgl_mgl','$jam_mgl','$jamwilayah','$tmpt_mgl','$makam','$namabaru1','$namabaru2','$now','Pengajuan Dalam Proses')");
if($tambah){
?> <script>alert('Berhasil Disimpan!'); window.location = 'pj_kematian.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pj_kematian.php';</script><?php
}
} ?>
<!-- END PROSES INPUT -->

<?php break; case "ubah": 
 $id_pjkt  = $_GET['id_pjkt'];
  $tb_dt = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_kematian ON pemohon.id_pm=pj_kematian.id_pm WHERE id_pjkt = '$id_pjkt'");
  
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
              <li class="breadcrumb-item active">Edit Data Pengajuan Surat Keterangan Kematian</li>
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
                <h3 class="card-title">Edit Data Pengajuan Surat Keterangan Kematian</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/from-data">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Nama Warga Meniggal</label>
                    <input type="text" class="form-control" name="nm_mgl" value="<?=$ed['nm_mgl']?>" required="">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                    <select name="jk_mgl" class="form-control" id="" required="">
                      <option value="<?=$ed['jk_mgl']?>"><?=$ed['jk_mgl']?></option>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tempat Lahir</label>
                      <input type="text" name="tmpt_lhr" class="form-control" value="<?=$ed['tmpt_lhr']?>" required="">
                        </div>
                      </div>
                    <div class="col-3">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Lahir</label>
                      <input type="date" name="tgl_lhr" class="form-control" value="<?=$ed['tgl_lhr']?>" required="">
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" name="alamat_mgl" class="form-control" value="<?=$ed['alamat_mgl']?>" required="">
                        </div>
                      </div>
                    </div>

                  <div class="row">
                    <div class="col-3">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Hari</label>
                    <select name="hari_mgl" class="form-control" id="" required="">
                      <option value="<?=$ed['hari_mgl']?>"><?=$ed['hari_mgl']?></option>
                      <option value="Senin">Senin</option>
                      <option value="Selasa">Selasa</option>
                      <option value="Rabu">Rabu</option>
                      <option value="Kamis">Kamis</option>
                      <option value="Jumat">Jumat</option>
                      <option value="Sabtu">Sabtu</option>
                      <option value="Minggu">Minggu</option>
                    </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Meninggal</label>
                    <input type="date" name="tgl_mgl" class="form-control" value="<?=$ed['tgl_mgl']?>">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Jam</label>
                      <input type="time" name="jam_mgl" class="form-control" value="<?=$ed['jam_mgl']?>" required="">
                        </div>
                    </div>
                    <div class="col-3">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Waktu Wilayah</label>
                      <select name="jamwilayah" class="form-control" value="<?=$ed['jamwilayah']?>" required="">
                      <option value="WIB">WIB</option>
                      <option value="WITA">WITA</option>
                      <option value="WIT">WIT</option>
                    </select>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputPassword1">Tempat Meniggal</label>
                    <input type="text" class="form-control" name="tmpt_mgl" value="<?=$ed['tmpt_mgl']?>" required="">
                  </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Tempat Pemakaman</label>
                    <input type="text" class="form-control" name="makam" value="<?=$ed['makam']?>" required="">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="id_pjkt" value="<?=$ed['id_pjkt']?>">

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
                <h3 class="card-title">Edit Foto KTP Yang Meninggal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <img src="<?php echo '../foto/'.$ed["ktp_mgl"]; ?>" width="120;">
                        <input type="file" name="ktpbaru" class="form-control">
                        <input type="hidden" name="fotosebelum" value="<?=$ed['ktp_mgl']?>">
                      </div>
                    </div>
                    <p style="color: red">Ekstensi yang diperbolehkan dalam bentuk .png | .jpg | .jpeg (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p>
                  </div>
                <input type="hidden" name="id_pjkt" value="<?=$ed['id_pjkt']?>">
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
                <h3 class="card-title">Edit Foto KK Yang Meninggal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <img src="<?php echo '../foto/'.$ed["kk_mgl"]; ?>" width="120;">
                        <input type="file" name="kkbaru" class="form-control">
                        <input type="hidden" name="fotosebelum" value="<?=$ed['kk_mgl']?>">
                      </div>
                    </div>
                    <p style="color: red">Ekstensi yang diperbolehkan dalam bentuk .png | .jpg | .jpeg (<u>MAKSIMAL UKURAN FILE 700KB</u>)</p>
                  </div>
                <input type="hidden" name="id_pjkt" value="<?=$ed['id_pjkt']?>">
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
$id_pjkt    = $_POST['id_pjkt'];
$nm_mgl = $_REQUEST['nm_mgl'];
$jk_mgl = $_REQUEST['jk_mgl'];
$tmpt_lhr = $_REQUEST['tmpt_lhr'];
$tgl_lhr = $_REQUEST['tgl_lhr'];
$alamat_mgl = $_REQUEST['alamat_mgl'];
$hari_mgl = $_REQUEST['hari_mgl'];
$tgl_mgl = $_REQUEST['tgl_mgl'];
$jam_mgl = $_REQUEST['jam_mgl'];
$jamwilayah = $_REQUEST['jamwilayah'];
$tmpt_mgl = $_REQUEST['tmpt_mgl'];
$makam = $_REQUEST['makam'];
$ubahsppd = mysqli_query($koneksi,"UPDATE pj_kematian SET nm_mgl = '$nm_mgl', jk_mgl = '$jk_mgl', tmpt_lhr = '$tmpt_lhr', tgl_lhr = '$tgl_lhr', alamat_mgl = '$alamat_mgl', hari_mgl = '$hari_mgl', tgl_mgl = '$tgl_mgl', jam_mgl = '$jam_mgl', jamwilayah = '$jamwilayah', tmpt_mgl = '$tmpt_mgl', makam = '$makam', tgl_skk = '$now' WHERE id_pjkt = '$id_pjkt'");

if($ubahsppd){
?> <script>alert('Data Berhasil Diubah!'); window.location = 'pj_kematian.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'pj_kematian.php';</script><?php
}

}
if (isset($_POST['simpanktp'])) {
  $id_pjkt    = $_POST['id_pjkt'];
$nama1 = $_FILES['ktpbaru']['name'];
$file_tmp1 = $_FILES['ktpbaru']['tmp_name'];
$fotosebelum = $_REQUEST['fotosebelum'];
$new1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama1);   
move_uploaded_file($file_tmp1, '../foto/'.$new1);
unlink('../foto/'.$fotosebelum);

$ubah = mysqli_query($koneksi,"UPDATE pj_kematian SET ktp_mgl ='$new1' WHERE id_pjkt = '$id_pjkt'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_kematian.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pj_kematian.php';</script> <?php
}
}

if (isset($_POST['simpankk'])) {
  $id_pjkt    = $_POST['id_pjkt'];
$nama2 = $_FILES['kkbaru']['name'];
$file_tmp2 = $_FILES['kkbaru']['tmp_name'];
$fotosebelum2 = $_REQUEST['fotosebelum2'];
$new2 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama2);   
move_uploaded_file($file_tmp2, '../foto/'.$new2);
unlink('../foto/'.$fotosebelum2);

$ubah = mysqli_query($koneksi,"UPDATE pj_kematian SET kk_mgl ='$new2' WHERE id_pjkt = '$id_pjkt'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_kematian.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pj_kematian.php';</script> <?php
}
}
?>
 <!-- END UBAH DATA -->

 <!-- PROSES HAPUS -->
<?php break; case "hps": 
  $id_pjkt = $_REQUEST['id_pjkt'];
  mysqli_query($koneksi, "DELETE FROM pj_kematian WHERE id_pjkt='$id_pjkt'") or die(mysqli_error());
  echo "<script>alert('Berhasil Dihapus!'); window.location = 'pj_kematian.php';</script>";
?>
<!-- END PROSES HAPUS -->

<?php break; } ?>
  <?php require_once("foot.php"); ?>