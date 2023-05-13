<?php
	Class Relatorios{
		function __construct($pdo){
			$this->pdo = $pdo;
		}
		function relatorioDeFunc(){
			$relat = $this->pdo->prepare("SELECT f.nome_func, fm.quant_alug FROM funcionarios AS f JOIN func_max_num_alug AS fm ON f.id=fm.funcionarios_id");
			$relat->execute();
			if($relat->rowCount() > 0){
				return $relat->fetchAll(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}
		function todosAlugFunc(){
			$todos = $this->pdo->prepare("SELECT f.nome_func, qa.quant_alug FROM funcionarios AS f JOIN quantidade_alug AS qa ON f.id=qa.funcionarios_id ORDER BY quant_alug DESC");
			$todos->execute();
			if($todos->rowCount() > 0){
				return $todos->fetchAll(PDO::FETCH_OBJ);
			} else{
				return null;
			}
		}
	}
?>

