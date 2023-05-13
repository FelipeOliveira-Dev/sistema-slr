<?php
	Class Funcionarios{
		function __construct($pdo){
			$this->pdo = $pdo;
		}
		function cadastrarFunc(){
			try{
				if (isset($_POST['nome_func']) and !empty($_POST['nome_func'])) {
					$nome_func = trim($_POST['nome_func']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['cpf']) and !empty($_POST['cpf'])) {
					$cpf = trim($_POST['cpf']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['nivel']) and !empty($_POST['nivel'])) {
					$nivel = trim($_POST['nivel']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['telefone']) and !empty($_POST['telefone'])) {
					$telefone = trim($_POST['telefone']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				if (isset($_POST['senha']) and !empty($_POST['senha'])) {
					$senha = trim($_POST['senha']);
				}else{
					throw new Exception('Este campo é obrigatório.');
				}
				$inserir = $this->pdo->prepare("INSERT INTO funcionarios (nome_func, cpf, nivel, telefone, senha) VALUES(:nome_func, :cpf,:nivel , :telefone, :senha)");
				$inserir->bindValue(':nome_func', $nome_func);
				$inserir->bindValue(':cpf', $cpf);
				$inserir->bindValue(':nivel', $nivel);
				$inserir->bindValue(':telefone', $telefone);
				$inserir->bindValue(':senha', $senha);
				if ($inserir->execute()) {
					echo "<div class='alert alert-success col-md-5'>
						Sucesso ao cadastrar funcionario!
					</div>";;
				}
			}catch(Exception $e){
				return 'Erro 404';
			}
		}
		function listarFunc(){
			$selecionar = $this->pdo->prepare('SELECT * FROM funcionarios');
			$selecionar->execute();
			if($selecionar->rowCount() > 0){
				return $selecionar->fetchAll(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}
		function deletarFunc(){
			try{
				if(isset($_GET['id'])){
					$id = $_GET['id'];
				} else{
					throw new Exception("Não foi possível identificar o registro que você deseja excluir.", 1);
					
				}

				$excluir = $this->pdo->prepare('DELETE FROM funcionarios WHERE id = :id');
				$excluir->bindValue(':id', $id);
				$excluir->execute();
				if($excluir->rowCount()){
					var_dump("excluído");
				} else{
					var_dump("erro excluir");
				}
			} catch(Exception $e){

			}
		}
		function listar($id){
			$seleciona = $this->pdo->prepare("SELECT * FROM funcionarios WHERE id = :id");
			$seleciona->bindValue(':id', $id);
			$seleciona->execute();
			if ($seleciona->rowCount() > 0) {
				return $seleciona->fetch(PDO::FETCH_OBJ);				
			} else{
				return null;
			}
		}
		function editarfunc(){
			try{
				if (isset($_POST['nome_func']) and !empty($_POST['nome_func'])) {
					$nome_func = trim($_POST['nome_func']);
				}else{
					throw new Exception('Este campo é obrigatório.NOME');
				}
				if (isset($_POST['cpf']) and !empty($_POST['cpf'])) {
					$cpf = trim($_POST['cpf']);
				}else{
					throw new Exception('Este campo é obrigatório.CPF');
				}
				if (isset($_POST['telefone']) and !empty($_POST['telefone'])) {
					$telefone = trim($_POST['telefone']);
				}else{
					throw new Exception('Este campo é obrigatório.TEL');
				}
				if (isset($_POST['senha']) and !empty($_POST['senha'])) {
					$senha = trim($_POST['senha']);
				}else{
					throw new Exception('Este campo é obrigatório.SENHA');
				}
				if (isset($_GET['id']) and !empty($_GET['id'])) {
					$id = trim($_GET['id']);
				}else{
					throw new Exception('Este campo é obrigatório.ID');
				}

				$update = $this->pdo->prepare("UPDATE funcionarios SET nome_func=:nome_func, cpf=:cpf, telefone=:telefone, senha=:senha WHERE id = :id");
				$update->bindValue(':nome_func', $nome_func);
				$update->bindValue(':cpf', $cpf);
				$update->bindValue(':telefone', $telefone);
				$update->bindValue(':senha', $senha);
				$update->bindValue(':id', $id);
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