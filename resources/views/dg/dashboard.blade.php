<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FONEA | <?php echo Auth::user()->Direction->libelle ?> </title>
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

  <style>
    .kpi-card {
      background: linear-gradient(135deg, #5beb92 0%, rgb(216, 223, 167) 100%);
      border: none;
      border-radius: 15px;
      color: white;
      transition: transform 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .kpi-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    
    .kpi-number {
      font-size: 2.5rem;
      font-weight: bold;
      margin-bottom: 0;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }
    
    .kpi-label {
      font-size: 0.9rem;
      opacity: 0.95;
      font-weight: 500;
    }
    
    .program-card {
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
    }
    
    .program-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .single-card-container {
      display: flex;
      justify-content: center;
    }
    
    .activity-metrics-card {
      background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      border: none;
      border-radius: 15px;
      color: white;
      margin-top: 30px;
    }
    
    .activity-kpi {
      background: rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .completion-progress {
      height: 8px;
      border-radius: 4px;
      background: rgba(255, 255, 255, 0.3);
      overflow: hidden;
      margin-top: 8px;
    }
    
    .completion-progress-bar {
      height: 100%;
      background: linear-gradient(90deg, #4CAF50, #81C784);
      transition: width 0.3s ease;
      border-radius: 4px;
    }
    
    .activity-status {
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 0.75rem;
      font-weight: 500;
      display: inline-block;
    }
    
    .status-completed {
      background: #4CAF50;
      color: white;
    }
    
    .status-planned {
      background: #FF9800;
      color: white;
    }
    
    .status-in-progress {
      background: #2196F3;
      color: white;
    }
    
    /* Card header improvements */
    .card-header {
      border-radius: 15px 15px 0 0 !important;
      font-weight: 600;
    }
    
    .card-header.text-success {
      background-color: #28a745;
      color: white !important;
    }
    
    .card-header.text-primary {
      background-color: #007bff;
      color: white !important;
    }
    
    .card-header.text-info {
      background-color: #17a2b8;
      color: white !important;
    }
    
    .card-header.text-warning {
      background-color: #ffc107;
      color: #212529 !important;
    }
    
    .card-header.text-dark {
      background-color: #343a40;
      color: white !important;
    }
    
    /* Table improvements */
    .table-responsive {
      border-radius: 8px;
      overflow: hidden;
    }
    
    .table th {
      background-color: #f8f9fa;
      font-weight: 600;
      border-top: none;
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(0,0,0,.02);
    }
    
    /* Activity tables specific styling */
    .activity-metrics-card .card {
      border: none;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .activity-metrics-card .table {
      margin-bottom: 0;
    }
    
    .activity-metrics-card .card-footer {
      background-color: #f8f9fa;
      border-top: 1px solid #dee2e6;
    }
    
    /* Responsive improvements */
    @media (max-width: 768px) {
      .kpi-number {
        font-size: 1.8rem;
      }
      
      .kpi-label {
        font-size: 0.8rem;
      }
      
      .single-card-container .col-md-8 {
        width: 100%;
      }
      
      .activity-kpi {
        margin-bottom: 15px;
      }
    }
    
    /* Badge improvements */
    .badge-success {
      background-color: #28a745;
      color: white;
      padding: 4px 8px;
      border-radius: 12px;
      font-size: 0.75rem;
    }
  </style>
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
              <h1>Tableau de Bord Statistique</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dg">Graphes Statistiques</a></li>
              <li class="breadcrumb-item active">Programmes FONEA</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <?php $userDirection = Auth::user()->Direction->code; ?>
        
        <!-- DE Direction Cards -->
        @if($userDirection == 'DE')
        <div class="row">
          <!-- Formation Qualifiante Card -->
          <div class="col-md-4">
            <div class="card program-card shadow-sm mb-4">
              <div class="card-header text-danger">
                  <h5 class="mb-0 text-center"><i class="fas fa-graduation-cap me-2"></i>Formation Qualifiante</h5>
              </div>
              <div class="card-body">
                  <!-- KPIs Row -->
                  <div class="row mb-3">
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ number_format($fq_data['total_formes'] ?? 0) }}</div>
                              <div class="kpi-label">Formés</div>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $fq_data['taux_insertion'] ?? 0 }}%</div>
                              <div class="kpi-label">Insertion</div>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $fq_data['nb_secteurs'] ?? 0 }}</div>
                              <div class="kpi-label">Secteurs</div>
                          </div>
                      </div>
                  </div>
                  <!-- DataTable -->
                  <div class="table-responsive">
                      <table id="fq-table" class="table table-bordered table-striped table-sm">
                          <thead>
                              <tr>
                                  <th>Secteur</th>
                                  <th>Formés</th>
                                  <th>Insérés</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if(isset($fq_details) && count($fq_details) > 0)
                                  @foreach($fq_details as $item)
                                  <tr>
                                      <td>{{ $item->secteur_nom ?? 'N/A' }}</td>
                                      <td>{{ number_format($item->total_formation ?? 0) }}</td>
                                      <td>{{ number_format($item->total_insertion ?? 0) }}</td>
                                  </tr>
                                  @endforeach
                              @else
                                  <tr><td colspan="3" class="text-center">Aucune donnée disponible</td></tr>
                              @endif
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>

          <!-- Formation Continue Card -->
          <div class="col-md-4">
            <div class="card program-card shadow-sm mb-4">
              <div class="card-header text-primary">
                  <h5 class="mb-0 text-center"><i class="fas fa-book-open me-2"></i>Formation Continue</h5>
              </div>
              <div class="card-body">
                  <!-- KPIs Row -->
                  <div class="row mb-3">
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ number_format($fc_data['total_participants'] ?? 0) }}</div>
                              <div class="kpi-label">Participants</div>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $fc_data['entreprises'] ?? 0 }}</div>
                              <div class="kpi-label">Entreprises</div>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $fc_data['taux'] ?? 0 }}</div>
                              <div class="kpi-label">Taux/Ent.</div>
                          </div>
                      </div>
                  </div>
                  <!-- DataTable -->
                  <div class="table-responsive">
                      <table id="fc-table" class="table table-bordered table-striped table-sm">
                          <thead>
                              <tr>
                                  <th>Qualification</th>
                                  <th>Développés</th>
                                  <th>Prévus</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if(isset($fc_details) && count($fc_details) > 0)
                                  @foreach($fc_details as $item)
                                  <tr>
                                      <td>{{ $item->qualification_nom ?? 'N/A' }}</td>
                                      <td>{{ number_format($item->total_participants ?? 0) }}</td>
                                      <td>{{ number_format($item->total_prevus ?? 0) }}</td>
                                  </tr>
                                  @endforeach
                              @else
                                  <tr><td colspan="3" class="text-center">Aucune donnée disponible</td></tr>
                              @endif
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>

          <!-- Programme Emploi Diplômé Card -->
          <div class="col-md-4">
            <div class="card program-card shadow-sm mb-4">
              <div class="card-header text-info">
                  <h5 class="mb-0 text-center"><i class="fas fa-user-graduate me-2"></i>Programme Emploi Diplômé</h5>
              </div>
              <div class="card-body">
                  <!-- KPIs Row -->
                  <div class="row mb-3">
                      <div class="col-6">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ number_format($ped_data['total_placements'] ?? 0) }}</div>
                              <div class="kpi-label">Placements</div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $ped_data['taux_reussite'] ?? 0 }}%</div>
                              <div class="kpi-label">Taux</div>
                          </div>
                      </div>
                  </div>
                  <!-- DataTable -->
                  <div class="table-responsive">
                      <table id="ped-table" class="table table-bordered table-striped table-sm">
                          <thead>
                              <tr>
                                  <th>Département</th>
                                  <th>Placements</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if(isset($ped_details) && count($ped_details) > 0)
                                  @foreach($ped_details as $item)
                                  <tr>
                                      <td>{{ $item->departement ?? 'N/A' }}</td>
                                      <td>{{ number_format($item->total_placements ?? 0) }}</td>
                                  </tr>
                                  @endforeach
                              @else
                                  <tr><td colspan="2" class="text-center">Aucune donnée disponible</td></tr>
                              @endif
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
        @endif

        <!-- DA Direction Card -->
        @if($userDirection == 'DA')
        <div class="row">
          <div class="single-card-container col-12">
            <div class="col-md-8">
              <div class="card program-card shadow-sm mb-4">
                <div class="card-header text-warning">
                    <h5 class="mb-0 text-center"><i class="fas fa-tools me-2"></i>Apprentissage des Métiers</h5>
                </div>
                <div class="card-body">
                    <!-- KPIs Row -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <div class="card kpi-card text-center p-2">
                                <div class="kpi-number">{{ number_format($am_data['total_apprentis'] ?? 0) }}</div>
                                <div class="kpi-label">Apprentis</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card kpi-card text-center p-2">
                                <div class="kpi-number">{{ $am_data['nb_metiers'] ?? 0 }}</div>
                                <div class="kpi-label">Métiers</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card kpi-card text-center p-2">
                                <div class="kpi-number">{{ $am_data['taux_reussite'] ?? 0 }}%</div>
                                <div class="kpi-label">Réussite</div>
                            </div>
                        </div>
                    </div>
                    <!-- DataTable -->
                    <div class="table-responsive">
                        <table id="am-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Qualification</th>
                                    <th>Formations</th>
                                    <th>Insertions</th>
                                    <th>Taux Réussite</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($am_details) && count($am_details) > 0)
                                    @foreach($am_details as $item)
                                    <tr>
                                        <td>{{ $item->qualification_nom ?? 'N/A' }}</td>
                                        <td>{{ number_format($item->total_formation ?? 0) }}</td>
                                        <td>{{ number_format($item->total_insertion ?? 0) }}</td>
                                        <td>{{ $item->taux_reussite ?? 0 }}%</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="4" class="text-center">Aucune donnée disponible</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif

        <!-- DEAP Direction Cards -->
        @if($userDirection == 'DEAP')
        <div class="row">
          <!-- Techniques de Développement Entrepreneuriat Card -->
          <div class="col-md-4">
            <div class="card program-card shadow-sm mb-4">
              <div class="card-header text-success">
                  <h5 class="mb-0 text-center"><i class="fas fa-book me-2"></i>Formations Entrepreneuriales</h5>
              </div>
              <div class="card-body">
                  <!-- KPIs Row -->
                  <div class="row mb-3">
                     <div class="col-6">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $tde_data['total_formation'] ?? 0 }}</div>
                              <div class="kpi-label">Formés</div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $tde_data['distinct_secteurs'] ?? 0 }}</div>
                              <div class="kpi-label">Secteurs</div>
                          </div>
                      </div>
                  </div>
                  <!-- DataTable -->
                  <div class="table-responsive">
                      <table id="tde-table" class="table table-bordered table-striped table-sm">
                          <thead>
                              <tr>
                                  <th>Secteur</th>
                                  <th>Formations</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if(isset($tde_details) && count($tde_details) > 0)
                                  @foreach($tde_details as $item)
                                  <tr>
                                      <td>{{ $item->secteur_nom ?? 'N/A' }}</td>
                                      <td>{{ number_format($item->total_formation ?? 0) }}</td>
                                  </tr>
                                  @endforeach
                              @else
                                  <tr><td colspan="2" class="text-center">Aucune donnée disponible</td></tr>
                              @endif
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>

          <!-- Idées de Projets Card -->
          <div class="col-md-4">
            <div class="card program-card shadow-sm mb-4">
              <div class="card-header text-success">
                  <h5 class="mb-0 text-center"><i class="fas fa-lightbulb me-2"></i>Porteurs d'Idées de Projets</h5>
              </div>
              <div class="card-body">
                  <!-- KPIs Row -->
                  <div class="row mb-3">
                      <div class="col-6">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $ip_data['total_idees'] ?? 0 }}</div>
                              <div class="kpi-label">Idées</div>
                          </div>
                      </div>
                      <div class="col-6">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $ip_data['nb_secteurs'] ?? 0 }}</div>
                              <div class="kpi-label">Secteurs</div>
                          </div>
                      </div>
                  </div>
                  <!-- DataTable -->
                  <div class="table-responsive">
                      <table id="ip-table" class="table table-bordered table-striped table-sm">
                          <thead>
                              <tr>
                                  <th>Secteur</th>
                                  <th>Idées</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if(isset($ip_details) && count($ip_details) > 0)
                                  @foreach($ip_details as $item)
                                  <tr>
                                      <td>{{ $item->secteur_nom ?? 'N/A' }}</td>
                                      <td>{{ $item->nb_idees ?? 0 }}</td>
                                  </tr>
                                  @endforeach
                              @else
                                  <tr><td colspan="2" class="text-center">Aucune donnée disponible</td></tr>
                              @endif
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>

          <!-- Financement Card -->
          <div class="col-md-4">
            <div class="card program-card shadow-sm mb-4">
              <div class="card-header text-success">
                  <h5 class="mb-0 text-center"><i class="fas fa-coins me-2"></i>Financement</h5>
              </div>
              <div class="card-body">
                  <!-- KPIs Row -->
                  <div class="row mb-3">
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ number_format($fin_data['total_financements'] ?? 0) }}</div>
                              <div class="kpi-label">Financements</div>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ number_format($fin_data['total_emploi_crees'] ?? 0) }}</div>
                              <div class="kpi-label">Emplois Créés</div>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="card kpi-card text-center p-2">
                              <div class="kpi-number">{{ $fin_data['rendement'] ?? 0 }}%</div>
                              <div class="kpi-label">Rendement</div>
                          </div>
                      </div>
                  </div>
                  <!-- DataTable -->
                  <div class="table-responsive">
                      <table id="fin-table" class="table table-bordered table-striped table-sm">
                          <thead>
                              <tr>
                                  <th>Financements</th>
                                  <th>Emplois Créés</th>
                                  <th>Secteur</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if(isset($fin_details) && count($fin_details) > 0)
                                  @foreach($fin_details as $item)
                                  <tr>
                                      <td>{{ $item->tranche_montant ?? 'N/A' }}</td>
                                      <td>{{ number_format($item->emplois_crees ?? 0) }}</td>
                                      <td>{{ $item->secteur ?? 'N/A' }}</td>
                                  </tr>
                                  @endforeach
                              @else
                                  <tr><td colspan="3" class="text-center">Aucune donnée disponible</td></tr>
                              @endif
                          </tbody>
                      </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
        @endif

         @if(isset($activities))
      <!-- Single Unified Activities Table -->
