<?php
	Class Aluguel{
		function __construct($pdo){
			$this->pdo = $pdo;
		}
		function realizaAluguel(){
			
			try{
				if (isset($_POST['dataDoAluguel']) and !empty($_POST['dataDoAluguel'])) {
					$dataDoAluguel = Helpper::dataSql($_POST['dataDoAluguel']);
					if($dataDoAluguel == null){
						throw new Exception("O formato da data está inválido");	
					}
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['dataDev']) and !empty($_POST['dataDev'])) {
					$dataDev = Helpper::dataSql($_POST['dataDev']);
					if($dataDev == null){
						throw new Exception("O formato da data está inválido");	
					}
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if(isset($_POST['Cliente_idCliente']) AND !empty($_POST['Cliente_idCliente'])){
					$Cliente_idCliente = $_POST['Cliente_idCliente'];
				} else{
					throw new Exception("O campo é obrigatório.", 101);
				}
				if(isset($_POST['Carros_idCarros']) AND !empty($_POST['Carros_idCarros'])){
					$Carros_idCarros = $_POST['Carros_idCarros'];
				} else{
					throw new Exception("O campo é obrigatório.", 101);
				}
				if(isset($_POST['funcionarios_id']) AND !empty($_POST['funcionarios_id'])){
					$funcionarios_id = $_POST['funcionarios_id'];
				} else{
					throw new Exception("O campo é obrigatório.", 101);
				}

				if($dataDev < $dataDoAluguel){
					echo "<div class='alert alert-danger col-md-5'>
					A data de devolução não pode ser antes da data do aluguel!
					</div>";
				}else{
					$alugar = $this->pdo->prepare("INSERT INTO aluguel (dataDoAluguel, dataDev, Cliente_idCliente, Carros_idCarros, funcionarios_id) VALUES (:dataDoAluguel, :dataDev, :Cliente_idCliente, :Carros_idCarros, :funcionarios_id)");
					$alugar->bindValue(':dataDoAluguel', $dataDoAluguel);
					$alugar->bindValue(':dataDev', $dataDev);
					$alugar->bindValue(':Cliente_idCliente', $Cliente_idCliente);
					$alugar->bindValue(':Carros_idCarros', $Carros_idCarros);
					$alugar->bindValue(':funcionarios_id', $funcionarios_id);
					if ($alugar->execute()) {
						echo "<div class='alert alert-success col-md-5'>
							Sucesso ao realizar aluguel!
						</div>";
					} else{
						echo "<div class='alert alert-danger col-md-5'>
							Falha ao realizar aluguel!
						</div>";
					}
					$alugar = $this->pdo->prepare("UPDATE carros SET status=:status WHERE idCarros = :idCarros");
					$alugar->bindValue(':idCarros', $Carros_idCarros);
					$alugar->bindValue(':status', "Alugado");
					$alugar->execute();
				}

				
			} catch(Exception $e){
				return"Erro.";
			}
		}
		function listarAlugueis(){
			$listar = $this->pdo->prepare("SELECT a.*, c.nome, ca.modelo, ca.idCarros, fu.nome_func FROM aluguel a LEFT JOIN cliente c ON Cliente_idCliente = c.idCliente LEFT JOIN carros ca ON Carros_idCarros = ca.idCarros LEFT JOIN funcionarios fu ON funcionarios_id = fu.id ORDER BY a.idAluguel DESC");
			$listar->execute();
			if ($listar->rowCount() > 0) {
				return $listar->fetchAll(PDO::FETCH_OBJ);
			}else{
				return null;
			}
		}
		function apagarAluguel(){
			try{
				if(isset($_GET['idAlugel'])){
					$idAlugel = $_GET['idAlugel'];
				} else{
					throw new Exception("Não foi possível identificar o registro que você deseja excluir.", 1);
				}
				$excluir = $this->pdo->prepare('DELETE FROM aluguel WHERE idAlugel = :idAlugel');
				$excluir->bindValue(':idAlugel', $idAlugel);
				$excluir->execute();
				if($excluir->rowCount()){
					echo "<br> Excluido com sucesso!";
				} else{
					echo "Erro na exclusão do elemento";;
				}
			} catch(Exception $e){

			}
		}
		function status(){
			try{
				if (isset($_GET['idCarros'])) {
					$idCarros = $_GET['idCarros'];
				}
				$alugar = $this->pdo->prepare("UPDATE carros SET status=:status WHERE idCarros = :idCarros");
				$alugar->bindValue(':idCarros', $idCarros);
				$alugar->bindValue(':status', "Disponível");
				$alugar->execute();
			}catch(Exception $e){

			}
		}
	}
?>