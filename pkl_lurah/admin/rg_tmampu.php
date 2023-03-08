<?php require_once("head.php");require_once("../koneksi.php");require_once("../fungsi_indotgl.php");  error_reporting(0); 

$action = isset($_GET['action']) ? $_GET['action'] : ''; 
switch($action){ default: $sql = mysqli_query($koneksi, "SELECT * FROM pemohon");
$id_rg_ktm = $_GET['id_rg_ktm'];
$pmhn = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_tmampu ON pemohon.id_pm=pj_tmampu.id_pm INNER JOIN rg_tmampu ON pj_tmampu.id_pj_ktm=rg_tmampu.id_pj_ktm INNER JOIN pegawai ON pegawai.id_pg=rg_tmampu.id_pg WHERE id_rg_ktm = '$id_rg_ktm' ");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Register Surat Keterangan Tidak Mampu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Register Surat Keterangan Tidak Mampu</li>
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
            <h3>Detail Register Surat Keterangan Tidak Mampu</h3>
          </div>
          <div class="card-body">
          <form name="table" method="POST">
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>Tempat & Tgl Lahir</th>
                  <th>JK</th>
                  <th>Pekerjaan</th>
                  <th>No HP</th>
                  <th>Alamat Sekarang</th>
                  <th>Surat Ditujukan Kepada</th>
                  <th>Pengantar RT</th>
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
                    <td><?= $ayyo['pekerjaan_ktm'] ?></td>
                    <td><?= $ayyo['no_hp'] ?></td>
                    <td><?= $ayyo['alamat_ktm'] ?></td>
                    <td><?= $ayyo['tujuan_ktm'] ?></td>
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['pengantar_ktm']; ?>"><img src="<?php echo '../foto/'.$ayyo['pengantar_ktm'] ?>" width="85px;"></a></td>
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
                <div class="row mb-3">
                  <a href="#" title="Cetak Tabel" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modaltmampu"><i class="fas fa-print fa-2x"></i> Cetak Data</a>
                </div>
                <div class="row">
                  <a href="?action=tambah" class="btn btn-success btn-sm float-left"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>Detail</th>
                    <th>Nama Pembuat Surat</th>
                    <th>Nama Pegawai yang Tanda Tangan</th>
                    <th>Tanggal Register</th>
                    <th>No Regis</th>
                    <th id="ikonbtn"><i class="fas fa-cogs"></i></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <tr>
                    <?php 
                    $no = 1;
                    $sql = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_tmampu ON pemohon.id_pm=pj_tmampu.id_pm INNER JOIN rg_tmampu ON pj_tmampu.id_pj_ktm=rg_tmampu.id_pj_ktm INNER JOIN pegawai ON pegawai.id_pg=rg_tmampu.id_pg");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td style="vertical-align: middle;"><a title="Detail ?" name="id_rg_ktm" href="?action=detail&id_rg_ktm=<?php echo $data['id_rg_ktm']; ?>" class="btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></i></a></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['nama_pg'] ?></td>
                    <td><?php echo tgl_indo($data['tgl_rg_ktm']) ?></td>
                    <td><?=$data['no_rg_ktm']?></td>
                    <td id="ikonbtn2">
                      <a title="Edit Data?" name="id_rg_ktm" href="?action=ubah&id_rg_ktm=<?php echo $data['id_rg_ktm']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                      <a name="hp_pjkt" href="?action=hps&id_rg_ktm=<?php echo $data['id_rg_ktm']; ?>" class="btn btn-danger btn-circle" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fas fa-trash"></i></a>
                      <a title="Cetak Surat" target="_blank" href="../cetak/c_tmampu.php?id_rg_ktm=<?php echo $data["id_rg_ktm"]; ?>" class="btn btn-primary btn-circle"><i class="fas fa-print"></i> </a>
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
<!-- modal -->
<?php 
    $qrytahun = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_tmampu ON pemohon.id_pm=pj_tmampu.id_pm INNER JOIN rg_tmampu ON pj_tmampu.id_pj_ktm=rg_tmampu.id_pj_ktm INNER JOIN pegawai ON pegawai.id_pg=rg_tmampu.id_pg GROUP BY YEAR(tgl_ktm) ASC");
     ?>
  <div class="modal fade" id="modaltmampu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Data</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../cetak/data_tmampu.php" method="post" target="_blank"> 
          <table>
            <div class="form-group row">
              <label class="col-sm-5 col-form-label" >Bulan</label>
            </div>
              <div class="col-sm-6" style="margin-bottom: 10px;">
                <select style="color: black;" name="bulan" class="form-control">
                  <option value="-01-">Januari</option>
                  <option value="-02-">Februari</option>
                  <option value="-03-">Maret</option>
                  <option value="-04-">April</option>
                  <option value="-05-">Mei</option>
                  <option value="-06-">Juni</option>
                  <option value="-07-">Juli</option>
                  <option value="-08-">Agustus</option>
                  <option value="-09-">September</option>
                  <option value="-10-">Oktober</option>
                  <option value="-11-">November</option>
                  <option value="-12-">Desember</option>
                </select>
              </div>
            </div>

            <label class="col-sm-5 col-form-label">Tahun</label>
              <div class="col-sm-6" style="margin-bottom: 10px;">
                <select style="color: black;" name="tahun" class="form-control">
                  <?php if(mysqli_num_rows($qrytahun)) { ?>
                  <?php while ($row = mysqli_fetch_array($qrytahun)) { ?>
                  <option><?php $formatwaktu = $row["tgl_ktm"];echo date('Y',strtotime($formatwaktu)); ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <button type="submit" name="cetak" class="btn btn-primary btn-sm">CETAK</button>
          </table>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="../cetak/data_tmampu.php?id_pj_ktm=<?php echo $row['id_pj_ktm']; ?>" class="btn btn-primary" target="_blank">Cetak Semua</a>
        </div>
      </div>
    </div>
  </div>
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
              <li class="breadcrumb-item active">Input Register Surat Keterangan Tidak Mampu</li>
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
                <h3 class="card-title">Input Register Surat Keterangan Tidak Mampu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama Pemohon dan tgl (Berdasarkan Pengajuan yang Telah Di acc)</label>
                          <select name="id_pj_ktm" class="form-control"  onchange='changeValue(this.value)'>
                            <option readonly="">-PILIH-</option>
                              <?php $dataskk = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_tmampu ON pemohon.id_pm=pj_tmampu.id_pm WHERE status_surat = '1'");
                              $satu  = "var tujuan_ktm = new Array();\n;";
                              while($data = mysqli_fetch_array($dataskk)) {?>
                            <option name="id_pj_ktm" value="<?= $data['id_pj_ktm'] ?>"><?= $data['nama'] ?> / <?= tgl_indo($data['tgl_ktm']) ?></option>
                            <?php $satu .= "tujuan_ktm['" .$data['id_pj_ktm']. "'] = {tujuan_ktm:'" . addslashes($data['tujuan_ktm'])."'};\n";?><?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Ditunjukkan Kepada</label>
                      <input readonly="" type="text" class="form-control" id="tujuan_ktm" placeholder="Ditunjukkan Kepada">
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama Pegawai (Untuk Tanda Tangan)</label>
                          <select name="id_pg" class="form-control"  onchange='changeValue(this.value)'>
                            <option readonly="">-PILIH-</option>
                              <?php $datapegawai = mysqli_query($koneksi, "SELECT * FROM pegawai");
                              while($datapg = mysqli_fetch_array($datapegawai)) {?>
                            <option name="id_pg" value="<?= $datapg['id_pg'] ?>"><?= $datapg['nama_pg'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Register</label>
                    <input type="number" name="no_rg_ktm" class="form-control" placeholder="Nomor Register">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Regis</label>
                      <input type="date" name="tgl_rg_ktm" class="form-control" value="<?=date('Y-m-d')?>" required="">
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
<!-- JS NGAMBIL DATA -->
<script type="text/javascript">
<?php echo $satu;?>
function changeValue(id){
document.getElementById('tujuan_ktm').value = tujuan_ktm[id].tujuan_ktm;}
</script>
<!-- END JS NGAMBIL DATA -->
<!-- PROSES INPUT -->
<?php 
$now = date('y-m-d');
if (isset($_POST['input'])) {
$id_pj_ktm = $_REQUEST['id_pj_ktm'];
$id_pg = $_REQUEST['id_pg'];
$tgl_rg_ktm = $_REQUEST['tgl_rg_ktm'];
$no_rg_ktm = $_REQUEST['no_rg_ktm'];

$tambah = mysqli_query($koneksi,"INSERT INTO rg_tmampu (id_pj_ktm,id_pg,tgl_rg_ktm,no_rg_ktm) VALUES('$id_pj_ktm','$id_pg','$tgl_rg_ktm','$no_rg_ktm')");
if($tambah){
?> <script>alert('Berhasil Disimpan!'); window.location = 'rg_tmampu.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'rg_tmampu.php';</script><?php
}
} ?>
<!-- END PROSES INPUT -->

<?php break; case "ubah": 
 $id_rg_ktm  = $_GET['id_rg_ktm'];
  $tb_dt = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_tmampu ON pemohon.id_pm=pj_tmampu.id_pm INNER JOIN rg_tmampu ON pj_tmampu.id_pj_ktm=rg_tmampu.id_pj_ktm INNER JOIN pegawai ON pegawai.id_pg=rg_tmampu.id_pg WHERE id_rg_ktm = '$id_rg_ktm'");
  
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
              <li class="breadcrumb-item active">Edit Register Surat Keterangan Tidak Mampu</li>
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
                <h3 class="card-title">Edit Register Surat Keterangan Tidak Mampu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/from-data">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama Pemohon dan tgl (Berdasarkan Pengajuan yang Telah Di acc)</label>
                          <select name="id_pj_ktm" class="form-control"  onchange='changeValue(this.value)'>
                            <option value="<?=$ed['id_pj_ktm']?>"><?=$ed['nama']?> / <?= tgl_indo($ed['tgl_ktm']) ?></option>
                              <?php $dataskk = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_tmampu ON pemohon.id_pm=pj_tmampu.id_pm WHERE status_surat = '1'");
                              $satu  = "var jenis_ush = new Array();\n;";
                              while($data = mysqli_fetch_array($dataskk)) {?>
                            <option name="id_pj_ktm" value="<?= $data['id_pj_ktm'] ?>"><?= $data['nama'] ?> / <?= tgl_indo($data['tgl_ktm']) ?></option>
                            <?php $satu .= "jenis_ush['" .$data['id_pj_ktm']. "'] = {jenis_ush:'" . addslashes($data['jenis_ush'])."'};\n";?><?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Ditunjukkan Kepada</label>
                      <input readonly="" type="text" class="form-control" id="tujuan_ktm" placeholder="Ditunjukkan Kepada">
                        </div>
                      </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama Pegawai (Untuk Tanda Tangan)</label>
                          <select name="id_pg" class="form-control"  onchange='changeValue(this.value)'>
                            <option value="<?=$ed['id_pg']?>"><?=$ed['nama_pg']?></option>
                              <?php $datapegawai = mysqli_query($koneksi, "SELECT * FROM pegawai");
                              while($datapg = mysqli_fetch_array($datapegawai)) {?>
                            <option name="id_pg" value="<?= $datapg['id_pg'] ?>"><?= $datapg['nama_pg'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Register</label>
                    <input type="number" name="no_rg_ktm" class="form-control" value="<?=$ed['no_rg_ktm']?>">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Regis</label>
                      <input type="date" name="tgl_rg_ktm" class="form-control" value="<?=$ed['tgl_rg_ktm']?>" required="">
                        </div>
                    </div>
                  </div>
                  <input type="hidden" name="id_rg_ktm" value="<?=$ed['id_rg_ktm']?>">

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
       </div>
   </div>
</section>
</div>
<!-- JS NGAMBIL DATA -->
<script type="text/javascript">
<?php echo $satu;?>
function changeValue(id){
document.getElementById('tujuan_ktm').value = tujuan_ktm[id].tujuan_ktm;}
</script>
<!-- END JS NGAMBIL DATA -->
<!-- PROSES UBAH DATA -->
<?php
$now = date('y-m-d');
if (isset($_POST['edit'])) {
$id_rg_ktm    = $_POST['id_rg_ktm'];
$id_pj_ktm = $_REQUEST['id_pj_ktm'];
$id_pg = $_REQUEST['id_pg'];
$tgl_rg_ktm = $_REQUEST['tgl_rg_ktm'];
$no_rg_ktm = $_REQUEST['no_rg_ktm'];
$ubahsppd = mysqli_query($koneksi,"UPDATE rg_tmampu SET id_pj_ktm = '$id_pj_ktm', id_pg = '$id_pg', tgl_rg_ktm = '$tgl_rg_ktm', no_rg_ktm = '$no_rg_ktm' WHERE id_rg_ktm = '$id_rg_ktm'");

if($ubahsppd){
?> <script>alert('Data Berhasil Diubah!'); window.location = 'rg_tmampu.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'rg_tmampu.php';</script><?php
}

}
if (isset($_POST['simpanktp'])) {
  $id_pj_ktm    = $_POST['id_pj_ktm'];
$nama1 = $_FILES['ktpbaru']['name'];
$file_tmp1 = $_FILES['ktpbaru']['tmp_name'];
$fotosebelum = $_REQUEST['fotosebelum'];
$new1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama1);   
move_uploaded_file($file_tmp1, '../foto/'.$new1);
unlink('../foto/'.$fotosebelum);

$ubah = mysqli_query($koneksi,"UPDATE pj_tmampu SET ktp_mgl ='$new1' WHERE id_pj_ktm = '$id_pj_ktm'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_tmampu.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pj_tmampu.php';</script> <?php
}
}

if (isset($_POST['simpankk'])) {
  $id_pj_ktm    = $_POST['id_pj_ktm'];
$nama2 = $_FILES['kkbaru']['name'];
$file_tmp2 = $_FILES['kkbaru']['tmp_name'];
$fotosebelum2 = $_REQUEST['fotosebelum2'];
$new2 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama2);   
move_uploaded_file($file_tmp2, '../foto/'.$new2);
unlink('../foto/'.$fotosebelum2);

$ubah = mysqli_query($koneksi,"UPDATE pj_tmampu SET kk_mgl ='$new2' WHERE id_pj_ktm = '$id_pj_ktm'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_tmampu.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pj_tmampu.php';</script> <?php
}
}
?>
 <!-- END UBAH DATA -->

 <!-- PROSES HAPUS -->
<?php break; case "hps": 
  $id_rg_ktm = $_REQUEST['id_rg_ktm'];
  mysqli_query($koneksi, "DELETE FROM rg_tmampu WHERE id_rg_ktm='$id_rg_ktm'") or die(mysqli_error());
  echo "<script>alert('Berhasil Dihapus!'); window.location = 'rg_tmampu.php';</script>";
?>
<!-- END PROSES HAPUS -->



<?php break; } ?>
  <?php require_once("foot.php"); ?>