<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class helper
{
	
	public static function getFilepath($path)
	{
		$filepath	= explode(DIR_MAIN, $path, 2);
		
		if(empty($filepath[1]))
		{
			return "index.php";
		}
		else
		{
			return $filepath[1];
		}	
	}
	
	/**
	 * Liefert CSS-Links
	 * @return string/Template
	 */
	public static function getCss()
	{
		$tpl	= template::getInstance();
		
		$css	= "";
		foreach($tpl->css as $cssFile)
		{
			$tpl->vars("css_file", $cssFile);
			$css	.=	$tpl->load("_css", 0);
		}
		
		return $css;
	}
	
	public static function specialFile($file)
	{
		$file	= explode(".",	$file, 2);
		switch($file[1])
		{
			case 'css':
			case 'js':
			case 'jpg':
				return true;
				break;
			default:
				return false;
		}
	}
}