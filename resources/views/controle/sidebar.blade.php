
<nav class="mt-2 full-height-nav">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <!-- Section Title - Formation -->
    <li class="nav-header text-uppercase" style="color: #6c757d; font-weight: 600; font-size: 0.75rem; letter-spacing: 1px; margin-bottom: 10px;">
      <i class="fas fa-graduation-cap mr-2"></i>Contrôle & PLANNING
    </li>
    
     <li class="nav-item">
            <a href="/controle" class="nav-link enhanced-nav-link">
            <i class="nav-icon fas fa-book text-warning"></i>

              <p>
              Planning d'activités
              
              </p>
            </a>
           
          </li>
    
     <li class="nav-item">
            <a href="/activite" class="nav-link enhanced-nav-link">
            <i class="nav-icon fas fa-calendar-alt text-success"></i>

              <p>
              Activités Realisées
              
              </p>
            </a>
           
          </li>
    
  
       
     
    <!-- Section Title - Développement Professionnel -->
   
    
    <!-- Divider -->
    <li class="nav-item">
      <hr class="sidebar-divider" style="border-color: rgba(255,255,255,0.1); margin: 20px 0;">
    </li>
    
    <!-- Section Title - Mon Compte -->
    <li class="nav-header text-uppercase" style="color: #6c757d; font-weight: 600; font-size: 0.75rem; letter-spacing: 1px; margin-bottom: 10px;">
      <i class="fas fa-user-circle mr-2"></i>Mon Compte
    </li>
    
    <li class="nav-item">
      <a href="/compte" class="nav-link enhanced-nav-link">
        <i class="nav-icon fas fa-user text-info"></i>
        <p>Mon compte
          
        </p>
      </a>
    </li>
    
    <li class="nav-item">
      <a href="/logout" class="nav-link enhanced-nav-link logout-link" onclick="return confirm('Voulez-vous vraiment vous déconnecter?')">
        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
        <p>Déconnexion</p>
      </a>
    </li>
  </ul>
</nav>

