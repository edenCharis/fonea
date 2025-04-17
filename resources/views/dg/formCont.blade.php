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
          <h4 class="text-success">  Statistiques d'employabilité via Formation Continue </h4>
             
              </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dg">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">DG</li>
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
             
              <!-- /.card-header -->
              <div class="card-body">
                <form>
                  <div class="row">
                  

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Année</label>
                        <select class="custom-select" name="annee_id">
                          <option selected value=""></option>
                          @foreach ($annees as $a )
                            <option value="{{ $a->id }}">{{ $a->libelle}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                        <label>Trimestre</label>
                        <select class="custom-select" name="trimestre_id">
                          <option selected value=""></option>
                          @foreach ($trimestres as $a )
                            <option value="{{ $a->id }}">{{ $a->libelle}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- Select multiple-->
                      <div class="form-group">
                        <label>Secteur d'activités</label>
                        <select multiple class="custom-select" name="secteurs[]">
                         
                          @foreach ($secteurs as $a )
                            <option value="{{ $a->id }}">{{ $a->libelle}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Compétences</label>
                        <select multiple class="custom-select" name="competences[]"  >
                        @foreach ($competences as $a )
                            <option value="{{ $a->id }}">{{ $a->libelle}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add2">
  <i class="fas fa-search"></i>
Appliquer </button>
                    </div>
                  </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
           <!-- #region -->

           <div class="card">
           <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    
                    <th>Secteur</th>
                    <th>Qualification / Groupe de compétences</th>
                    <th>Poste</th>
                    <th>Entreprises prises en charges</th>
                    <th>Employés formés</th>
         
                    <th>Période</th>
                  
               
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $d)  
                     <tr>
                       <td> {{ $d->secteur->libelle }}</td>
                       <td> {{ $d->qualification->libelle }}</td>
                       <td> {{ $d->poste }}</td>
                   
                       <td> {{ $d->entreprise }}</td>
                       <td> {{ $d->total_employes }}</td>
                    
                       <td> {{ $d->trimestre->libelle."-".$d->trimestre->annee->libelle }}</td>
                     </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>

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


     @include("dg.footer")
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,"searching":false,
      "buttons": [ "csv", "excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>

</body>
</html>
