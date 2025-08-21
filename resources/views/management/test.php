@extends('adminlte::page')

@section('title', 'Dashboard Exécutif FONEA')

@section('content_header')
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="text-white">
                        <i class="fas fa-chart-line me-3"></i>
                        Dashboard Exécutif FONEA
                    </h1>
                </div>
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 justify-content-end bg-transparent">
                            <li class="breadcrumb-item"><a href="#" class="text-white-50">Accueil</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-title">
                <i class="fas fa-filter"></i>
                Filtres de Période
            </div>
            
            <form id="dashboardForm" method="GET" action="{{ route('dg.dashboard') }}">
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label for="reportType" class="form-label fw-semibold">Type de Période</label>
                        <select class="form-select" id="reportType" name="reportType" required>
                            <option value="">Sélectionner...</option>
                            <option value="trimestre" {{ request('reportType') == 'trimestre' ? 'selected' : '' }}>Trimestriel</option>
                            <option value="annee" {{ request('reportType') == 'annee' ? 'selected' : '' }}>Annuel</option>
                        </select>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <label for="annee" class="form-label fw-semibold">Année</label>
                        <select id="annee" name="annee" class="form-select">
                            <option value="">Toutes les années</option>
                            @foreach($annees as $annee)
                                <option value="{{ $annee->id }}" {{ request('annee', '2024') == $annee->libelle ? 'selected' : '' }}>
                                    {{ $annee->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-lg-3 col-md-6" id="trimestreSelect" style="display: {{ request('reportType') == 'trimestre' ? 'block' : 'none' }};">
                        <label for="trimestre" class="form-label fw-semibold">Trimestre</label>
                        <select id="trimestre" name="trimestre" class="form-select">
                            <option value="">Tous les trimestres</option>
                            @foreach($trimestres as $trimestre)
                                <option value="{{ $trimestre->id }}" {{ request('trimestre') == $trimestre->id ? 'selected' : '' }}>
                                    T{{ $trimestre->numero }} - {{ $trimestre->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-12 d-flex align-items-end">
                        <div class="w-100 d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-sync-alt me-2"></i>
                                Actualiser
                            </button>
                            <button type="button" class="btn btn-success" onclick="window.print()">
                                <i class="fas fa-print me-2"></i>
                                Imprimer
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Executive Summary -->
        <div class="executive-summary fade-in">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="summary-card">
                        <div class="summary-number">
                            {{ number_format(($fq_data['total_formes'] ?? 0) + ($fc_data['total_participants'] ?? 0) + ($ped_data['total_placements'] ?? 0) + ($am_data['total_apprentis'] ?? 0) + ($tde_data['total_formes'] ?? 0)) }}
                        </div>
                        <div class="summary-label">Bénéficiaires Totaux</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="summary-card">
                        <div class="summary-number">
                            {{ number_format(($tde_data['emplois_crees'] ?? 0) + ($ip_details->sum('emplois_crees') ?? 0)) }}
                        </div>
                        <div class="summary-label">Emplois Créés</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="summary-card">
                        <div class="summary-number">
                            {{ round((($fq_data['taux_insertion'] ?? 0) + ($am_data['taux_reussite'] ?? 0) + ($ped_data['taux_reussite'] ?? 0)) / 3) }}%
                        </div>
                        <div class="summary-label">Taux d'Insertion Global</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="summary-card">
                        <div class="summary-number">85%</div>
                        <div class="summary-label">Exécution Budgétaire</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Direction de l'Emploi (DE) -->
        <div class="direction-accordion fade-in">
            <div class="direction-card">
                <div class="direction-header de" onclick="toggleDirection('de')" role="button" aria-expanded="false">
                    <h3 class="direction-title">
                        <i class="fas fa-briefcase"></i>
                        Direction de l'Emploi (DE)
                    </h3>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-light text-dark me-3">3 Programmes</span>
                        <i class="fas fa-chevron-down collapse-indicator" id="de-indicator"></i>
                    </div>
                </div>
                <div class="direction-content collapse" id="de-content">
                    <div class="program-cards-container">
                        <div class="row g-4">
                            <!-- Formation Qualifiante -->
                            <div class="col-lg-4 col-md-6">
                                <div class="program-card">
                                    <div class="program-card-header de-fq">
                                        <i class="fas fa-graduation-cap"></i>
                                        Formation Qualifiante
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ number_format($fq_data['total_formes'] ?? 0) }}</div>
                                                    <div class="kpi-label">Formés</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $fq_data['taux_insertion'] ?? 0 }}%</div>
                                                    <div class="kpi-label">Insertion</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $fq_data['nb_secteurs'] ?? 0 }}</div>
                                                    <div class="kpi-label">Secteurs</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-container">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fas fa-industry me-1"></i>Secteur</th>
                                                        <th><i class="fas fa-users me-1"></i>Formés</th>
                                                        <th><i class="fas fa-check-circle me-1"></i>Insérés</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($fq_details ?? [] as $detail)
                                                        <tr>
                                                            <td>{{ $detail->secteur_nom }}</td>
                                                            <td>{{ number_format($detail->total_formation) }}</td>
                                                            <td>{{ number_format($detail->total_insertion) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted">Aucune donnée disponible</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Formation Continue -->
                            <div class="col-lg-4 col-md-6">
                                <div class="program-card">
                                    <div class="program-card-header de-fc">
                                        <i class="fas fa-book-open"></i>
                                        Formation Continue
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ number_format($fc_data['total_participants'] ?? 0) }}</div>
                                                    <div class="kpi-label">Participants</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $fc_data['entreprises'] ?? 0 }}</div>
                                                    <div class="kpi-label">Entreprises</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $fc_data['taux'] ?? 0 }}</div>
                                                    <div class="kpi-label">Taux/Ent.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-container">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fas fa-certificate me-1"></i>Qualification</th>
                                                        <th><i class="fas fa-arrow-up me-1"></i>Développés</th>
                                                        <th><i class="fas fa-target me-1"></i>Prévus</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($fc_details ?? [] as $detail)
                                                        <tr>
                                                            <td>{{ $detail->qualification_nom }}</td>
                                                            <td>{{ number_format($detail->total_participants) }}</td>
                                                            <td>{{ number_format($detail->total_prevus) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted">Aucune donnée disponible</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Programme Emploi Diplômé -->
                            <div class="col-lg-4 col-md-6">
                                <div class="program-card">
                                    <div class="program-card-header de-ped">
                                        <i class="fas fa-user-graduate"></i>
                                        Programme Emploi Diplômé
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ number_format($ped_data['total_placements'] ?? 0) }}</div>
                                                    <div class="kpi-label">Placements</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $ped_data['taux_reussite'] ?? 0 }}%</div>
                                                    <div class="kpi-label">Taux</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-container">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fas fa-map-marker-alt me-1"></i>Département</th>
                                                        <th><i class="fas fa-briefcase me-1"></i>Placements</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($ped_details ?? [] as $detail)
                                                        <tr>
                                                            <td>{{ $detail->departement }}</td>
                                                            <td>{{ number_format($detail->total_placements) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2" class="text-center text-muted">Aucune donnée disponible</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="summary-stats">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="fw-bold text-primary fs-4">
                                        {{ number_format(($fq_data['total_formes'] ?? 0) + ($fc_data['total_participants'] ?? 0) + ($ped_data['total_placements'] ?? 0)) }}
                                    </div>
                                    <small class="text-muted">Total Bénéficiaires DE</small>
                                </div>
                                <div class="col-md-3">
                                    <div class="fw-bold text-success fs-4">
                                        {{ round((($fq_data['taux_insertion'] ?? 0) + ($ped_data['taux_reussite'] ?? 0)) / 2) }}%
                                    </div>
                                    <small class="text-muted">Taux Moyen d'Insertion</small>
                                </div>
                                <div class="col-md-3">
                                    <div class="fw-bold text-info fs-4">{{ $fc_data['entreprises'] ?? 0 }}</div>
                                    <small class="text-muted">Entreprises Partenaires</small>
                                </div>
                                <div class="col-md-3">
                                    <div class="fw-bold text-warning fs-4">{{ $fq_data['nb_secteurs'] ?? 0 }}</div>
                                    <small class="text-muted">Secteurs Couverts</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Direction de l'Apprentissage (DA) -->
        <div class="direction-accordion fade-in">
            <div class="direction-card">
                <div class="direction-header da" onclick="toggleDirection('da')" role="button" aria-expanded="false">
                    <h3 class="direction-title">
                        <i class="fas fa-tools"></i>
                        Direction de l'Apprentissage (DA)
                    </h3>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-dark text-warning me-3">1 Programme</span>
                        <i class="fas fa-chevron-down collapse-indicator" id="da-indicator"></i>
                    </div>
                </div>
                <div class="direction-content collapse" id="da-content">
                    <div class="program-cards-container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="program-card">
                                    <div class="program-card-header da-am">
                                        <i class="fas fa-hammer"></i>
                                        Apprentissage des Métiers
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 mb-4">
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ number_format($am_data['total_apprentis'] ?? 0) }}</div>
                                                    <div class="kpi-label">Apprentis</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $am_data['nb_metiers'] ?? 0 }}</div>
                                                    <div class="kpi-label">Métiers</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $am_data['taux_reussite'] ?? 0 }}%</div>
                                                    <div class="kpi-label">Réussite</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-container">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fas fa-certificate me-1"></i>Qualification</th>
                                                        <th><i class="fas fa-users me-1"></i>Formations</th>
                                                        <th><i class="fas fa-check-circle me-1"></i>Insertions</th>
                                                        <th><i class="fas fa-percentage me-1"></i>Taux Réussite</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($am_details ?? [] as $detail)
                                                        <tr>
                                                            <td>{{ $detail->qualification_nom }}</td>
                                                            <td>{{ number_format($detail->total_formation) }}</td>
                                                            <td>{{ number_format($detail->total_insertion) }}</td>
                                                            <td>
                                                                @php
                                                                    $taux = $detail->taux_reussite;
                                                                    $badgeClass = $taux >= 75 ? 'bg-success' : ($taux >= 70 ? 'bg-warning text-dark' : 'bg-danger');
                                                                @endphp
                                                                <span class="badge {{ $badgeClass }}">{{ $taux }}%</span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center text-muted">Aucune donnée disponible</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="summary-stats">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="fw-bold text-primary fs-4">{{ number_format($am_data['total_apprentis'] ?? 0) }}</div>
                                    <small class="text-muted">Total Apprentis Formés</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="fw-bold text-success fs-4">
                                        {{ number_format(($am_data['total_apprentis'] ?? 0) * ($am_data['taux_reussite'] ?? 0) / 100) }}
                                    </div>
                                    <small class="text-muted">Apprentis Insérés</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="fw-bold text-info fs-4">{{ $am_data['nb_metiers'] ?? 0 }}</div>
                                    <small class="text-muted">Métiers Enseignés</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Direction de l'Employabilité et de l'Autonomisation des Personnes (DEAP) -->
        <div class="direction-accordion fade-in">
            <div class="direction-card">
                <div class="direction-header deap" onclick="toggleDirection('deap')" role="button" aria-expanded="false">
                    <h3 class="direction-title">
                        <i class="fas fa-users"></i>
                        Direction de l'Employabilité et de l'Autonomisation des Personnes (DEAP)
                    </h3>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-light text-success me-3">3 Programmes</span>
                        <i class="fas fa-chevron-down collapse-indicator" id="deap-indicator"></i>
                    </div>
                </div>
                <div class="direction-content collapse" id="deap-content">
                    <div class="program-cards-container">
                        <div class="row g-4">
                            <!-- Formations Entrepreneuriales -->
                            <div class="col-lg-4 col-md-6">
                                <div class="program-card">
                                    <div class="program-card-header deap">
                                        <i class="fas fa-book"></i>
                                        Formations Entrepreneuriales
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ number_format($tde_data['total_formes'] ?? 0) }}</div>
                                                    <div class="kpi-label">Formés</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $distinct_secteurs ?? 0 }}</div>
                                                    <div class="kpi-label">Secteurs</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-container">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fas fa-industry me-1"></i>Secteur</th>
                                                        <th><i class="fas fa-graduation-cap me-1"></i>Formations</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($tde_details ?? [] as $detail)
                                                        <tr>
                                                            <td>{{ $detail->secteur_nom }}</td>
                                                            <td>{{ number_format($detail->total_formation) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2" class="text-center text-muted">Aucune donnée disponible</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Porteurs d'Idées -->
                            <div class="col-lg-4 col-md-6">
                                <div class="program-card">
                                    <div class="program-card-header deap">
                                        <i class="fas fa-lightbulb"></i>
                                        Porteurs d'Idées de Projets
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ number_format($ip_data['total_idees'] ?? 0) }}</div>
                                                    <div class="kpi-label">Idées</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $ip_data['nb_secteurs'] ?? 0 }}</div>
                                                    <div class="kpi-label">Secteurs</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-container">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fas fa-industry me-1"></i>Secteur</th>
                                                        <th><i class="fas fa-lightbulb me-1"></i>Idées</th>
                                                        <th><i class="fas fa-briefcase me-1"></i>Emplois</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($ip_details ?? [] as $detail)
                                                        <tr>
                                                            <td>{{ $detail->secteur_nom }}</td>
                                                            <td>{{ number_format($detail->nb_idees) }}</td>
                                                            <td>{{ number_format($detail->emplois_crees) }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted">Aucune donnée disponible</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Financement -->
                            <div class="col-lg-4 col-md-6">
                                <div class="program-card">
                                    <div class="program-card-header deap">
                                        <i class="fas fa-coins"></i>
                                        Financement
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-2">
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ number_format($fin_data['total_financements'] ?? 0) }}</div>
                                                    <div class="kpi-label">Financements</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ number_format($fin_data['total_emploi_crees'] ?? 0) }}</div>
                                                    <div class="kpi-label">Emplois</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="kpi-card">
                                                    <div class="kpi-number">{{ $fin_data['rendement'] ?? 0 }}</div>
                                                    <div class="kpi-label">Rendement</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-container">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fas fa-money-bill me-1"></i>Tranche</th>
                                                        <th><i class="fas fa-briefcase me-1"></i>Emplois</th>
                                                        <th><i class="fas fa-industry me-1"></i>Secteur</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($fin_details ?? [] as $detail)
                                                        <tr>
                                                            <td>{{ $detail->tranche_montant }}</td>
                                                            <td>{{ number_format($detail->emplois_crees) }}</td>
                                                            <td>{{ $detail->secteur }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center text-muted">Aucune donnée disponible</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="summary-stats">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="fw-bold text-primary fs-4">
                                        {{ number_format(($tde_data['total_formes'] ?? 0) + ($ip_data['total_idees'] ?? 0)) }}
                                    </div>
                                    <small class="text-muted">Total Bénéficiaires DEAP</small>
                                </div>
                                <div class="col-md-3">
                                    <div class="fw-bold text-success fs-4">{{ number_format($tde_data['emplois_crees'] ?? 0) }}</div>
                                    <small class="text-muted">Emplois Créés</small>
                                </div>
                                <div class="col-md-3">
                                    <div class="fw-bold text-info fs-4">{{ number_format($fin_data['total_financements'] ?? 0) }}</div>
                                    <small class="text-muted">Projets Financés</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="fw-bold text-warning fs-4">{{ number_format($ip_data['total_idees'] ?? 0) }}</div>
                                    <small class="text-muted">Idées de Projets</small>
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
                <h4>
                    <i class="fas fa-chart-line me-2"></i>
                    Suivi des Activités {{ date('Y') }} - Directions Métiers
                </h4>
                <ul class="nav nav-tabs" id="activitiesTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-activities-tab" data-bs-toggle="tab" data-bs-target="#all-activities" type="button" role="tab">
                            <i class="fas fa-list me-2"></i>
                            Toutes ({{ count($activities['activities_planned'] ?? []) + count($activities['activities_completed'] ?? []) }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="planned-activities-tab" data-bs-toggle="tab" data-bs-target="#planned-activities" type="button" role="tab">
                            <i class="fas fa-calendar-plus me-2"></i>
                            Planifiées ({{ count($activities['activities_planned'] ?? []) }})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-activities-tab" data-bs-toggle="tab" data-bs-target="#completed-activities" type="button" role="tab">
                            <i class="fas fa-check-circle me-2"></i>
                            Réalisées ({{ count($activities['activities_completed'] ?? []) }})
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-0">
                <div class="tab-content" id="activitiesTabContent">
                    <!-- Toutes les Activités -->
                    <div class="tab-pane fade show active" id="all-activities" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-info"><i class="fas fa-tasks me-1"></i>Activité</th>
                                        <th class="text-info"><i class="fas fa-building me-1"></i>Type</th>
                                        <th class="text-info"><i class="fas fa-money-bill me-1"></i>Budget (XAF)</th>
                                        <th class="text-info"><i class="fas fa-percentage me-1"></i>Taux (%)</th>
                                        <th class="text-info"><i class="fas fa-info-circle me-1"></i>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities['activities_planned'] ?? [] as $activity)
                                        <tr class="bg-warning bg-opacity-10">
                                            <td>{{ $activity->libelle }}</td>
                                            <td><span class="badge bg-info">Planifiée</span></td>
                                            <td class="text-primary fw-bold">{{ number_format($activity->mtb) }}</td>
                                            <td>{{ $activity->taux }}%</td>
                                            <td>
                                                @if($activity->planned_statut == 'en_cours')
                                                    <span class="badge bg-warning text-dark">En cours</span>
                                                @elseif($activity->planned_statut == 'termine')
                                                    <span class="badge bg-success">Terminée</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $activity->planned_statut }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    @foreach($activities['activities_completed'] ?? [] as $activity)
                                        <tr class="bg-success bg-opacity-10">
                                            <td>{{ $activity->libelle }}</td>
                                            <td><span class="badge bg-success">Réalisée</span></td>
                                            <td class="text-muted">-</td>
                                            <td class="text-success">100%</td>
                                            <td>
                                                @if($activity->statut_budget == 'realise')
                                                    <span class="badge bg-success">Réalisée</span>
                                                @else
                                                    <span class="badge bg-info">{{ $activity->statut_budget }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    @if(empty($activities['activities_planned']) && empty($activities['activities_completed']))
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Aucune activité disponible</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Activités Planifiées -->
                    <div class="tab-pane fade" id="planned-activities" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-info"><i class="fas fa-tasks me-1"></i>Activité</th>
                                        <th class="text-info"><i class="fas fa-money-bill me-1"></i>Budget (XAF)</th>
                                        <th class="text-info"><i class="fas fa-percentage me-1"></i>Taux (%)</th>
                                        <th class="text-info"><i class="fas fa-info-circle me-1"></i>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($activities['activities_planned'] ?? [] as $activity)
                                        <tr>
                                            <td>{{ $activity->libelle }}</td>
                                            <td class="text-primary fw-bold">{{ number_format($activity->mtb) }}</td>
                                            <td>{{ $activity->taux }}%</td>
                                            <td>
                                                @if($activity->planned_statut == 'en_cours')
                                                    <span class="badge bg-warning text-dark">En cours</span>
                                                @elseif($activity->planned_statut == 'termine')
                                                    <span class="badge bg-success">Terminée</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $activity->planned_statut }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Aucune activité planifiée</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="fas fa-calculator me-1"></i>
                                <strong>Budget Total Planifié:</strong> 
                                <span class="text-primary fw-bold">
                                    {{ number_format(collect($activities['activities_planned'] ?? [])->sum('mtb')) }} XAF
                                </span>
                            </small>
                        </div>
                    </div>
                    
                    <!-- Activités Réalisées -->
                    <div class="tab-pane fade" id="completed-activities" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-info"><i class="fas fa-tasks me-1"></i>Activité</th>
                                        <th class="text-info"><i class="fas fa-info-circle me-1"></i>Statut Budget</th>
                                        <th class="text-info"><i class="fas fa-check-circle me-1"></i>État</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($activities['activities_completed'] ?? [] as $activity)
                                        <tr>
                                            <td>{{ $activity->libelle }}</td>
                                            <td>
                                                @if($activity->statut_budget == 'realise')
                                                    <span class="badge bg-success">Réalisé</span>
                                                @else
                                                    <span class="badge bg-info">{{ $activity->statut_budget }}</span>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-success">Terminée</span></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Aucune activité réalisée</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="fas fa-check-circle me-1"></i>
                                <strong>Activités Terminées:</strong> 
                                <span class="text-success fw-bold">{{ count($activities['activities_completed'] ?? []) }} activité(s)</span>
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
                                <span class="text-info fs-6 fw-bold">
                                    @php
                                        $total = count($activities['activities_planned'] ?? []) + count($activities['activities_completed'] ?? []);
                                        $completed = count($activities['activities_completed'] ?? []);
                                        $rate = $total > 0 ? round(($completed / $total) * 100) : 0;
                                    @endphp
                                    {{ $rate }}%
                                </span>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        :root {
            --fonea-blue: #2c5aa0;
            --fonea-blue-dark: #1e4080;
            --fonea-green: #28a745;
            --fonea-orange: #ffc107;
            --fonea-red: #dc3545;
            --fonea-teal: #17a2b8;
            --light-bg: #f8f9fc;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.08);
            --card-shadow-hover: 0 8px 30px rgba(0,0,0,0.12);
            --transition: all 0.3s ease;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--fonea-blue), var(--fonea-blue-dark));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 20px 20px;
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }

        /* Executive Summary Cards */
        .executive-summary {
            margin-bottom: 3rem;
        }

        .summary-card {
            background: linear-gradient(135deg, var(--fonea-blue) 0%, var(--fonea-blue-dark) 100%);
            color: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--card-shadow);
            border: none;
            height: 100%;
        }

        .summary-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
        }

        .summary-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .summary-label {
            font-size: 1.1rem;
            opacity: 0.95;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: var(--card-shadow);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .filter-title {
            color: var(--fonea-blue);
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }

        .filter-title i {
            margin-right: 0.5rem;
        }

        .form-select, .form-control {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--fonea-blue);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--fonea-blue), var(--fonea-blue-dark));
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(44, 90, 160, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--fonea-green), #1e7e34);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }

        /* Direction Cards */
        .direction-accordion {
            margin-bottom: 2rem;
        }

        .direction-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .direction-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .direction-header {
            padding: 1.5rem 2rem;
            cursor: pointer;
            position: relative;
            transition: var(--transition);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .direction-header:hover {
            opacity: 0.9;
        }

        .direction-header.de {
            background: linear-gradient(135deg, var(--fonea-red) 0%, #c82333 100%);
            color: white;
        }

        .direction-header.da {
            background: linear-gradient(135deg, var(--fonea-orange) 0%, #e0a800 100%);
            color: #212529;
        }

        .direction-header.deap {
            background: linear-gradient(135deg, var(--fonea-green) 0%, #1e7e34 100%);
            color: white;
        }

        .direction-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            flex-grow: 1;
            display: flex;
            align-items: center;
        }

        .direction-title i {
            margin-right: 0.75rem;
            font-size: 1.2rem;
        }

        .collapse-indicator {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
            margin-left: 1rem;
        }

        .collapse-indicator.rotated {
            transform: rotate(180deg);
        }

        .direction-content {
            padding: 0;
            border-top: 3px solid rgba(0,0,0,0.1);
        }

        /* Program Cards */
        .program-cards-container {
            padding: 2rem;
        }

        .program-card {
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: var(--transition);
            border: none;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .program-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 25px rgba(0,0,0,0.12);
        }

        .program-card-header {
            font-weight: 600;
            padding: 1.25rem;
            text-align: center;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .program-card-header i {
            margin-right: 0.5rem;
        }

        .program-card-header.de-fq {
            background: linear-gradient(135deg, var(--fonea-red), #c82333);
            color: white;
        }

        .program-card-header.de-fc {
            background: linear-gradient(135deg, var(--fonea-blue), var(--fonea-blue-dark));
            color: white;
        }

        .program-card-header.de-ped {
            background: linear-gradient(135deg, var(--fonea-teal), #138496);
            color: white;
        }

        .program-card-header.da-am {
            background: linear-gradient(135deg, var(--fonea-orange), #e0a800);
            color: #212529;
        }

        .program-card-header.deap {
            background: linear-gradient(135deg, var(--fonea-green), #1e7e34);
            color: white;
        }

        /* KPI Cards */
        .kpi-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            transition: var(--transition);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
            padding: 1.25rem 0.75rem;
            margin-bottom: 1rem;
            height: 100%;
        }

        .kpi-card:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .kpi-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }

        .kpi-label {
            font-size: 0.8rem;
            opacity: 0.95;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Table Styling */
        .table-container {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1.5rem;
        }

        .table {
            margin-bottom: 0;
            font-size: 0.9rem;
            border-radius: 8px;
            overflow: hidden;
        }

        .table th {
            background: linear-gradient(135deg, #495057, #343a40);
            color: white;
            font-weight: 600;
            border: none;
            font-size: 0.85rem;
            padding: 1rem 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 0.75rem;
            border-color: #dee2e6;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0,0,0,0.02);
        }

        .table tbody tr:hover {
            background-color: rgba(44, 90, 160, 0.05);
            transition: var(--transition);
        }

        /* Activities Section */
        .activities-section {
            background: white;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            margin-top: 3rem;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .activities-header {
            background: linear-gradient(135deg, var(--fonea-blue) 0%, var(--fonea-blue-dark) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .activities-header h4 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .nav-tabs {
            border: none;
            justify-content: center;
        }

        .nav-tabs .nav-link {
            border: none;
            color: rgba(255,255,255,0.8);
            background: transparent;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            margin: 0 0.25rem;
            transition: var(--transition);
        }

        .nav-tabs .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-tabs .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 700;
        }

        /* Summary Stats */
        .summary-stats {
            background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(255,255,255,0.7));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 15px;
            padding: 1rem;
            margin-top: 1rem;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-down {
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                max-height: 0;
            }
            to {
                opacity: 1;
                max-height: 1000px;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.8rem;
            }
            
            .summary-number {
                font-size: 2.2rem;
            }
            
            .kpi-number {
                font-size: 1.4rem;
            }
            
            .kpi-label {
                font-size: 0.7rem;
            }
            
            .direction-title {
                font-size: 1.1rem;
            }
            
            .program-cards-container {
                padding: 1rem;
            }
        }

        /* Print Styles */
        @media print {
            .filter-section,
            .btn,
            .collapse-indicator {
                display: none !important;
            }
            
            .direction-content {
                display: block !important;
            }
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Show/Hide trimestre based on report type
            $('#reportType').on('change', function() {
                if (this.value === 'trimestre') {
                    $('#trimestreSelect').show();
                    $('#trimestre').prop('required', true);
                } else {
                    $('#trimestreSelect').hide();
                    $('#trimestre').prop('required', false);
                    $('#trimestre').val('');
                }
            });

            // Add fade-in animation to cards
            const cards = $('.direction-card, .activities-section, .executive-summary');
            cards.each(function(index) {
                const $this = $(this);
                setTimeout(() => {
                    $this.addClass('fade-in');
                }, index * 150);
            });

            // Initialize Bootstrap tabs
            $('#activitiesTab button').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
        });

        // Toggle direction content
        function toggleDirection(directionId) {
            const content = document.getElementById(directionId + '-content');
            const indicator = document.getElementById(directionId + '-indicator');
            const header = content.previousElementSibling;
            
            if (content.classList.contains('show')) {
                // Collapse
                content.classList.remove('show');
                indicator.classList.remove('rotated');
                header.setAttribute('aria-expanded', 'false');
                
                // Animate collapse
                content.style.maxHeight = content.scrollHeight + 'px';
                requestAnimationFrame(() => {
                    content.style.maxHeight = '0px';
                    content.style.opacity = '0';
                });
            } else {
                // Expand
                content.classList.add('show', 'slide-down');
                indicator.classList.add('rotated');
                header.setAttribute('aria-expanded', 'true');
                
                // Animate expand
                content.style.maxHeight = '0px';
                content.style.opacity = '0';
                requestAnimationFrame(() => {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    content.style.opacity = '1';
                });
                
                // Reset max-height after animation
                setTimeout(() => {
                    if (content.classList.contains('show')) {
                        content.style.maxHeight = 'none';
                    }
                }, 400);
            }
        }

        // Print functionality
        window.addEventListener('beforeprint', function() {
            // Expand all collapsed sections for printing
            const collapsedContent = document.querySelectorAll('.direction-content:not(.show)');
            collapsedContent.forEach(content => {
                content.classList.add('show');
                content.style.maxHeight = 'none';
                content.style.opacity = '1';
            });
        });

        window.addEventListener('afterprint', function() {
            // Restore collapsed state after printing
            const allContent = document.querySelectorAll('.direction-content');
            allContent.forEach(content => {
                if (!content.classList.contains('show')) {
                    content.style.maxHeight = '0px';
                    content.style.opacity = '0';
                }
            });
        });

        // Show notification function
        function showNotification(message, type = 'info') {
            const notification = $('<div>')
                .addClass(`alert alert-${type} alert-dismissible fade show position-fixed`)
                .css({
                    'top': '20px',
                    'right': '20px',
                    'z-index': '10000',
                    'min-width': '300px'
                })
                .html(`
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `);
            
            $('body').append(notification);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
    </script>
@stop