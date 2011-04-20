<?php
$pathMain	= explode("config", dirname(__FILE__));
$dirname	= substr(dirname(__FILE__), strlen($_SERVER['DOCUMENT_ROOT']), strlen(dirname(__FILE__))-strlen("config")-strlen($_SERVER['DOCUMENT_ROOT']));

//Path (relative)
define("DIR_MAIN",		$dirname);

//Path (absolute)
define("PATH_MAIN",		$pathMain[0]);
define("PATH_CLASS",	PATH_MAIN."class/");
define("PATH_TPL",		PATH_MAIN."template/");
define("PATH_MODEL",	PATH_MAIN."model/");
define("PATH_LIB",		PATH_MAIN."lib/");
define("PATH_VIEW",		PATH_MAIN."view/");

//Links
define("LINK_MAIN",		"http://".$_SERVER['HTTP_HOST'].DIR_MAIN);
define("LINK_LIB",		LINK_MAIN."lib/");
define("LINK_TPL",		LINK_MAIN."template/");
define("LINK_CSS",		LINK_TPL."css/");
define("LINK_JS",		LINK_TPL."js/");