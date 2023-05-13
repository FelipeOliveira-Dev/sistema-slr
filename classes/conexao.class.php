<?php  
	Class Conexao{
		public $pdo;
		public function conecta(){
			try {	
				$pdo = new PDO("mysql:host=localhost; dbname=locadora", "root", "");
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->exec("set names utf8");
			} catch (PDOException $erro) {
				echo "Erro na conexão:" . $erro->getMessage();
			}
			return $pdo;
		}
	}
?>