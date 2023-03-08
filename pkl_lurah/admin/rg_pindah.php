<?php require_once("head.php");require_once("../koneksi.php");require_once("../fungsi_indotgl.php");  error_reporting(0); 

$action = isset($_GET['action']) ? $_GET['action'] : ''; 
switch($action){ default: $sql = mysqli_query($koneksi, "SELECT * FROM pemohon");
$id_rg_pindah = $_GET['id_rg_pindah'];
$pmhn = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm INNER JOIN rg_pindah ON pj_pindah.id_pj_pindah=rg_pindah.id_pj_pindah INNER JOIN pegawai ON pegawai.id_pg=rg_pindah.id_pg WHERE id_rg_pindah = '$id_rg_pindah' ");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Register Surat Keterangan Pindah</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Register Surat Keterangan Pindah</li>
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
            <h3>Detail Register Surat Keterangan Pindah</h3>
          </div>
          <div class="card-body">
          <form name="table" method="POST">
            <table id="example1" class="table table-bordered table-hover">
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
                <div class="row mb-3">
                  <a href="#" title="Cetak Tabel" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalusaha"><i class="fas fa-print fa-2x"></i> Cetak Data</a>
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
                    $sql = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm INNER JOIN rg_pindah ON pj_pindah.id_pj_pindah=rg_pindah.id_pj_pindah INNER JOIN pegawai ON pegawai.id_pg=rg_pindah.id_pg");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td style="vertical-align: middle;"><a title="Detail ?" name="id_rg_pindah" href="?action=detail&id_rg_pindah=<?php echo $data['id_rg_pindah']; ?>" class="btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></i></a></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['nama_pg'] ?></td>
                    <td><?php echo tgl_indo($data['tgl_rg_pindah']) ?></td>
                    <td><?=$data['no_rg_pindah']?></td>
                    <td id="ikonbtn2">
                      <a title="Edit Data?" name="id_rg_pindah" href="?action=ubah&id_rg_pindah=<?php echo $data['id_rg_pindah']; ?>" class="btn btn-warning btn-circle"><i class="fas fa-edit"></i></a>
                      <a name="hp_pjkt" href="?action=hps&id_rg_pindah=<?php echo $data['id_rg_pindah']; ?>" class="btn btn-danger btn-circle" onClick="javascript: return confirm('Konfirmasi data akan dihapus?');"><i class="fas fa-trash"></i></a>
                      <a title="Cetak Surat" target="_blank" href="../cetak/c_pindah.php?id_rg_pindah=<?php echo $data["id_rg_pindah"]; ?>" class="btn btn-primary btn-circle"><i class="fas fa-print"></i> </a>
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
    $qrytahun = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm INNER JOIN rg_pindah ON pj_pindah.id_pj_pindah=rg_pindah.id_pj_pindah INNER JOIN pegawai ON pegawai.id_pg=rg_pindah.id_pg GROUP BY YEAR(tgl_pdh) ASC");
     ?>
  <div class="modal fade" id="modalusaha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cetak Data</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../cetak/data_pindah.php" method="post" target="_blank"> 
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
                  <option><?php $formatwaktu = $row["tgl_pdh"];echo date('Y',strtotime($formatwaktu)); ?></option>
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
            <a href="../cetak/data_pindah.php?id_pindah=<?php echo $row['id_pindah']; ?>" class="btn btn-primary" target="_blank">Cetak Semua</a>
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
              <li class="breadcrumb-item active">Input Register Surat Keterangan Pindah</li>
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
                <h3 class="card-title">Input Register Surat Keterangan Pindah</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama Pemohon dan tgl (Berdasarkan Pengajuan yang Telah Di acc)</label>
                          <select name="id_pj_pindah" class="form-control"  onchange='changeValue(this.value)'>
                            <option readonly="">-PILIH-</option>
                              <?php $dataskk = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm WHERE status_surat = '1'");
                              $satu  = "var alamat_pdh = new Array();\n;";
                              while($data = mysqli_fetch_array($dataskk)) {?>
                            <option name="id_pj_pindah" value="<?= $data['id_pj_pindah'] ?>"><?= $data['nama'] ?> / <?= tgl_indo($data['tgl_pdh']) ?></option>
                            <?php $satu .= "alamat_pdh['" .$data['id_pj_pindah']. "'] = {alamat_pdh:'" . addslashes($data['alamat_pdh'])."'};\n";?><?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Alamat Pindah</label>
                      <input readonly="" type="text" class="form-control" id="alamat_pdh" placeholder="Alamat Pindah">
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
                    <input type="number" name="no_rg_pindah" class="form-control" placeholder="Nomor Register">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Regis</label>
                      <input type="date" name="tgl_rg_pindah" class="form-control" value="<?=date('Y-m-d')?>" required="">
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
document.getElementById('alamat_pdh').value = alamat_pdh[id].alamat_pdh;}
</script>
<!-- END JS NGAMBIL DATA -->
<!-- PROSES INPUT -->
<?php 
$now = date('y-m-d');
if (isset($_POST['input'])) {
$id_pj_pindah = $_REQUEST['id_pj_pindah'];
$id_pg = $_REQUEST['id_pg'];
$tgl_rg_pindah = $_REQUEST['tgl_rg_pindah'];
$no_rg_pindah = $_REQUEST['no_rg_pindah'];

$tambah = mysqli_query($koneksi,"INSERT INTO rg_pindah (id_pj_pindah,id_pg,tgl_rg_pindah,no_rg_pindah) VALUES('$id_pj_pindah','$id_pg','$tgl_rg_pindah','$no_rg_pindah')");
if($tambah){
?> <script>alert('Berhasil Disimpan!'); window.location = 'rg_pindah.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'rg_pindah.php';</script><?php
}
} ?>
<!-- END PROSES INPUT -->

<?php break; case "ubah": 
 $id_rg_pindah  = $_GET['id_rg_pindah'];
  $tb_dt = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm INNER JOIN rg_pindah ON pj_pindah.id_pj_pindah=rg_pindah.id_pj_pindah INNER JOIN pegawai ON pegawai.id_pg=rg_pindah.id_pg WHERE id_rg_pindah = '$id_rg_pindah'");
  
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
              <li class="breadcrumb-item active">Edit Register Surat Keterangan Pindah</li>
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
                <h3 class="card-title">Edit Register Surat Keterangan Pindah</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="" method="post" enctype="multipart/from-data">
                <div class="card-body">
                  
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Nama Pemohon dan tgl (Berdasarkan Pengajuan yang Telah Di acc)</label>
                          <select name="id_pj_pindah" class="form-control"  onchange='changeValue(this.value)'>
                            <option value="<?=$ed['id_pj_pindah']?>"><?=$ed['nama']?> / <?= tgl_indo($ed['tgl_pdh']) ?></option>
                              <?php $dataskk = mysqli_query($koneksi, "SELECT * FROM pemohon INNER JOIN pj_pindah ON pemohon.id_pm=pj_pindah.id_pm WHERE status_surat = '1'");
                              $satu  = "var alamat_pdh = new Array();\n;";
                              while($data = mysqli_fetch_array($dataskk)) {?>
                            <option name="id_pj_pindah" value="<?= $data['id_pj_pindah'] ?>"><?= $data['nama'] ?> / <?= tgl_indo($data['tgl_pdh']) ?></option>
                            <?php $satu .= "alamat_pdh['" .$data['id_pj_pindah']. "'] = {alamat_pdh:'" . addslashes($data['alamat_pdh'])."'};\n";?><?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Alamat Pindah</label>
                      <input readonly="" type="text" class="form-control" id="alamat_pdh" placeholder="Alamat Pindah">
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
                    <input type="number" name="no_rg_pindah" class="form-control" value="<?=$ed['no_rg_pindah']?>">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Regis</label>
                      <input type="date" name="tgl_rg_pindah" class="form-control" value="<?=$ed['tgl_rg_pindah']?>" required="">
                        </div>
                    </div>
                  </div>
                  <input type="hidden" name="id_rg_pindah" value="<?=$ed['id_rg_pindah']?>">

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
document.getElementById('alamat_pdh').value = alamat_pdh[id].alamat_pdh;}
</script>
<!-- END JS NGAMBIL DATA -->
<!-- PROSES UBAH DATA -->
<?php
$now = date('y-m-d');
if (isset($_POST['edit'])) {
$id_rg_pindah    = $_POST['id_rg_pindah'];
$id_pj_pindah = $_REQUEST['id_pj_pindah'];
$id_pg = $_REQUEST['id_pg'];
$tgl_rg_pindah = $_REQUEST['tgl_rg_pindah'];
$no_rg_pindah = $_REQUEST['no_rg_pindah'];
$ubahsppd = mysqli_query($koneksi,"UPDATE rg_pindah SET id_pj_pindah = '$id_pj_pindah', id_pg = '$id_pg', tgl_rg_pindah = '$tgl_rg_pindah', no_rg_pindah = '$no_rg_pindah' WHERE id_rg_pindah = '$id_rg_pindah'");

if($ubahsppd){
?> <script>alert('Data Berhasil Diubah!'); window.location = 'rg_pindah.php';</script><?php
}else{
?> <script>alert('Gagal, cek kembali!.'); window.location = 'rg_pindah.php';</script><?php
}

}
if (isset($_POST['simpanktp'])) {
  $id_pj_pindah    = $_POST['id_pj_pindah'];
$nama1 = $_FILES['ktpbaru']['name'];
$file_tmp1 = $_FILES['ktpbaru']['tmp_name'];
$fotosebelum = $_REQUEST['fotosebelum'];
$new1 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama1);   
move_uploaded_file($file_tmp1, '../foto/'.$new1);
unlink('../foto/'.$fotosebelum);

$ubah = mysqli_query($koneksi,"UPDATE pj_pindah SET ktp_mgl ='$new1' WHERE id_pj_pindah = '$id_pj_pindah'");
if($ubah){
  ?> <script>alert('Berhasil Diperbaharui');window.location='pj_pindah.php';</script> <?php
}else{
  ?> <script>alert('Gagal Diperbaharui');window.location='pj_pindah.php';</script> <?php
}
}

if (isset($_POST['simpankk'])) {
  $id_pj_pindah    = $_POST['id_pj_pindah'];
$nama2 = $_FILES['kkbaru']['name'];
$file_tmp2 = $_FILES['kkbaru']['tmp_name'];
$fotosebelum2 = $_REQUEST['fotosebelum2'];
$new2 = rand(1000,9999).preg_replace("/[^a-zA-Z0-9]/", ".", $nama2);   
move_uploaded_file($file_tmp2, '../foto/'.$new2);
unlink('../foto/'.$fotosebelum2);

$ubah = mysqli_query($koneksi,"UPDATE pj_pindah SET kk_mgl ='$new2' WHERE id_pj_pindah = '$id_pj_pindah'");
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
  $id_rg_pindah = $_REQUEST['id_rg_pindah'];
  mysqli_query($koneksi, "DELETE FROM rg_pindah WHERE id_rg_pindah='$id_rg_pindah'") or die(mysqli_error());
  echo "<script>alert('Berhasil Dihapus!'); window.location = 'rg_pindah.php';</script>";
?>
<!-- END PROSES HAPUS -->



<?php break; } ?>
  <?php require_once("foot.php"); ?>