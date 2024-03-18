<?php
   $servidor = "localhost";
   $usuario = "root";
   $senha = "";
   $bdd = "pdf1";

   $conn = new mysqli($servidor, $usuario, $senha, $bdd);
   
   if($conn->connect_error) {
      die("Houve um erro: ".$conn->connect_error);
   } 

?>