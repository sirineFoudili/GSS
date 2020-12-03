<?php
$bdd= new PDO("mysql:host=localhost;dbname=gss;charset=utf8","root","");
$conn = mysqli_connect("localhost", "root", "", "gss"); 

if (isset($_POST['envoiga']) ){
 $id = $_GET['adminap'];
 if(!empty(trim($_POST['idaa'])))
 {
$recherche="SELECT `idadmin` FROM `groupe-admin` WHERE `idadmin`='".$_POST['idaa']."'"; 
$rs=mysqli_query($conn,$recherche);

if(mysqli_num_rows($rs)>0){ 
echo "<script> alert('tu peux pas ajouter le groupe  deux fois'); </script> ";
}

if (mysqli_num_rows($rs)<=0) { 
 $requete=$bdd->prepare('INSERT INTO `groupe-admin`( `idadmin`, `nom`,`type`,`service`, `motdepasse`, `description`,
  `serveur_idserveur`) VALUES (?,?,?,?,?,?,?)');
 $requete->execute(array($_POST['idaa'],$_POST['nomaa'],$_POST['typeaa'],$_POST['seraa'],$_POST['mdpaa'],$_POST['desaa'],$id));
 $requete1=$requete->fetch();

 echo "<script> alert('le groupe  a ete bien ajouter'); </script>";
 }

}
header("Location:grp-par.php?adminap=$id");
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

            <!--AJAX-->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" /> -->
        <script rel="stylesheet" href="vendor/bootstrap/js/bootstrap.min.js"></script> 
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
        <li style="margin-right:3px;"><a href="liste-serveurs-par.php" class="fa fa-angle-left" title="Précédent" ></a></li>
                        <?php  
                      session_start();
                      $r=session_id();
     if (strcmp( $_SESSION['type'], "Admin") == 0) {
          echo '<li style="margin-right:3px;"><a href="interfaceadmin.php" class="fa fa-home" title="Accueille" ></a></li>';
          echo '<li><a href="liste-compte.php" class="fa fa-users" title="Comptes" ></a></li>';

            }
      if (strcmp( $_SESSION['type'], "User") == 0) {
         echo '<li style="margin-right:3px;"><a href="interfaceuser.php" class="fa fa-home" title="Accueille" ></a></li>';
            }
           
    ?>
                        <li><a href="profile.php" class="fa fa-user" title="Profile"></a></li>
                        <li><a href="msg.php" class="fa fa-envelope" title="Gmail"></a></li>
                        <li><a href="statistiques.php" class="fa fa-signal" title="Statistiques"></a></li>
                        <li><a href="deconecte.php" class="fa fa-sign-out" title="Déconnexion"></a></li>
                    </ul>
                </div> 
                </div> 
         </header>

   

      <div id="wrapper">
      <div id="page-inner">

        <?php
if (strcmp( $_SESSION['type'], "Admin") == 0) {
        echo '<div  style="margin-left:1450px;">
<button type="button"  data-toggle="modal" data-target="#myModala"style="padding:1px 1px 1px 1px; border-radius: 30%;"> 
<img style="width:28px;height:26px; border-radius: 50% ;" src="img/add.png"></button> 
<button type="button"  style="padding:1px 1px 1px 1px; border-radius: 30%;" name="btn_delete" id="btn_delete" >
<img style="width:28px;height:26px; border-radius: 50% ;" src="img/delete.png">         </button>
                          </div>'; } ?>

<div style="text-align: center; color: #2b3856;"> 
  <b style="font-size:40px;">GROUPE D'ADMINS</b></div>
                                             

              <div class="row">
              <div class="col-md-12">
              <div class="panel panel-default">
              <div class="panel-body">
              <div class="table-responsive" style="overflow-x:scroll;">
                                           
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead style="color:#2b3856;">
                   <tr>
<?php
if (strcmp( $_SESSION['type'], "Admin") == 0) {
    echo '<th><img style="width:26px;height:24px; " src="img/trash.png"></th>'; } ?>                                                     
          <th>ID</th>
          <th>Nom</th>
          <th>Service</th> 
          <th>Type</th>
          <th>Description</th>
<?php
if (strcmp( $_SESSION['type'], "Admin") == 0) {
    echo '<th>Mot De Passe</th>';} ?>

<?php
if (strcmp( $_SESSION['type'], "Admin") == 0) {
    echo '<th><i class="fa fa-pencil"></i></th>';} ?>
                                                                        </tr>
                                                                      </thead>
                            <tbody  class="warning">
<?php
$bdd= new PDO("mysql:host=localhost;dbname=gss;charset=utf8","root","");
$conn = mysqli_connect("localhost", "root", "", "gss"); 
$query = "SELECT * FROM `groupe-admin`  WHERE `serveur_idserveur`='".$_GET['adminap']."'" ;
$stat = $bdd->query($query);
$tab = $stat->fetchAll ();
foreach($tab as $row)
{
echo "<tr>";
if (strcmp( $_SESSION['type'], "Admin") == 0) {echo  '<td> <input type="checkbox" name="chc[]" value="'.$row["idadmin"]; echo'"> </td>';}
echo '<td>' .$row["idadmin"]; echo '</td>';
echo '<td>' .$row["nom"]; echo '</td>';
echo '<td>' .$row["service"]; echo '</td>';
echo '<td>' .$row["type"]; echo '</td>';
echo '<td>' .$row["description"]; echo '</td>';
if (strcmp( $_SESSION['type'], "Admin") == 0) {echo '<td>' .$row["motdepasse"]; echo '</td>';}
if (strcmp( $_SESSION['type'], "Admin") == 0) {echo '<td> <a href="modifier-grp-par.php?modu='.$row['idadmin'].'"  data-toggle="modal1" data-target="#my"> 
<img style="width:33px;height:30px; border-radius: 50% ;" src="img/edit.png"></button></td>';}
echo "</tr>";
}
?> 
                                                    </tbody>
                                                       </table>
                                                       </div>
                                                       </div>

                                    </div>       
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
         

<script>
$(document).ready(function(){
 
 $('#btn_delete').click(function(){
  
  if(confirm("Voulez-vous vraiment supprimer ces informations?"))
  {
   var id = [];
   
   $(':checkbox:checked').each(function(i){
    id[i] = $(this).val();
   });
   
   if(id.length === 0) //tell you if the array is empty
   {
    alert("Sélectionner un élément!!!");
   }
   else
   {
    $.ajax({
     url:'supprimer-grpadmin.php',
     method:'POST',
     data:{id:id},
     success:function()
     {
     location.reload();
      }
     });
   }
   
  }
  else
  {
   return false;
  }

 });
});
</script>





               
                <div class="row">
                <div class="col-md-6">   
                <div class="modal fade" id="myModala" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" style="padding:35px 50px; background-color:#2B3856;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 style="font-size:20px;color:white;text-align: center;"><span class="fa fa-user-plus"></span><i><b>Ajouter un admin</b></i></h4></div>

                <div class="modal-body" style="padding:40px 50px;">
                <form role="form" action="" method="post">
          
           <div class="form-group">
           <label for="usrname">ID</label>
           <input type="text" class="form-control" placeholder="id" name="idaa" required>
          </div>

          <div class="form-group">
           <label for="usrname">NOM</label>
           <input type="text" class="form-control" placeholder="nom" name="nomaa" required>
          </div>

           <div class="form-group">
           <label for="usrname">SERVICE</label>
           <select  class="form-control" name="seraa"> 
                  <option>Système et sécurité</option>
                  <option>Support informatique</option>
                  <option>Data management</option>
                  <option>Infrastructure</option>
                  <option>Patrimoine data</option>
            </select>
          </div></br>

          <div class="form-group">
           <label for="usrname">TYPE</label>
           <input type="text" class="form-control" placeholder="type" name="typeaa">
          </div></br>


          <div class="form-group">
           <label for="usrname">DESCRIPTION</label>
           <input type="text" class="form-control" placeholder="description" name="desaa">
          </div>

          <div class="form-group">
           <label for="usrname">MOT DE PASSE</label>
           <input type="text" class="form-control" placeholder="mdp" name="mdpaa" required>
          </div>

                

        <button type="submit" class="btn btn-success" name="envoiga"> Ajouter</button>
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
