<?php
include_once("../config/path.conf.php");
include_once(PATH_CLASS."helper.class.php");
include_once(PATH_CLASS."template.class.php");
include_once(PATH_CLASS."resourceController.class.php");

$file	= helper::getFilepath($_SERVER['REQUEST_URI']);
$tpl	= template::getInstance();

if(file_exists(PATH_MAIN."model/".$file) === true && helper::specialFile($file) === false)
{
	include_once(PATH_MAIN."model/".$file);
}
elseif(file_exists(PATH_MAIN.$file) === true && helper::specialFile($file) === true)
{
	new resourceController($file);
	exit();
}
else
{
	$tpl->vars("content",	"Datei nicht vorhanden!");
}

$tpl->load("layout", 1);
