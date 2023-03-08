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
            <h1>Verifikasi Surat Keterangan Domisili</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Verifikasi Surat Keterangan Domisili</li>
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
            <table id="example1" class="table table-bordered table-hover">
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
                <!-- <a href="?action=tambah" class="btn btn-success btn-sm float-right"><i class="fa fa-plus-circle"></i> Tambah Data</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NO</th>
                    <th>Detail</th>
                    <th>Nama Pembuat Surat</th>
                    <th>Tgl Pengajuan</th>
                    <th>Status Surat Pengajuan</th>
                    <th>Setujui / Tolak Pengajuan</i></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                  <tr>
                    <?php 
                    $no = 1;
                    $sql = mysqli_query($koneksi,"SELECT * FROM pemohon INNER JOIN pj_domisili ON pemohon.id_pm=pj_domisili.id_pm");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                    <td><?php echo $no++ ?></td>
                    <td style="vertical-align: middle;"><a title="Detail?" name="id_pj_dms" href="?action=detail&id_pj_dms=<?php echo $data['id_pj_dms']; ?>" class="btn btn-primary btn-circle"><i class="fas fa-info-circle"></i></i></a></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo tgl_indo($data['tgl_dms']) ?></td>
                    <td><?php echo $data['status_dms'] ?></td>
                    <td id="ikonbtn2">
                      <form action="" method="post">
                        <div class="text-center">
                          <input type="text" class="form-control mb-2" name="status_dms" placeholder="Isi Keterangan ACC/Tolak" required="">
                          <button type="submit" name="tolak" class="btn btn-secondary btn-danger" title="Tolak">
                          <a><i class="fas fa-calendar-times"></i></a>
                          </button>
                          <button type="submit" name="acc" class="btn btn-secondary btn-success" title="Setujui">
                          <a ><i class="fas fa-calendar-check"></i></a>
                          <input type="hidden" class="form-control" name="id_pj_dms" id="inputName" value="<?=$data['id_pj_dms'];?>"> 
                          </button>
                        </div>
                      </form>
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

<!-- PROSES DISPOSISI -->
<?php 
  if (isset($_POST['tolak'])) {
    $id_pj_dms = $_POST['id_pj_dms'];
    $status_dms = $_POST['status_dms'];
    $status_surat = $_POST['status_surat'];
    $update = mysqli_query($koneksi, "UPDATE pj_domisili SET status_dms = '$status_dms', status_surat = '2' WHERE id_pj_dms = '$id_pj_dms'");
if($update){
          ?> <script>alert('Berhasil Disimpan!'); window.location = 'vr_domisili.php';</script><?php
        }else{
          ?> <script>alert('Gagal, cek kembali!.'); window.location = 'vr_domisili.php';</script><?php
        }  
  }
else if (isset($_POST['acc'])) {
    $id_pj_dms = $_POST['id_pj_dms'];
    $status_dms = $_POST['status_dms'];
    $status_surat = $_POST['status_surat'];
    $update = mysqli_query($koneksi, "UPDATE pj_domisili SET status_dms = '$status_dms', status_surat = '1' WHERE id_pj_dms = '$id_pj_dms'");
if($update){
          ?> <script>alert('Berhasil Disimpan!'); window.location = 'vr_domisili.php';</script><?php
        }else{
          ?> <script>alert('Gagal, cek kembali!.'); window.location = 'vr_domisili.php';</script><?php
        }
  }
?>
<!-- END DISPOSISI -->

<?php break; } ?>
  <?php require_once("foot.php"); ?>