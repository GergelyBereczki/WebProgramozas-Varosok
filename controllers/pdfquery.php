<?php

error_reporting(E_ALL);
ini_set('display_errors', "On");

require_once(SERVER_ROOT . 'tcpdf/tcpdf.php');


class Pdfquery_controller {
	public $baseName = 'pdfmaker';

	public function main(array $vars) {
		$pdfQueryModel = new Pdfquery_model($vars);
		$retData = $pdfQueryModel->get_data($vars);
		if ($retData['eredmeny'] == "OK") {
			$pdf = new MyPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('Web-programozás II');
			$pdf->SetTitle('Városok');
			$pdf->SetSubject('Városok');
			$pdf->SetKeywords('TCPDF, városok, lélekszám, megye');

			$pdf->SetHeaderData(SITE_ROOT . "images/icon.png", 30,
								"LAKOSSÁG LISTÁJA",
								"Web-programozás II\n2. projektfeladat\n" . date('Y.m.d-G:i:s', time()));

			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			$l = array();
			if (@file_exists(dirname(__FILE__) . '/lang/hun.php')) {
				require_once(dirname(__FILE__) . '/lang/hun.php');
				$pdf->setLanguageArray($l);
			} else if (@file_exists('.tcpdf/examples/lang/hun.php')) {
				require_once('.tcpdf/examples/lang/hun.php');
				$pdf->setLanguageArray($l);
			} else {
				$l['a_meta_charset'] = 'UTF-8';
				$l['a_meta_dir'] = 'ltr';
				$l['a_meta_language'] = 'hu';
				$l['w_page'] = 'oldal';
				$pdf->setLanguageArray($l);
			}

			$pdf->SetFont('helvetica', 'B', 10);

			// add a page
			$pdf->AddPage();

			// table caption
			$caption = 'LAKOSSÁG';

			// column titles
			$header = array('MEGYE', 'VÁROS', 'ÉVSZÁM', 'LAKOSSÁG', 'MEGYEJOG');

			// data loading
			$rows = $retData['varosok'];
//			$rows = $pdf->LoadData('tanosveny', 'ut');

			// print colored table
			$pdf->ColoredTable($caption, $header, $rows);

			// close and output PDF document
			$pdf->Output('varosok' . date('Ymd-Gis', time()) . '.pdf', 'D');
		} else {
			$view = new View_Loader($this->baseName . '_main');
			foreach ($retData as $name => $value) {
				$view->assign($name, $value);
			}
		}
	}
}
