<!DOCTYPE html>
<html lang="en">
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
            --primary-color: #4f46e5;
            --secondary-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --surface-color: #ffffff;
            --background-color: #f8fafc;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border-color: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        .validation-header {
            background: var(--surface-color);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            margin-bottom: 1.5rem;
            padding: 1.25rem;
            height: 120px;
        }

        .filter-form-section {
            background: var(--surface-color);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
            margin-bottom: 1.5rem;
            padding: 1.25rem;
            border-left: 4px solid var(--primary-color);
        }

        .stats-card {
            background: var(--surface-color);
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            padding: 1rem;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
            height: 100px;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .category-section {
            background: var(--surface-color);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .category-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #6366f1 100%);
            color: white;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .data-card {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            background: var(--surface-color);
            height: fit-content;
        }

        .data-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
        }

        .data-card-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            background: #f8fafc;
        }

        .data-card-body {
            padding: 1.25rem;
        }

        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-validated {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-validate {
            background: var(--secondary-color);
            border: none;
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-validate:hover {
            background: #059669;
            transform: translateY(-1px);
            color: white;
        }

        .btn-reject {
            background: var(--danger-color);
            border: none;
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-reject:hover {
            background: #dc2626;
            transform: translateY(-1px);
            color: white;
        }

        .btn-details {
            background: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .btn-details:hover {
            background: var(--primary-color);
            color: white;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .filter-tab {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .filter-tab.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .progress-ring {
            width: 45px;
            height: 10px;
        }

        .progress-ring circle {
            transition: stroke-dashoffset 0.35s;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .loading {
            animation: pulse 2s infinite;
        }

        .content-wrapper {
            background-color: var(--background-color);
        }

        .compact-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.75rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-width: 80px;
        }

        .info-value {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .info-label {
            font-size: 0.7rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .card-meta {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin-bottom: 0.75rem;
        }

        .btn-group-compact {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-group-compact .btn-details {
            grid-column: 1 / -1;
        }

        .filter-form {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid var(--border-color);
        }

        .form-floating label {
            color: var(--text-secondary);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }

        .btn-filter {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            background: #3730a3;
            border-color: #3730a3;
            transform: translateY(-1px);
            color: white;
        }

        .btn-reset {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            background: #f3f4f6;
            color: var(--text-primary);
        }

        /* Réductions d'espacement */
        .container-fluid {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .content-header {
            padding: 0.75rem 0;
        }

        .breadcrumb {
            margin-bottom: 0.5rem;
        }

        /* Titre principal plus compact */
        .validation-header h1 {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .validation-header p {
            font-size: 0.9rem;
        }

        /* Section filtres plus compacte */
        .filter-form-section h4 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
              <li class="breadcrumb-item"><a href="/dg">Tableau de Bord</a></li>
              <li class="breadcrumb-item active">Validation des données</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Header Section -->
        <div class="validation-header">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="mb-2" style="color: var(--text-primary); font-weight: 700;">
                        <i class="fas fa-check-double text-success me-3"></i>
                        Validation des Données
                    </h1>
                    <p class="mb-0 text-muted">
                      Gérez et validez les données reportées par vos agent
                    </p>
                  
                </div>
             <div class="col-lg-4">
    <div class="row">
        <!-- Validées -->
        <div class="col-6">
            <div class="stats-card text-center">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <div class="progress-ring">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e5e7eb" stroke-width="4" fill="transparent"/>
                            <circle cx="30" cy="30" r="25" stroke="#10b981" stroke-width="4" fill="transparent"
                                    stroke-dasharray="157" stroke-dashoffset="{{ 157 - (157 * $data['valide'] / ($data['valide'] + $data['invalide'])) }}"/>
                        </svg>
                    </div>
                </div>
                <h4 class="mb-1" style="color: var(--secondary-color);">{{ $data['valide'] }}</h4>
                <small class="text-muted">Validées</small>
            </div>
        </div>

        <!-- En attente / Invalide -->
        <div class="col-6">
            <div class="stats-card text-center">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <div class="progress-ring">
                        <svg width="60" height="60">
                            <circle cx="30" cy="30" r="25" stroke="#e5e7eb" stroke-width="4" fill="transparent"/>
                            <circle cx="30" cy="30" r="25" stroke="#f59e0b" stroke-width="4" fill="transparent"
                                    stroke-dasharray="157" stroke-dashoffset="{{ 157 - (157 * $data['invalide'] / ($data['valide'] + $data['invalide'])) }}"/>
                        </svg>
                    </div>
                </div>
                <h4 class="mb-1" style="color: var(--warning-color);">{{ $data['invalide'] }}</h4>
                <small class="text-muted">En attente</small>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>

        <!-- Section de Filtrage -->
       <div class="filter-form-section">
    <h4 class="mb-3" style="color: var(--text-primary); font-weight: 600;">
        <i class="fas fa-filter me-2" style="color: var(--primary-color);"></i>
        Filtrer les données
    </h4>
    <form class="filter-form" id="filterForm">
        <div class="row align-items-end">
            <!-- Année -->
            <div class="col-md-4">
                <div class="form-floating">
                    <select id="filter_annee" name="annee" class="form-select">
                        <option value="">Toutes les années</option>
                        @foreach($annees as $annee)
                            <option value="{{ $annee->id }}" {{ (old('annee') == $annee->id) ? 'selected' : '' }}>
                                {{ $annee->libelle }}
                            </option>
                        @endforeach
                    </select>
                    <label for="filter_annee">
                        <i class="fas fa-calendar-alt me-2"></i>Année
                    </label>
                </div>
            </div>

            <!-- Trimestre -->
            <div class="col-md-4">
                <div class="form-floating">
                    <select id="filter_trimestre" name="trimestre" class="form-select">
                        <option value="">Tous les trimestres</option>
                        @foreach($trimestres as $trimestre)
                            <option value="{{ $trimestre->id }}" {{ (old('trimestre') == $trimestre->id) ? 'selected' : '' }}>
                                {{ $trimestre->libelle }}
                            </option>
                        @endforeach
                    </select>
                    <label for="filter_trimestre">
                        <i class="fas fa-chart-pie me-2"></i>Trimestre
                    </label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="col-md-4">
                <div class="d-grid gap-2 d-md-flex">
                    <button type="submit" class="btn btn-filter flex-fill">
                        <i class="fas fa-search me-2"></i>Filtrer
                    </button>
                    <button type="reset" class="btn btn-reset">
                        <i class="fas fa-undo me-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>


        <!-- Filtres -->
        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all">
                <i class="fas fa-list me-2"></i>Toutes
            </button>
            <button class="filter-tab text-warning" data-filter="pending">
                <i class="fas fa-clock me-2"></i>En attente
            </button>
            <button class="filter-tab text-success" data-filter="validated">
                <i class="fas fa-check me-2"></i>Validées
            </button>
           
        </div>

          <?php $userDirection = Auth::user()->Direction->code; ?>
       <!-- Section Formation Qualifiante -->
       @if($userDirection == "DEAP")
        <div class="category-section">                     
            <div class="category-header">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-graduation-cap me-3"></i>
                        Formation Entrepreneuriales
                    </h3>
                
                </div>
                <span class="badge bg-light text-dark fs-6"><?php echo count($data['formations']);?> éléments</span>
            </div>
            
            <div class="p-4">
                <div class="row">

                @forEach($data['formations'] as $formation)
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h5 class="card-title mb-2"><?php  echo $formation->intitule;?></h5>
                                <p class="card-meta">
                                    <i class="fas fa-user me-1"></i> Agent  <?php echo $formation->user->lastName." ".$formation->user->name; ?>
                                    
                                </p>
                              <span class="status-badge {{ $formation->valide ? 'status-validated' : 'status-pending' }}">
                                  {{ $formation->valide ? 'Validée' : 'En attente' }}
                                </span>

                            </div>
                            <div class="data-card-body">
                                <div class="compact-info">

                                @forEach($formation->formation as $detail)
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->secteur->libelle?></span>
                                        <span class="info-label">Secteur</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->metier->libelle?></span>
                                        <span class="info-label">Métier</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->npaf?></span>
                                        <span class="info-label">Personnés à formés</span>
                                    </div>
                                  @endforeach
                                </div>
                                @forEach($formation->realisationFormation as $rf)
                                <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->npaf?></span>
                                    <span class="info-label">Personnes formés</span>
                                </div>
                                @endforeach
                                <div class="btn-group-compact">

                                @if($formation->valide == 0)
                                    <button class="btn btn-validate" 
                                             data-id="<?php echo $formation->id?>" 
                                                   data-type="tde">
                                      <i class="fas fa-check me-1"></i> Valider
                      </button> 
                     @endif

                                   
                                   <!-- <button class="btn btn-details" onclick="showDetails(1)">
                                        <i class="fas fa-eye me-1"></i>Voir détails
                                    </button>-->
                                </div>
                            </div>
                        </div>
                    </div>

                   
                
                @endforeach
                </div>
            </div>
        </div>

     
        <div class="category-section">
            <div class="category-header">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-coins me-3"></i>
                        Financements
                    </h3>
                </div>
                <span class="badge bg-light text-dark fs-6"> <?php echo count($data['financements']);?> elements</span>
            </div>
            
            <div class="p-4">
                <div class="row">
                    <!-- Card 1 -->

                    
                @forEach($data['financements'] as $financement)
                    <div class="col-lg-4 col-md-6">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h5 class="card-title mb-2"><?php  echo $financement->intitule;?></h5>
                                <p class="card-meta">
                                    <i class="fas fa-user me-1"></i> Agent  <?php echo $financement->user->lastName." ".$financement->user->name; ?>
                                    
                                </p>
                              <span class="status-badge {{ $financement->valide ? 'status-validated' : 'status-pending' }}">
                                     {{ $financement->valide ? 'Validée' : 'En attente' }}
                                 </span>

                            </div>
                            <div class="data-card-body">
                                <div class="compact-info">

                                @forEach($financement->financement as $detail)
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->secteur->libelle?></span>
                                        <span class="info-label">Secteur</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->mtb?></span>
                                        <span class="info-label">Montant Financement</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->nbp?></span>
                                        <span class="info-label">Béneficiaires prévus</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->nbre_emploi_cree?></span>
                                        <span class="info-label">Emplois Crées</span>
                                    </div>
                                  @endforeach
                                </div>
                                @forEach($financement->realisationFinancement as $rf)
                                <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->nrb ?></span>
                                    <span class="info-label">Beneficiaires réels</span>
                                </div>
                                @endforeach
                                <div class="btn-group-compact">

                                @if($financement->valide == 0)
                                    <button class="btn btn-validate" 
                                             data-id="<?php echo $financement->id?>" 
                                              data-type="tde">
                                                     <i class="fas fa-check me-1"></i> Valider
                                      </button> 
                                  @endif

                                   
                                   <!-- <button class="btn btn-details" onclick="showDetails(1)">
                                        <i class="fas fa-eye me-1"></i>Voir détails
                                    </button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                 @endforeach
                
                </div>
            </div>
        </div>

  
        <div class="category-section">
            <div class="category-header">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-lightbulb me-3"></i>
                      Idées de projets
                    </h3>
                  
                </div>
                <span class="badge bg-light text-dark fs-6"><?php echo count($data['tde']);?>  éléments</span>
            </div>
            
            <div class="p-4">
                <div class="row">
                    <!-- Card 1 -->

                  @forEach($data["tde"] as $tde)
                  <div class="col-lg-4 col-md-6">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h5 class="card-title mb-2"><?php  echo $tde->intitule;?></h5>
                                <p class="card-meta">
                                    <i class="fas fa-user me-1"></i> Agent  <?php echo $tde->user->lastName." ".$tde->user->name; ?>
                                    
                                </p>
                              <span class="status-badge {{ $tde->valide ? 'status-validated' : 'status-pending' }}">
                                     {{ $tde->valide ? 'Validée' : 'En attente' }}
                                 </span>

                            </div>
                            <div class="data-card-body">
                                <div class="compact-info">

                                @forEach($tde->detailsTDE as $detail)
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->secteur->libelle?></span>
                                        <span class="info-label">Secteur</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->metier->libelle?></span>
                                        <span class="info-label">Métier</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->operateur_formation?></span>
                                        <span class="info-label">Opérateur de formation</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->nipv?></span>
                                        <span class="info-label">idéess de projets validés</span>
                                    </div>
                                  @endforeach
                                </div>
                                @forEach($tde->realisationTDE as $rf)
                                <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->nipi ?></span>
                                    <span class="info-label">Idées de projets installés</span>
                                </div>
                                @endforeach
                                <div class="btn-group-compact">

                                @if($tde->valide == 0)
                                    <button class="btn btn-validate" 
                                             data-id="<?php echo $tde->id?>" 
                                              data-type="tde">
                                                     <i class="fas fa-check me-1"></i> Valider
                                      </button> 
                                  @endif

                                   
                                   <!-- <button class="btn btn-details" onclick="showDetails(1)">
                                        <i class="fas fa-eye me-1"></i>Voir détails
                                    </button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                 @endforeach
                 
                </div>
            </div>
        </div>
       @endif

     @if($userDirection == "DE")
         <div class="category-section">                     
            <div class="category-header">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-graduation-cap me-3"></i>
                        Formation Qualifiante
                    </h3>
                
                </div>
                <span class="badge bg-light text-dark fs-6"><?php echo count($data['formations_qualifiantes']);?> éléments</span>
            </div>
            
            <div class="p-4">
                <div class="row">

                @forEach($data['formations_qualifiantes'] as $formation)
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h5 class="card-title mb-2"><?php  echo $formation->intitule;?></h5>
                                <p class="card-meta">
                                    <i class="fas fa-user me-1"></i> Agent  <?php echo $formation->user->lastName." ".$formation->user->name; ?>
                                    
                                </p>
                              <span class="status-badge {{ $formation->valide ? 'status-validated' : 'status-pending' }}">
                                  {{ $formation->valide ? 'Validée' : 'En attente' }}
                                </span>

                            </div>
                            <div class="data-card-body">
                                <div class="compact-info">

                                @forEach($formation->detailsFQ as $detail)
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->secteur->libelle?></span>
                                        <span class="info-label">Secteur</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->qualification->libelle?></span>
                                        <span class="info-label">Qualification</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->ndaf?></span>
                                        <span class="info-label">Demandeurs à former</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->ndai?></span>
                                        <span class="info-label">Demandeurs à inserér</span>
                                    </div>
                                  @endforeach
                                </div>
                                @forEach($formation->realisationFQ as $rf)
                                <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->ndf?></span>
                                    <span class="info-label">Demandeurs formés</span>
                                </div>
                                 <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->ndi?></span>
                                    <span class="info-label">Demandeurs inserés</span>
                                </div>
                                @endforeach
                                <div class="btn-group-compact">

                              @if($formation->valide == 0)
                                    <button class="btn btn-validate" 
                                             data-id="<?php echo $formation->id?>" 
                                                   data-type="formation_qualifiante">
                                           <i class="fas fa-check me-1"></i> Valider
                                    </button> 
                              @endif

                                   
                                   <!-- <button class="btn btn-details" onclick="showDetails(1)">
                                        <i class="fas fa-eye me-1"></i>Voir détails
                                    </button>-->
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                </div>
            </div>
        </div>


         <div class="category-section">                     
            <div class="category-header">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fas fa-chart-line me-3"></i>
                        Formation Continue
                    </h3>
                
                </div>
                <span class="badge bg-light text-dark fs-6"><?php echo count($data['formations_continues']);?> éléments</span>
            </div>
            
            <div class="p-4">
                <div class="row">

                  @forEach($data['formations_continues'] as $formation)
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h5 class="card-title mb-2"><?php  echo $formation->intitule;?></h5>
                                <p class="card-meta">
                                    <i class="fas fa-user me-1"></i> Agent  <?php echo $formation->user->lastName." ".$formation->user->name; ?>
                                    
                                </p>
                              <span class="status-badge {{ $formation->valide ? 'status-validated' : 'status-pending' }}">
                                  {{ $formation->valide ? 'Validée' : 'En attente' }}
                                </span>

                            </div>
                            <div class="data-card-body">
                                <div class="compact-info">
                                 <div class="info-item">
                                        <span class="info-value"><?php echo $formation->secteur->libelle?></span>
                                        <span class="info-label">Secteur</span>
                                    </div>
                                  <div class="info-item">
                                        <span class="info-value"><?php echo $formation->ned?></span>
                                        <span class="info-label">Employés à développer</span>
                                    </div>
                                @forEach($formation->detailsFC as $detail)
                                   
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->competence->libelle?></span>
                                        <span class="info-label">Competence</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->entreprise?></span>
                                        <span class="info-label">Entreprise</span>
                                    </div>
                                    
                                  @endforeach
                                </div>
                                @forEach($formation->realisationFC as $rf)
                               
                                 <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->ned?></span>
                                    <span class="info-label">Employés developés</span>
                                </div>
                                @endforeach
                                <div class="btn-group-compact">

                                @if($formation->valide == 0)
                                    <button class="btn btn-validate" 
                                             data-id="<?php echo $formation->id?>" 
                                                   data-type="formation_continue">
                                      <i class="fas fa-check me-1"></i> Valider
                      </button> 
                     @endif

                                   
                                   <!-- <button class="btn btn-details" onclick="showDetails(1)">
                                        <i class="fas fa-eye me-1"></i>Voir détails
                                    </button>-->
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                </div>
            </div>
        </div>


    <div class="category-section">                     
            <div class="category-header">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-user-graduate me-3"></i>
                        Programme Emploi Diplômé
                    </h3>
                
                </div>
                <span class="badge bg-light text-dark fs-6"><?php echo count($data['peds']);?> éléments</span>
            </div>
            
            <div class="p-4">
                <div class="row">

                  @forEach($data['peds'] as $formation)
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h5 class="card-title mb-2"><?php  echo $formation->offre;?></h5>
                                <p class="card-meta">
                                    <i class="fas fa-user me-1"></i> Agent  <?php echo $formation->user->lastName." ".$formation->user->name; ?>
                                    
                                </p>
                              <span class="status-badge {{ $formation->valide ? 'status-validated' : 'status-pending' }}">
                                  {{ $formation->valide ? 'Validée' : 'En attente' }}
                                </span>

                            </div>
                            <div class="data-card-body">
                                <div class="compact-info">
                                 <div class="info-item">
                                        <span class="info-value"><?php echo $formation->secteur->libelle?></span>
                                        <span class="info-label">Secteur</span>
                                    </div>
              
                                  <div class="info-item">
                                        <span class="info-value"><?php echo $formation->departement ?></span>
                                        <span class="info-label">Département</span>
                                    </div>
                                @forEach($formation->detailsPED as $detail)
                                   
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->qualification->libelle?></span>
                                        <span class="info-label">Qualification</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->nc?></span>
                                        <span class="info-label">Candidatures</span>
                                    </div>
                                    
                                  @endforeach
                                </div>
                                @forEach($formation->realisationPED as $rf)
                               
                                 <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->npa?></span>
                                    <span class="info-label">Placements accordés</span>
                                </div>
                                @endforeach
                                <div class="btn-group-compact">

                                @if($formation->valide == 0)
                                    <button class="btn btn-validate" 
                                             data-id="<?php echo $formation->id?>" 
                                                   data-type="ped">
                                      <i class="fas fa-check me-1"></i> Valider
                      </button> 
                     @endif

                                   
                                   <!-- <button class="btn btn-details" onclick="showDetails(1)">
                                        <i class="fas fa-eye me-1"></i>Voir détails
                                    </button>-->
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                </div>
            </div>
        </div>

  @endif


   @if($userDirection == "DA")
         <div class="category-section">                     
            <div class="category-header">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-tools me-3"></i>
                       Apprentissage des métiers
                    </h3>
                
                </div>
                <span class="badge bg-light text-dark fs-6"><?php echo count($data['apprentissages']);?> éléments</span>
            </div>
            
            <div class="p-4">
                <div class="row">

                @forEach($data['apprentissages'] as $formation)
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="data-card">
                            <div class="data-card-header">
                                <h5 class="card-title mb-2"><?php  echo $formation->intitule;?></h5>
                                <p class="card-meta">
                                    <i class="fas fa-user me-1"></i> Agent  <?php echo $formation->user->lastName." ".$formation->user->name; ?>
                                    
                                </p>
                              <span class="status-badge {{ $formation->valide ? 'status-validated' : 'status-pending' }}">
                                  {{ $formation->valide ? 'Validée' : 'En attente' }}
                                </span>

                            </div>
                            <div class="data-card-body">
                                <div class="compact-info">

                                @forEach($formation->detailsApprentissage as $detail)
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->secteur->libelle?></span>
                                        <span class="info-label">Secteur</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->qualification->libelle?></span>
                                        <span class="info-label">Qualification</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->ndaf?></span>
                                        <span class="info-label">Demandeurs à former</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-value"><?php echo $detail->ndai?></span>
                                        <span class="info-label">Demandeurs à inserér</span>
                                    </div>
                                  @endforeach
                                </div>
                                @forEach($formation->realisationApprentissage as $rf)
                                <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->ndf?></span>
                                    <span class="info-label">Demandeurs formés</span>
                                </div>
                                 <div class="info-item text-center mb-2">
                                    <span class="info-value"><?php echo $rf->ndi?></span>
                                    <span class="info-label">Demandeurs inserés</span>
                                </div>
                                @endforeach
                                <div class="btn-group-compact">

                              @if($formation->valide == 0)
                                    <button class="btn btn-validate" 
                                             data-id="<?php echo $formation->id?>" 
                                                   data-type="apprentissage">
                                           <i class="fas fa-check me-1"></i> Valider
                                    </button> 
                              @endif

                                   
                                   <!-- <button class="btn btn-details" onclick="showDetails(1)">
                                        <i class="fas fa-eye me-1"></i>Voir détails
                                    </button>-->
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                </div>
            </div>
        </div>


  @endif


      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <!-- Modal de Confirmation -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="confirmationModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="modalIcon" class="mb-3"></div>
                <h4 id="modalTitle" class="mb-3"></h4>
                <p id="modalMessage" class="text-muted"></p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" id="confirmBtn" class="btn">Confirmer</button>
            </div>
        </div>
    </div>
  </div>

 

    <div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModalLabel">
                    Message
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="sessionMessage">Opération effectuée avec succès.</p>
            </div>
        </div>
    </div>
</div>

  <!-- Footer -->
   @include("dg.footer")

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Gestion du formulaire de filtrage
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const annee = document.getElementById('filter_annee').value;
    const trimestre = document.getElementById('filter_trimestre').value;
    
   
    // Afficher un message de confirmation
    showSuccessMessage(`Données filtrées: Année ${annee || 'Toutes'}, Trimestre ${trimestre || 'Tous'}`);
    
    // Ici vous pourriez masquer/afficher les cards selon les critères
    filterDataByPeriod(annee, trimestre);
});

// Reset du formulaire
document.querySelector('[type="reset"]').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('filter_annee').value = '';
    document.getElementById('filter_trimestre').value = '';
    showSuccessMessage('Filtres réinitialisés');
    
    // Réafficher toutes les données
    filterDataByPeriod('', '');
});

function filterDataByPeriod(annee, trimestre) {
    // Simuler le filtrage des données par période
    const cards = document.querySelectorAll('.data-card');
    cards.forEach(card => {
        // Logique de filtrage basée sur les critères
        // En réalité, vous compareriez avec les données réelles de chaque card
        card.style.display = 'block';
    });
}

// Gestion des filtres par statut
document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        filterCards(filter);
    });
});

function filterCards(filter) {
    const cards = document.querySelectorAll('.data-card');
    cards.forEach(card => {
        const status = card.querySelector('.status-badge');
        if (filter === 'all') {
            card.parentElement.style.display = 'block';
        } else if (filter === 'pending' && status.classList.contains('status-pending')) {
            card.parentElement.style.display = 'block';
        } else if (filter === 'validated' && status.classList.contains('status-validated')) {
            card.parentElement.style.display = 'block';
        } else if (filter === 'rejected' && status.classList.contains('status-rejected')) {
            card.parentElement.style.display = 'block';
        } else {
            card.parentElement.style.display = 'none';
        }
    });
}

// Fonction de validation
document.addEventListener('DOMContentLoaded', () => {
    // Select all validate buttons
    const validateButtons = document.querySelectorAll('.btn-validate');

    validateButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const type = button.getAttribute('data-type');

            showConfirmationModal(
                'validate',
                'Valider cette donnée ?',
                'Cette action marquera la donnée comme validée.',
                () => {
                    // Map type to route
                    const urlMap = {
                        'tde': `/tdevalidate/${id}`,
                        'formation_qualifiante': `/formqual/${id}`,
                        'formation_continue': `/formcont/${id}`,
                        'apprentissage': `/apprent/${id}`,
                        'ped': `/ped/${id}`
                    };

                    const url = urlMap[type.toLowerCase()];

                    if (!url) {
                        console.error('Type inconnu !');
                        showErrorMessage('Type inconnu !');
                        return;
                    }

                    // Create a hidden form to submit POST request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;

                    // CSRF token for Laravel
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    form.appendChild(csrfInput);

                    document.body.appendChild(form);
                    form.submit(); // Redirects to the route
                }
            );
        });
    });
});



