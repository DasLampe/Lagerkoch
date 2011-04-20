<?php
class pageController
{
	private $tpl;
	
	public function __construct()
	{
		require_once(PATH_CLASS."template.class.php");
		$this->tpl		= template::getInstance();
		$this->standartTpl();
	}
	
	/**
	 * Ist $request eine Datei, welche über ResourceController aufgerufen wird?
	 * @param string $request
	 * @return boolean
	 */
	public function isSpecialFile($request)
	{
		$request	= explode(".", $request);
		switch($request[count($request)-1])
		{
			case "css":
			case "jpg":
			case "gif":
			case "png":
			case "js":
				return true;
				break;
			default:
				return false;
		}
	}
	
	/**
	 * Ist $request eine Seite?
	 * @param string $request
	 * @return boolean
	 */
	public function isSite($request)
	{
		$request	= helper::deleteDirName($request);
		if(preg_match("!(.*\/|\/.*\/)!s", $request))
		{
			$request	= explode("/", $request);
			$file		= $request[0];
		}
		else
		{
			$file		= $request;
		}
		
		if(file_exists(PATH_MODEL.$file.".class.php"))
		{
			return true;
		}
		return false;
	}
	
	public function renderPage($request)
	{
		$request	= helper::deleteDirName($request);
		if(preg_match("!\/.*!s", $request))
		{
			$file	= explode("/", $request);
			$file		= $file[0];
		}
		else
		{
			$file		= $request;
		}
		
		require_once(PATH_MODEL.$file.".class.php");
		
		$pageModel	= $file."Model";		
		$pageModel	= new $pageModel;
		
		/*
		 * Lese Model für Inhalt
		 */
		if(preg_match("!(\/ajax|\/ajax\/)$!s", $request) == true || IS_AJAX == true)
		{//definded in /config/config.php
			header("Content-type: text/x-json");
			echo $this->getContent($pageModel, $request);
		}
		elseif(preg_match("!(\/pdf|\/pdf\/)$!s", $request) == true)
		{
			header("Content-type: application/pdf");
			echo $this->getContent($pageModel, $request);
		}
		else
		{
			$this->tpl->vars("content", $this->getContent($pageModel, $request));
		
			//Gebe Template aus
			$this->tpl->load("layout", 1);
		}
	}
	
	/**
	 * Event Dispatcher
	 * @param class $object
	 * @param string $request
	 * @return string (Template)
	 */
	private function getContent($object, $request)
	{
		if(!preg_match("!(\/.*|\/.*\/)!s", $request))
		{
			return $object->noEvent();
		}
		elseif(helper::isEventMethod($object, $request) === true)
		{
			$request	= explode("/", $request);
			return $object->$request[1]($request);
		}
		else
		{
			return $object->noMethod($request);
		}	
	}
	
	/**
	 * Standart Template Platzhalter
	 */
	private function standartTpl()
	{
		$this->tpl->vars("LINK_MAIN",	LINK_MAIN);
		$this->tpl->vars("LINK_TPL",	LINK_TPL);
		$this->tpl->vars("LINK_LIB",	LINK_LIB);
		$this->tpl->vars("LINK_CSS",	LINK_CSS);
	}
}