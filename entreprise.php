<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculatrice | Escompte</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/scrolling-nav.css">
    <link rel="stylesheet" href="css/style.css">
    <?php
       //Les paramètres de connexion
       $DB_host = "localhost";
       $DB_user = "root";
       $DB_pass = "";
       $DB_name = "finance";

       try {
           //ON crée une nouvelle connexion
           $db = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
       } catch(PDOException $e) {
           echo $e->getMessage();
       }
       $valide=true ;
       if(isset($_POST['ajout'])){
         if(empty($_POST['entreprise'])){
           $valide=false;
           $errentreprise="Enter le nom de l'entreprise";
         }
         else{
           $entreprise=$_POST['entreprise'];
         }
         if(empty($_POST['banque'])){
          $valide=false;
          $errbanque="Entrer le nom de la banque";
        }
        else{
          $banque=$_POST['banque'];
        }
        if(empty($_POST['lieu'])){
          $valide=false;
          $errlieu="Entrer le lieu de la banque";
        }
        else{
          $lieu=$_POST['lieu'];
        }
        
        if($valide){
          $requete = "INSERT INTO entreprise (entreprise, banque, lieu) VALUES ('$entreprise','$banque', '$lieu')";
          $db->exec($requete);
          $ok="Ajout avec succée";
        }
       }
    ?>
</head>
<body>
   <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #00b6de;"  id="mainNav">
    <div class="container  ">
      <a class="navbar-brand js-scroll-trigger text-white" href="#page-top">Calculatrice</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger text-white" href="index.php">Intérêts Simple</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger text-white" href="compose.php">Intérêts Composé</a>
          </li>
          
          <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Escompte
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="entreprise.php">Ajout entreprise</a>
                  <a class="dropdown-item" href="effet.php">Ajout effet</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="bordereau.php">bordereau</a>
                </div>
            </li>
        </ul>
      </div>
    </div>
  </nav>

    <div class="header ">
      <p class="titre">Calculatrice</p>
      <h1 class="sous-titre">Escompte | Identifier Entreprise</h1>
      <p>Permet de génèrer le bordereau d'escompte d'une sociéte xyz 
        dont leurs effets ont été négociés auprès d'une banque quelconque </p>
      <div>
      <?php
        if(isset($ok)) echo '<div class="alert alert-success" role="alert">'.$ok."</div>";
      ?>
    <p class="titre2">Entrez le nom de l'entreprise et la banque</p>
      <form method="post" action="entreprise.php">
            <div class="form-group">
              <label for="entreprise" class="label">Nom de l'entreprise</label>
              <input type="text" class="form-control" id="entreprise" name="entreprise" placeholder="Enter le nom de l'entreprise">
              <?php
                if(isset($errentreprise)) echo '<small class="form-text text-muted">'.$errentreprise.'</small>';
              ?>
            </div>
            <div class="form-group">
              <label for="banque"  class="label">Nom de la banque</label>
              <input type="text" class="form-control" id="banque" name="banque"placeholder="Entrer le nom de la banque">
              <?php
                if(isset($errbanque)) echo '<small class="form-text text-muted">'.$errbanque.'</small>';
              ?>
            </div>
            <div class="form-group">
              <label for="lieu"  class="label">Lieu de la banque</label>
              <input type="text" class="form-control" id="lieu" name="lieu"placeholder="Entrer le lieu de la banque">
              <?php
                if(isset($errlieu)) echo '<small class="form-text text-muted">'.$errlieu.'</small>';
              ?>
            </div>
            <input type="submit" class="btn btn-primary" value="Ajout" name="ajout">
        </form>
        <br>
    </div>
   



  <!-- Bootstrap core JavaScript -->
  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
</body>
</html>