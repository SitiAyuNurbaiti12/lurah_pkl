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
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr class="text-center">
                  <th>Nama</th>
                  <th>JK</th>
                  <th>Pekerjaan</th>
                  <th>Tempat TGL Lahir</th>
                  <th>NIK</th>
                  <th>Agama</th>
                  <th>Alamat</th>
                  <th>Jenis Usaha</th>
                  <th>Alamat Lengkap Usaha</th>
                  <th>Foto Surat Pengantar RT</th>
                  <th>Foto KTP</th>
                  <th>Foto KK</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                while($ayyo = mysqli_fetch_array($pmhn)){ ?>
                  <tr class="text-center">
                    <td><?= $ayyo['nama'] ?></td>
                    <td><?= $ayyo['jk_pmh'] ?></td> 
                    <td><?= $ayyo['pekerjaan'] ?></td>           
                    <td><?= $ayyo['tp_lahir'] ?> <?= tgl_indo($ayyo['tgl_lahir']) ?></td>
                    <td><?= $ayyo['nik'] ?></td> 
                    <td><?= $ayyo['agama'] ?></td> 
                    <td><?= $ayyo['alamat'] ?></td> 
                    <td><?= $ayyo['jenis_ush'] ?></td>  
                    <td><?= $ayyo['alamat_ush'] ?></td>   
                    <td style="vertical-align: middle;" style="vertical-align: middle;" class="text-center"><a target="_blank" href="../foto/<?php echo  $ayyo['pengantar_rt']; ?>"><img src="<?php echo '../foto/'.$ayyo['pengantar_rt'] ?>" width="85px;"></a></td>
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
                <h3 class="card-title">Data Pengajuan Surat Keterangan Usaha</h3>
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
                    <th>TGL Pembuatan Surat ini</th>
                    <th>Status Surat</th>
                    <th>Setujui / Tolak Pengajuan</i></th>
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
                    <td><?=tgl_indo($data['tgl_ush'])?></td>
                    <td><?=$data['status_ush']?></td>
                    <td id="ikonbtn2">
                      <form action="" method="post">
                        <div class="text-center">
                          <input type="text" class="form-control mb-2" name="status_ush" placeholder="Isi Keterangan ACC/Tolak" required="">
                          <button type="submit" name="tolak" class="btn btn-secondary btn-danger" title="Tolak">
                          <a><i class="fas fa-calendar-times"></i></a>
                          </button>
                          <button type="submit" name="acc" class="btn btn-secondary btn-success" title="Setujui">
                          <a ><i class="fas fa-calendar-check"></i></a>
                          <input type="hidden" class="form-control" name="id_pj_ush" id="inputName" value="<?=$data['id_pj_ush'];?>"> 
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
    $id_pj_ush = $_POST['id_pj_ush'];
    $status_ush = $_POST['status_ush'];
    $status_surat = $_POST['status_surat'];
    $update = mysqli_query($koneksi, "UPDATE pj_usaha SET status_ush = '$status_ush', status_surat = '2' WHERE id_pj_ush = '$id_pj_ush'");
if($update){
          ?> <script>alert('Berhasil Disimpan!'); window.location = 'vr_usaha.php';</script><?php
        }else{
          ?> <script>alert('Gagal, cek kembali!.'); window.location = 'vr_usaha.php';</script><?php
        }  
  }
else if (isset($_POST['acc'])) {
    $id_pj_ush = $_POST['id_pj_ush'];
    $status_ush = $_POST['status_ush'];
    $status_surat = $_POST['status_surat'];
    $update = mysqli_query($koneksi, "UPDATE pj_usaha SET status_ush = '$status_ush', status_surat = '1' WHERE id_pj_ush = '$id_pj_ush'");
if($update){
          ?> <script>alert('Berhasil Disimpan!'); window.location = 'vr_usaha.php';</script><?php
        }else{
          ?> <script>alert('Gagal, cek kembali!.'); window.location = 'vr_usaha.php';</script><?php
        }
  }
?>
<!-- END DISPOSISI -->

<?php break; } ?>
  <?php require_once("foot.php"); ?>