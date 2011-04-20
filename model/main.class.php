<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class mainModel extends basePage
{
	public function noEvent()
	{
		$this->tpl->vars("headline",	"Willkommen");
		$this->tpl->vars("content",		"Beim Lagerkoch!");
		$this->tpl->vars("content",		$this->tpl->load("_p"));
		
		return $this->tpl->load("_standartContent");
	}
	
	public function testEvent()
	{
		return 'bla';
	}
}