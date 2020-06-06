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
         
        if(empty($_POST['valeur'])){
          $valide=false;
          $errvaleur="Enter la Valeur Nominal";
        }
        else{
          $valeur=$_POST['valeur'];
        }
        if(empty($_POST['date_debut'])){
          $valide=false;
          $errdate_debut="Enter la date debut";
        }
        else{
          $date_debut=$_POST['date_debut'];
        }
        if(empty($_POST['date_fin'])){
          $valide=false;
          $errdate_fin="Entrer la date d'échéance";
        }
        else{
          $date_fin=$_POST['date_fin'];
        }
        if(empty($_POST['banque'])){
          $valide=false;
          $errbanque="Entrer la banque domiciliatrice";
        }
        else{
          $banque=$_POST['banque'];
        }
        if(empty($_POST['lieu'])){
          $valide=false;
          $errlieu="Entrer le lieu de paiement";
        }
        else{
          $lieu=$_POST['lieu'];
        }
        
        if($valide){
          $requete = "INSERT INTO effet(id_entreprise, valeur, debut, fin, banque, lieu) VALUES ($entreprise,$valeur,'$date_debut',
          '$date_fin','$banque','$lieu') ";
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
      <h1 class="sous-titre">Escompte | Ajout Effet</h1>
      <p>Permet de génèrer le bordereau d'escompte d'une sociéte xyz 
        dont leurs effets ont été négociés auprès d'une banque quelconque </p>
      <div>
      <?php
        if(isset($ok)) echo '<div class="alert alert-success" role="alert">'.$ok."</div>";
      ?>
    <p class="titre2">Ajout d'un effet</p>
      <form method="post" action="effet.php">
          <div class="form-group">
              <label for="entreprise"  class="label">Entreprise</label>
              <select class="form-control" id="entreprise" name="entreprise">
                <?php
                   $sql = 'SELECT * FROM entreprise';
                   $req = $db->query($sql);
           
                   while ($ligne = $req->fetch()) {
                      echo '<option value="'.$ligne['id'].'">'.$ligne['entreprise'].'</option>';
                   }
                ?>
              </select>
              <?php
                if(isset($errentreprise)) echo '<small class="form-text text-muted">'.$errentreprise.'</small>';
              ?>
            </div>
            <div class="form-group">
              <label for="valeur" class="label">Valeur Nominal</label>
              <input type="number" class="form-control" id="valeur" name="valeur" placeholder="Enter la Valeur Nominal">
              <?php
                if(isset($errvaleur)) echo '<small class="form-text text-muted">'.$errvaleur.'</small>';
              ?>
            </div>
            <div class="form-group">
                <label for="date_debut"  class="label">Date début</label>
                <input type="date" class="form-control" id="date_debut" name="date_debut" placeholder="Entrer la date début">
                <?php
                if(isset($errdate_debut)) echo '<small class="form-text text-muted">'.$errdate_debut.'</small>';
              ?>
            </div>
            <div class="form-group">
              <label for="date_fin"  class="label">Date d'échéance</label>
              <input type="date" class="form-control" id="date_fin" name="date_fin" placeholder="Entrer la date d'échéance">
              <?php
                if(isset($errdate_fin)) echo '<small class="form-text text-muted">'.$errdate_fin.'</small>';
              ?>
            </div>
            <div class="form-group">
              <label for="banque"  class="label">Banque domiciliatrice</label>
              <input type="text" class="form-control" id="banque" name="banque" placeholder="Entrer la banque domiciliatrice">
              <?php
                if(isset($errbanque)) echo '<small class="form-text text-muted">'.$errbanque.'</small>';
              ?>
            </div>
            <div class="form-group">
              <label for="lieu"  class="label">Lieu de paiement</label>
              <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Entrer le lieu de paiement">
              <?php
                if(isset($errlieu)) echo '<small class="form-text text-muted">'.$errlieu.'</small>';
              ?>
            </div>
            <input type="submit" class="btn btn-primary" value="Ajouter" name="ajout">
        </form>
        </div>
        <br>
    </div>
   



  <!-- Bootstrap core JavaScript -->
  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
</body>
</html>