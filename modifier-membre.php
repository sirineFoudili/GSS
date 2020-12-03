<?php
$bdd= new PDO("mysql:host=localhost;dbname=gss;charset=utf8","root","");
$conn = mysqli_connect("localhost", "root", "", "gss"); 

$id = $_GET['mm'];
$sql = 'SELECT * FROM `membre` WHERE `idmembre`=:id';
$statement = $bdd->prepare($sql);
$statement->execute([':id' => $id]);
$mem = $statement->fetch(PDO::FETCH_OBJ);
##########################################

if (isset($_POST['modc'])) {

if(!empty(trim($_POST['id']))){

$requete=$bdd->prepare('UPDATE `membre` SET `idmembre`=?, `nom`=?, `motdepasse`=?  WHERE `idmembre`=?');
$requete->execute(array($_POST['id'],$_POST['nom'],$_POST['mdp'],$id));
$requete1=$requete->fetch();
echo '<script>alert("la modification est bien effectuée");</script>';
}

 if (isset($_POST['id'])) {
$query ="SELECT * FROM `membre` WHERE `idmembre`='".$_POST['id']."'";
$stat = $bdd->query($query);
$tab = $stat->fetchAll ();
foreach($tab as $row)
{
$v=$row["groupepartage_idgrppartage"];
}
header("Location:membre.php?mem=$v");}
else{
  $query ="SELECT * FROM `membre` WHERE `idmembre` ='".$_GET['mm']."'";
$stat = $bdd->query($query);
$tab = $stat->fetchAll ();
foreach($tab as $row)
{
$v=$row["groupepartage_idgrppartage"];
}
header("Location:membre.php?mem=$v");
}
}
?> 
<!DOCTYPE html>
<html style="font-size: 85%;">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>GSS</title>

        <link href="css1/bootstrap1.css" rel="stylesheet" />
        <link href="css1/style1.css" rel="stylesheet" />
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,500,500italic,700,900">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/templatemo-misc.css">
        <link rel="stylesheet" href="css/templatemo-style0.css"> 
        <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link href="js1/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
         <style type="text/css">
               a.btn-left, .top-header .social-top ul li a, .main-header .menu-wrapper a.toggle-menu {
                                    border: 2px solid #5E7D7E;
                                    border-radius: 40%;}
        </style>
         
</head>

<body>
       
       <section id="pageloader">
            <div class="loader-item fa fa-spin colored-border"></div>
        </section> 

    <header class="site-header container-fluid">
            <div class="top-header">
                
               <div style="padding: 5px 0 5px 5px;">   <img src="images/logo.png" width="100px" height="100px"   ></div>
              
               <div class="social-top" col-md-6 col-sm-6>
                    <ul>
                        <?php  
$query ="SELECT * FROM `membre` WHERE `idmembre` ='".$_GET['mm']."'";
$stat = $bdd->query($query);
$tab = $stat->fetchAll ();
foreach($tab as $row)
{
$n=$row["groupepartage_idgrppartage"];
}  echo '<li style="margin-right:3px;"><a href="membre.php?mem='.$n.'" class="fa fa-angle-left" title="Précédent" ></a></li>';
                      session_start();
                      $r=session_id();
     if (strcmp( $_SESSION['type'], "Admin") == 0) {
          echo '<li style="margin-right:3px;"><a href="interfaceadmin.php" class="fa fa-home" title="Accueil"></a></li>';
          echo '<li><a href="liste-compte.php" class="fa fa-users" title="Comptes"></a></li>';

            }
      if (strcmp( $_SESSION['type'], "User") == 0) {
          echo '<li><a href="interfaceuser.php" class="fa fa-home" title="Accueil" ></a></li>';
            }
           
    ?>
                        <li><a href="profile.php" class="fa fa-user" title="Profile"></a></li>
                        <li><a href="msg.php" class="fa fa-envelope" title="G-mail"></a></li>
                        <li><a href="statistiques.php" class="fa fa-signal" title="Statistiques"></a></li>
                        <li><a href="deconecte.php" class="fa fa-sign-out" title="Déconnexion"></a></li>
                    </ul>
                </div> 
                </div> 
         </header>


<div id="wrapper">
<div class="row" >
<div class="col-md-4">    
</div>
 <div class="col-md-4">                             
            <div class="modal-dialog">
           <div class="modal-content">
          <div class="modal-header" style="padding:35px 50px; background-color:#2B3856;">
          <h4 style="font-size:20px;color:white;text-align: center;"><i><b>modifier le membre</b></i></h4>
        </div>

 <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="" method="post">  
 
            <div class="form-group">
           <label for="usrname">ID</label>
           <input type="text" class="form-control" placeholder="id" name="id" required value="<?= $mem->idmembre;?>">
          </div>


          <div class="form-group">
           <label for="usrname"> NOM</label>
           <input type="text" class="form-control" placeholder="nom" name="nom" required value="<?= $mem->nom;?>">
          </div>

          <div class="form-group">
           <label for="usrname">MOT DE PASSE</label>
           <input type="text" class="form-control" placeholder="mdp" name="mdp" required value="<?= $mem->motdepasse;?>"> <br>

                

        <button type="submit" class="btn btn-success" name="modc">Modifier</button>
        <br><br>
        <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">Annuler</button>

</form>
</div>
</div>
</div>
</div>
</div>
</div>





                    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="js1/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="js1/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js1/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="js1/dataTables/jquery.dataTables.js"></script>
    <script src="js1/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>

       <!-- Preloader -->
        <script type="text/javascript">
            //<![CDATA[
            $(window).load(function() { // makes sure the whole site is loaded
                $('.loader-item').fadeOut(); // will first fade out the loading animation
                    $('#pageloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
                $('body').delay(350).css({'overflow-y':'visible'});
            })
            //]]>
        </script>

    <!-- CUSTOM SCRIPTS -->
    <script src="js1/custom.js"></script>
    
   
</body>
</html>