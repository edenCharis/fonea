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
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Mon Compte</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
      <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modifier mon profil</h3>
                    </div>
                    <form action="{{ route('updateAccount', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="direction" class="form-label">Direction</label>
                                    <input type="text" class="form-control" id="direction" name="libelle" value="{{ $data->direction }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                  <label for="password" class="form-label">Mot de passe</label>
                                  <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Laisser vide pour ne pas changer" autocomplete="new-password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" tabindex="-1">
                                      <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                    </button>
                                  </div>
                                  <small class="text-muted">Laissez vide si vous ne souhaitez pas modifier le mot de passe.</small>
                                </div>
                                <script>
                                  document.addEventListener('DOMContentLoaded', function () {
                                    const passwordInput = document.getElementById('password');
                                    const togglePassword = document.getElementById('togglePassword');
                                    const togglePasswordIcon = document.getElementById('togglePasswordIcon');
                                    togglePassword.addEventListener('click', function () {
                                      const type = passwordInput.type === 'password' ? 'text' : 'password';
                                      passwordInput.type = type;
                                      togglePasswordIcon.classList.toggle('fa-eye');
                                      togglePasswordIcon.classList.toggle('fa-eye-slash');
                                    });
                                  });
                                </script>
                                <div class="col-md-6 mb-3">
                                    <label for="libelle">Nom(s)</label>
                                    <input type="text" class="form-control" id="libelle" name="libelle" value="{{ $data->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="mtb">Prénom(s)</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $data->lastName }}" required >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="taux_realisation">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" value="{{ $data->role }}"  required disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                <label for="taux_realisation">Direction</label>
                                    <input type="text" class="form-control" id="direction" name="direction" value="{{ $data->direction }}"  required disabled>
                                
                                  
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Sauvegarder</button>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> Retour</a>
                        </div>
                    </form>
                </div>
            </div>

      <!-- /.container-fluid -->
 </section>
  </div>


<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModalLabel">
                    {{ session('status') === 'succes' ? 'success' : 'error' }}
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
 @include("admin.footer")

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>


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
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script></script>



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
