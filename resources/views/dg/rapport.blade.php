<!DOCTYPE html>
<html lang="fr">
<head>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FONEA |<?php echo Auth::user()->Direction->libelle ?></title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
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
   
  <style>
    :root {
      --fonea-blue: #2c5aa0;
      --fonea-blue-dark: #1e4080;
      --fonea-green: #28a745;
      --fonea-orange: #ffc107;
      --fonea-red: #dc3545;
      --light-bg: #f8f9fc;
    }

    body {
      font-family: 'Source Sans Pro', sans-serif;
      background-color: var(--light-bg);
    }

    /* Executive Summary Cards */
    .executive-summary {
      margin-bottom: 2rem;
    }

    .summary-card {
      background: linear-gradient(135deg, var(--fonea-blue) 0%, var(--fonea-blue-dark) 100%);
      color: white;
      border-radius: 15px;
      padding: 2rem;
      text-align: center;
      transition: transform 0.3s ease;
      box-shadow: 0 8px 25px rgba(44, 90, 160, 0.2);
    }

    .summary-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 35px rgba(44, 90, 160, 0.3);
    }

    .summary-number {
      font-size: 3rem;
      font-weight: bold;
      margin-bottom: 0.5rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .summary-label {
      font-size: 1.1rem;
      opacity: 0.9;
      font-weight: 500;
    }

    /* Filter Section */
    .filter-section {
      background: white;
      border-radius: 15px;
      padding: 1.5rem;
      margin-bottom: 2rem;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .filter-title {
      color: var(--fonea-blue);
      font-weight: 600;
      margin-bottom: 1rem;
      font-size: 1.1rem;
    }

    /* Direction Cards */
    .direction-card {
      background: white;
      border-radius: 15px;
      margin-bottom: 2rem;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .direction-header {
      padding: 1.5rem;
      text-align: center;
      font-size: 1.3rem;
      font-weight: 700;
      color: white;
    }

    .direction-header.de { background: linear-gradient(135deg, #dc3545, #c82333); }
    .direction-header.da { background: linear-gradient(135deg, #ffc107, #e0a800); color: #212529 !important; }
    .direction-header.deap { background: linear-gradient(135deg, #28a745, #1e7e34); }

    /* KPI Cards */
    .kpi-card {
      background: linear-gradient(135deg, #5beb92 0%, rgb(216, 223, 167) 100%);
      border: none;
      border-radius: 12px;
      color: white;
      transition: transform 0.3s ease;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      text-align: center;
      padding: 1rem;
      margin-bottom: 1rem;
    }

    .kpi-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .kpi-number {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 0.2rem;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .kpi-label {
      font-size: 0.8rem;
      opacity: 0.95;
      font-weight: 500;
    }

    /* Program Cards */
    .program-card {
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      border: none;
      margin-bottom: 1rem;
    }

    .program-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .program-card-header {
      font-weight: 600;
      padding: 1rem;
      border-radius: 12px 12px 0 0;
      text-align: center;
    }

    .program-card-header.de-fq { background-color: var(--fonea-red); color: white; }
    .program-card-header.de-fc { background-color: var(--fonea-blue); color: white; }
    .program-card-header.de-ped { background-color: #17a2b8; color: white; }
    .program-card-header.da-am { background-color: var(--fonea-orange); color: #212529; }
    .program-card-header.deap { background-color: var(--fonea-green); color: white; }

    /* Activities Section */
    .activities-section {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      margin-top: 2rem;
      overflow: hidden;
    }

    .activities-header {
      background: linear-gradient(135deg, var(--fonea-blue) 0%, var(--fonea-blue-dark) 100%);
      color: white;
      padding: 1.5rem;
      text-align: center;
    }

    .nav-tabs .nav-link {
      border: none;
      color: rgba(255,255,255,0.8);
      background: transparent;
      font-weight: 500;
    }

    .nav-tabs .nav-link.active {
      background-color: rgba(255, 255, 255, 0.2);
      color: white;
      font-weight: bold;
      border-radius: 10px 10px 0 0;
    }

    .nav-tabs .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border: none;
    }

    /* Table Styling */
    .table {
      margin-bottom: 0;
      font-size: 0.9rem;
    }

    .table th {
      background-color: #f8f9fa;
      font-weight: 600;
      border-top: none;
      font-size: 0.85rem;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(0,0,0,.02);
    }

    .badge {
      font-size: 0.75rem;
      padding: 0.4rem 0.8rem;
      border-radius: 12px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .summary-number {
        font-size: 2rem;
      }
      
      .kpi-number {
        font-size: 1.5rem;
      }
      
      .kpi-label {
        font-size: 0.7rem;
      }
    }

    /* Print Styles */
    @media print {
      .filter-section,
      .btn {
        display: none !important;
      }
      
      body {
        background: white !important;
      }
    }

    /* Loading animation */
    .loading-spinner {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 9999;
    }

    .spinner-border {
      color: var(--fonea-blue);
    }

    /* Fade animation */
    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

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

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard Exécutif FONEA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Filter Section -->
        <div class="filter-section">
          <div class="filter-title">
            <i class="fas fa-filter me-2"></i>
            Filtres de Période
          </div>
          
          <form id="dashboardForm">
            <div class="row g-3">
              <div class="col-md-3">
                <label for="reportType" class="form-label">Type de Période</label>
                <select class="form-select" id="reportType" required>
                  <option value="">Sélectionner...</option>
                  <option value="trimestre">Trimestriel</option>
                  <option value="annee">Annuel</option>
                </select>
              </div>
              
              <div class="col-md-3">
                <label for="annee" class="form-label">Année</label>
                <select class="form-select" id="annee" required>
                  <option value="">Sélectionner une année...</option>
                  <option value="2024">2024</option>
                  <option value="2023">2023</option>
                  <option value="2022">2022</option>
                </select>
              </div>
              
              <div class="col-md-3" id="trimestreSelect" style="display: none;">
                <label for="trimestre" class="form-label">Trimestre</label>
                <select class="form-select" id="trimestre">
                  <option value="">Sélectionner un trimestre...</option>
                  <option value="T1">1er Trimestre</option>
                  <option value="T2">2ème Trimestre</option>
                  <option value="T3">3ème Trimestre</option>
                  <option value="T4">4ème Trimestre</option>
                </select>
              </div>

              <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                  <i class="fas fa-sync-alt me-2"></i>
                  Actualiser
                </button>
                <button type="button" class="btn btn-success" onclick="window.print()">
                  <i class="fas fa-print me-2"></i>
                  Imprimer
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Loading Spinner -->
        <div class="loading-spinner">
          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Chargement...</span>
          </div>
        </div>

        <!-- Dashboard Content -->
        <div id="dashboardContent" style="display: none;">
          
          <!-- Executive Summary -->
          <div class="executive-summary">
            <div class="row">
              <div class="col-md-3">
                <div class="summary-card">
                  <div class="summary-number" id="totalBeneficiaires">3,429</div>
                  <div class="summary-label">Bénéficiaires Totaux</div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="summary-card">
                  <div class="summary-number" id="totalEmplois">1,254</div>
                  <div class="summary-label">Emplois Créés</div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="summary-card">
                  <div class="summary-number" id="tauxInsertion">72%</div>
                  <div class="summary-label">Taux d'Insertion Global</div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="summary-card">
                  <div class="summary-number" id="budgetExecution">85%</div>
                  <div class="summary-label">Exécution Budgétaire</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Direction de l'Emploi (DE) -->
          <div class="direction-card fade-in">
            <div class="direction-header de">
              <i class="fas fa-briefcase me-2"></i>
              Direction de l'Emploi (DE)
            </div>
            <div class="card-body p-3">
              <div class="row">
                <!-- Formation Qualifiante -->
                <div class="col-md-4">
                  <div class="program-card">
                    <div class="program-card-header de-fq">
                      <i class="fas fa-graduation-cap me-2"></i>Formation Qualifiante
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fq-formes">1,247</div>
                            <div class="kpi-label">Formés</div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fq-insertion">75%</div>
                            <div class="kpi-label">Insertion</div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fq-secteurs">12</div>
                            <div class="kpi-label">Secteurs</div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive mt-3">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Secteur</th>
                              <th>Formés</th>
                              <th>Insérés</th>
                            </tr>
                          </thead>
                          <tbody id="fq-table-body">
                            <tr><td>Agriculture</td><td>234</td><td>187</td></tr>
                            <tr><td>BTP</td><td>189</td><td>156</td></tr>
                            <tr><td>Mécanique</td><td>156</td><td>134</td></tr>
                            <tr><td>Informatique</td><td>145</td><td>128</td></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Formation Continue -->
                <div class="col-md-4">
                  <div class="program-card">
                    <div class="program-card-header de-fc">
                      <i class="fas fa-book-open me-2"></i>Formation Continue
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fc-participants">892</div>
                            <div class="kpi-label">Participants</div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fc-entreprises">45</div>
                            <div class="kpi-label">Entreprises</div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fc-taux">20</div>
                            <div class="kpi-label">Taux/Ent.</div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive mt-3">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Qualification</th>
                              <th>Développés</th>
                              <th>Prévus</th>
                            </tr>
                          </thead>
                          <tbody id="fc-table-body">
                            <tr><td>Management</td><td>156</td><td>180</td></tr>
                            <tr><td>Marketing</td><td>134</td><td>150</td></tr>
                            <tr><td>Comptabilité</td><td>123</td><td>140</td></tr>
                            <tr><td>Informatique</td><td>89</td><td>100</td></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Programme Emploi Diplômé -->
                <div class="col-md-4">
                  <div class="program-card">
                    <div class="program-card-header de-ped">
                      <i class="fas fa-user-graduate me-2"></i>Programme Emploi Diplômé
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="kpi-card">
                            <div class="kpi-number" id="ped-placements">456</div>
                            <div class="kpi-label">Placements</div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="kpi-card">
                            <div class="kpi-number" id="ped-taux">68%</div>
                            <div class="kpi-label">Taux</div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive mt-3">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Département</th>
                              <th>Placements</th>
                            </tr>
                          </thead>
                          <tbody id="ped-table-body">
                            <tr><td>Brazzaville</td><td>156</td></tr>
                            <tr><td>Pointe-Noire</td><td>123</td></tr>
                            <tr><td>Kouilou</td><td>89</td></tr>
                            <tr><td>Niari</td><td>88</td></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Direction de l'Apprentissage (DA) -->
          <div class="direction-card fade-in">
            <div class="direction-header da">
              <i class="fas fa-tools me-2"></i>
              Direction de l'Apprentissage (DA)
            </div>
            <div class="card-body p-3">
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="program-card">
                    <div class="program-card-header da-am">
                      <i class="fas fa-hammer me-2"></i>Apprentissage des Métiers
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="am-apprentis">834</div>
                            <div class="kpi-label">Apprentis</div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="am-metiers">15</div>
                            <div class="kpi-label">Métiers</div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="am-reussite">82%</div>
                            <div class="kpi-label">Réussite</div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive mt-3">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Qualification</th>
                              <th>Formations</th>
                              <th>Insertions</th>
                              <th>Taux Réussite</th>
                            </tr>
                          </thead>
                          <tbody id="am-table-body">
                            <tr><td>Maçonnerie</td><td>156</td><td>134</td><td>86%</td></tr>
                            <tr><td>Plomberie</td><td>123</td><td>98</td><td>80%</td></tr>
                            <tr><td>Électricité</td><td>134</td><td>112</td><td>84%</td></tr>
                            <tr><td>Menuiserie</td><td>89</td><td>76</td><td>85%</td></tr>
                            <tr><td>Mécanique Auto</td><td>98</td><td>82</td><td>84%</td></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Direction de l'Employabilité et de l'Autonomisation des Personnes (DEAP) -->
          <div class="direction-card fade-in">
            <div class="direction-header deap">
              <i class="fas fa-users me-2"></i>
              Direction de l'Employabilité et de l'Autonomisation des Personnes (DEAP)
            </div>
            <div class="card-body p-3">
              <div class="row">
                <!-- Formations Entrepreneuriales -->
                <div class="col-md-4">
                  <div class="program-card">
                    <div class="program-card-header deap">
                      <i class="fas fa-book me-2"></i>Formations Entrepreneuriales
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="kpi-card">
                            <div class="kpi-number" id="tde-formes">567</div>
                            <div class="kpi-label">Formés</div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="kpi-card">
                            <div class="kpi-number" id="tde-secteurs">8</div>
                            <div class="kpi-label">Secteurs</div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive mt-3">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Secteur</th>
                              <th>Formations</th>
                            </tr>
                          </thead>
                          <tbody id="tde-table-body">
                            <tr><td>Agriculture</td><td>145</td></tr>
                            <tr><td>Commerce</td><td>123</td></tr>
                            <tr><td>Artisanat</td><td>98</td></tr>
                            <tr><td>Services</td><td>87</td></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Porteurs d'Idées -->
                <div class="col-md-4">
                  <div class="program-card">
                    <div class="program-card-header deap">
                      <i class="fas fa-lightbulb me-2"></i>Porteurs d'Idées de Projets
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="kpi-card">
                            <div class="kpi-number" id="ip-idees">234</div>
                            <div class="kpi-label">Idées</div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="kpi-card">
                            <div class="kpi-number" id="ip-secteurs">6</div>
                            <div class="kpi-label">Secteurs</div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive mt-3">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Secteur</th>
                              <th>Idées</th>
                            </tr>
                          </thead>
                          <tbody id="ip-table-body">
                            <tr><td>Tech/Digital</td><td>67</td></tr>
                            <tr><td>Agriculture</td><td>56</td></tr>
                            <tr><td>Commerce</td><td>45</td></tr>
                            <tr><td>Artisanat</td><td>34</td></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Financement -->
                <div class="col-md-4">
                  <div class="program-card">
                    <div class="program-card-header deap">
                      <i class="fas fa-coins me-2"></i>Financement
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fin-financements">189</div>
                            <div class="kpi-label">Financements</div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fin-emplois">456</div>
                            <div class="kpi-label">Emplois Créés</div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="kpi-card">
                            <div class="kpi-number" id="fin-rendement">2.4</div>
                            <div class="kpi-label">Rendement</div>
                          </div>
                        </div>
                      </div>
                      <div class="table-responsive mt-3">
                        <table class="table table-striped table-sm">
                          <thead>
                            <tr>
                              <th>Tranche</th>
                              <th>Emplois</th>
                              <th>Secteur</th>
                            </tr>
                          </thead>
                          <tbody id="fin-table-body">
                            <tr><td>0-500K</td><td>123</td><td>Commerce</td></tr>
                            <tr><td>500K-1M</td><td>156</td><td>Agriculture</td></tr>
                            <tr><td>1M-2M</td><td>89</td><td>Artisanat</td></tr>
                            <tr><td>2M+</td><td>88</td><td>Services</td></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Section Activités Consolidées -->
          <div class="activities-section fade-in">
            <div class="activities-header">
              <h4 class="mb-3 text-center">
                <i class="fas fa-chart-line me-2"></i>
                Suivi des Activités <span id="activitiesYear">2024</span> - Toutes Directions
              </h4>
              <ul class="nav nav-tabs justify-content-center" id="activitiesTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="all-activities-tab" data-bs-toggle="tab" data-bs-target="#all-activities" type="button" role="tab">
                    <i class="fas fa-list me-2"></i>Toutes (24)
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="planned-activities-tab" data-bs-toggle="tab" data-bs-target="#planned-activities" type="button" role="tab">
                    <i class="fas fa-calendar-plus me-2"></i>Planifiées (15)
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="completed-activities-tab" data-bs-toggle="tab" data-bs-target="#completed-activities" type="button" role="tab">
                    <i class="fas fa-check-circle me-2"></i>Réalisées (9)
                  </button>
                </li>
              </ul>
            </div>
            <div class="card-body p-0">
              <div class="tab-content" id="activitiesTabContent">
                <!-- Toutes les Activités -->
                <div class="tab-pane fade show active" id="all-activities" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped mb-0">
                      <thead class="table-dark">
                        <tr>
                          <th><i class="fas fa-tasks me-1"></i>Activité</th>
                          <th><i class="fas fa-building me-1"></i>Direction</th>
                          <th><i class="fas fa-money-bill me-1"></i>Budget (XAF)</th>
                          <th><i class="fas fa-percentage me-1"></i>Taux (%)</th>
                          <th><i class="fas fa-info-circle me-1"></i>Statut</th>
                        </tr>
                      </thead>
                      <tbody id="all-activities-body">
                        <tr class="bg-warning bg-opacity-10">
                          <td>Formation des jeunes en Agriculture</td>
                          <td><span class="badge bg-danger">DE</span></td>
                          <td class="text-primary fw-bold">25,000,000</td>
                          <td>75%</td>
                          <td><span class="badge bg-warning text-dark">En cours</span></td>
                        </tr>
                        <tr class="bg-success bg-opacity-10">
                          <td>Programme d'apprentissage BTP</td>
                          <td><span class="badge bg-warning text-dark">DA</span></td>
                          <td class="text-muted">-</td>
                          <td class="text-success">100%</td>
                          <td><span class="badge bg-success">Réalisée</span></td>
                        </tr>
                        <tr class="bg-warning bg-opacity-10">
                          <td>Financement des micro-entreprises</td>
                          <td><span class="badge bg-success">DEAP</span></td>
                          <td class="text-primary fw-bold">45,000,000</td>
                          <td>60%</td>
                          <td><span class="badge bg-info">En attente</span></td>
                        </tr>
                        <tr class="bg-success bg-opacity-10">
                          <td>Formation continue en Management</td>
                          <td><span class="badge bg-danger">DE</span></td>
                          <td class="text-muted">-</td>
                          <td class="text-success">100%</td>
                          <td><span class="badge bg-success">Réalisée</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                
                <!-- Activités Planifiées -->
                <div class="tab-pane fade" id="planned-activities" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped mb-0">
                      <thead class="table-dark">
                        <tr>
                          <th><i class="fas fa-tasks me-1"></i>Activité</th>
                          <th><i class="fas fa-building me-1"></i>Direction</th>
                          <th><i class="fas fa-money-bill me-1"></i>Budget (XAF)</th>
                          <th><i class="fas fa-percentage me-1"></i>Taux (%)</th>
                          <th><i class="fas fa-info-circle me-1"></i>Statut</th>
                        </tr>
                      </thead>
                      <tbody id="planned-activities-body">
                        <tr>
                          <td>Formation des jeunes en Agriculture</td>
                          <td><span class="badge bg-danger">DE</span></td>
                          <td class="text-primary fw-bold">25,000,000</td>
                          <td>75%</td>
                          <td><span class="badge bg-warning text-dark">En cours</span></td>
                        </tr>
                        <tr>
                          <td>Financement des micro-entreprises</td>
                          <td><span class="badge bg-success">DEAP</span></td>
                          <td class="text-primary fw-bold">45,000,000</td>
                          <td>60%</td>
                          <td><span class="badge bg-info">En attente</span></td>
                        </tr>
                        <tr>
                          <td>Programme d'insertion professionnelle</td>
                          <td><span class="badge bg-warning text-dark">DA</span></td>
                          <td class="text-primary fw-bold">30,000,000</td>
                          <td>45%</td>
                          <td><span class="badge bg-warning text-dark">En cours</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer bg-light">
                    <small class="text-muted">
                      <i class="fas fa-calculator me-1"></i>
                      <strong>Budget Total Planifié:</strong> 
                      <span class="text-primary fw-bold">100,000,000 XAF</span>
                    </small>
                  </div>
                </div>
                
                <!-- Activités Réalisées -->
                <div class="tab-pane fade" id="completed-activities" role="tabpanel">
                  <div class="table-responsive">
                    <table class="table table-sm table-striped mb-0">
                      <thead class="table-dark">
                        <tr>
                          <th><i class="fas fa-tasks me-1"></i>Activité</th>
                          <th><i class="fas fa-building me-1"></i>Direction</th>
                          <th><i class="fas fa-info-circle me-1"></i>Statut Budget</th>
                          <th><i class="fas fa-check-circle me-1"></i>État</th>
                        </tr>
                      </thead>
                      <tbody id="completed-activities-body">
                        <tr>
                          <td>Programme d'apprentissage BTP</td>
                          <td><span class="badge bg-warning text-dark">DA</span></td>
                          <td><span class="badge bg-success">Réalisé</span></td>
                          <td><span class="badge bg-success">Terminée</span></td>
                        </tr>
                        <tr>
                          <td>Formation continue en Management</td>
                          <td><span class="badge bg-danger">DE</span></td>
                          <td><span class="badge bg-success">Réalisé</span></td>
                          <td><span class="badge bg-success">Terminée</span></td>
                        </tr>
                        <tr>
                          <td>Accompagnement entrepreneurial</td>
                          <td><span class="badge bg-success">DEAP</span></td>
                          <td><span class="badge bg-warning text-dark">Partiel</span></td>
                          <td><span class="badge bg-success">Terminée</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-footer bg-light">
                    <small class="text-muted">
                      <i class="fas fa-check-circle me-1"></i>
                      <strong>Activités Terminées:</strong> 
                      <span class="text-success fw-bold">9 activité(s)</span>
                    </small>
                  </div>
                </div>
              </div>
            </div>

            <!-- Résumé des Activités -->
            <div class="card-footer bg-light border-top">
              <div class="row text-center">
                <div class="col-md-4">
                  <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-calendar-plus text-warning me-2"></i>
                    <small class="text-muted">
                      <strong>Total Planifiées:</strong><br>
                      <span class="text-primary fs-6 fw-bold">15 activité(s)</span>
                    </small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-check-circle text-success me-2"></i>
                    <small class="text-muted">
                      <strong>Total Réalisées:</strong><br>
                      <span class="text-success fs-6 fw-bold">9 activité(s)</span>
                    </small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-chart-pie text-info me-2"></i>
                    <small class="text-muted">
                      <strong>Taux de Réalisation:</strong><br>
                      <span class="text-info fs-6 fw-bold">60%</span>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.dashboard-content -->

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="#">FONEA</a>.</strong>
    Tous droits réservés.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0 | 
      <small>Généré le <span id="footerDate"></span></small>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<!-- ./wrapper -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
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
document.addEventListener('DOMContentLoaded', function() {
  // Initialize date
  document.getElementById('footerDate').textContent = new Date().toLocaleDateString('fr-FR');
  
  // Form elements
  const dashboardForm = document.getElementById('dashboardForm');
  const reportTypeSelect = document.getElementById('reportType');
  const trimestreSelect = document.getElementById('trimestreSelect');
  const dashboardContent = document.getElementById('dashboardContent');
  const loadingSpinner = document.querySelector('.loading-spinner');
  const activitiesYear = document.getElementById('activitiesYear');

  // Show/Hide trimestre based on report type
  reportTypeSelect.addEventListener('change', function() {
    if (this.value === 'trimestre') {
      trimestreSelect.style.display = 'block';
      document.getElementById('trimestre').required = true;
    } else {
      trimestreSelect.style.display = 'none';
      document.getElementById('trimestre').required = false;
    }
  });

  // Form submission
  dashboardForm.addEventListener('submit', function(e) {
    e.preventDefault();
    generateDashboard();
  });

  // Generate dashboard function
  function generateDashboard() {
    const reportType = document.getElementById('reportType').value;
    const annee = document.getElementById('annee').value;
    const trimestre = document.getElementById('trimestre').value;

    if (!reportType || !annee || (reportType === 'trimestre' && !trimestre)) {
      alert('Veuillez remplir tous les champs obligatoires.');
      return;
    }

    // Show loading spinner
    showLoading();

    // Simulate API call with timeout
    setTimeout(() => {
      // Generate data based on filters
      generateMetrics(reportType, annee, trimestre);
      
      // Update activities year
      activitiesYear.textContent = annee;
      
      // Show dashboard content
      hideLoading();
      dashboardContent.style.display = 'block';
      dashboardContent.classList.add('fade-in');
      
      // Smooth scroll to content
      dashboardContent.scrollIntoView({ behavior: 'smooth' });
    }, 1500);
  }

  // Show loading spinner
  function showLoading() {
    loadingSpinner.style.display = 'block';
    dashboardContent.style.display = 'none';
  }

  // Hide loading spinner
  function hideLoading() {
    loadingSpinner.style.display = 'none';
  }

  // Generate metrics based on filters
  function generateMetrics(reportType, annee, trimestre) {
    const multiplier = reportType === 'annee' ? 4 : 1;
    const baseMultiplier = annee === '2024' ? 1 : (annee === '2023' ? 0.9 : 0.8);
    
    // Executive Summary
    const totalBenef = Math.floor((Math.random() * 1000 + 2500) * multiplier * baseMultiplier);
    const totalEmplois = Math.floor((Math.random() * 500 + 800) * multiplier * baseMultiplier);
    const tauxInsertion = Math.floor(Math.random() * 15 + 65);
    const budgetExecution = Math.floor(Math.random() * 20 + 75);
    
    document.getElementById('totalBeneficiaires').textContent = totalBenef.toLocaleString();
    document.getElementById('totalEmplois').textContent = totalEmplois.toLocaleString();
    document.getElementById('tauxInsertion').textContent = tauxInsertion + '%';
    document.getElementById('budgetExecution').textContent = budgetExecution + '%';

    // DE - Formation Qualifiante
    document.getElementById('fq-formes').textContent = Math.floor((Math.random() * 500 + 800) * multiplier * baseMultiplier).toLocaleString();
    document.getElementById('fq-insertion').textContent = Math.floor(Math.random() * 15 + 70) + '%';
    document.getElementById('fq-secteurs').textContent = Math.floor(Math.random() * 5 + 10);

    // DE - Formation Continue
    document.getElementById('fc-participants').textContent = Math.floor((Math.random() * 300 + 600) * multiplier * baseMultiplier).toLocaleString();
    document.getElementById('fc-entreprises').textContent = Math.floor(Math.random() * 20 + 30);
    document.getElementById('fc-taux').textContent = Math.floor(Math.random() * 10 + 15);

    // DE - Programme Emploi Diplômé
    document.getElementById('ped-placements').textContent = Math.floor((Math.random() * 200 + 300) * multiplier * baseMultiplier).toLocaleString();
    document.getElementById('ped-taux').textContent = Math.floor(Math.random() * 15 + 60) + '%';

    // DA - Apprentissage
    document.getElementById('am-apprentis').textContent = Math.floor((Math.random() * 300 + 500) * multiplier * baseMultiplier).toLocaleString();
    document.getElementById('am-metiers').textContent = Math.floor(Math.random() * 5 + 12);
    document.getElementById('am-reussite').textContent = Math.floor(Math.random() * 10 + 75) + '%';

    // DEAP - TDE
    document.getElementById('tde-formes').textContent = Math.floor((Math.random() * 200 + 400) * multiplier * baseMultiplier).toLocaleString();
    document.getElementById('tde-secteurs').textContent = Math.floor(Math.random() * 3 + 6);

    // DEAP - Idées de Projets
    document.getElementById('ip-idees').textContent = Math.floor((Math.random() * 100 + 150) * multiplier * baseMultiplier).toLocaleString();
    document.getElementById('ip-secteurs').textContent = Math.floor(Math.random() * 2 + 5);

    // DEAP - Financement
    document.getElementById('fin-financements').textContent = Math.floor((Math.random() * 80 + 120) * multiplier * baseMultiplier).toLocaleString();
    document.getElementById('fin-emplois').textContent = Math.floor((Math.random() * 200 + 300) * multiplier * baseMultiplier).toLocaleString();
    document.getElementById('fin-rendement').textContent = (Math.random() * 1.5 + 1.8).toFixed(1);

    // Update table data
    updateTableData(multiplier, baseMultiplier);
  }

  // Update table data
  function updateTableData(multiplier, baseMultiplier) {
    // FQ Table
    const fqTableBody = document.getElementById('fq-table-body');
    const fqSecteurs = ['Agriculture', 'BTP', 'Mécanique', 'Informatique', 'Commerce'];
    fqTableBody.innerHTML = '';
    fqSecteurs.slice(0, 4).forEach(secteur => {
      const formes = Math.floor((Math.random() * 100 + 100) * multiplier * baseMultiplier);
      const inseres = Math.floor(formes * (Math.random() * 0.3 + 0.6));
      fqTableBody.innerHTML += `<tr><td>${secteur}</td><td>${formes.toLocaleString()}</td><td>${inseres.toLocaleString()}</td></tr>`;
    });

    // FC Table
    const fcTableBody = document.getElementById('fc-table-body');
    const fcQualifications = ['Management', 'Marketing', 'Comptabilité', 'Informatique'];
    fcTableBody.innerHTML = '';
    fcQualifications.forEach(qual => {
      const developpes = Math.floor((Math.random() * 50 + 80) * multiplier * baseMultiplier);
      const prevus = Math.floor(developpes * (Math.random() * 0.4 + 1.1));
      fcTableBody.innerHTML += `<tr><td>${qual}</td><td>${developpes.toLocaleString()}</td><td>${prevus.toLocaleString()}</td></tr>`;
    });

    // PED Table
    const pedTableBody = document.getElementById('ped-table-body');
    const departements = ['Brazzaville', 'Pointe-Noire', 'Kouilou', 'Niari'];
    pedTableBody.innerHTML = '';
    departements.forEach(dept => {
      const placements = Math.floor((Math.random() * 80 + 50) * multiplier * baseMultiplier);
      pedTableBody.innerHTML += `<tr><td>${dept}</td><td>${placements.toLocaleString()}</td></tr>`;
    });

    // AM Table
    const amTableBody = document.getElementById('am-table-body');
    const metiers = ['Maçonnerie', 'Plomberie', 'Électricité', 'Menuiserie', 'Mécanique Auto'];
    amTableBody.innerHTML = '';
    metiers.forEach(metier => {
      const formations = Math.floor((Math.random() * 80 + 80) * multiplier * baseMultiplier);
      const insertions = Math.floor(formations * (Math.random() * 0.2 + 0.75));
      const taux = Math.floor((insertions/formations) * 100);
      amTableBody.innerHTML += `<tr><td>${metier}</td><td>${formations.toLocaleString()}</td><td>${insertions.toLocaleString()}</td><td>${taux}%</td></tr>`;
    });

    // TDE Table
    const tdeTableBody = document.getElementById('tde-table-body');
    const tdeSecteursData = [['Agriculture', 145], ['Commerce', 123], ['Artisanat', 98], ['Services', 87]];
    tdeTableBody.innerHTML = '';
    tdeSecteursData.forEach(([secteur, formations]) => {
      const randomFormations = Math.floor(formations * multiplier * baseMultiplier * (Math.random() * 0.4 + 0.8));
      tdeTableBody.innerHTML += `<tr><td>${secteur}</td><td>${randomFormations.toLocaleString()}</td></tr>`;
    });

    // IP Table  
    const ipTableBody = document.getElementById('ip-table-body');
    const ipSecteursData = [['Tech/Digital', 67], ['Agriculture', 56], ['Commerce', 45], ['Artisanat', 34]];
    ipTableBody.innerHTML = '';
    ipSecteursData.forEach(([secteur, idees]) => {
      const randomIdees = Math.floor(idees * multiplier * baseMultiplier * (Math.random() * 0.4 + 0.8));
      ipTableBody.innerHTML += `<tr><td>${secteur}</td><td>${randomIdees.toLocaleString()}</td></tr>`;
    });

    // Financement Table
    const finTableBody = document.getElementById('fin-table-body');
    const finData = [
      ['0-500K', 123, 'Commerce'],
      ['500K-1M', 156, 'Agriculture'], 
      ['1M-2M', 89, 'Artisanat'],
      ['2M+', 88, 'Services']
    ];
    finTableBody.innerHTML = '';
    finData.forEach(([tranche, emplois, secteur]) => {
      const randomEmplois = Math.floor(emplois * multiplier * baseMultiplier * (Math.random() * 0.4 + 0.8));
      finTableBody.innerHTML += `<tr><td>${tranche}</td><td>${randomEmplois.toLocaleString()}</td><td>${secteur}</td></tr>`;
    });
  }

  // Initialize Bootstrap tabs
  var triggerTabList = [].slice.call(document.querySelectorAll('#activitiesTab button'));
  triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl);
  });

  // Auto-generate dashboard with default values for demo
  setTimeout(() => {
    document.getElementById('reportType').value = 'annee';
    document.getElementById('annee').value = '2024';
    generateDashboard();
  }, 500);
});
</script>

</body>
</html>