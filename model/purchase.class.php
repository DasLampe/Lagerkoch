<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class purchaseModel extends basePage
{
	public function noEvent()
	{
		$this->tpl->vars("purchaseForm",		$this->purchaseForm());
		return $this->tpl->load("main",0, PATH_VIEW."purchase/");
	}
	
	private function getPurchaseData()
	{
		$db		= Db::getConnection();
		
		$result	= $db->prepare("SELECT zutaten_id, SUM(`unity`) as unity
								FROM ".MYSQL_PREFIX."rezeptZutaten
								WHERE rezept_id IN ".helper::placeholders($_POST['dishes'])."
								GROUP BY zutaten_id");
		$result->execute($_POST['dishes']);
		$row	= $result->fetchAll(PDO::FETCH_ASSOC);
		
		for($i=0;$i<count($row);$i++)
		{
			$result	= $db->prepare("SELECT name, unit, price
						FROM ".MYSQL_PREFIX."zutaten
						WHERE id = :zutaten_id");
			$result->bindValue(':zutaten_id', $row[$i]['zutaten_id']);
			$result->execute();
			$rowZutaten				= $result->fetch(PDO::FETCH_ASSOC);
			
			$row[$i]['name']		= $rowZutaten['name'];
			$row[$i]['price']		= $rowZutaten['price'];
			$row[$i]['unit']		= $rowZutaten['unit'];
			$row[$i]['pricePerson']	= (($rowZutaten['price'] * $row[$i]['unity']) * $_POST['person']);
			$row[$i]['unity']		= ($row[$i]['unity'] * $_POST['person']);
		}
		
		return $row;
	}
	
	public function getPurchase()
	{
		$table_row		= "";
		
		$row			= $this->getPurchaseData();
		foreach($row as $element)
		{
			$this->tpl->vars("ingredientName",		$element['name']);
			$this->tpl->vars("ingredientPrice",		round($element['price'],2));
			$this->tpl->vars("ingredientUnity",		round($element['unity'],2,PHP_ROUND_HALF_UP));
			$this->tpl->vars("ingredientUnit",		$element['unit']);
			$this->tpl->vars("ingredientPriceGes",	round($element['pricePerson'], 2, PHP_ROUND_HALF_UP));
			
			$table_row	.= $this->tpl->load("_ingredientList", 0, PATH_VIEW."purchase/");
		}

		return $table_row;
	}
	
	private function purchaseForm()
	{
		$this->tpl->vars("dishes",		$this->getDishes());
		return $this->tpl->load("purchaseForm", 0, PATH_VIEW."purchase/");
	}
	
	public function getDishes()
	{
		$content	= "";
		$db			= Db::getConnection();
		
		$result		= $db->query("SELECT id, name FROM ".MYSQL_PREFIX."rezept");
		while($row	= $result->fetch(PDO::FETCH_ASSOC))
		{
			$content	.= '<li>'.$row['name'].' <input type="hidden" name="dishes_draft[]" value="'.$row['id'].'" /></li>';
		}
		
		return $content;
	}
	
	public function getList()
	{
		$dishes		= $this->getPurchaseData();
		
		require_once(PATH_CLASS."pdf.class.php");
		
		$header=array('Zutat','Menge');
		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial', '', 28);
		$pdf->Cell(80);
		$pdf->Cell(30,10,'Einkaufsliste',0,0,'C');
		$pdf->ln();
		$pdf->SetFont('Arial','',16);
		$pdf->Cell(150);
		$pdf->Cell(40,10,utf8_decode('für ').$_POST['person'].' Personen',0,0,'R');
		$pdf->ln();
		$pdf->FancyTable($header,$dishes);
		
		$pdf->SetY(-32);
		$pdf->SetFont('Arial', '', 14);
		$pdf->Cell(40,10, '(c) Lagerkoch');
		$pdf->Cell(100);
		$pdf->Cell(40,10, 'http://andreflemming.de');
		return $pdf->Output();
	}
}