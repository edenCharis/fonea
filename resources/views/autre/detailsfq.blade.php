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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
              <li class="breadcrumb-item"><a href="/fomationQualifiante">Formation Qualifiante</a></li>
              <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-sm-12">
        
        
        
          <div class="row">
          <div class="col-sm-6">
           <div class="card">
              <div class="card-header bg-warning text-white">
                <h3 class="card-title">Détailler une action de formation qualifiante</h3>
              </div>
            
                <div class="card-body">
                <form method="GET" action="{{ route("detailsFQ.edit",$details->id) }}">
                  @csrf
                <div class="mb-3">
                        <label for="secteur_id" class="form-label">Selectionnez le secteur </label>
                        <select id="secteur_id" name="secteur_id" class="form-select" required>
                            <option value="{{ $details->secteur->id}}"  selected>{{ $details->secteur->libelle}}</option>
                            @foreach($secteurs as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="mb-3">
                        <label for="qualification_id" class="form-label">Selectionnez la qualification </label>
                        <select id="qualification_id" name="qualification_id" class="form-select" required>
                            <option value="{{ $details->qualification->id}}"  selected>{{ $details->qualification->libelle}}</option>
                            @foreach($qualifications as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                    <label for="ndaf" class="form-label">Nombre de démandeurs à former</label>
                     
                        <input type="number" min="1" id="ndaf" name="ndaf" class="form-control" value="{{ $details->ndaf}}"  required>
                    </div>
                    <div class="mb-3">
                    <label for="ndaf" class="form-label">Nombre de démandeurs à insérer</label>
                        <input type="text" min="1" id="ndai" name="ndai" class="form-control" value="{{ $details->ndai}}" required>
                    </div>
                    
                  <div class="card-footer">
                  <button type="submit" class="btn btn-warning"> <i class="fas fa-edit fa-xs"></i> Modifier</button>
                </div>
              </form>

                </div>
               </div>
                   
                </div>
                     <div class="col-sm-6">
           <div class="card">
              <div class="card-header bg-secondary text-white">
                <h3 class="card-title"> Réalisation d'une formation qualifiante</h3>
              </div>
                <div class="card-body">
                <form method="GET" action="{{ route("realisationFQ.edit",$realisations->id) }}">
                  @csrf

                    <div class="mb-3">

                       
                        <input type="hidden"  id="form_qual_id" name="form_qual_id" class="form-control" value="{{ $data->id}}"  required>
                    </div>
                    <div class="mb-3">
                    <label for="ndaf" class="form-label">Nombre de démandeurs formés</label>
                     
                        <input type="number" min="1" id="ndaf" name="ndf" class="form-control" value="{{ $realisations->ndf}}"  required>
                    </div>
                    <div class="mb-3">
                    <label for="ndaf" class="form-label">Nombre de démandeurs  inséres </label>
                        <input type="number" min="1" id="ndi" name="ndi" class="form-control" value="{{ $realisations->ndi}}" required>
                    </div>
                     <div class="mb-3">
                    <label for="ndaf" class="form-label">Décrochage </label>
                        <input type="number" min="1" id="decrochage" name="decrochage" class="form-control" value="{{ $realisations->decrochage}}" required>
                    </div>
                    
                  <div class="card-footer">
                  <button type="submit" class="btn btn-secondary"> <i class="fas fa-edit fa-xs"></i> Modifier</button>
                </div>
              </form>

                </div>
               </div>
                   
                </div>
              <div class="col-sm-6">
                <div class="card">
              <div class="card-header bg-info text-white">
                <h3 class="card-title">Editer une action de formation qualifiante</h3>
              </div>
            
                <div class="card-body">
                <form method="POST" action="{{ route("formation_qualifiante.update",$data->id) }}">
                @csrf
                @method('GET')
                <div class="mb-3">
                  <input type="hidden" name="formation_qual_id" value="{{ $data->id }}">
                        <label for="intitule" class="form-label"> Action de formation </label>
                        <input type="text" class="form-control" name="intitule" value="{{ $data->intitule}}">
                </div>
                <div class="mb-3">
                    <label for="trimestre">Trimestre</label>
                    <select id="trimestre_id" name="trimestre_id" class="form-select" >
                            <option value="{{$data->trimestre->id}}"  selected>{{ $data->trimestre->libelle}}</option>
                            @foreach($trimestres as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle."-".$s->annee->libelle }}</option>
                            @endforeach
                        </select>
                  </div>

                  <div class="card-footer">

                  <button type="submit" class="btn btn-info"> <i class="fas fa-edit fa-xs"></i> Modifier</button>
                </div>
              </form>
                   
                </div>

            
                <!-- /.card-body -->

             
            </div>
        
          
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  </div>



  <div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModalLabel">
                    {{ session('status') === 'success' ? 'Success' : 'error' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ session('message') }}</p>
            </div>
        </div>
    </div>
</div>
  <!-- /.content-wrapper -->
 @include("autre.footer")

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
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
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
@if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sessionModal = new bootstrap.Modal(document.getElementById('sessionModal'));
            sessionModal.show();
        });
    </script>
@endif

</body>
</html>
