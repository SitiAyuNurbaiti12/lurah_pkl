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
            <h1>Verifikasi Pengajuan Surat Keterangan Pindah</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Verifikasi Pengajuan Surat Keterangan Pindah</li>
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
            <table id="example1" class="table table-bordered table-striped">
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
                  <th>Foto KTP</th>
                  <th>Foto KK</th>
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
                <h3 class="card-title">Data Pengajuan Surat Keterangan Pindah</h3>
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
                    <th>Tanggal Pengajuan</th>
                    <th>Status Pengajuan</th>
                    <th>Setujui / Tolak Pengajuan</i></th>
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
                    <td><?php echo tgl_indo($data['tgl_pdh']) ?></td>
                    <td><?=$data['status_pdh']?></td>
                    <td id="ikonbtn2">
                      <form action="" method="post">
                        <div class="text-center">
                          <input type="text" class="form-control mb-2" name="status_pdh" placeholder="Isi Keterangan ACC/Tolak" required="">
                          <button type="submit" name="tolak" class="btn btn-secondary btn-danger" title="Tolak">
                          <a><i class="fas fa-calendar-times"></i></a>
                          </button>
                          <button type="submit" name="acc" class="btn btn-secondary btn-success" title="Setujui">
                          <a ><i class="fas fa-calendar-check"></i></a>
                          <input type="hidden" class="form-control" name="id_pj_pindah" id="inputName" value="<?=$data['id_pj_pindah'];?>"> 
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
    $id_pj_pindah = $_POST['id_pj_pindah'];
    $status_pdh = $_POST['status_pdh'];
    $status_surat = $_POST['status_surat'];
    $update = mysqli_query($koneksi, "UPDATE pj_pindah SET status_pdh = '$status_pdh', status_surat = '2' WHERE id_pj_pindah = '$id_pj_pindah'");
if($update){
          ?> <script>alert('Berhasil Disimpan!'); window.location = 'vr_pindah.php';</script><?php
        }else{
          ?> <script>alert('Gagal, cek kembali!.'); window.location = 'vr_pindah.php';</script><?php
        }  
  }
else if (isset($_POST['acc'])) {
    $id_pj_pindah = $_POST['id_pj_pindah'];
    $status_pdh = $_POST['status_pdh'];
    $status_surat = $_POST['status_surat'];
    $update = mysqli_query($koneksi, "UPDATE pj_pindah SET status_pdh = '$status_pdh', status_surat = '1' WHERE id_pj_pindah = '$id_pj_pindah'");
if($update){
          ?> <script>alert('Berhasil Disimpan!'); window.location = 'vr_pindah.php';</script><?php
        }else{
          ?> <script>alert('Gagal, cek kembali!.'); window.location = 'vr_pindah.php';</script><?php
        }
  }
?>
<!-- END DISPOSISI -->

<?php break; } ?>
  <?php require_once("foot.php"); ?>