<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once(dirname(__FILE__)."/path.conf.php");
include_once(dirname(__FILE__)."/database.conf.php");
error_reporting(E_ALL);

header('Content-Type: text/html; charset=utf-8');
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