// Fonction pour afficher les détails
function showDetails(id) {
    showSuccessMessage(`Affichage des détails pour l'élément ${id}`);
    // Ici vous pourriez ouvrir un modal avec plus de détails
}

// Modal de confirmation
function showConfirmationModal(action, title, message, callback) {
    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalIcon = document.getElementById('modalIcon');
    const confirmBtn = document.getElementById('confirmBtn');

    if (action === 'validate') {
        modalIcon.innerHTML = '<i class="fas fa-check-circle text-success fa-3x"></i>';
        confirmBtn.className = 'btn btn-validate';
        confirmBtn.innerHTML = '<i class="fas fa-check me-2"></i>Valider';
    } else {
        modalIcon.innerHTML = '<i class="fas fa-times-circle text-danger fa-3x"></i>';
        confirmBtn.className = 'btn btn-reject';
        confirmBtn.innerHTML = '<i class="fas fa-times me-2"></i>Rejeter';
    }

    modalTitle.textContent = title;
    modalMessage.textContent = message;

    confirmBtn.onclick = () => {
        modal.hide();
        callback();
    };

    modal.show();
}

// Mettre à jour le statut d'une card
function updateCardStatus(id, status) {
    // Trouver la card par ID (vous devriez ajouter des data-id aux cards)
    const cards = document.querySelectorAll('.data-card');
    cards.forEach(card => {
        // Logique pour identifier la bonne card
        const badge = card.querySelector('.status-badge');
        const buttons = card.querySelector('.btn-group-compact');
        
        // Simuler la mise à jour pour la première card trouvée avec le bon statut
        if (badge && buttons) {
            badge.className = `status-badge status-${status}`;
            if (status === 'validated') {
                badge.textContent = 'Validée';
                buttons.innerHTML = `
                    <div class="alert alert-success mb-0">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Validée</strong><br>
                        <small>Le ${new Date().toLocaleDateString('fr-FR')}</small>
                    </div>
                `;
            } else if (status === 'rejected') {
                badge.textContent = 'Rejetée';
                buttons.innerHTML = `
                    <div class="alert alert-danger mb-0">
                        <i class="fas fa-times-circle me-2"></i>
                        <strong>Rejetée</strong><br>
                        <small>Le ${new Date().toLocaleDateString('fr-FR')}</small>
                    </div>
                `;
            }
            return false; // Sortir de la boucle après la première mise à jour
        }
    });
}

