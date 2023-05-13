<?php
	Class Login{
		private $pdo;
		function __construct($pdo){
			$this->pdo = $pdo;
		}
		function verificaLogin(){
			try{
				if (isset($_POST['cpf']) AND !empty($_POST['cpf'])) {
					$cpf = trim($_POST['cpf']);
				} else{
					throw new Exception("Campo cpf vazio.", 1);
				}
				if (isset($_POST['senha']) AND !empty($_POST['senha'])) {
					$senha = trim($_POST['senha']);
				} else{
					throw new Exception("Campo senha vazio.", 2);
				}
				$select = $this->pdo->prepare("SELECT nivel FROM funcionarios WHERE cpf = :cpf AND senha = :senha");
				$select->bindValue(':cpf', $cpf);
				$select->bindValue(':senha', $senha);
				$select->execute();
				if($select->rowCount() == 1){
					session_start();
					$_SESSION['cpf'] = $cpf;
					$_SESSION['senha'] = $senha;
					$nivel = $select->fetch(PDO::FETCH_COLUMN);
					$_SESSION['nivel'] = $nivel;
					if($nivel == 2 || $nivel == 1){
						header('location:paginicial.php');
					} else{
						header('location:index.php');
					}
			
				} else{
					echo "<div class='alert alert-danger col-md-5'>
						Cpf e/ou senha incorretos!!!
					</div>";
				}
			} catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}
?>