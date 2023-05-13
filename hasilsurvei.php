<?php include 'air.php'; ?>
<?php include 'pam.php'; ?>
<?php include 'tanah.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>Contoh Grafik dengan Chart.js</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style2.css">
</head>
<body onload="getdata()">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">SURVEI AIR KOTA MEDAN DAN DELI SERDANG</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav" style="justify-content: flex-start;">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Grafik
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#" onclick="grafik1()">Kondisi Air PAM</a>
                <a class="dropdown-item" href="#" onclick="grafik2()">Kondisi Air Tanah</a>
                <a class="dropdown-item" href="#" onclick="grafik3()">Penggunaan Air PAM dan air Tanah</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
  <div class="container">
    <canvas id="data"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('data');
    var grafik;
    function grafik1(){
      destroyChart();
      var datapam = <?php echo $jsonpam; ?>;

      grafik = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: datapam.map(function(item) { return item.label; }),
          datasets: [{
          label: 'Kualitas air PAM',
          data: datapam.map(function(item) { return item.value; }),
          borderWidth: 1
          }]
      },
      options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    align: 'start',
                    display: true, 
                    labels: {
                        boxWidth: 10,
                        padding: 10 
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
      });
    }
    function grafik2(){
      destroyChart();
      var datasumur = <?php echo $jsonsumur; ?>;

      grafik = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: datasumur.map(function(item) { return item.label; }),
          datasets: [{
          label: 'Kualitas air tanah',
          data: datasumur.map(function(item) { return item.value; }),
          borderWidth: 1
          }]
      },
      options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    align: 'start',
                    display: true,
                    labels: {
                        boxWidth: 10, 
                        padding: 10 
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
      });
    }
    function grafik3(){
      destroyChart();
      var datasumber = <?php echo $jsonsumber; ?>;

      grafik = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: datasumber.map(function(item) { return item.label; }),
          datasets: [{
          label: 'Sumber air',
          data: datasumber.map(function(item) { return item.value; }),
          borderWidth: 1
          }]
      },
      options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    align: 'start',
                    display: true, 
                    labels: {
                        boxWidth: 10, 
                        padding: 10 
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
      });
    }

    function destroyChart() {
        if (grafik) {
            grafik.destroy();
        }
    }
  </script>

</body>
</html>