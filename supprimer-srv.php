<?php
$connect = mysqli_connect("localhost", "root", "", "gss");
if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
  $query = "DELETE FROM `serveur` WHERE idserveur = '".$id."'";
  mysqli_query($connect, $query);
 }
}
?>