// Mettre à jour les statistiques
function updateStats() {
    const validated = document.querySelectorAll('.status-validated').length;
    const pending = document.querySelectorAll('.status-pending').length;
    
    const validatedElement = document.querySelector('.stats-card h4[style*="--secondary-color"]');
    const pendingElement = document.querySelector('.stats-card h4[style*="--warning-color"]');
    
    if (validatedElement) validatedElement.textContent = validated;
    if (pendingElement) pendingElement.textContent = pending;
}

// Messages de succès et d'erreur
function showSuccessMessage(message) {
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
    toast.setAttribute('role', 'alert');
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    document.body.appendChild(toast);
    
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    setTimeout(() => toast.remove(), 5000);
}

function showErrorMessage(message) {
    const toast = document.createElement('div');
    toast.className = 'toast align-items-center text-white bg-danger border-0 position-fixed top-0 end-0 m-3';
    toast.setAttribute('role', 'alert');
    toast.style.zIndex = '9999';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-exclamation-circle me-2"></i>${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    document.body.appendChild(toast);
    
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
    
    setTimeout(() => toast.remove(), 5000);
}

// Animations au scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

document.querySelectorAll('.data-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(card);
});

// Ajouter des animations subtiles aux boutons
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Animation d'entrée pour les cards
    setTimeout(() => {
        document.querySelectorAll('.data-card').forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 200);
});
</script>

</body>
</html>