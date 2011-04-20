<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
require_once(PATH_LIB."fpdf/fpdf.php");
class pdf extends FPDF
{
	//Colored table
	function FancyTable($header,$data)
	{
		//Colors, line width and bold font
		$this->SetFillColor(224, 224, 224);
		$this->SetTextColor(0);
		$this->SetDrawColor(19, 137, 0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		//Header
		$w=array(95,95);
		for($i=0;$i<count($header);$i++)
		{
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		}
		$this->Ln();
		//Color and font restoration
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		//Data
		$fill=false;
		foreach($data as $row)
		{
			$this->Cell($w[0],6,utf8_decode($row['name']),'LR',0,'L',$fill);
			$this->Cell($w[1],6,round($row['unity'],2,PHP_ROUND_HALF_UP).' '.utf8_decode($row['unit']),'LR',0,'R',$fill);
			$this->Ln();
			$fill=!$fill;
		}
		$this->Cell(array_sum($w),0,'','T');
	}	
}