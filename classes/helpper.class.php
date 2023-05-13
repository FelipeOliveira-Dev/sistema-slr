<?php
	Class Helpper{
		// Formata data dd/mm/aaaa para aaaa-mm-dd
		static function dataSql($databr) {
			if (!empty($databr)){
				if(Helpper::validateDate($databr, 'Y-m-d')){ //Se já estiver no formato correto, retorna
					return $databr;
				} else if(Helpper::validateDate($databr, 'd/m/Y')){//Se estiver no formato Brasileiro, formata e retorna
					$p_dt = explode('/',$databr);
					$data_sql = $p_dt[2].'-'.$p_dt[1].'-'.$p_dt[0];
					return $data_sql;
				} else{
					return null;
				}
			} else{
				return null;
			}
		}

		static function validateDate($date, $format = 'Y-m-d H:i:s'){
		    $d = DateTime::createFromFormat($format, $date);
		    return $d && $d->format($format) == $date;
		}

		static function dataBR($dataSQL) {
			if (!empty($dataSQL)){
				if(Helpper::validateDate($dataSQL, 'd/m/Y')){ //Se já estiver no formato correto, retorna
					return $dataSQL;
				} else if(Helpper::validateDate($dataSQL, 'Y-m-d')){//Se estiver no formato Brasileiro, formata e retorna
					$p_dt = explode('-',$dataSQL);
					$data_sql = $p_dt[2].'/'.$p_dt[1].'/'.$p_dt[0];
					return $data_sql;
				} else{
					return null;
				}
			} else{
				return null;
			}
		}
	}
?>