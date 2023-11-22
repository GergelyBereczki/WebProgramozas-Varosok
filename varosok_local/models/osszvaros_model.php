<?php

class Osszvaros_Model {
	public function get_data($vars) {
		$retData['eredmeny'] = array();
		try {
			$dbh = new PDO('mysql:host=localhost;dbname=varosok', 'root', '',
						   array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
			$stmt = $dbh->prepare(
				"SELECT m.nev AS megye, SUM(l.osszesen) AS total_lakossag
				FROM lelekszam l
				JOIN varos v ON l.varosid = v.id
				JOIN megye m ON v.megyeid = m.id
				WHERE l.ev = 2015
				GROUP BY m.nev;"
			);
			$stmt->execute();
			foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $item) {
				$retData['uzenet']['megye'][] = $item['megye'];
				$retData['uzenet']['total_lakossag'][] = $item['total_lakossag'];
			}
		} catch
		(PDOException $e) {
			$retData['eredmeny'] = "ERROR";
			$retData['uzenet'] = $e->getMessage();
		}
		return $retData;
	}
}
