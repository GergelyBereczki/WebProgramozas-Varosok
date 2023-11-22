<?php

class Grafikon_Controller {
	public $baseName = 'grafikon';  //meghatározni, hogy melyik oldalon vagyunk

	public function main(array $vars) { // a router által továbbított paramétereket kapja
		$osszVarosModel = new Osszvaros_Model;
		//a modellben belépteti a felhasználót
		$retData = $osszVarosModel->get_data($vars);

		//betöltjük a nézetet
		$view = new View_Loader($this->baseName . "_main");
		foreach ($retData as $name => $value)
			$view->assign($name, $value);
	}
}

?>