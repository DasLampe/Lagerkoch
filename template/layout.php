<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Lagerkoch</title>
<link href="{LINK_TPL}css/my_layout.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
<link href="css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
<![endif]-->

<link href="{LINK_TPL}css/jquery.ui.css" rel="stylesheet" type="text/css" />

<script language="JavaScript" type="text/javascript" src="{LINK_LIB}jquery/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="{LINK_LIB}jquery/jquery.ui.min.js"></script>
<script language="JavaScript" type="text/javascript" src="{LINK_TPL}js/dish.js"></script>
<script language="JavaScript" type="text/javascript" src="{LINK_TPL}js/purchase.js"></script>
</head>
<body>
	<div id="header_margin">
		<div id="header">
      		<h1>Lagerkoch</h1>
      </div>
	</div>
  <div class="page_margins">
    <!-- start: skip link navigation -->
    <a class="skip" title="skip link" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
    <a class="skip" title="skip link" href="#content">Skip to the content</a><span class="hideme">.</span>
    <!-- end: skip link navigation -->
    <!-- start: skip link navigation -->
    <!-- end: skip link navigation -->
    <div class="page">

      <div id="nav">
        <!-- skiplink anchor: navigation -->
        <a id="navigation" name="navigation"></a>
        <div class="hlist">
          <!-- main navigation: horizontal list -->
          <ul>
            <li><a href="{LINK_MAIN}main">Startseite</a></li>
            <li><a href="{LINK_MAIN}dish">Gericht eintragen</a></li>
            <li><a href="{LINK_MAIN}purchase">Einkaufsliste erstellen</a></li>
          </ul>
        </div>
      </div>
      <div id="main">
      	<div id="col1" class="clearfix">
      		{content}
      	</div>
      </div>
  </div>
</div>
       <!-- begin: #footer -->
      <div id="footer">Layout based on <a href="http://www.yaml.de/">YAML</a>
      </div>
      <!-- begin: #footer -->
</body>
</html>