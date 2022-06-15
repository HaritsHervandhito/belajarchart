<?php
include('koneksi1.php');
$covid = mysqli_query($koneksi, "select * from tb_totaldeaths");
while($row = mysqli_fetch_array($covid)){
  $country[] = $row['country'];
  $query = mysqli_query($koneksi, "select sum(total_deaths) as total_deaths from tb_totaldeaths where id_country ='".$row['id_country']."'");
  $row = $query->fetch_array();
  $total_deaths[] = $row['total_deaths'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Total Deaths COVID</title>
  <script type="text/javascript" src="Chart.js"></script>
</head>
<body>
  <div style="width: 800px;height: 800px">
    <canvas id="myChart"></canvas>
  </div>

  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data:{
        labels: <?php echo json_encode($country); ?>,
        datasets: [{
          label: 'Grafik Penjualan',
          data: <?php echo json_encode($total_deaths); ?>,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  </script>
</body>
</html>