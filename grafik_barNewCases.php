<?php
include('koneksi1.php');
$covid = mysqli_query($koneksi, "select * from tb_newcases");
while($row = mysqli_fetch_array($covid)){
  $country[] = $row['country'];
  $query = mysqli_query($koneksi, "select sum(new_cases) as new_cases from tb_newcases where id_country ='".$row['id_country']."'");
  $row = $query->fetch_array();
  $new_cases[] = $row['new_cases'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>New Cases COVID</title>
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
          data: <?php echo json_encode($new_cases); ?>,
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