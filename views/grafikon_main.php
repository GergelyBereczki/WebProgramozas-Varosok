<!DOCTYPE html>
<html lang="hu">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reszponzív Chart.js</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <div style="width: 80%; margin: auto;">
    <canvas id="myChart"></canvas>
  </div>

  <script>
    // Setup Block
    const park_names = <?php echo json_encode($viewData['uzenet']['megye']) ?>;
    const park_count = <?php echo json_encode($viewData['uzenet']['total_lakossag']) ?>;
    const data = {
      labels: park_names,
      datasets: [{
        label: 'Lakosok száma megyénként 2015-ben',
        data: park_count,
        borderWidth: 1,
        backgroundColor: '#FF6363CC',
      }]
    };

    // Config Block
    const config = {
      type: 'bar',
      data,
      options: {
        responsive: true,
        maintainAspectRatio: true, // Most true-ra állítva
        aspectRatio: 2, // Arány beállítása (2 = 2:1 arány)
        plugins: {
          legend: {
            title: {
              padding: 10
            },
            labels: {
              color: '#000000',
              font: {
                size: 18
              }
            }
          }
        },
        scales: {
          y: {
            ticks: {
              color: '#000000',
            },
            beginAtZero: true,
          },
          x: {
            ticks: {
              color: '#000000',
            }
          }
        }
      },
    }

    // Render Block
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, config);
  </script>
</body>

</html>
