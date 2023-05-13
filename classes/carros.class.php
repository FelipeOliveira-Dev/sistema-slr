<?php
	Class Carros{
		public $modelo;
		public $placa;
		public $cor;
		public $anoFab;
		public $marca;
		function __construct($pdo){
			$this->pdo = $pdo;
		}
		function cadastrar(){
			try{
				if (isset($_POST['modelo']) and !empty($_POST['modelo'])) {
					$modelo = trim($_POST['modelo']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['placa']) and !empty($_POST['placa'])) {
					$placa = trim($_POST['placa']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['cor']) and !empty($_POST['cor'])) {
					$cor = trim($_POST['cor']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['anoFab']) and !empty($_POST['anoFab'])) {
					$anoFab = trim($_POST['anoFab']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['marca']) and !empty($_POST['marca'])) {
					$marca = trim($_POST['marca']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['status']) and !empty($_POST['status'])) {
					$status = trim($_POST['status']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				$inserir = $this->pdo->prepare("INSERT INTO carros (modelo, placa, cor, anoFab, marca, status) VALUES(:modelo, :placa, :cor, :anoFab, :marca, :status)");
				$inserir->bindValue(':modelo', $modelo);
				$inserir->bindValue(':placa', $placa);
				$inserir->bindValue(':cor', $cor);
				$inserir->bindValue(':anoFab', $anoFab);
				$inserir->bindValue(':marca', $marca);
				$inserir->bindValue(':status', $status);
				if ($inserir->execute()) {
					echo "<div class='alert alert-success col-md-5'>
						Sucesso ao cadastrar carro!
					</div>";
				}
			}catch(Exception $e){
				return 'Erro 404';
			}
		}
		function listarCarros(){
			$selecionar = $this->pdo->prepare('SELECT * FROM carros');
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetchAll(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}
		function deletar(){
			try{
				if(isset($_GET['placa'])){
					$placa = $_GET['placa'];
				} else{
					throw new Exception("Não foi possível identificar o registro que você deseja excluir.", 1);
				}
				$excluir = $this->pdo->prepare('DELETE FROM carros WHERE placa = :placa');
				$excluir->bindValue(':placa', $placa);
				$excluir->execute();
				if($excluir->rowCount()){
					echo "<br> Excluido com sucesso!";
				} else{
					echo "Erro na exclusão do elemento";;
				}
			} catch(Exception $e){

			}
		}
		function listar($idCarros){
			$seleciona = $this->pdo->prepare("SELECT * FROM carros WHERE idCarros = :idCarros");
			$seleciona->bindValue(':idCarros', $idCarros);
			$seleciona->execute();
			if ($seleciona->rowCount() > 0) {
				return $seleciona->fetch(PDO::FETCH_OBJ);				
			} else{
				return null;
			}
		}
		function editar(){
			try{
				if (isset($_POST['modelo']) and !empty($_POST['modelo'])) {
					$modelo = trim($_POST['modelo']);
				}else{
					throw new Exception(': Campos não atualizados.');
				}
				if (isset($_POST['placa']) and !empty($_POST['placa'])) {
					$placa = trim($_POST['placa']);
				}else{
					throw new Exception(': Campos não atualizados.');
				}
				if (isset($_POST['cor']) and !empty($_POST['cor'])) {
					$cor = trim($_POST['cor']);
				}else{
					throw new Exception(': Campos não atualizados.');
				}
				if (isset($_POST['anoFab']) and !empty($_POST['anoFab'])) {
					$anoFab = trim($_POST['anoFab']);
				}else{
					throw new Exception(': Campos não atualizados.');
				}
				if (isset($_POST['marca']) and !empty($_POST['marca'])) {
					$marca = trim($_POST['marca']);
				}else{
					throw new Exception(': Campos não atualizados.');
				}
				if (isset($_POST['status']) and !empty($_POST['status'])) {
					$status = trim($_POST['status']);
				}else{
					throw new Exception(': Campos não atualizados.');
				}
				if (isset($_POST['idCarros']) and !empty($_POST['idCarros'])) {
					$idCarros = trim($_POST['idCarros']);
				}else{
					throw new Exception(': Campos obrigtórios não atualizados.');
				}

				$update = $this->pdo->prepare("UPDATE carros SET modelo=:modelo, cor=:cor, placa=:placa, anoFab=:anoFab,
				marca=:marca, status=:status WHERE idCarros = :idCarros");
				$update->bindValue(':modelo', $modelo);
				$update->bindValue(':placa', $placa);
				$update->bindValue(':cor', $cor);
				$update->bindValue(':anoFab', $anoFab);
				$update->bindValue(':marca', $marca);
				$update->bindValue(':status', $status);
				$update->bindValue(':idCarros', $idCarros);
				if ($update->execute()) {
					return 'Cadastro realizado com sucesso.';
				}else{
					return "Falha";
				}
			} catch(Exception $e){
				echo "Erro" . $e->getMessage();
			}
		}
	}				
?>