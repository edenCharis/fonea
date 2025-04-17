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
              <li class="breadcrumb-item"><a href="/tde">Entrepreunariat</a></li>
              <li class="breadcrumb-item active">Financements</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
              <button type="button" class="btn btn-sm btn-dark"  data-bs-toggle="modal" data-bs-target="#addTrimestreModal">
     <i class="fa fa-plus"></i>  Action TDE</button>
     <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#add1">
     <i class="fas fa-info"></i>
  Détails </button>
  <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#add2">
  <i class="fas fa-rocket"></i>
Réalisations </button>

<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add3">
<i class="fas fa-chart-line"></i>
Statistiques </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Numéro d'identification</th>
                    <th>Intitulé</th>
                    <th>Béneficiaires prévues</th>
                    <th>Béneficiaires  réels</th>
                  
                    <th>Trimestre</th>
                    <th>Année</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $d)  
                     <tr>
                    <td>{{ $d->numero_identification}}</td>
                    <td>{{ $d->intitule }}</td>
                    <td>
                   
                   @foreach ($d->financement as $tde)
                   <div>{{ $tde->nbp }}</div>
                   @endforeach
                
                    </td> 
                    <td>
                   
                   @foreach ($d->realisationFinancement as $tde)
                   <div>{{ $tde->nrb }}</div>
                   @endforeach
                
                    </td> 
                    <td>{{ $d->trimestre->libelle}}</td>
                    <td>{{ $d->trimestre->annee->libelle}}</td>
                    <td> 

                      
                    <form action="{{ route('TDE.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Etes-vous sûr de vouloir supprimer cette ligne ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> <i class="fas fa-trash fa-xs"></i>  </button>
            </form> 
                  </td>
                     </tr>
                  @endforeach
                
              
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="addTrimestreModal" tabindex="-1" aria-labelledby="addTrimestreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrimestreModalLabel">    <i class="nav-icon fas fa-hard-hat"></i>
                Action de financement relative au TDE  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="trimestreForm" method="POST" action="{{ route('TDE.store') }}">
                @csrf
                <div class="modal-body">
                <div class="mb-3">
                <input type="hidden" id="type" name="type" class="form-control" value="2"  required>
            
                        <label for="name" class="form-label">Intitulé de l'action TDE</label>
                        <input type="text" id="name" name="name" class="form-control"  required>
                    </div>
                    <div class="mb-3">
                        <label for="trimestre_id" class="form-label">Selectionnez le trimestre </label>
                        <select id="trimestre_id" name="trimestre_id" class="form-select" required>
                            <option value="" disabled selected></option>
                            @foreach($trimestres as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle."-".$s->annee->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add1" tabindex="-1" aria-labelledby="add1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add1">    <i class="nav-icon fas fa-hard-hat"></i>
                Détailler l'action de financement  d'une TDE  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add1" method="POST" action="{{ route('detailsTDE.store') }}">
                @csrf
                <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" name="financement" value="financement" >
                        <label for="tde_id" class="form-label">Selectionnez l'action de financement TDE </label>
                        <select id="tde_id" name="tde_id" class="form-select" required>
                            <option value="" disabled selected></option>
                            @foreach($data as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle."-".$s->numero_identification }}</option>
                            @endforeach
                        </select>
                    </div>
              
                    <div class="mb-3">  
                    <label for="nbp" class="form-label">Nombre de beneficiaires prévus</label>
                        
                        <input type="number" min="1" id="nbp" name="nbp" class="form-control" placeholder="" required>
                    </div>
                   
                   
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add2" tabindex="-1" aria-labelledby="add2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add2">    <i class="nav-icon fas fa-hard-hat"></i>
                Réalisation d'une action de financement de TDE  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add2" method="POST" action="{{ route('realisationTDE.store') }}">
                 @csrf
                <div class="modal-body">
                <div class="mb-3">
                <input type="hidden" name="realisationFinancement-" value="realisationFinancement">
                        <label for="tde_id" class="form-label">Selectionnez l'action de financement TDE</label>
                        <select id="tde_id" name="tde_id" class="form-select" required>
                            <option value="" disabled selected></option>
                            @foreach($data as $s)
                                <option value="{{ $s->id }}">{{ $s->numero_identification }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                       <label for="nrb" class="form-label">Nombre de Béneficiaires réels </label>
                           <input type="number" min="1" id="nrb" name="nrb" class="form-control" required>
                       </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"> <i class="fa fa-plus"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
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

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
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
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<script src="dist/js/adminlte.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script></script>
<!-- AdminLTE for demo purposes -->

@if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sessionModal = new bootstrap.Modal(document.getElementById('sessionModal'));
            sessionModal.show();
        });
    </script>
@endif
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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


</body>
</html>
