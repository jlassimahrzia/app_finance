<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Calculatrice | Intérêts Simple</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/scrolling-nav.css">
    <link rel="stylesheet" href="css/style.css">
    <?php
       function calcul_interet_simple($montant,$taux,$duree){
          $interet = $montant - ($montant*pow(1+$taux,$duree));
          return $interet;
       }
       $valide=true ;
       if(isset($_POST['calculer'])){
        if(empty($_POST['montant'])){
           $valide=false;
           $errmontant="Il faut spécifiée le montant";
         }
        else{
            $montant = $_POST['montant'];
         }
        if(empty($_POST['taux'])){
          $valide=false;
          $errtaux="Il faut spécifiée le taux";
         }
        else{
            $taux = $_POST['taux'];
        }
        
        if(empty($_POST['duree'])){
            //$valide=false;
            $errduree="Il faut spécifiée la durée et l'unité";
          }
          else{
            $duree = $_POST['duree'];
            $unite= $_POST['temps'];
            if($unite=="2"){
              $duree=$duree/12;
              //$ok=true;
            }
            else if($unite=="3"){
              $duree=$duree/360;
              //$ok=true;
            }
          }
        
        if(empty($_POST['date1'])&&empty($_POST['date2'])){
            //$valide=false;
            $errduree="Il faut spécifiée la durée et l'unité";
          }
          else{
            $date1 = new DateTime($_POST['date1']);
            $date2= new DateTime($_POST['date2']);
            $nbrjr = $date1->diff($date2);
            $duree=$nbrjr->days/360;
            //$ok=true ;
          }
        if(!isset($duree)){
          $valide=false;
        }
        if($valide){
          $res = calcul_interet_simple($montant,$taux,$duree);
        }
        else{
          echo  "non" ;
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
      <h1 class="sous-titre">Intérêts Composé</h1>
      <p>Calculez combien un placement peut vous rapporter à une durée donnée grâce aux intérêts composé.</p>
      <div>
      <?php
          if(isset($res)){
            echo '<div class="alert alert-primary" role="alert">
            <p>l'."'interet produit est ".$res." Dinars</p></div>";
          }
        ?>
      <form method="post" action="compose.php">
            <div class="form-group">
              <label for="montant" class="label">Montant Initial de placement</label>
              <input type="text" class="form-control" id="montant" name="montant" placeholder="Enter le montant initial">
              <?php
                if(isset($errmontant)) echo '<small class="form-text text-muted">'.$errmontant.'</small>';
              ?>
            </div>
            <div class="form-group">
              <label for="taux"  class="label">Taux bancaire de placement</label>
              <input type="text" class="form-control" id="duree" name="taux"placeholder="Entrer le taux de placement">
              <?php
                if(isset($errtaux)) echo '<small class="form-text text-muted">'.$errtaux.'</small>';
              ?>
            </div>
            <p> <u> Donnez la durée </u></p>
            <div class="form-group">
              <label for="duree"  class="label">Durée de placement</label>
              <input type="text" class="form-control" id="duree" name="duree"placeholder="Entrer la duree de placement">
            
            </div>
            <div class="form-group">
              <label for="temps"  class="label">Unité de temps</label>
              <select class="form-control" id="temps" name="temps">
                <option value="1">Année</option>
                <option value="2">Mois</option>
                <option value="3">Jours</option>
              </select>
              <?php
                if(isset($errduree)) echo '<small class="form-text text-muted">'.$errduree.'</small>';
              ?>
            </div>
            <p> <u> Ou bien précisé la date d'affectation et la date de remboursement du placement </u></p>
            <div class="form-group">
              <label for="date1"  class="label">date d'affectation de placement</label>
              <input type="date" class="form-control" id="date1" name="date1" placeholder="date d'affectation de placement">
            </div>
            <div class="form-group">
              <label for="date2"  class="label">date de remboursement</label>
              <input type="date" class="form-control" id="date2" name="date2" placeholder="date de remboursement de placement">
              <?php
                if(isset($errduree)) echo '<small class="form-text text-muted">'.$errduree.'</small>';
              ?>
            </div>
            <input type="submit" class="btn btn-primary" name="calculer" value="Calculer">
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