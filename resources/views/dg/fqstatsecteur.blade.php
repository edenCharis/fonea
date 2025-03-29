<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FONEA | Direction Génerale </title>
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
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
@include("dg.nav")

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   @include("dg.head")

      <!-- Sidebar Menu -->
   @include("dg.sidebar")
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Graphes Statistiques</a></li>
              <li class="breadcrumb-item active">Formation Qualifiante</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
     <div class="col-8">
          
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h4 class="card-title text-success">Insertions & Formations par métier</h4>
            
           


            </div>

            <!-- /.card-header -->
            <div class="card-body">

            <div class="row">
                    <div class="col-sm-4">
                      <form action="{{ route("dg.fq.insertion_formation.recherche") }}" method="POST" >
                      <!-- select -->
                      @csrf
                      <div class="form-group">
                       
                        <select class="custom-select form-sm" name="annee_id">
                          <option selected value="">Selectionnez l'année</option>
                          @foreach ($annees as $a )
                            <option value="{{ $a->id }}">{{ $a->libelle}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">

                    <div class="form-group">
                    <button type="submit" class="btn btn-xs btn-danger">
                  <i class="fas fa-search"></i>
Appliquer </button>
<button type="button" id="downloadExcel" class="btn btn-xs btn-success" >
                        <i class="fas fa-file-excel"></i>
Telecharger </button>


                    </div>

                   
                   
</form>
                    </div>
            </div>

        
    

   
            <canvas id="repartitionSecteursBarsChart" width="400" height="200"></canvas>

    




              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="col-4">
        <div class="card shadow-sm">
    <div class="card-header  text-success">
        <h5 class="mb-0">Formation Qualifiante</h5>
    </div>
    <div class="card-body">
        <div class="row">
           
            <div class="col-md-6 mb-3">
                <a href="/fq.stat.insertion" class="btn btn-outline-success w-100 d-flex align-items-center">
                    <i class="fas fa-user-check me-2"></i>Insertion & Formations
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="/dg" class="btn btn-outline-success w-100 d-flex align-items-center">
                    <i class="fas fa-handshake"></i> Offres & Métiers
                </a>
            </div>
           
          
            <div class="col-md-6 mb-3">
                <a href="/fq.stat.secteur"  class="btn btn-outline-danger w-100 d-flex align-items-center">
                    <i class="fas fa-industry me-2"></i> Secteur d'activités
                </a>
            </div>
        </div>
    </div>
</div>

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
 @include("dg.footer")

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>

<script>



const data = @json($data);




const labels = data.map(item => `${item.trimestre}-${item.annee} (${item.secteur})`);

// Préparation des datasets pour les insertions et formations
const insertionsData = data.map(item => item.total_insertions);
const formationsData = data.map(item => item.total_formations);

// Création du graphique à barres
const ctx = document.getElementById('repartitionSecteursBarsChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels, // Axe X : combinaison de trimestre-année et secteur
        datasets: [
            {
                label: 'Insertions',
                data: insertionsData, // Données des insertions
                backgroundColor: 'rgba(75, 192, 192, 0.6)', // Couleur des barres des insertions
                borderColor: 'rgba(75, 192, 192, 1)', // Bordure des barres
                borderWidth: 1
            },
            {
                label: 'Formations',
                data: formationsData, // Données des formations
                backgroundColor: 'rgba(255, 99, 132, 0.6)', // Couleur des barres des formations
                borderColor: 'rgba(255, 99, 132, 1)', // Bordure des barres
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Répartition des Formations et Insertions par Secteurs d\'Activités'
            },
            legend: {
                display: true,
                position: 'top' // Position de la légende
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Trimestre-Annee (Secteurs)' // Légende pour l'axe X
                },
                ticks: {
                    autoSkip: false // Afficher toutes les étiquettes
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Nombre Total' // Légende pour l'axe Y
                },
                beginAtZero: true // Démarrer à 0 sur l'axe Y
            }
        }
    }
});


</script>
</body>
</html>