<?php


?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); box-shadow: 0 2px 15px rgba(0,0,0,0.1);">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
    
    <!-- Statistics Quick Indicators -->
    <li class="nav-item d-none d-md-block ml-3">
      <div class="nav-link text-white d-flex align-items-center">
       
        <i class="fas fa-user text-danger mr-2"></i> <span class="mr-2"> <?php echo Auth::user()->name?></span>
        <small class="badge badge-warning mr-2">Active</small>
      </div>
   
  </ul>
  
  <!-- Center - App Title with Stats Icon -->
  <div class="navbar-nav mx-auto d-none d-lg-flex">
    <div class="nav-item">
      <div class="nav-link text-white d-flex align-items-center">
        <i class="fas fa-analytics text-primary mr-2" style="font-size: 1.2rem;"></i>
        <span style="font-weight: 600; font-size: 1.1rem;">FONEA 360</span>
        <span class="ml-2 text-muted" style="font-size: 0.9rem;">| <i class="text-info">Transformez vos chiffres en décisions</i></span>
      </div>
    </div>
  </div>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Real-time Stats Indicator -->
    <li class="nav-item d-none d-lg-block">
      <div class="nav-link text-white d-flex align-items-center">
        <div class="pulse-dot mr-2"></div>
        <small class="text-success">Données en temps réel</small>
      </div>
    </li>
    
    <!-- Notifications for Stats Updates -->
    <li class="nav-item dropdown">
      <a class="nav-link text-white" data-toggle="dropdown" href="#" role="button">
        <i class="fas fa-bell"></i>
        <span class="badge badge-warning navbar-badge animate__animated animate__pulse">3</span>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <span class="dropdown-item-text">Nouvelles données disponibles</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-chart-bar mr-2 text-success"></i>
          Rapport mensuel généré
        </a>
        <a href="#" class="dropdown-item">
          <i class="fas fa-database mr-2 text-info"></i>
          Synchronisation terminée
        </a>
        <a href="#" class="dropdown-item">
          <i class="fas fa-exclamation-triangle mr-2 text-warning"></i>
          Anomalie détectée
        </a>
      </div>
    </li>

    <!-- Direction Info with Stats Context -->
    <li class="nav-item">
      <div class="nav-link text-white d-flex align-items-center">
        <div class="text-center">
         
          <small class="text-warning d-block" style="font-weight: 600; font-size: 0.85rem;">
            {{Auth::user()->Direction->libelle}}
          </small>
          </div>
      </div>
    </li>
    
    <!-- Country Flags with Enhanced Styling -->
    <li class="nav-item">
      <div class="image position-relative">
        <img src="images/congo.png" class="img-circle elevation-3" height="45" width="45" alt="Congo" 
             style="border: 2px solid rgba(255,255,255,0.3);">
        <span class="badge badge-success position-absolute" style="top: -2px; right: -2px; font-size: 0.6rem;">●</span>
      </div>
    </li>
    
    <li class="nav-item">
      <div class="image position-relative">
        <img src="images/flag.png" class="img-circle elevation-3" height="45" width="45" alt="Flag"
             style="border: 2px solid rgba(255,255,255,0.3);">
      </div>
    </li>
    
    <!-- Enhanced Logout with Confirmation -->
    <li class="nav-item">
      <a href="/logout" class="nav-link text-white" " 
         title="Déconnexion sécurisée">
        <i class="nav-icon fas fa-sign-out-alt fa-lg hover-effect"></i>
      </a>
    </li>
  </ul>
</nav>

<style>
/* Pulse animation for real-time indicator */
.pulse-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: #28a745;
  animation: pulse-glow 2s infinite;
}

@keyframes pulse-glow {
  0% {
    box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
  }
  70% {
    box-shadow: 0 0 0 8px rgba(40, 167, 69, 0);
  }
  100% {
    box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
  }
}

/* Hover effects */
.hover-effect {
  transition: all 0.3s ease;
}

.hover-effect:hover {
  transform: scale(1.1);
  color: #ff6b6b !important;
}

/* Badge animations */
.navbar-badge {
  animation: bounce 2s infinite;
}

@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-3px);
  }
  60% {
    transform: translateY(-2px);
  }
}

/* Responsive improvements */
@media (max-width: 768px) {
  .navbar-nav .nav-link {
    padding: 0.5rem 0.75rem;
  }
  
  .image img {
    height: 35px;
    width: 35px;
  }
}

/* Enhanced dropdown */
.dropdown-menu {
  border: none;
  box-shadow: 0 5px 25px rgba(0,0,0,0.15);
  border-radius: 8px;
}

.dropdown-item:hover {
  background-color: rgba(0,123,255,0.1);
}
</style>