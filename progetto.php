<?php
	
	require("core/config.php");
	
      

      if(!isset($_COOKIE['user'])){
         
         $sql = "INSERT INTO `gpoi_work`.`Progetto` (`Id_Progetto`, `Titolo`) VALUES (NULL, '');";

          if ($conn->query($sql) === TRUE) {
             $last_id = $conn->insert_id;
              setcookie("user", $last_id, time()+(604800)*54); //cookie che scade dopo un anno
            } 
         else {
             echo "ERRORE: <br>" . $conn->error;
         }
      }

	 
	
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
	  
	  <center><form action="progetto.php" method="post">
		<input name="add_task" type="submit" value="Aggiungi task" />
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
			if(isset($_COOKIE['user'])){

            $utente = $_COOKIE['user'];
				$query_valori = "SELECT * FROM Task WHERE Id_Progetto_E = ".$utente;
            $risultato_estrai = $conn->query($query_valori);
            
            if ($risultato_estrai) {

               $righe = mysqli_num_rows($risultato_estrai);
               //for($i=0; $i<$righe; $i++){
                  
                   while($row = mysqli_fetch_array($risultato_estrai, MYSQLI_NUM)){
                     
                  
                     echo "
                      <tr>
                        <td>
                           <input  name=\"numerazione\" />
                        </td>
                        <td>
                           <input type=\"text\" name=\"nome\" />
                        </td>
                        <td>
                           <input type=\"text\" name=\"durata\" />
                        </td>
                        <td>
                           <input type=\"text\" name=\"earlystart\" />
                        </td>
                        <td>
                           <input type=\"text\" name=\"latestart\" />
                        </td>
                      </tr> ";
               //}
               }
               
            } 
            else {
             die ("ERRORE: <br>" . $conn->error);
            }
				 
				
			}
		 ?>
         
      </table>
	  </form></center>
   </body>
</html>