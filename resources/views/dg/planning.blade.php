<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FONEA | <?php echo Auth::user()->direction; ?></title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" type="image/png" href="images/images.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
   <link rel="stylesheet" href="dist/css/modal.css">
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
              <li class="breadcrumb-item"><a href="/dg">Planning des activités</a></li>
              
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
               
              <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addYearModal">
    <i class="fa fa-plus"></i> Activité
</button>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 
                   
                    
                    <th>Activité prévue</th>
                    <th>Coût</th>
                    <th>Année</th>
                    <th>Taux de réalisation</th>
                    <th>Statut</th>
                    
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @forelse ($data as $d)  
                  <tr>
                  
                    <td>{{ $d->libelle}}</td>
                    <td> {{ number_format($d->mtb, 0, '.', ' ') }}</td>
                    <td>{{ $d->annee->libelle}}</td>
                    <td>{{ $d->taux_realisation. "  %"}}</td>
                    <td class="
    @if ($d->statut == 1)
        text-success
    @elseif ($d->statut == 0)
        text-danger
    @endif
">
<b> {{($d->statut == 1) ? 'Executée' : 'En Attente' }}</b>

                 

                         <td> 
  <div class="d-flex action-buttons">
  <button class="btn btn-sm btn-info btn-edit"
    data-id="{{ $d->id }}"
    data-libelle="{{ $d->libelle }}"
    data-mtb="{{ $d->mtb }}"
    data-annee="{{ $d->annee->id }}"
    data-taux="{{ $d->taux_realisation }}"
    data-statut="{{ $d->statut }}">
  <i class="fa fa-edit"></i>
</button>


    <button class="btn btn-sm btn-danger" onclick="openDeleteModal({{ $d->id }}, '{{ addslashes($d->libelle) }}')">
      <i class="fas fa-trash"></i>
    </button>
  </div>
</td>

                        
                    </td>
                        
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


      <div class="modal fade" id="addYearModal" tabindex="-1" aria-labelledby="addYearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addYearModalLabel">   <i class="nav-icon fas fa-calendar"></i> Programmer une activité</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <form action=" {{ route('activites.store')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                     <input type="hidden" class="form-control" id="direction" name="direction" value="<?php echo Auth::user()->Direction->id?>" required>
                       
                    <div class="mb-3">
                        <label for="annee_id" class="form-label">Selectionnez l'année de l'activité </label>
                        <select id="annee_id" name="annee_id" class="form-control" required>
                            <option value="" disabled selected></option>
                            @foreach($annees as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="libelle">Intitulé de l'activité</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" required>
                        </div>
                        <div class="mb-3">
                        <label for="mtb">Coût de l'activité</label>
                            <input type="number" class="form-control" id="mtb" name="mtb" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i>  Enregistrer</button>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>


<div class="modal fade modern-modal edit-modal" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="editModalLabel">
            <i class="fas fa-edit me-2"></i>Modifier l'activité
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="edit-icon mb-3">
              <i class="fas fa-edit text-white fa-lg"></i>
            </div>
            
            <input type="hidden" id="edit_activity_id" name="id">
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <select id="edit_annee_id" name="annee_id" class="form-select" required>
                    @foreach($annees as $s)
                        <option value="{{ $s->id }}">{{ $s->libelle }}</option>
                    @endforeach
                  </select>
                  <label for="edit_annee_id">Année de l'activité</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <select id="edit_statut" name="statut" class="form-select" required>
                    <option value="0">En Attente</option>
                    <option value="1">Executée</option>
                  </select>
                  <label for="edit_statut">Statut</label>
                </div>
              </div>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="edit_libelle" name="libelle" placeholder="Intitulé" required>
              <label for="edit_libelle">Intitulé de l'activité</label>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="edit_mtb" name="mtb" placeholder="Coût" required>
                  <label for="edit_mtb">Coût de l'activité</label>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="edit_taux" name="taux_realisation" placeholder="Taux" min="0" max="100">
                  <label for="edit_taux">Taux de réalisation (%)</label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-modern" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-save btn-modern">
              <i class="fas fa-save me-2"></i>Sauvegarder
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade modern-modal delete-modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="deleteModalLabel">
            <i class="fas fa-exclamation-triangle me-2"></i>Confirmation de suppression
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <div class="delete-icon">
            <i class="fas fa-trash-alt text-white fa-2x"></i>
          </div>
          <h4 class="mb-3">Êtes-vous sûr ?</h4>
          <p class="text-muted mb-4">Vous êtes sur le point de supprimer définitivement cette activité :</p>
          <div class="alert alert-light border" role="alert">
            <strong id="activityToDelete">Nom de l'activité</strong>
          </div>
          <p class="text-muted small">Cette action est irréversible et ne peut pas être annulée.</p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary btn-modern" data-bs-dismiss="modal">
            <i class="fas fa-times me-2"></i>Annuler
          </button>
          <form id="deleteForm" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete btn-modern">
              <i class="fas fa-trash me-2"></i>Supprimer
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModalLabel">
                    {{ session('status') === 'success' ? 'success' : 'error' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ session('message') }}</p>
            </div>
        </div>
    </div>
</div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @include("controle.footer")

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
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>
<script>
// Open Edit Modal
$(document).on('click', '.btn-edit', function () {
  let id = $(this).data('id');
  let libelle = $(this).data('libelle');
  let mtb = $(this).data('mtb');
  let annee = $(this).data('annee');
  let taux = $(this).data('taux');
  let statut = $(this).data('statut');

  console.log("Opening modal with:", id, libelle, mtb, annee, taux, statut);

  document.getElementById('edit_activity_id').value = id;
  document.getElementById('edit_libelle').value = libelle;
  document.getElementById('edit_mtb').value = mtb;
  document.getElementById('edit_annee_id').value = annee;
  document.getElementById('edit_taux').value = taux;
  document.getElementById('edit_statut').value = statut;

  document.getElementById('editForm').action = `{{ url('activites') }}/${id}`;

  var editModal = new bootstrap.Modal(document.getElementById('editModal'));
  editModal.show();
});


// Open Delete Modal
function openDeleteModal(id, activityName) {
  // Set activity name in modal
  document.getElementById('activityToDelete').textContent = activityName;
  
  // Set form action - use your Laravel route
  document.getElementById('deleteForm').action = `{{ route('activites.destroy', '') }}/${id}`;
  
  // Show modal
  const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
  deleteModal.show();
}

// Handle form submissions with loading states
document.getElementById('editForm').addEventListener('submit', function(e) {
  const submitBtn = this.querySelector('button[type="submit"]');
  submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sauvegarde...';
  submitBtn.disabled = true;
});

document.getElementById('deleteForm').addEventListener('submit', function(e) {
  const submitBtn = this.querySelector('button[type="submit"]');
  submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Suppression...';
  submitBtn.disabled = true;
});

// Add smooth animations
document.addEventListener('DOMContentLoaded', function() {
  // Add subtle animations to buttons
  const buttons = document.querySelectorAll('.btn');
  buttons.forEach(btn => {
    btn.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-2px)';
    });
    btn.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });
});
</script>
<script src="dist/js/adminlte.js"></script>
@if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sessionModal = new bootstrap.Modal(document.getElementById('sessionModal'));
            sessionModal.show();
        });
    </script>
@endif
<script>







</body>
</html>
