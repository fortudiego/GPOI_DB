<?php
	
	//require("core/config.php");

	
	
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
		<input name="end_task" type="submit" value="Termina" />
	 </form></center>
	 
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
         <tr>
            <td>
               <input type="text" name=casella60>
            </td>
            <td>
               <input type="text" name=casella1>
            </td>
            <td>
               <input type="text" name=casella2>
            </td>
            <td>
               <input type="text" name=casella3>
            </td>
            <td>
               <input type="text" name=casella4>
            </td>
         </tr>
		 <?php
			if(isset($_POST['add_task'])){
				echo "
				 <tr>
					<td>
					   <input type=\"text\" name=casella60>
					</td>
					<td>
					   <input type=\"text\" name=casella1>
					</td>
					<td>
					   <input type=\"text\" name=casella2>
					</td>
					<td>
					   <input type=\"text\" name=casella3>
					</td>
					<td>
					   <input type=\"text\" name=casella4>
					</td>
				 </tr> ";
			}
		 ?>
         
      </table>
   </body>
</html>