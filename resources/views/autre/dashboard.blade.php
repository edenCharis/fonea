<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fonea | Gestion des données statistiques</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" type="image/png" href="images/images.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .dashboard-card {
      transition: transform 0.2s;
    }
    .dashboard-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .metric-card {
      background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }
    .metric-value {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .metric-label {
      font-size: 0.9rem;
      opacity: 0.9;
    }
    .chart-container {
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .section-header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 15px 20px;
      border-radius: 10px 10px 0 0;
      margin-bottom: 0;
    }
    .progress-custom {
      height: 10px;
      border-radius: 5px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include("autre.nav")
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @include("autre.head")
    <!-- Sidebar Menu -->
    @include("autre.sidebar")
    <!-- /.sidebar-menu -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-chart-line"></i> Tableau de Bord DSIP</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">DSIP</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Key Metrics Row -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="totalActions">0</h3>
                <p>Actions Totales</p>
              </div>
              <div class="icon">
                <i class="fas fa-tasks"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="totalBeneficiaries">0</h3>
                <p>Bénéficiaires Formés</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="totalPlacements">0</h3>
                <p>Placements Réalisés</p>
              </div>
              <div class="icon">
                <i class="fas fa-briefcase"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="successRate">0%</h3>
                <p>Taux de Réussite</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
          <!-- Program Distribution -->
          <div class="col-md-6">
            <div class="card dashboard-card">
              <div class="card-header section-header">
                <h3 class="card-title"><i class="fas fa-chart-pie"></i> Répartition par Programme</h3>
              </div>
              <div class="card-body">
                <canvas id="programChart" height="300"></canvas>
              </div>
            </div>
          </div>

          <!-- Quarterly Performance -->
          <div class="col-md-6">
            <div class="card dashboard-card">
              <div class="card-header section-header">
                <h3 class="card-title"><i class="fas fa-chart-bar"></i> Performance Trimestrielle</h3>
              </div>
              <div class="card-body">
                <canvas id="quarterlyChart" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Sector Analysis -->
        <div class="row">
          <div class="col-md-8">
            <div class="card dashboard-card">
              <div class="card-header section-header">
                <h3 class="card-title"><i class="fas fa-industry"></i> Analyse par Secteur</h3>
              </div>
              <div class="card-body">
                <canvas id="sectorChart" height="200"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card dashboard-card">
              <div class="card-header section-header">
                <h3 class="card-title"><i class="fas fa-target"></i> Objectifs vs Réalisations</h3>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <span class="text-sm">Formation Qualifiante</span>
                  <div class="progress progress-custom">
                    <div class="progress-bar bg-primary" style="width: 75%"></div>
                  </div>
                  <small class="text-muted">75% de l'objectif atteint</small>
                </div>
                <div class="mb-3">
                  <span class="text-sm">PED</span>
                  <div class="progress progress-custom">
                    <div class="progress-bar bg-success" style="width: 85%"></div>
                  </div>
                  <small class="text-muted">85% de l'objectif atteint</small>
                </div>
                <div class="mb-3">
                  <span class="text-sm">Formation Continue</span>
                  <div class="progress progress-custom">
                    <div class="progress-bar bg-warning" style="width: 68%"></div>
                  </div>
                  <small class="text-muted">68% de l'objectif atteint</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activities -->
        <div class="row">
          <div class="col-md-12">
            <div class="card dashboard-card">
              <div class="card-header section-header">
                <h3 class="card-title"><i class="fas fa-clock"></i> Activités Récentes</h3>
              </div>
              <div class="card-body">
                <div class="timeline">
                  <div class="time-label">
                    <span class="bg-green">Aujourd'hui</span>
                  </div>
                  <div>
                    <i class="fas fa-graduation-cap bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 2 heures</span>
                      <h3 class="timeline-header">Nouvelle action de Formation Qualifiante</h3>
                      <div class="timeline-body">
                        Action "Développement Web" ajoutée dans le secteur Informatique
                      </div>
                    </div>
                  </div>
                  <div>
                    <i class="fas fa-briefcase bg-green"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 4 heures</span>
                      <h3 class="timeline-header">Nouveau placement PED</h3>
                      <div class="timeline-body">
                        15 candidats placés chez TotalEnergies Congo
                      </div>
                    </div>
                  </div>
                  <div>
                    <i class="fas fa-users bg-orange"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fas fa-clock"></i> 6 heures</span>
                      <h3 class="timeline-header">Formation Continue terminée</h3>
                      <div class="timeline-body">
                        Formation en Management complétée avec 25 participants
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
          <div class="col-md-12">
            <div class="card dashboard-card">
              <div class="card-header section-header">
                <h3 class="card-title"><i class="fas fa-rocket"></i> Actions Rapides</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <a href="/formationQualifiante" class="btn btn-primary btn-block">
                      <i class="fas fa-graduation-cap"></i> Formation Qualifiante
                    </a>
                  </div>
                  <div class="col-md-3">
                    <a href="/ped" class="btn btn-success btn-block">
                      <i class="fas fa-briefcase"></i> Programme PED
                    </a>
                  </div>
                  <div class="col-md-3">
                    <a href="/formationContinue" class="btn btn-warning btn-block">
                      <i class="fas fa-users"></i> Formation Continue
                    </a>
                  </div>
                  <div class="col-md-3">
                    <a href="/rapports" class="btn btn-info btn-block">
                      <i class="fas fa-chart-bar"></i> Rapports
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>

  @include("autre.footer")

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>

<script>
$(document).ready(function() {
    // Simulate data loading
    updateMetrics();
    createCharts();
});

function updateMetrics() {
    // Simulate API calls with sample data
    $('#totalActions').text('127');
    $('#totalBeneficiaries').text('1,847');
    $('#totalPlacements').text('892');
    $('#successRate').text('73%');
}

function createCharts() {
    // Program Distribution Chart
    const programCtx = document.getElementById('programChart').getContext('2d');
    new Chart(programCtx, {
        type: 'doughnut',
        data: {
            labels: ['Formation Qualifiante', 'Programme PED', 'Formation Continue'],
            datasets: [{
                data: [45, 35, 20],
                backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Quarterly Performance Chart
    const quarterlyCtx = document.getElementById('quarterlyChart').getContext('2d');
    new Chart(quarterlyCtx, {
        type: 'bar',
        data: {
            labels: ['T1 2024', 'T2 2024', 'T3 2024', 'T4 2024'],
            datasets: [{
                label: 'Formés',
                data: [320, 450, 380, 520],
                backgroundColor: '#007bff',
                borderRadius: 5
            }, {
                label: 'Placés',
                data: [280, 390, 320, 440],
                backgroundColor: '#28a745',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Sector Analysis Chart
    const sectorCtx = document.getElementById('sectorChart').getContext('2d');
    new Chart(sectorCtx, {
        type: 'horizontalBar',
        data: {
            labels: ['Informatique', 'BTP', 'Commerce', 'Industrie', 'Agriculture', 'Services'],
            datasets: [{
                label: 'Nombre de formations',
                data: [35, 28, 22, 18, 15, 12],
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', 
                    '#dc3545', '#6f42c1', '#fd7e14'
                ],
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Auto-refresh data every 5 minutes
setInterval(updateMetrics, 300000);
</script>

</body>
</html>