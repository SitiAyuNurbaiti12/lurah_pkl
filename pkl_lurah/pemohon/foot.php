<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2022
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Logout.</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apa Anda Yakin Ingin Logout?.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
<!-- js chart -->

 <script type="text/javascript" src="JQuery/jquery-3.4.1.min.js"></script>
 <script type="text/javascript" src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="../Chartjs/dist/Chart.min.js"> </script>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script src="process.js"></script>

<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
$.getJSON( "http://localhost:/chart-pie/data-produk.php", function( data ) {
    var TabelData="";
    $(data).each(function(i){ 
        TabelData +="<tr><td>"+data[i].NamaProduk+"</td><td>"+data[i].JmlItem+"</td></tr>"; 
    });
    //tampilkan di tabel id DataTabelProduk
    $("#DatatTabelProduk").html(TabelData);

    //array untuk chart label dan chart data
    var isi_labels = [];
    var isi_data=[];
    var TotalJml = 0;
    //menghitung total jumlah item
    data.forEach(function (obj) {
        TotalJml += Number(obj["JmlItem"]);
    });

    //push ke dalam array isi label dan isi data
    var JmlItem = 0;
    $(data).each(function(i){         
        isi_labels.push(data[i].NamaProduk); 
        //jml item dalam persentase
        isi_data.push(((data[i].JmlItem/TotalJml) * 100).toFixed(2));
    });

    //deklarasi chartjs untuk membuat grafik 2d di id mychart   
    var ctx = document.getElementById('myChart').getContext('2d');

    var myPieChart = new Chart(ctx, {
        //chart akan ditampilkan sebagai pie chart
        type: 'pie',
        data: {
            //membuat label chart
            labels: isi_labels,
            datasets: [{
                label: 'Data Produk',
                //isi chart
                data: isi_data,
                //membuat warna pada chart
                backgroundColor: [
                    'rgb(26, 214, 13)',
                    'rgb(235, 52, 110)',
                    'rgb(52, 82, 235)',
                    'rgb(138, 4, 113)',
                    'rgb(214, 134, 13)'
                ],
                //borderWidth: 0, //this will hide border
            }]
        },
        options: {
            //konfigurasi tooltip
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var labels = data.labels[tooltipItem.index];
                        var currentValue = dataset.data[tooltipItem.index];
                        return labels+": "+currentValue+" %";
                    }
                }
            }
          }
    });
});
</script>

</body>
</html>

