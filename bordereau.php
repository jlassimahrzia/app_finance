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

      if(isset($_POST['generer'])){
        if(isset($_POST['entreprise'])){
          $entreprise = $_POST['entreprise'];
          echo $entreprise;
        }
      }

      function calcul_nbrjr($debut,$fin){
        $date1 = new DateTime($debut);
        $date2= new DateTime($fin);
        $nbrjr = $date1->diff($date2);
        return $nbrjr->days ;
      }
      function calcul_escompte($valeur,$nbrjr){
        return ($valeur*9*$nbrjr)/36000 ;
      }
      function calcul_tva($comm){
        return $comm*0.18;
      }
      function choix_commission($lieu_effet,$banque_effet,$lieu_banque,$banque_entreprise){
        if($banque_effet==$banque_entreprise){
          if($lieu_effet==$lieu_banque){
            return 0.500;
          }
          else{
            return 2.000;
          }
        }
        else{
          if($lieu_effet==$lieu_banque){
            return 1.200;
          }
          else{
            return 3.000;
          }
        }
      }
      function nbrjour_banque($lieu_effet,$banque_effet,$lieu_banque,$banque_entreprise){
        if($banque_effet==$banque_entreprise){
          if($lieu_effet==$lieu_banque){
            return 2;
          }
          else{
            return 4;
          }
        }
        else{
          if($lieu_effet==$lieu_banque){
            return 4;
          }
          else{
            return 4;
          }
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
      <h1 class="sous-titre">Escompte | Bordereau</h1>
      <p>Permet de génèrer le bordereau d'escompte d'une sociéte xyz 
        dont leurs effets ont été négociés auprès d'une banque quelconque </p>
      <div>
      <p><b>Conditions d'escompte :</b></p>
      <ul>
        <li>Taux d'escompte est de 9%</li>
        <li>2 jours de banque pour les effets domiciliés sur place et 4 jours de banque sinon.</li>
      </ul>
      <p><b>La banque retient en plus des commissions fixes selon les modalités suivantes :</b></p>
      <ul>
        <li>Commission fixe effet sur place domicilié : 0.500 DT</li>
        <li>Commission fixe effet sur place non-domicilié : 1.200 DT</li>
        <li>Commission fixe effet déplacé domicilié : 2.000 DT</li>
        <li>Commission fixe effet déplacé non-domicilié : 3.000 DT</li>
      </ul>
      <p><b> Taux de la TVA est de 18% </b></p>
    <p class="titre2">Sélectionné l'entreprise à affichée son bordereau</p>
    <form method="post" action="bordereau.php">
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
            </div>
            <input type="submit" class="btn btn-primary" value="Générer" name="generer">
    </form>
    <br>
    <p class="titre2">Bordereau d'escompte</p>
    <table class="table table-bordered">
        <thead>
            <tr class="table-light">
                <th>Banque</th>
                <th colspan="8">
                  <?php 
                    if(isset($entreprise)) 
                        $sql= "SELECT * from entreprise where id='$entreprise'";
                        $rep=$db->query($sql);

                        $ligne = $rep->fetch() ;
                        echo $ligne['banque'];
                        
                  ?>
                </th>
            </tr> 
            <tr class="table-light">
                <th>Entreprise</th>
                <th colspan="8">
                   <?php if(isset($ligne)) echo $ligne['entreprise']; ?>
                </th>
            </tr> 
            <tr  class="table-primary">
                <th scope="col">Num d'effet</th>
                <th scope="col">Banque</th>
                <th scope="col">Valeur Nominal</th>
                <th scope="col">Echéance</th>
                <th scope="col">NBR des jours</th>
                <th scope="col">NbrJR de Banque</th>
                <th scope="col">Escompe</th>
                <th scope="col">CF</th>
                <th scope="col">TVA</th>
            </tr>
        </thead>
        <tbody>
           
            <?php
                  if(isset($entreprise)){
                    $sql="SELECT * FROM effet where id_entreprise='$entreprise'";
                    $rep= $db->query($sql);
                    $x=1;
                    $escompte=0;
                    $valeur=0;
                    $commission=0;
                    $tva=0;
                    while($ligne1 = $rep->fetch()){
                      echo '<tr>';
                      echo '<th scope="row">'.$x.'</th>';
                      echo '<td scope="col">'.$ligne1['banque'].'</td>';
                      $valeur+=$ligne1['valeur'];
                      echo '<td scope="col">'.$ligne1['valeur'].'</td>';
                      echo '<td scope="col">'.$ligne1['fin'].'</td>';
                      $nbr = calcul_nbrjr($ligne1['debut'],$ligne1['fin']);
                      echo '<td scope="col">'.$nbr.'</td>';
                      $nbr_b = nbrjour_banque($ligne1['lieu'],$ligne1['banque'],$ligne['lieu'],$ligne['banque']);
                      echo '<td scope="col">'.$nbr_b.'</td>';
                      $jr=$nbr+$nbr_b;
                      $escompte+=calcul_escompte($ligne1['valeur'],$jr);
                      echo '<td scope="col">'.calcul_escompte($ligne1['valeur'],$jr).'</td>';
                      $comm = choix_commission($ligne1['lieu'],$ligne1['banque'],$ligne['lieu'],$ligne['banque']);
                      $commission+=$comm;
                      echo '<td scope="col">'.$comm.'</td>';
                      $tva+=calcul_tva($comm);
                      echo '<td scope="col">'.calcul_tva($comm).'</td>';
                      echo '</tr>';
                      $x++;
                    }
                  }
            ?>
            <tr  class="table-primary">
                <th scope="col" colspan="2">Total</th>
                <th scope="col" colspan="4">Valeur Nominal</th>
                <th scope="col">Escompe</th>
                <th scope="col">CF</th>
                <th scope="col">TVA</th>
            </tr>
            <tr>
                <th scope="col" colspan="2">Total</th>
                <td scope="col" colspan="4"><?php if(isset($valeur)) echo $valeur;?></td>
                <td scope="col"><?php if(isset($escompte)) echo $escompte;?></td>
                <td scope="col"><?php if(isset($commission)) echo $commission;?></td>
                <td scope="col"><?php if(isset($tva)) echo $tva;?></td>
            </tr>
            <tr  class="table-primary">
                <th scope="col" colspan="9">Agios</th>
            </tr>
            <tr>
                <td scope="col" colspan="9">
                  <?php 
                    if(isset($escompte)&&isset($commission)&&isset($tva)) {
                      $agios=$escompte+$commission+$tva;
                      echo $agios;
                    }
                  ?>
                </td>
            </tr>
            <tr  class="table-primary">
                <th scope="col" colspan="9">Montant Net</th>
            </tr>
            <tr>
                <td scope="col" colspan="9">
                  <?php  
                      if(isset($agios)){
                          $total=$valeur-$agios;
                          echo $total;
                      }
                  ?>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    </div>
   



  <!-- Bootstrap core JavaScript -->
  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
</body>
</html>