<!-- Tabbed Activities Interface -->
<div class="col-12">
  <div class="card activity-metrics-card shadow-lg">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-3 text-center">
        <i class="fas fa-chart-line me-2"></i>
        Suivi des Activités {{ date('Y') }} - {{ Auth::user()->Direction->libelle }}
      </h4>
      <ul class="nav nav-tabs card-header-tabs justify-content-center" id="activitiesTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active text-white bg-transparent border-light" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-activities" type="button" role="tab">
            <i class="fas fa-list me-2"></i>Toutes ({{ count($activities['activities_planned']) + count($activities['activities_completed']) }})
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link text-white bg-transparent border-light" id="planned-tab" data-bs-toggle="tab" data-bs-target="#planned-activities" type="button" role="tab">
            <i class="fas fa-calendar-plus me-2"></i>Planifiées ({{ count($activities['activities_planned']) }})
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link text-white bg-transparent border-light" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed-activities" type="button" role="tab">
            <i class="fas fa-check-circle me-2"></i>Réalisées ({{ count($activities['activities_completed']) }})
          </button>
        </li>
      </ul>
    </div>
    <div class="card-body p-0">
      <div class="tab-content" id="activitiesTabContent">
        <!-- All Activities Tab -->
        <div class="tab-pane fade show active" id="all-activities" role="tabpanel">
          <div class="table-responsive">
            <table class="table table-sm table-striped mb-0">
              <thead class="table-dark">
                <tr>
                  <th class="text-info"><i class="fas fa-tasks me-1"></i> Activité</th>
                  <th class="text-info"><i class="fas fa-money-bill me-1"></i> Budget (XAF)</th>
                
                  <th class="text-info"><i class="fas fa-percentage me-1"></i> Taux (%)</th>
                  <th class="text-info"><i class="fas fa-info-circle me-1"></i> Statut</th>
                </tr>
              </thead>
              <tbody>
                <!-- Planned Activities -->
                @if(isset($activities['activities_planned']) && count($activities['activities_planned']) > 0)
                  @foreach($activities['activities_planned'] as $activity)
                  <tr class="bg-warning bg-opacity-10">
                    <td class="fw-semibold">{{ $activity->libelle }}</td>
                    <td class="text-primary fw-bold">{{ number_format($activity->mtb) }}</td>
                  
                    <td class="text-muted">{{ $activity->taux }}%</td>
                     <td>
                     <span class="badge px-3 py-1 
    {{ $activity->planned_statut == 0 ? 'bg-danger' : 'bg-success' }}">
    <i class="fas fa-check me-1"></i>
    {{ $activity->planned_statut == 0 ? 'En attente' : 'Exécuté' }}
