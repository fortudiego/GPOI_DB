<?php

	 class Gestione{

		function __constuctor(){

		}


		function stampa_righa($par){ 
			require 'config.php';
			$numero = 1;
			if($par==1){
				$progetto = $_COOKIE['user'];
				 
				$result_max = $conn->query("SELECT MAX(Num_Task)AS massimo FROM task WHERE Id_Progetto_E = ".$progetto);
				$row = $result_max->fetch_object();
				$numero = ($row->massimo)+1;
			}

			echo "<tr>
	                  <td>
	                     <input value='".$numero."' style=\"text-align:center;\"  name=\"num\" readonly/>
	                  </td>
	                  <td>
	                     <input type=\"text\" name=\"nome_task\" value='' required/>
	                  </td>
	                  <td>
	                     <input type=\"text\" name=\"durata\" value='' required/>
	                  </td>
	                  <td>
	                     <input type=\"text\" name=\"partenza\" value='' required/>
	                  </td>
	                  <td>
	                     <input type=\"text\" name=\"latestart\" value='' required/>
	                  </td>
	               </tr>";
        }

		function setta_cookie(){
			require 'config.php';
			$sql = "INSERT INTO `gpoi_work`.`Progetto` (`Id_Progetto`, `Titolo`) VALUES (NULL, '');";
	        
	        if ($conn->query($sql) === TRUE) {
	            $last_id = $conn->insert_id;
	            setcookie("user", $last_id, time()+(604800)*54); //cookie che scade dopo un anno

	            $this->stampa_righa(0);
	        } 

         	else {
             echo "ERRORE: <br>" . $conn->error;
         	}
			 
		}

		function inserisci(){
			require 'config.php';  
			$numero = $_POST['num'];
			$nome_task = $_POST['nome_task'];
			$durata = $_POST['durata'];
			$partenza = $_POST['partenza'];
			$late = $_POST['latestart'];
			$progetto = $_COOKIE['user'];

			$query_ins = "INSERT INTO `gpoi_work`.`task` (`Id_Task`, `Nome`, `Durata`, `Partenza`, `Id_Progetto_E`, `Num_Task`) VALUES (NULL, '$nome_task', '$durata', $partenza, $progetto, $numero);";
			$result_ins = $conn->query($query_ins);
			if(!$result_ins){
				echo "Errore inserimento: ".$conn->error;
			}
		}

		function stampa(){
			require 'config.php';
			if(isset($_COOKIE['user'])){
				$progetto = $_COOKIE['user'];

			$query_est = "SELECT * FROM Task WHERE Id_Progetto_E = ".$progetto;
			$risultato_estrai = $conn->query($query_est); 
				while($righe = mysqli_fetch_assoc($risultato_estrai)){
					echo "
	                    <tr>
	                        <td>
	                           <input style=\"text-align:center;\" value='".$righe['Num_Task']."' type='text'  readonly/>
	                        </td>
	                        <td>
	                           <input value='".$righe['Nome']."' type='text'  />
	                        </td>
	                        <td>
	                           <input value='".$righe['Durata']."' type='text'  />
	                        </td>
	                        <td>
	                           <input value='".$righe['Partenza']."' type='text'  />
	                        </td>
	                        <td>
	                           <input value='".$righe['LateStart']."' type='text'  />
	                        </td>
	                    </tr> ";
				}
				$this->stampa_righa(1);
			}
		}

	}
?>