<?php
include_once("../config/config.php");
include_once(PATH_CLASS."helper.class.php");
include_once(PATH_CLASS."db.class.php");
include_once(PATH_CLASS."basePage.class.php");
include_once(PATH_CLASS."pageController.class.php");
include_once(PATH_CLASS."resourceController.class.php");

$pageController	= new pageController();
if($pageController->isSite($_SERVER['REQUEST_URI']) === true)
{
	$pageController->renderPage($_SERVER['REQUEST_URI']);
}
elseif($pageController->isSpecialFile($_SERVER['REQUEST_URI']))
{
	$resourceController	= new resourceController($_SERVER['REQUEST_URI']);	
}
elseif($pageController->isSite($_SERVER['REQUEST_URI']) === false)
{
	echo "404";
}
else
{
	header("Location: main");
}