<style>

    /* CRITICAL: Full height navigation container */
    .full-height-nav {
        height: 100vh !important;
        min-height: 100vh !important;
        display: flex !important;
        flex-direction: column !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }

    /* Container fixes to prevent horizontal scrollbar */
    .nav-sidebar {
        overflow-x: hidden !important;
        max-width: 100%;
        height: 100% !important;
        min-height: 100% !important;
        padding: 0 !important;
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .nav-sidebar ul {
        width: 100%;
        height: 100% !important;
        min-height: 100% !important;
        padding: 0;
        margin: 0;
        overflow-x: hidden;
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .nav-sidebar .nav-item {
        width: 100%;
        overflow-x: hidden;
        flex-shrink: 0;
    }

    /* Add a spacer to push content to fill remaining space */
    .nav-sidebar ul::after {
        content: '';
        flex: 1;
        min-height: 50px;
    }

    /* Enhanced Navigation Links */
    .enhanced-nav-link {
        border-radius: 8px !important;
        margin: 2px 8px !important;
        padding: 10px 15px !important;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: block !important;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: none !important;
        width: auto !important;
        color: #c2c7d0 !important;
    }

    .enhanced-nav-link:hover {
        background: linear-gradient(135deg, rgba(0,123,255,0.1), rgba(0,123,255,0.05)) !important;
        transform: translateX(3px);
        box-shadow: 0 3px 10px rgba(0,123,255,0.2);
        color: #fff !important;
        text-decoration: none !important;
    }

    .enhanced-nav-link.active {
        background: linear-gradient(135deg, #007bff, #0056b3) !important;
        color: white !important;
    }

    /* Submenu Links */
    .enhanced-sub-link {
        border-radius: 6px !important;
        margin: 1px 8px 1px 20px !important;
        padding: 8px 12px !important;
        transition: all 0.3s ease;
        position: relative;
        font-size: 0.9rem;
        display: block !important;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        max-width: none !important;
        width: auto !important;
    }

    .enhanced-sub-link:hover {
        background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(40,167,69,0.05)) !important;
        transform: translateX(2px);
        box-shadow: 0 2px 8px rgba(40,167,69,0.2);
    }

    .enhanced-sub-link.active {
        background: linear-gradient(135deg, #28a745, #1e7e34) !important;
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

    .enhanced-sub-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 0;
        background: linear-gradient(135deg, #28a745, #1e7e34);
        transition: width 0.3s ease;
    }

    .enhanced-sub-link.active::before,
    .enhanced-sub-link:hover::before {
        width: 3px;
    }

    /* Icon styling */
    .nav-icon {
        font-size: 1.1rem !important;
        width: 20px !important;
        text-align: center;
        margin-right: 10px !important;
        flex-shrink: 0;
    }

    /* Right icons and badges */
    .right-icon {
        float: right;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .enhanced-nav-link:hover .right-icon {
        transform: scale(1.1);
    }

    /* Badge styling */
    .badge.right {
        float: right;
        margin-top: 3px;
        flex-shrink: 0;
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
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        color: #6c757d !important;
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

    /* Treeview styling */
    .nav-treeview {
        background: rgba(0,0,0,0.1);
        border-radius: 0 8px 8px 0;
        margin: 0 8px !important;
        padding: 5px 0;
        border-left: 2px solid rgba(0,123,255,0.2);
        overflow-x: hidden;
    }

    /* Text content handling */
    .enhanced-nav-link p,
    .enhanced-sub-link p {
        margin: 0 !important;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .enhanced-nav-link {
            margin: 1px 4px !important;
            padding: 8px 12px !important;
        }
        
        .enhanced-sub-link {
            margin: 1px 4px 1px 16px !important;
            padding: 6px 10px !important;
        }
        
        .nav-header {
            padding: 6px 12px 3px 12px !important;
            font-size: 0.7rem !important;
        }
        
        .nav-treeview {
            margin: 0 4px !important;
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
/* CRITICAL: Full height navigation container */
.full-height-nav {
    height: 100vh !important;
    min-height: 100vh !important;
    display: flex !important;
    flex-direction: column !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
}

/* Container fixes to prevent horizontal scrollbar */
.nav-sidebar {
    overflow-x: hidden !important;
    max-width: 100%;
    height: 100% !important;
    min-height: 100% !important;
    padding: 0 !important;
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
}

.nav-sidebar ul {
    width: 100%;
    height: 100% !important;
    min-height: 100% !important;
    padding: 0;
    margin: 0;
    overflow-x: hidden;
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
}

.nav-sidebar .nav-item {
    width: 100%;
    overflow-x: hidden;
    flex-shrink: 0;
}

/* Add a spacer to push content to fill remaining space */
.nav-sidebar ul::after {
    content: '';
    flex: 1;
    min-height: 50px;
}

/* Enhanced Navigation Links */
.enhanced-nav-link {
    border-radius: 8px !important;
    margin: 2px 8px !important;
    padding: 10px 15px !important;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    display: block !important;
    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: none !important;
    width: auto !important;
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

/* Submenu Links */
.enhanced-sub-link {
    border-radius: 6px !important;
    margin: 1px 8px 1px 20px !important;
    padding: 8px 12px !important;
    transition: all 0.3s ease;
    position: relative;
    font-size: 0.9rem;
    display: block !important;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    max-width: none !important;
    width: auto !important;
}

.enhanced-sub-link:hover {
    background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(40,167,69,0.05)) !important;
    transform: translateX(2px);
    box-shadow: 0 2px 8px rgba(40,167,69,0.2);
}

.enhanced-sub-link.active {
    background: linear-gradient(135deg, #28a745, #1e7e34) !important;
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

.enhanced-sub-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 0;
    background: linear-gradient(135deg, #28a745, #1e7e34);
    transition: width 0.3s ease;
}

.enhanced-sub-link.active::before,
.enhanced-sub-link:hover::before {
    width: 3px;
}

/* Icon styling */
.nav-icon {
    font-size: 1.1rem !important;
    width: 20px !important;
    text-align: center;
    margin-right: 10px !important;
    flex-shrink: 0;
}

/* Right icons and badges */
.right-icon {
    float: right;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.enhanced-nav-link:hover .right-icon {
    transform: scale(1.1);
}

/* Badge styling */
.badge.right {
    float: right;
    margin-top: 3px;
    flex-shrink: 0;
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
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
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

/* Treeview styling */
.nav-treeview {
    background: rgba(0,0,0,0.1);
    border-radius: 0 8px 8px 0;
    margin: 0 8px !important;
    padding: 5px 0;
    border-left: 2px solid rgba(0,123,255,0.2);
    overflow-x: hidden;
}

/* Text content handling */
.enhanced-nav-link p,
.enhanced-sub-link p {
    margin: 0 !important;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .enhanced-nav-link {
        margin: 1px 4px !important;
        padding: 8px 12px !important;
    }
    
    .enhanced-sub-link {
        margin: 1px 4px 1px 16px !important;
        padding: 6px 10px !important;
    }
    
    .nav-header {
        padding: 6px 12px 3px 12px !important;
        font-size: 0.7rem !important;
    }
    
    .nav-treeview {
        margin: 0 4px !important;
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
