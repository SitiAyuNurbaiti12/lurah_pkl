<?php require_once("head.php");require_once("../koneksi.php");require_once("../fungsi_indotgl.php");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
    
  <div class="card">
        <div class="card-header">
          <h3 class="card-title">Diagram Seluruh Tabel</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <div class="chart-responsive mb-3">
                <canvas id="pieChart" height="200"></canvas>
              </div>
              <div class="inner text-center"><h4><b>Diagram Data</b></h4></div>
              <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col">
              <ul class="chart-legend clearfix">
                <?php 
                  // $query = mysqli_query($koneksi, "SELECT * FROM users WHERE NOT level = 'admin' AND NOT level = 'karyawan' GROUP BY level");
                  $pegawai = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pegawai"));
                  $pj_kematian = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pj_kematian"));
                  $pj_usaha = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pj_usaha"));
                  $pj_domisili = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pj_domisili"));
                  $pj_pindah = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pj_pindah"));
                  $pj_tmampu = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM pj_tmampu"));
                  ?>
                    <li class="row">
                    <div class="col-4">
                      <div class="small-box bg-dark">
                        <div class="inner">
                          <h3><?= $pegawai ?></h3>

                          <p>Pegawai</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-user-secret nav-icon"></i>
                        </div>
                        <a href="pegawai.php" class="small-box-footer">Lihat Tabel <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="small-box bg-dark">
                        <div class="inner text-light">
                          <h3><?= $pj_kematian ?></h3>

                          <p>Pengajuan Surat Kematian</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-file-alt nav-icon"></i>
                        </div>
                        <a href="vr_kematian.php" class="small-box-footer">Lihat Tabel <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="small-box bg-dark">
                        <div class="inner">
                          <h3><?= $pj_pindah ?></h3>

                          <p>Pengajuan Surat Keterangan Pindah</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-file-alt nav-icon"></i>
                        </div>
                        <a href="vr_pindah.php" class="small-box-footer">Lihat Tabel <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    </li>

                    <li class="row">
                    <div class="col-4">
                      <div class="small-box bg-dark">
                        <div class="inner">
                          <h3><?= $pj_usaha ?></h3>

                          <p>Pengajuan Surat Keterangan Usaha</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-file-alt nav-icon"></i>
                        </div>
                        <a href="vr_usaha.php" class="small-box-footer">Lihat Tabel <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="small-box bg-dark">
                        <div class="inner text-light">
                          <h3><?= $pj_domisili ?></h3>

                          <p>Pengajuan Surat Keterangan Domisili</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-file-alt nav-icon"></i>
                        </div>
                        <a href="vr_domisili.php" class="small-box-footer">Lihat Tabel <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="small-box bg-dark">
                        <div class="inner">
                          <h3><?= $pj_tmampu ?></h3>

                          <p>Pengajuan Surat Keterangan Tidak Mampu</p>
                        </div>
                        <div class="icon">
                          <i class="fas fa-file-alt nav-icon"></i>
                        </div>
                        <a href="vr_tmampu.php" class="small-box-footer">Lihat Tabel <i class="fas fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    </li>
              </ul>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <!-- /.footer -->
    </div>
    <!-- /.card -->
</div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> 
  </div>

  <?php require_once("foot.php"); ?>


<!-- Si Chart -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<script>
$(function () {
  'use strict'
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'pegawai',
          'pj_kematian',
          'pj_usaha',
          'pj_tmampu',
          'pj_domisili',
          'pj_pindah',
      ],
      datasets: [
        {
          data: [<?= $pegawai ?>,<?= $pj_kematian ?>,<?= $pj_usaha ?>,<?= $pj_tmampu ?>,<?= $pj_domisili ?>,<?= $pj_pindah ?>],
          backgroundColor : ['#343a40', '#dc3545','#342321','#6f42c1','#20c997','#fd7e14','#6c757d','#ffc107'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and doughnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })
});

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
      labels  : ['Juni','Juli','Agustus','September'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : [6510000, 5700000, 5230000, 6300000]
        },
        {
          backgroundColor: '#ced4da',
          borderColor    : '#ced4da',
          data           : [5550000, 5000000, 4900000, 5400000]
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: false,

            // Include a dollar sign in the ticks
            callback: function (value, index, values) {
              if (value >= 1) {
                value /= 1
              }
              return 'Rp. ' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })

  var $visitorsChart = $('#visitors-chart')
  var visitorsChart  = new Chart($visitorsChart, {
    data   : {
      labels  : ['Juni','Juli','Agustus','September'],
      datasets: [{
        type                : 'line',
        data                : [5920000, 6700000, 5460000, 6890000],
        backgroundColor     : 'transparent',
        borderColor         : '#ffc107',
        pointBorderColor    : '#ffc107',
        pointBackgroundColor: '#ffc107',
        fill                : false
      },
        {
          type                : 'line',
          data                : [4210000, 5630000, 4030000, 6100000],
          backgroundColor     : 'tansparent',
          borderColor         : 'black',
          pointBorderColor    : 'black',
          pointBackgroundColor: 'black',
          fill                : false
        }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : false,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})

</script>