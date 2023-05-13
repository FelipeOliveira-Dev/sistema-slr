<?php
	Class Clientes{
		function __construct($pdo){
			$this->pdo = $pdo;
		}
		function cadastrarCliente(){
			try{
				if(isset($_POST['nome']) AND !empty($_POST['nome'])){
					$nome = $_POST['nome'];
				} else{
					throw new Exception("Este campo é obrigatório!", 1);	
				}
				if(isset($_POST['cpf']) AND !empty($_POST['cpf'])){
					$cpf = $_POST['cpf'];
				} else{
					throw new Exception("Este campo é obrigatório!", 1);	
				}
				if (isset($_POST['data_nasc']) and !empty($_POST['data_nasc'])) {
					$data_nasc = Helpper::dataSql($_POST['data_nasc']);
					if($data_nasc == null){
						throw new Exception("O formato da data está inválido");	
					}
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if(isset($_POST['telefone']) AND !empty($_POST['telefone'])){
					$telefone = $_POST['telefone'];
				} else{
					throw new Exception("Este campo é obrigatório!", 1);	
				}
				$cadCliente = $this->pdo->prepare("INSERT INTO cliente (nome, data_nasc, cpf, telefone) VALUES (:nome, :data_nasc, :cpf, :telefone)");
				$cadCliente->bindValue(':nome', $nome);
				$cadCliente->bindValue(':data_nasc', $data_nasc);
				$cadCliente->bindValue(':cpf', $cpf);
				$cadCliente->bindValue(':telefone', $telefone);
				if ($cadCliente->execute()) {
					echo "<div class='alert alert-success col-md-5'>
						Sucesso ao inserir cliente!
					</div>";
				} else{
					echo "<div class='alert alert-danger col-md-5'>
						Falha ao inserir cliente!
					</div>";
				}
			}catch(Exception $e){
				return "Houve um erro, 404";
			}
		}
		function listarClientes(){
			$listar = $this->pdo->prepare("SELECT * FROM cliente");
			$listar->execute();
			if ($listar->rowCount() > 0) {
				return $listar->fetchAll(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}
		function apagarClientes(){
			try{
				if(isset($_GET['idCliente'])){
					$idCliente = $_GET['idCliente'];
				} else{
					throw new Exception("Não foi possível encontrar o cliente que você deseja excluir.", 1);
				}
				$apagar = $this->pdo->prepare("DELETE FROM cliente WHERE idCliente = :idCliente");
				$apagar->bindValue(':idCliente', $idCliente);
				$apagar->execute();
				if ($apagar->rowCount()) {
					echo "Cliente excluído com sucesso!";
				} else{
					echo "Erro ao excluir cliente";
				}
			} catch(Exception $e){
				return "Houve um erro. 404";
			}
		}
		function editarCliente(){
			try{
				if(isset($_POST['idCliente']) AND !empty($_POST['idCliente'])){
					$idCliente = $_POST['idCliente'];
				} else{
					throw new Exception("Este campo é obrigatório.", 101);
				}
				if(isset($_POST['nome']) AND !empty($_POST['nome'])){
					$nome = $_POST['nome'];
				} else{
					throw new Exception("Este campo é obrigatório.", 101);
				}
				if(isset($_POST['cpf']) AND !empty($_POST['cpf'])){
					$cpf = $_POST['cpf'];
				} else{
					throw new Exception("Este campo é obrigatório.", 101);
				}
				if(isset($_POST['data_nasc']) AND !empty($_POST['data_nasc'])){
					$data_nasc = $_POST['data_nasc'];
				} else{
					throw new Exception("Este campo é obrigatório.", 101);
				}
				if(isset($_POST['telefone']) AND !empty($_POST['telefone'])){
					$telefone = $_POST['telefone'];
				} else{
					throw new Exception("Este campo é obrigatório.", 101);
				}

				$atualizar = $this->pdo->prepare("UPDATE cliente SET nome = :nome, cpf = :cpf, data_nasc = :data_nasc, telefone = :telefone WHERE idCliente = :idCliente");
				$atualizar->bindValue(':nome', $nome);
				$atualizar->bindValue(':cpf', $cpf);
				$atualizar->bindValue(':data_nasc', $data_nasc);
				$atualizar->bindValue(':telefone', $telefone);
				$atualizar->bindValue(':idCliente', $idCliente);
				if ($atualizar->execute()) {
					echo "Sucesso ao atualizar";
				} else{
					echo "Falha ao atualizar";
				}
			} catch(Exception $e){
				return "Houve um erro!";
			}
		}
		function listarCliente($idCliente){
			$selecao = $this->pdo->prepare('SELECT * FROM cliente WHERE idCliente = :idCliente');
			$selecao->bindValue(':idCliente',$idCliente);
			$selecao->execute();
			if($selecao->rowCount() > 0){
				return $selecao->fetch(PDO::FETCH_OBJ);
			} else{
				return null;
			}

		}
	}
?>