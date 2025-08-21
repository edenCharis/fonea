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
              <li class="breadcrumb-item"><a href="/apprentissage">Apprentissage des métiers</a></li>
              <li class="breadcrumb-item active">Tableau de bord</li>
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
              <button type="button" class="btn btn-sm btn-success"  data-bs-toggle="modal" data-bs-target="#addTrimestreModal">
     <i class="fa fa-plus"></i>  Action de formation</button>
     <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#add1">
     <i class="fas fa-info"></i>
  Détails </button>
  <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#add2">
  <i class="fas fa-rocket"></i>
Réalisations </button>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Numéro d'identification</th>
                    <th>Intitulé</th>
                    <th>Secteur</th>
                    <th>Qualification</th>
                    <th>Demandeurs à former</th>
                    <th>Demandeurs à insérer</th>
                    <th>Demandeurs formés</th>
                    <th>Demandeurs inserés</th>

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
                   
                   @foreach ($d->detailsApprentissage as $fq)
                   <div>{{ $fq->secteur->libelle }}</div>
                   @endforeach
                
                    </td>
                    

                    <td>
                  
                  @foreach ($d->detailsApprentissage as $fq)
                  <div>{{ $fq->qualification->libelle }}</div>
                  @endforeach
               
                   </td>
                   <td>
                  
                  @foreach ($d->detailsApprentissage as $fq)
                  <div>{{ $fq->ndaf }}</div>
                  @endforeach
               
                   </td>
                   <td>
                  @foreach ($d->detailsApprentissage as $fq)
                  <div>{{ $fq->ndai }}</div>
                  @endforeach
                   </td>
                   <td>
                  @foreach ($d->realisationApprentissage as $fq)
                  <div>{{ $fq->ndf }}</div>
                  @endforeach
                   </td>
                   <td>
                  @foreach ($d->realisationApprentissage as $fq)
                  <div>{{ $fq->ndi }}</div>
                  @endforeach
                   </td>
                    <td>{{ $d->trimestre->libelle}}</td>
                    <td>{{ $d->trimestre->annee->libelle}}</td>
                 
                     
                    <td> 
                        <div class="btn-group" role="group">
                          
                            
                            <!-- Delete Button -->
                                            <form action="{{ route('apprentissageMetier.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Etes vous sûr de vouloir supprimer cette ligne ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"> <i class="fas fa-trash fa-xs"></i>  </button>
            </form> 
                        </div>
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

  <!-- ADD MODALS (existing) -->
  <div class="modal fade" id="addTrimestreModal" tabindex="-1" aria-labelledby="addTrimestreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTrimestreModalLabel">    <i class="nav-icon fas fa-tools"></i>
                Action d'apprentissage de métiers  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="trimestreForm" method="POST" action="{{ route('apprentissageMetier.store') }}">
                @csrf
                <div class="modal-body">
                <div class="mb-3">
                        <label for="name" class="form-label">Intitulé de l'action de formation</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="annee_id" class="form-label">Selectionnez le trimestre </label>
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
                <h5 class="modal-title" id="add1">    <i class="nav-icon fas fa-tools"></i>
                Détailler une action d'apprentissage de métiers  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add1" method="POST" action="{{ route('detailsApprentissage.store') }}">
                @csrf
                <div class="modal-body">
                <div class="mb-3">
                        <label for="apprentissage_id" class="form-label">Selectionnez l'action de formation </label>
                        <select id="apprentissage_id" name="apprentissage_id" class="form-select" required>
                            <option value="" disabled selected></option>
                            @foreach($data as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle."-".$s->numero_identification }}</option>
                            @endforeach
                        </select>
                    </div>
              
                    <div class="mb-3">
                        <label for="secteur_id" class="form-label">Selectionnez le secteur </label>
                        <select id="secteur_id" name="secteur_id" class="form-select" required>
                            <option value="" disabled selected></option>
                            @foreach($secteurs as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="qualification_id" class="form-label">Selectionnez la qualification </label>
                        <select id="qualification_id" name="qualification_id" class="form-select" required>
                            <option value="" disabled selected></option>
                            @foreach($qualification as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">  
                    <label for="operateur_formation" class="form-label">Opérateur de formation</label>
                        
                        <input type="text" min="1" id="operateur_formation" name="operateur_formation" class="form-control" placeholder="" required>
                    </div>

                    <div class="mb-3">
                    <label for="ndaf" class="form-label">Nombre de démandeurs à former</label>
                     
                        <input type="number" min="1" id="ndaf" name="ndaf" class="form-control"  required>
                    </div>
                    <div class="mb-3">
                    <label for="ndaf" class="form-label">Nombre de démandeurs à insérer</label>
                     
                  
                        <input type="text" min="1" id="ndai" name="ndai" class="form-control" required>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    
                    <button type="submit" class="btn btn-success"> <i class="fa fa-plus"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add2" tabindex="-1" aria-labelledby="add2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add2">    <i class="nav-icon fas fa-graduation-cap"></i>
                Réalisation d'une action de formation  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add2" method="POST" action="{{ route('realisationApprentissage.store') }}">
                @csrf
                <div class="modal-body">
                <div class="mb-3">
                        <label for="apprentissage_id" class="form-label">Selectionnez l'action de formation </label>
                        <select id="apprentissage_id" name="apprentissage_id" class="form-select" required>
                            <option value="" disabled selected></option>
                            @foreach($data as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle."-".$s->numero_identification }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">  
                    <label for="ndf" class="form-label">Nombre de démandeurs formés</label>
                        
                        <input type="number" min="1" id="ndf" name="ndf" class="form-control" placeholder="" required>
                    </div>
                    <div class="mb-3">
                    <label for="ndi" class="form-label"> Nombre de démandeurs inserés</label>
                        <input type="text" min="1" id="ndi" name="ndi" class="form-control" placeholder="" required>
                    </div>
                    <div class="mb-3"> 
                    <label for="decrochage" class="form-label"> Nombre des décrochages</label>
                    
                        <input type="number" min="0" id="decrochage" name="decrochage" class="form-control" placeholder="" required>
                    </div>
 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-save fa-xs"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <!-- EDIT MODALS -->
  
  <!-- Edit Apprentissage Modal -->
  <div class="modal fade" id="editApprentissageModal" tabindex="-1" aria-labelledby="editApprentissageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editApprentissageModalLabel">
                    <i class="nav-icon fas fa-edit"></i>
                    Modifier l'action de formation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editApprentissageForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_apprentissage_id" name="apprentissage_id">
                    
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Intitulé de l'action de formation</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_trimestre_id" class="form-label">Selectionnez le trimestre</label>
                        <select id="edit_trimestre_id" name="trimestre_id" class="form-select" required>
                            <option value="" disabled>Choisir un trimestre</option>
                            @foreach($trimestres as $s)
                                <option value="{{ $s->id }}">{{ $s->libelle."-".$s->annee->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>

  <!-- Edit Details Modal -->
  <div class="modal fade" id="editDetailsModal" tabindex="-1" aria-labelledby="editDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
             
                <h5 class="modal-title" id="editDetailsModalLabel">
                    <i class="nav-icon fas fa-info"></i>
                    Modifier les détails de l'action
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editDetailForm" method="POST">
                @csrf
                @method('GET')
                <div id="editDetailsContent">
                    <!-- Details forms will be populated here -->
                </div>
                </form>
            </div>
     
        </div>
    </div>
  </div>

  <!-- Edit Realisation Modal -->
  <div class="modal fade" id="editRealisationModal" tabindex="-1" aria-labelledby="editRealisationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="editRealisationModalLabel">
                    <i class="nav-icon fas fa-rocket"></i>
                    Modifier les réalisations
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                              <form id="editRealisationForm" method="POST">
                @csrf
                @method('GET')
                <div id="editRealisationContent">
                    <!-- Realisation forms will be populated here -->
                </div>
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

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
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
        "responsive": true, 
        "lengthChange": true, 
        "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

// Edit Apprentissage Function
function editApprentissage(id, intitule, trimestreId) {
    $('#edit_apprentissage_id').val(id);
    $('#edit_name').val(intitule);
    $('#edit_trimestre_id').val(trimestreId);
    // Set the form action
    $('#editApprentissageForm').attr('action', `/apprentissageMetier/${id}`);
}

// Edit Details Function
function editDetails(apprentissageId, detailsData) {
    let html = '';
    
    if (detailsData && detailsData.length > 0) {
        detailsData.forEach(function(detail) {
            html += generateDetailForm(detail);
        });
    } else {
        html = '<div class="alert alert-info">Aucun détail trouvé pour cette action de formation.</div>';
    }
    
    $('#editDetailsContent').html(html);
    

    $('#editDetailForm').attr('action', `/detailsApprentissage.update/${id}`);
    
}

// Generate Detail Form HTML
function generateDetailForm(detail) {
    // Generate secteur options
    let secteurOptions = '<option value="" disabled>Choisir un secteur</option>';
    @foreach($secteurs as $secteur)
        secteurOptions += `<option value="{{ $secteur->id }}" ${detail.secteur_id == {{ $secteur->id }} ? 'selected' : ''}>{{ $secteur->libelle }}</option>`;
    @endforeach

    // Generate qualification options
    let qualificationOptions = '<option value="" disabled>Choisir une qualification</option>';
    @foreach($qualification as $qual)
        qualificationOptions += `<option value="{{ $qual->id }}" ${detail.qualification_id == {{ $qual->id }} ? 'selected' : ''}>{{ $qual->libelle }}</option>`;
    @endforeach

    return `
          
            <div class='row'>
                <div class='col-md-6 mb-3'>
                    <label class='form-label'>Secteur</label>
                    <select name='secteur_id' class='form-select' required>
                        ${secteurOptions}
                    </select>
                </div>
                
                <div class='col-md-6 mb-3'>
                    <label class='form-label'>Qualification</label>
                    <select name='qualification_id' class='form-select' required>
                        ${qualificationOptions}
                    </select>
                </div>
            </div>
            
            <div class='row'>
                <div class='col-md-4 mb-3'>
                    <label class='form-label'>Opérateur de formation</label>
                    <input type='text' name='operateur_formation' class='form-control' 
                           value='${detail.operateur_formation || ''}' required>
                </div>
                
                <div class='col-md-4 mb-3'>
                    <label class='form-label'>Demandeurs à former</label>
                    <input type='number' name='ndaf' class='form-control' 
                           value='${detail.ndaf || ''}' min='1' required>
                </div>
                
                <div class='col-md-4 mb-3'>
                    <label class='form-label'>Demandeurs à insérer</label>
                    <input type='number' name='ndai' class='form-control' 
                           value='${detail.ndai || ''}' min='1' required>
                </div>
            </div>
            
            <div class='text-end'>
                <button type='submit' class='btn btn-primary btn-sm'>
                    <i class='fa fa-save'></i> Mettre à jour
                </button>
            </div>
        `;
}

// Edit Realisation Function  
function editRealisation(apprentissageId, realisationData) {
    let html = '';
    
    if (realisationData && realisationData.length > 0) {
        realisationData.forEach(function(realisation) {
            html += generateRealisationForm(realisation);
        });
    } else {
        html = '<div class="alert alert-info">Aucune réalisation trouvée pour cette action de formation.</div>';
    }
    
    $('#editRealisationContent').html(html);
      $('#editRealisationForm').attr('action', `/realisationApprentissage.update/${id}`);
    
}

// Generate Realisation Form HTML
function generateRealisationForm(realisation) {
    return `
          <div class='row'>
                <div class='col-md-4 mb-3'>
                    <label class='form-label'>Demandeurs formés</label>
                    <input type='number' name='ndf' class='form-control' 
                           value='${realisation.ndf || ''}' min='0' required>
                </div>
                
                <div class='col-md-4 mb-3'>
                    <label class='form-label'>Demandeurs insérés</label>
                    <input type='number' name='ndi' class='form-control' 
                           value='${realisation.ndi || ''}' min='0' required>
                </div>
                
                <div class='col-md-4 mb-3'>
                    <label class='form-label'>Nombre de décrochages</label>
                    <input type='number' name='decrochage' class='form-control' 
                           value='${realisation.decrochage || ''}' min='0' required>
                </div>
            </div>
            
            <div class='text-end'>
                <button type='submit' class='btn btn-success btn-sm'>
                    <i class='fa fa-save'></i> Mettre à jour
                </button>
            </div>
      `;
}




</script>
</body>
</html>