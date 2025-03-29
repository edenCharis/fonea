<?php 

include "../../php/connexion.php";

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Impression de la Liste des Crédits</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Inclure les liens vers les fichiers CSS d'AdminLTE et d'autres dépendances -->
</head>
<body>
  <div class="wrapper">
    <div class="invoice">
    <header class="main-header">
      <h1>Fonds National d'Appui à l'Employabilité et à l'Apprentissage</h1>
      <h3><?php echo $_SESSION['agence'];?></h3> <!-- Ajout du nom de l'agence -->
    </header>

    <!-- Contenu principal -->
    <div class="content-wrapper">
      <!-- Titre de la page -->
      <section class="content-header">
        <h1>Liste des crédits</h1>
      </section>

      <!-- Tableau des crédits -->
      <section class="content">
         <h3><?php echo $_SESSION['agence'];?></h3> 
         <table id="example1" class="table table-bordered table-hover">
                                     <thead>
                                       <tr>
                                        
                                         <th>Date</th>
                                         <th>Motif</th>
                                         <th>N° Approvisionnement</th>
                                         <th>Montant</th>
                                        
                                       </tr>
                                     </thead>
                                     <tbody>
                                     <?php 
                                     
                                     
                                     $query = "SELECT * FROM credit where caisse =".getCaisseId($_SESSION['agence'])."";
                                     $stmt = $pdo->prepare($query);
                                     $stmt->execute();
                                     
                                     
                                     $debits = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   
                                         foreach($debits as $debit){
                                     ?>
                   
                                       <tr>
                                      
                                       <td><?php echo $debit['date_credit'];?></td>
                                       <td><?php echo $debit['motif_credit'];?></td>
                                       <td><?php   if($debit['approvisionnement'] !== null){
                                                 echo $debit['approvisionnement'];
                                       }else{
                                        echo "//";
                                       };?></td>
                                       <td><?php echo $debit['montant_credit'];?></td>
                                      
                                       
                                       </tr>
                   
                                       <?php } ?>
                                     
                                     </tbody>
                                   </table>
      </section>
    </div>

    <!-- Pied de page -->
    <footer class="main-footer">
      <p>Date de l'impression : <span id="print-date"></span></p>
    </footer>
    </div>
    <!-- En-tête -->
  
  </div>

  <!-- Inclure les liens vers les fichiers JavaScript d'AdminLTE et d'autres dépendances -->

  <!-- Script pour mettre à jour la date de l'impression -->
  <script>
    const printDateElement = document.getElementById('print-date');
    const currentDate = new Date();
    printDateElement.textContent = currentDate.toLocaleDateString();

    window.onload = function() {
      window.print();
    };
  </script>
</body>
</html>
