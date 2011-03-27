<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class resourceController
{
	public function __construct($file)
	{
		//$file	= explode("/", $file);
		$file	= str_replace("-", "/", $file);
		$type	= $this->getHeaderType($file);
		
		if(file_exists(PATH_MAIN.$file))
		{
			if($type =="application/x-httpd-php")
			{
			 	include(PATH_MAIN.$file);
			}
			else
			{
				global $param;
				if(isset($_SERVER['HTTP_REFERER']))
				{
					$referer	= $_SERVER['HTTP_REFERER'];
				}
				else
				{
					$referer	= LINK_MAIN;
				}
				
				 header("Content-Type: ".$type);
				//readfile(PATH_MAIN.$file); ---> Old Way
				 $content		= file_get_contents(PATH_MAIN.$file);		
				 
				echo $content;
			}
		}
		else
		{
			echo 'Datei ('.$file.') existiert nicht!';
		}
	}
	
	private function getHeaderType($file)
	{
		$type	= explode(".", $file);
				
		switch($type[1])
		{
			 case "css":
				$type = "text/css";
				break;
			case "jpg":
				$type = "image/jpg";
				break;
			case "gif":
				$type = "image/gif";
				break;		
			case "png":
				$tpye = "image/png";
				break;
			case "js":
				$type = "text/javascript";
				break;
			case "php":
				$type = "application/x-httpd-php";
				break;
		}
		
		return $type;
	}
}