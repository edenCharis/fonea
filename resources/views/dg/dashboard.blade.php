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
              <li class="breadcrumb-item"><a href="/dg">Graphes Statistiques</a></li>
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
              <h4 class="card-title text-success">Offres par Métier & Trimestre de l'année </h4>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            <div class="row">
                    <div class="col-sm-4">
                      <form action="{{ route("dg.fq.recherche.annee") }}" method="POST" >
                      <!-- select -->
                      @csrf
                      <div class="form-group">
                       
                        <select class="custom-select" name="annee_id">
                          <option selected value="">Selectionnez l'année</option>
                          @foreach ($annees as $a )
                            <option value="{{ $a->id }}">{{ $a->libelle}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-4">

                    <div class="form-group">
                    <button type="submit" class="btn btn-xs btn-info">
  <i class="fas fa-search"></i>
Appliquer </button>

<button type="button" id="downloadExcel" class="btn btn-xs btn-success">
  <i class="fas fa-file-excel"></i>
Telecharger </button>

                    </div>
                   
</form>
                    </div>
            </div>

        
    

   
            <canvas id="distributionChart" width="400" height="200"></canvas>

    


 


              
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
                    <i class="fas fa-user-check me-2"></i> Insertion & Formations
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="/dg" class="btn btn-outline-success w-100 d-flex align-items-center">
                    <i class="fas fa-handshake"></i> Offres & Métiers
                </a>
            </div>
           
          
          
            <div class="col-md-6 mb-3">
                <a href=""  class="btn btn-outline-danger w-100 d-flex align-items-center">
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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

    var data = @json($data);
    var trimestralData = {};
    var metierLabels = [];
    var trimestreLabels = [];


    data.forEach(function(item) {
        if (!trimestralData[item.trimestre+"-"+item.annee]) {
            trimestralData[item.trimestre+"-"+item.annee] = {};
        }
        if (!trimestralData[item.trimestre+"-"+item.annee][item.metier]) {
            trimestralData[item.trimestre+"-"+item.annee][item.metier] = 0;
        }
        trimestralData[item.trimestre + "-" +item.annee][item.metier] += item.total_offres;
        if (!metierLabels.includes(item.metier)) {
            metierLabels.push(item.metier);
        }
        if (!trimestreLabels.includes(item.trimestre+"-"+item.annee)) {
            trimestreLabels.push(item.trimestre + "-" + item.annee);
        }
    });
    var generateRandomColor = function() {
        return 'rgb(' + Math.floor(Math.random() * 256) + ',' +
            Math.floor(Math.random() * 256) + ',' +
            Math.floor(Math.random() * 256) + ')';
    };
    var datasets = metierLabels.map(function(metier) {
        return {
            label: metier,
            data: trimestreLabels.map(function(trimestre) {
                return trimestralData[trimestre] && trimestralData[trimestre][metier] ? trimestralData[trimestre][metier] : 0;
            }),
            backgroundColor: generateRandomColor(),
            borderWidth: 1
        };
    });
    var ctx = document.getElementById('distributionChart').getContext('2d');
    var distributionChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: trimestreLabels,
            datasets: datasets
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Trimestre'
                    }
                },
                y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1 
                },
                title: {
                    display: true,
                    text: 'Nombre d\'offres'
                }
            },
            afterBuildTicks: function (scale) {
                scale.ticks = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] 
            },
            plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Répartition des offres par trimestre et métier'
                            }
                        }
            }
        }
    });




    
    document.getElementById('downloadExcel').addEventListener('click', function () {
    const ws_data = [
        ['Année','Trimestre','Métier', 'Nombre offres'],  
        ...data.map(item => [
            item.annee,
            item.trimestre,
            item.metier,  
            item.total_offres
        ])
    ];

    const ws = XLSX.utils.aoa_to_sheet(ws_data);  
    const wb = XLSX.utils.book_new();  
    XLSX.utils.book_append_sheet(wb, ws, 'Données'); 

   
    XLSX.writeFile(wb, 'donnees_chart.xlsx');

    alert('Le fichier Excel a été téléchargé avec succès !');

  });
</script>














</body>
</html>