</span>

                    </td>
                  </tr>
                  @endforeach
                @endif

                <!-- Completed Activities -->
                @if(isset($activities['activities_completed']) && count($activities['activities_completed']) > 0)
                  @foreach($activities['activities_completed'] as $activity)
                  <tr class="bg-dark bg-opacity-10">
                    <td class="fw-semibold">{{ $activity->libelle }}</td>
                    <td class="text-muted">-</td>
                   
                    <td class="text-success">100%</td>
                    <td>
                      <span class="badge bg-success px-3 py-1">
                        <i class="fas fa-check me-1"></i>{{ ucfirst($activity->statut_budget) }}
                      </span>
                    </td>
                  </tr>
                  @endforeach
                @endif

                @if((empty($activities['activities_planned']) || count($activities['activities_planned']) == 0) && 
                   (empty($activities['activities_completed']) || count($activities['activities_completed']) == 0))
                  <tr><td colspan="5" class="text-center text-muted py-4">Aucune activité trouvée</td></tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        
        <!-- Planned Activities Tab -->
        <div class="tab-pane fade" id="planned-activities" role="tabpanel">
          <div class="table-responsive">
            <table class="table table-sm table-striped mb-0">
              <thead class="table-dark">
                <tr>
                  <th class="text-white"><i class="fas fa-tasks me-1"></i>Activité</th>
                  <th class="text-white"><i class="fas fa-money-bill me-1"></i>Budget (XAF)</th>
                  <th class="text-white"><i class="fas fa-percentage me-1"></i>Taux (%)</th>
                  <th class="text-white"><i class="fas fa-info-circle me-1"></i>Statut</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($activities['activities_planned']) && count($activities['activities_planned']) > 0)
                  @foreach($activities['activities_planned'] as $activity)
                  <tr class="bg-warning bg-opacity-10">
                    <td class="fw-semibold">{{ $activity->libelle }}</td>
                    <td class="text-primary fw-bold">{{ number_format($activity->mtb) }}</td>
                    <td class="text-info fw-semibold">{{ $activity->taux }}%</td>
                    <td>
                      <span class="badge bg-warning text-dark px-3 py-1">
                        <i class="fas fa-clock me-1"></i>{{ ucfirst($activity->planned_statut) }}
                      </span>
                    </td>
                  </tr>
                  @endforeach
                @else
                  <tr><td colspan="4" class="text-center text-muted py-4">Aucune activité planifiée</td></tr>
                @endif
              </tbody>
            </table>
          </div>
          @if(isset($activities['activities_planned']) && count($activities['activities_planned']) > 0)
          <div class="card-footer bg-light">
            <small class="text-muted">
              <i class="fas fa-calculator me-1"></i>
              <strong>Budget Total Planifié:</strong> 
              <span class="text-primary fw-bold">
                {{ number_format(collect($activities['activities_planned'])->sum('mtb')) }} XAF
              </span>
            </small>
          </div>
          @endif
        </div>
        
        <!-- Completed Activities Tab -->
        <div class="tab-pane fade" id="completed-activities" role="tabpanel">
          <div class="table-responsive">
            <table class="table table-sm table-striped mb-0">
              <thead class="table-dark">
                <tr>
                  <th class="text-white"><i class="fas fa-tasks me-1"></i>Activité</th>
                  <th class="text-white"><i class="fas fa-info-circle me-1"></i>Statut Budget</th>
                  <th class="text-white"><i class="fas fa-check-circle me-1"></i>État</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($activities['activities_completed']) && count($activities['activities_completed']) > 0)
                  @foreach($activities['activities_completed'] as $activity)
                  <tr class="bg-success bg-opacity-10">
                    <td class="fw-semibold">{{ $activity->libelle }}</td>
                    <td>
                      <span class="badge 
                        @if($activity->statut_budget == 'realise') bg-success
                        @elseif($activity->statut_budget == 'partiel') bg-warning text-dark
                        @else bg-secondary
                        @endif
                        px-2 py-1">
                        {{ ucfirst($activity->statut_budget) }}
                      </span>
                    </td>
                    <td>
                      <span class="badge bg-success px-3 py-1">
                        <i class="fas fa-check me-1"></i>Réalisée
                      </span>
                    </td>
                  </tr>
                  @endforeach
                @else
                  <tr><td colspan="3" class="text-center text-muted py-4">Aucune activité réalisée</td></tr>
                @endif
              </tbody>
            </table>
          </div>
          @if(isset($activities['activities_completed']) && count($activities['activities_completed']) > 0)
          <div class="card-footer bg-light">
            <small class="text-muted">
              <i class="fas fa-check-circle me-1"></i>
              <strong>Activités Terminées:</strong> 
              <span class="text-success fw-bold">{{ count($activities['activities_completed']) }} activité(s)</span>
            </small>
          </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Overall Summary Footer -->
    <div class="card-footer bg-light border-top">
      <div class="row text-center">
        <div class="col-md-4">
          <div class="d-flex align-items-center justify-content-center">
            <i class="fas fa-calendar-plus text-warning me-2"></i>
            <small class="text-muted">
              <strong>Total Planifiées:</strong><br>
              <span class="text-primary fs-6 fw-bold">{{ count($activities['activities_planned'] ?? []) }} activité(s)</span>
            </small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center justify-content-center">
            <i class="fas fa-check-circle text-success me-2"></i>
            <small class="text-muted">
              <strong>Total Réalisées:</strong><br>
              <span class="text-success fs-6 fw-bold">{{ count($activities['activities_completed'] ?? []) }} activité(s)</span>
            </small>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center justify-content-center">
            <i class="fas fa-chart-pie text-info me-2"></i>
            <small class="text-muted">
              <strong>Taux de Réalisation:</strong><br>
              @php
                $totalPlanned = count($activities['activities_planned'] ?? []);
                $totalCompleted = count($activities['activities_completed'] ?? []);
                $completionRate = $totalPlanned > 0 ? round(($totalCompleted / $totalPlanned) * 100, 1) : 0;
              @endphp
              <span class="text-info fs-6 fw-bold">{{ $completionRate }}%</span>
            </small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Custom tab styling for better visibility on blue background */
.nav-tabs .nav-link.active {
  background-color: rgba(255, 255, 255, 0.2) !important;
  border-color: rgba(255, 255, 255, 0.3) !important;
  color: white !important;
  font-weight: bold;
}

.nav-tabs .nav-link:hover {
  background-color: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.2);
}
</style>
        @endif

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

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
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
  $(function () {
    // Initialize DataTables for all tables
    $("#fq-table, #fc-table, #ped-table, #am-table, #tde-table, #ip-table, #fin-table, #planned-activities-table, #completed-activities-table").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "pageLength": 5,
      "searching": false,
      "info": false,
      "paging": false,
      "ordering": true,
      "language": {
        "emptyTable": "Aucune donnée disponible",
        "zeroRecords": "Aucun résultat trouvé"
      }
    });

    // Add smooth scrolling for better UX
    $('html, body').css({
      'scroll-behavior': 'smooth'
    });

    // Initialize tooltips if needed
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

</body>
</html>