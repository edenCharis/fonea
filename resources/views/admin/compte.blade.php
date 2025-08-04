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
  
  <!-- SweetAlert2 for confirmation dialogs -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    .profile-card {
      border: none;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border: 5px solid #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .profile-upload {
      position: relative;
      display: inline-block;
    }
    .profile-upload input[type="file"] {
      position: absolute;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    .upload-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0, 0, 0, 0.7);
      color: white;
      text-align: center;
      padding: 5px;
      font-size: 12px;
    }
  </style>
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
            <h5 class="text-info">Gestion du profil utilisateur</h5>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Profile Information Card -->
      
          <!-- Profile Forms -->
          <div class="col-md-8">
            <!-- Personal Information -->
            <div class="card col-sm-8">
              <div class="card-header bg-info">
                <h5 class="mb-0 text-white">
                  <i class="fas fa-user-edit"></i> Informations Personnelles
                </h5>
              </div>
              <div class="card-body">
                <form method="POST" >
                  @csrf
                  @method('PUT')
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="{{ auth()->user()->name ?? '' }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="email" class="form-label">Adresse Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ auth()->user()->email ?? '' }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-info">
                      <i class="fas fa-save"></i> Mettre à jour les informations
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Change Password -->
          

            <!-- Account Settings -->
        
    
          </div  class="col-md-8">

           <div class="card col-sm-8">
              <div class="card-header bg-warning">
                <h5 class="mb-0 text-white">
                  <i class="fas fa-lock"></i> Changer le Mot de Passe
                </h5>
              </div>
              <div class="card-body">
                <form method="POST" >
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label for="current_password" class="form-label">Mot de passe actuel</label>
                    <div class="input-group">
                      <input type="password" class="form-control" id="current_password" name="current_password" required>
                      <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                        <i class="fas fa-eye" id="current_password_icon"></i>
                      </button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="new_password" class="form-label">Nouveau mot de passe</label>
                        <div class="input-group">
                          <input type="password" class="form-control" id="new_password" name="new_password" required>
                          <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                            <i class="fas fa-eye" id="new_password_icon"></i>
                          </button>
                        </div>
                        <small class="text-muted">Minimum 8 caractères</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                        <div class="input-group">
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                          <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password')">
                            <i class="fas fa-eye" id="confirm_password_icon"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-end">
                    <button type="submit" class="btn btn-warning">
                      <i class="fas fa-key"></i> Changer le mot de passe
                    </button>
                  </div>
                </form>
              </div>
            </div>

         <div>A

            
         </div>

          
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Success/Error Modal -->
    <div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sessionModalLabel">
                        {{ session('status') === 'success' ? 'Succès' : 'Erreur' }}
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
  // Profile picture preview and upload
  document.getElementById('profilePicture').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('profilePreview').src = e.target.result;
        document.getElementById('saveImageBtn').style.display = 'inline-block';
      }
      reader.readAsDataURL(file);
    }
  });

  // Toggle password visibility
  function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + '_icon');
    
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }

  // Password confirmation validation
  document.getElementById('confirm_password').addEventListener('input', function() {
    const newPassword = document.getElementById('new_password').value;
    const confirmPassword = this.value;
    
    if (newPassword !== confirmPassword) {
      this.setCustomValidity('Les mots de passe ne correspondent pas');
    } else {
      this.setCustomValidity('');
    }
  });

  // Form submission with SweetAlert confirmation for password change
  document.querySelector('form[action*=""]').addEventListener('submit', function(e) {
    e.preventDefault();
    
    Swal.fire({
      title: 'Confirmer le changement',
      text: 'Êtes-vous sûr de vouloir changer votre mot de passe?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#ffc107',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Oui, changer!',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        this.submit();
      }
    });
  });

  // Auto-submit profile picture form when image is selected
  document.getElementById('profilePictureForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = document.getElementById('saveImageBtn');
    
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
    submitBtn.disabled = true;
    
    // Simulate form submission (replace with actual AJAX call)
    setTimeout(() => {
      Swal.fire({
        title: 'Succès!',
        text: 'Photo de profil mise à jour avec succès!',
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
      });
      
      submitBtn.style.display = 'none';
      submitBtn.innerHTML = '<i class="fas fa-save"></i> Enregistrer Photo';
      submitBtn.disabled = false;
    }, 1500);
  });
</script>
</body>
</html>