<?php

class Pdfquery_model {
	protected $megyeMindegy;
	protected $megyeJogu;
	protected $sqlSelect;
	protected $queryConstraints;

	public function __construct($vars) {
		$this->megyeMindegy = $vars['megye_jog'] == 'mindegy';
		if ($this->megyeMindegy) {
			$this->sqlSelect =
				"SELECT megye.nev as megye, varos.nev as varos, lelekszam.ev as mikor, lelekszam.osszesen as lelekszam, varos.megyeijogu as megyejog
FROM megye 
INNER JOIN varos on megye.id = varos.megyeid 
INNER JOIN lelekszam on varos.id = lelekszam.varosid
WHERE lelekszam.osszesen >= :minlel and lelekszam.osszesen <= :maxlel 
  and lelekszam.ev >= :minev and lelekszam.ev <= :maxev";
			$this->queryConstraints = array(
				':minlel' => $vars['min_lel'],
				':maxlel' => $vars['max_lel'],
				':minev' => $vars['min_ev'],
				':maxev' => $vars['max_ev']
			);
		} else {
			$this->sqlSelect =
				"SELECT megye.nev as megye, varos.nev as varos, lelekszam.ev as mikor, lelekszam.osszesen as lelekszam, varos.megyeijogu as megyejog
FROM megye  
INNER JOIN varos on megye.id = varos.megyeid  
INNER JOIN lelekszam on varos.id = lelekszam.varosid
WHERE lelekszam.osszesen >= :minlel and lelekszam.osszesen <= :maxlel 
and lelekszam.ev >= :minev and lelekszam.ev <= :maxev
and varos.megyeijogu = :megyeJog";
			$this->megyeJogu = $vars['megye_jog'] == "megye_jogu";
			$this->queryConstraints = array(
				':minlel' => $vars['min_lel'],
				':maxlel' => $vars['max_lel'],
				':minev' => $vars['min_ev'],
				':maxev' => $vars['max_ev'],
				':megyeJog' => ($this->megyeJogu) ? -1 : 0,
			);
		}
	}



	public function get_data($vars) {
		$retData['eredmeny'] = "";
		$varosList = array();
		try {
			$connection = Database::getConnection();
			$stmt = $connection->prepare($this->sqlSelect);
			$stmt->execute($this->queryConstraints);
			$itemCount = $stmt->rowCount();
			if ($itemCount == 0) {
				$retData['eredmeny'] = "ERROR";
				$retData['uzenet'] = "Nincsen találat!";
			} else {
				foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $Item) {
					$megyejogValue = ($Item['megyejog'] == -1) ? true : false;

					$varosList[] = [
						'megye' => $Item['megye'],
						'varos' => $Item['varos'],
						'mikor' => $Item['mikor'],
						'lelekszam' => $Item['lelekszam'],
						'megyejog' => $megyejogValue,						
					];
				}
				$retData['eredmeny'] = "OK";
				$retData['varosok'] = $varosList;
			}
		} catch (PDOException $e) {
			$retData['eredmeny'] = "ERROR";
			$retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
		}
		return $retData;
	}
}