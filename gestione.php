<?php

	 class Gestione{

		function __constuctor(){

		}

		function alert($mex){
			print "<script>alert('".$mex."');</script>";
		}

		function stampa_righa($par){ 
			require 'config.php';
			$numero = 1;
			$pred = "";
			if($par==0){
				$pred = "0";
			}
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
	                     <input type=\"text\" name=\"durata\" value=''/>
	                  </td>
	                  <td>
	                     <input type=\"text\" name=\"partenza\" value=''/>
	                  </td>
	                  <td>
	                     <input type=\"text\" name=\"predecessori\" value='".$pred."'/>
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
			$progetto = $_COOKIE['user'];

			$query_ins = "INSERT INTO `gpoi_work`.`task` (`Id_Task`, `Nome`, `Durata`, `Partenza`, `Id_Progetto_E`, `Num_Task`) VALUES (NULL, '$nome_task', '$durata', $partenza, $progetto, $numero);";
			$result_ins = $conn->query($query_ins);
			if(!$result_ins){
				echo "Errore inserimento task: ".$conn->error;
			}
			if($numero == 1){
				//$this->alert("Il primo task non può avere predecessori");  
			}
			else{
				$this->ins_predecessori($numero);
			}
		}



		function predecessori($task){

		}

		function ins_predecessori($num_task){
			require 'config.php';
			$progetto = $_COOKIE['user'];
			$prede_action = $_POST['predecessori'];
			$query_id = "SELECT Id_Task FROM task WHERE Num_Task = ".$num_task." AND Id_Progetto_E = ".$progetto;
			$result_id = $conn->query($query_id);
			$row_id = $result_id->fetch_object();
			$id_task = ($row_id->Id_Task); //id del task interessato sul quale si lavora
			   

			if($num_task == 1 AND $prede_action <> 0){
				$this->alert("Il primo task non può avere predecessori"); 
			}
			else{ 
				$arr_prede = array();
				//da gestire sul client imposizione ";" e/o "," come separatore tra i predecessori
				$prede_action = str_replace(';', "", $prede_action);
				$prede_action = str_replace(',', "", $prede_action);

				for($i=0; $i< strlen($prede_action); $i++){ 
					$arr_prede[$i] = $prede_action[$i];
					
					//bisogna calcolare l'id del task del predecessore estratto

					$query_id_precedente = "SELECT Id_Task FROM task WHERE Id_Progetto_E = ".$progetto." AND Num_Task = ".$prede_action[$i];
					$result_task_pre = $conn->query($query_id_precedente);
					$row_id_pre = $result_task_pre->fetch_object();
					$id_task_pre = ($row_id_pre->Id_Task); //id del task che verrà inserito come predecessore

					if($num_task == $prede_action[$i]){
						$this->alert("Il task num. ".$num_task." non può avere come predecessore se stesso");
					}
					else{
						$query_ins_pred = "INSERT INTO `gpoi_work`.`predecessore` (`IdT`, `IdP`) VALUES (".$id_task.",".$id_task_pre.");"; 
						//echo $query_ins_pred."<br/>";

						$result_pred = $conn->query($query_ins_pred);
						if(!$result_pred){
							echo "Errore inserimento predecessore: ".$conn->error;
						}
					}
				}

				//print_r($arr_prede); //ok restituisce predecessori sistemati
			}
		}



		function stampa(){
			require 'config.php';
			if(isset($_COOKIE['user'])){
				$progetto = $_COOKIE['user'];

			$query_est = "SELECT * FROM Task WHERE Id_Progetto_E = ".$progetto;
			$risultato_estrai = $conn->query($query_est); 
				while($righe = mysqli_fetch_assoc($risultato_estrai)){
					//importante 
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