<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administrateur</title>
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
@include("admin.nav")
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   @include("admin.head")

      <!-- Sidebar Menu -->
   @include("admin.sidebar")
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
            <h5 class="text-info">Gestion des offres de services</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/administrateur"></a>Tableau de bord</li>
              <li class="breadcrumb-item active">ODS</li>
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
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTrimestreModal">
     <i class="fa fa-plus"></i>  Ajouter </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 
                   
                    <th>Offre de services</th>
                    <th>Direction</th>
                   
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($data as $d)  
                  <tr>
                    <td>{{ $d->libelle}}</td>
                    <td>{{ $d->direction}}</td>
                 

                    <td> 
                             <a href="" class="btn btn-sm btn-info"> <i class="fa fa-edit"></i> </a>
                             <a href="" class="btn btn-sm btn-danger"> <i class="fa fa-trash"></i> </a>
                        
                    </td>
                  </tr>
                  @empty
                 
                  @endforelse
                
              
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




<!-- Success/Error Modal -->
<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModalLabel">
                    {{ session('status') === 'success' ? 'Success' : 'Error' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ session('message') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Auto-trigger Modal if Session is Set -->
@if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sessionModal = new bootstrap.Modal(document.getElementById('sessionModal'));
            sessionModal.show();
        });
    </script>
@endif

    </section>
    <!-- /.content -->

    <div class="modal fade" id="addTrimestreModal" tabindex="-1" aria-labelledby="addTrimestreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrimestreModalLabel">   <i class="nav-icon fas fa-briefcase"></i> Ajouter une offre de service </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="trimestreForm" method="POST" action="{{ route('ods.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="annee_id" class="form-label">Selectionnez la direction </label>
                        <select id="direction" name="direction" class="form-select" required>
                            <option value="" disabled selected></option>
                            @foreach($directions as $s)
                                <option value="{{ $s->code }}">{{ $s->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Offre de service</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Entrez l'offre de service" required>
                    </div>
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
  </div>
  <!-- /.content-wrapper -->
 @include("admin.footer")

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
