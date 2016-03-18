<?php
   require("core/config.php");
   require("core/gestione.php");
    
   
   $ogg = new Gestione();
   

?>
<html>
   <head>
      <title>
         Nome sw
      </title>
   </head>
   <body>
      <h1 align=center> Nome software </h1>
      <table align=center border=2>
         <tr>
            <td><a href="progetto.html"> Progetto </a></td>
            <td><a href="risorse.html"> Risorse </a></td>
            <td><a href="gant.html"> Gant </a></td>
         </tr>
      </table>
      <br><br>
      <center>
         <form action="progetto.php" method="post">
            <input name="btn_add" type="submit" value="Aggiungi task / Salva" />
            <input name="end_task" type="submit" value="Termina" /><br><br>
            <table align=center border=2>
               <tr>
                  <td>
                     Numerazione
                  </td>
                  <td>
                     Nome
                  </td>
                  <td>
                     Durata
                  </td>
                  <td>
                     Partenza
                  </td>
                  <td>
                     Predecessori
                  </td>
               </tr>
              <?php
                if(!isset($_COOKIE['user'])){ 
                  $ogg->setta_cookie();
                }

              ?>

              <?php

                if(isset($_POST['btn_add'])){
                  $ogg->inserisci(); 
                }
                $ogg->stampa();
              ?>
             
            </table>
         </form>
      </center>
   </body>
</html>