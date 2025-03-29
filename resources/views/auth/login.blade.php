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
<body class="hold-transition login-page">
<div class="login-box">
 

  <div class="card">
  <div class="login-logo">
<img src="images/ico.png" width="150" height="100" alt="">
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
        <span class="fas fa-lock"></span>
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
      </form>

      <p class="mb-0">
        <a href="{{ route("register") }}" class="text-center">Créer un compte</a>
      </p>
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
</body>
</html>
