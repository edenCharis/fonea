<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <!-- Section Title -->
    <li class="nav-header text-uppercase" style="color: #6c757d; font-weight: 600; font-size: 0.75rem; letter-spacing: 1px; margin-bottom: 10px;">
      <i class="fas fa-chart-line mr-2"></i>Gestion des Données
    </li>
     <li class="nav-item">
      <a href="/administrateur" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-book text-success"></i>
        <p  class="text-white">Journal d'actions
          <span class="badge badge-info right">{{$userCount ?? ''}}</span>
        </p>
      </a>
    </li>
    
    <!-- Users Management -->
    <li class="nav-item">
      <a href="users" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-users text-white"></i>
        <p class="text-white">Utilisateurs
          <span class="badge badge-info right">{{$userCount ?? ''}}</span>
        </p>
      </a>
    </li>
    
    <!-- ODS -->
    <li class="nav-item">
      <a href="/offre" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-briefcase text-success"></i>
        <p  class="text-white">ODS
        
        </p>
      </a>
    </li>
    
    <!-- Directions -->
    <li class="nav-item">
      <a href="/directions" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-user-tie text-warning"></i>
        <p  class="text-white">Directions
          <span class="right-icon">
            <i class="fas fa-sitemap text-muted"></i>
          </span>
        </p>
      </a>
    </li>
    
    <!-- Secteurs -->
    <li class="nav-item">
      <a href="/secteur" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-industry text-secondary"></i>
        <p  class="text-white">Secteurs
         
        </p>
      </a>
    </li>

    <!-- Section Title - Time Management -->
    <li class="nav-header text-uppercase" style="color: #6c757d; font-weight: 600; font-size: 0.75rem; letter-spacing: 1px; margin: 15px 0 10px 0;">
      <i class="fas fa-clock mr-2"></i>Gestion Temporelle
    </li>
    
    <!-- Année -->
    <li class="nav-item">
      <a href="/annee" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-calendar text-danger"></i>
        <p  class="text-white">Année
          <span class="badge badge-outline-primary right">2025</span>
        </p>
      </a>
    </li>
    
    <!-- Trimestre -->
    <li class="nav-item">
      <a href="/trimestre" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-calendar-alt text-info"></i>
        <p  class="text-white">Trimestre
          
        </p>
      </a>
    </li>

    <!-- Section Title - Professional Data -->
    <li class="nav-header text-uppercase" style="color: #6c757d; font-weight: 600; font-size: 0.75rem; letter-spacing: 1px; margin: 15px 0 10px 0;">
      <i class="fas fa-briefcase mr-2"></i>Données Professionnelles
    </li>
    
    <!-- Métier -->
    <li class="nav-item">
      <a href="/metier" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-hammer text-red"></i>
        <p  class="text-white">Métier
          
        </p>
      </a>
    </li>
    
    <!-- Qualification -->
    <li class="nav-item">
      <a href="/qualification" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-graduation-cap text-success"></i>
        <p  class="text-white" >Qualification
         
        </p>
      </a>
    </li>
    
    <!-- Compétence -->
    <li class="nav-item">
      <a href="/competence" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-lightbulb text-warning"></i>
        <p  class="text-white">Compétence
         
        </p>
      </a>
    </li>

    <!-- Divider -->
    <li class="nav-item">
      <hr class="sidebar-divider" style="border-color: rgba(255,255,255,0.1); margin: 20px 0;">
    </li>

    <!-- Section Title - Account -->
    <li class="nav-header text-uppercase" style="color: #6c757d; font-weight: 600; font-size: 0.75rem; letter-spacing: 1px; margin-bottom: 10px;">
      <i class="fas fa-user-circle mr-2"></i>Mon Compte
    </li>
    
    <!-- Profil -->
    <li class="nav-item">
      <a href="/profil" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-user-edit text-info"></i>
        <p  class="text-white">Mon profil
       
        </p>
      </a>
    </li>
    
    <!-- Logout -->
    <li class="nav-item">
      <a href="/logout" class="nav-link enhanced-nav-link logout-link" onclick="return confirm('Voulez-vous vraiment vous déconnecter?')">
        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
        <p  class="text-white">Déconnexion
         
        </p>
      </a>
    </li>
  </ul>
</nav>

<style>
/* Enhanced Navigation Links */
.enhanced-nav-link {
  border-radius: 8px !important;
  margin: 2px 8px;
  padding: 10px 15px !important;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.enhanced-nav-link:hover {
  background: linear-gradient(135deg, rgba(0,123,255,0.1), rgba(0,123,255,0.05)) !important;
  transform: translateX(3px);
  box-shadow: 0 3px 10px rgba(0,123,255,0.2);
}

.enhanced-nav-link.active {
  background: linear-gradient(135deg, #007bff, #0056b3) !important;
  color: white !important;
}

/* Active link indicator */
.enhanced-nav-link::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  height: 100%;
  width: 0;
  background: linear-gradient(135deg, #007bff, #0056b3);
  transition: width 0.3s ease;
}

.enhanced-nav-link.active::before,
.enhanced-nav-link:hover::before {
  width: 4px;
}

/* Icon styling */
.nav-icon {
  font-size: 1.1rem !important;
  width: 20px !important;
  text-align: center;
  margin-right: 10px !important;
}

/* Right icons and badges */
.right-icon {
  float: right;
  transition: all 0.3s ease;
}

.enhanced-nav-link:hover .right-icon {
  transform: scale(1.1);
}

/* Badge styling */
.badge.right {
  float: right;
  margin-top: 3px;
}

.badge-outline-primary {
  color: #007bff;
  border: 1px solid #007bff;
  background: transparent;
  font-size: 0.65rem;
}

/* Section headers */
.nav-header {
  padding: 8px 15px 5px 15px !important;
  font-weight: 600 !important;
  border-bottom: 1px solid rgba(255,255,255,0.05);
}

/* Logout special styling */
.logout-link:hover {
  background: linear-gradient(135deg, rgba(220,53,69,0.1), rgba(220,53,69,0.05)) !important;
  box-shadow: 0 3px 10px rgba(220,53,69,0.2);
}

.logout-link::before {
  background: linear-gradient(135deg, #dc3545, #c82333) !important;
}

/* Sidebar divider */
.sidebar-divider {
  margin: 15px 0;
  border: none;
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .enhanced-nav-link {
    margin: 1px 4px;
    padding: 8px 12px !important;
  }
  
  .nav-header {
    padding: 6px 12px 3px 12px !important;
    font-size: 0.7rem !important;
  }
}

/* Animation for active page detection */
.nav-link.active .nav-icon {
  animation: pulse-icon 2s infinite;
}

@keyframes pulse-icon {
  0% { transform: scale(1); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

/* Statistics-themed colors for different sections */
.nav-item:nth-child(2) .enhanced-nav-link:hover { border-left: 3px solid #007bff; }
.nav-item:nth-child(3) .enhanced-nav-link:hover { border-left: 3px solid #28a745; }
.nav-item:nth-child(4) .enhanced-nav-link:hover { border-left: 3px solid #ffc107; }
.nav-item:nth-child(5) .enhanced-nav-link:hover { border-left: 3px solid #6c757d; }
</style>