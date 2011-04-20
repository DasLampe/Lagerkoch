<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
abstract class basePage
{
	protected $tpl;
	
	public function __construct()
	{
		include_once(PATH_CLASS."template.class.php");
		$this->tpl	= template::getInstance();
	}
	
	/**
	 * Sollte keine Methode gefunden werden, führe diese aus
	 * Evtl später noch Log Funktion
	 * @param string $request
	 * @return Methode (dadraus string (Template))
	 */
	public function noMethod($request)
	{
		return $this->noEvent();
	}
}