<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class resourceController
{
	public function __construct($request)
	{
		$request	= helper::deleteDirName($request);
		$type		= $this->getHeaderType($request);
		
		if(file_exists(PATH_MAIN.$request))
		{
			if($type =="application/x-httpd-php")
			{
			 	include(PATH_MAIN.$request);
			}
			else
			{
				header("Content-Type: ".$type);
				$content	= file_get_contents(PATH_MAIN.$request);
				$search		= array(
									"%LINK_MAIN%",
				 					"%LINK_CSS%",
									"%LINK_LIB%",
									"%LINK_TPL%"
				 					);
				$replace	= array(
				 					LINK_MAIN,
				 					LINK_CSS,
				 					LINK_LIB,
				 					LINK_TPL,
				 					);
				$content	= str_replace($search, $replace, $content);

 				echo $content;
			}
		}
		else
		{
			echo 'Datei ('.$request.') existiert nicht!';
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