<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FONEA | Connexion</title>
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" type="image/png" href="images/images.png">
</head>
<body class="hold-transition login-page" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: relative;">
<!-- Floating Statistical Elements -->
<div class="floating-stats">
  <!-- Chart Icons -->
  <div class="stat-element" style="position: absolute; top: 10%; left: 10%; animation: float 6s ease-in-out infinite;">
    <i class="fas fa-chart-line text-danger" style="font-size: 3.5rem; color: rgba(255,255,255,0.15);"></i>
  </div>
  <div class="stat-element" style="position: absolute; top: 20%; right: 15%; animation: float 8s ease-in-out infinite reverse;">
    <i class="fas fa-chart-pie text-warning" style="font-size: 3.2rem; color: rgba(255,255,255,0.12);"></i>
  </div>
  <div class="stat-element" style="position: absolute; bottom: 30%; left: 8%; animation: float 7s ease-in-out infinite;">
    <i class="fas fa-chart-bar text-dark" style="font-size: 3.8rem; color: rgba(255,255,255,0.1);"></i>
  </div>
  <div class="stat-element" style="position: absolute; bottom: 15%; right: 12%; animation: float 9s ease-in-out infinite reverse;">
    <i class="fas fa-analytics text-success" style="font-size: 3.4rem;"></i>
  </div>
  
  <!-- Geometric Shapes -->
  <div class="text-warning" style="position: absolute; top: 35%; left: 5%; width: 60px; height: 60px; border: 2px solid rgba(255,255,255,0.08); border-radius: 50%; animation: rotate 20s linear infinite;"></div>
  <div  class="text-danger"style="position: absolute; top: 60%; right: 8%; width: 40px; height: 40px; background: rgba(255,255,255,0.05); transform: rotate(45deg); animation: float 12s ease-in-out infinite;"></div>
  <div  class="text-dark" style="position: absolute; bottom: 45%; left: 15%; width: 2px; height: 80px; background: linear-gradient(to bottom, rgba(255,255,255,0.1), transparent); animation: pulse 4s ease-in-out infinite;"></div>
  
  <!-- Data Points -->
  <div style="position: absolute; top: 25%; left: 25%; display: flex; gap: 8px; animation: float 10s ease-in-out infinite;">
    <div  class="text-success" style="width: 8px; height: 8px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
    <div  class="text-danger" style="width: 8px; height: 15px; background: rgba(255,255,255,0.08); border-radius: 2px;"></div>
    <div  class="text-warning" style="width: 8px; height: 12px; background: rgba(255,255,255,0.09); border-radius: 2px;"></div>
  </div>
</div>

<div class="login-box">     
  <div class="card" style="box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-radius: 15px; border: none;">
    <div class="login-logo"> 
      <img src="images/logo.png" width="150" height="150" alt="">
      <!-- Slogan ajouté -->
      <p class="text-muted  text-success mt-1 mb-0" style="font-size: 14px; font-style: italic; color: #6c757d !important;">
        Transformez vos chiffres en décisions
      </p>
    </div>
    
    <div class="card-body login-card-body">         
      <p class="login-box-msg">Connectez vous pour commencer une session</p>
             
      <form action="{{ route('login')}}" method="POST">
        @csrf
        @if (session('correct')):         
          <div class="text-success">                
            {{ session('correct')}}         
          </div>
        @endif
        
        <div class="form-group"> 
          <div class="form-group">   
            <div class="input-group">    
              <input       
                type="email"       
                id="email"       
                class="form-control @error('email') is-invalid @enderror"       
                name="email"       
                placeholder="Email"       
                value="{{ old("email")}}"    
              >    
              <div class="input-group-append">      
                <div class="input-group-text">        
                  <span class="fas fa-envelope"></span>      
                </div>    
              </div>      
            </div>   
            <!-- Error Message -->  
            @error('email')  
            <div class="text-danger mt-2">{{ $message }}</div>  
            @enderror
          </div>
         
          <div class="form-group">  
            <!-- Input + Icon -->  
            <div class="input-group">    
              <input       
                type="password"       
                id="password"       
                class="form-control @error('password') is-invalid @enderror "       
                name="password"       
                value="{{ old("password")}}"      
                placeholder="Mot de passe"    
              >    
              <div class="input-group-append">      
                <div class="input-group-text">              
                </div>      
                <div class="input-group-text">      
                  <span class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></span>    
                </div>    
              </div>     
            </div>   
            <!-- Error Message -->  
            @error('password')  
            <div class="text-danger mt-2">{{ $message }}</div>  
            @enderror
          </div>
         
          <div class="row">                   
            <!-- /.col -->          
            <div class="col-12">            
              <button type="submit" class="btn btn-success btn-block"> <i class="fas fa-sign-in-alt"></i> Se connecter</button>          
            </div>          
            <!-- /.col -->        
          </div>
        </div>
      </form>          
    </div>    
    <!-- /.login-card-body -->  
  </div>
</div>
<!-- /.login-box --> 

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>  
  document.addEventListener('DOMContentLoaded', function () {    
    const togglePassword = document.getElementById('togglePassword');    
    const passwordInput = document.getElementById('password');     
    
    togglePassword.addEventListener('click', function () {      
      // Toggle password visibility      
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';      
      passwordInput.setAttribute('type', type);       
      
      // Toggle the eye icon      
      this.classList.toggle('fa-eye');      
      this.classList.toggle('fa-eye-slash');    
    });  
  });
</script>

<style>
/* Floating animations */
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

@keyframes rotate {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

@keyframes pulse {
  0%, 100% { opacity: 0.1; }
  50% { opacity: 0.3; }
}

/* Additional statistical elements */
.floating-stats::before {
  content: '';
  position: absolute;
  top: 15%;
  right: 25%;
  width: 100px;
  height: 2px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
  animation: pulse 6s ease-in-out infinite;
}

.floating-stats::after {
  content: '📊 📈 📉 📋';
  position: absolute;
  bottom: 20%;
  left: 20%;
  font-size: 1.5rem;
  opacity: 0.08;
  animation: float 15s ease-in-out infinite;
  letter-spacing: 20px;
}

/* Enhanced card styling */
.card {
  backdrop-filter: blur(10px);
  background: rgba(255,255,255,0.95) !important;
}

.login-logo {
  background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
  border-radius: 15px 15px 0 0;
  padding: 20px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .stat-element {
    display: none;
  }
}
</style>

</body>
</html>