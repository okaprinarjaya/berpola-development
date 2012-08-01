<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Example Application</title>
<script type="text/javascript" src="<?php echo ASSETS_PATH; ?>/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_PATH; ?>/js/formee.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_PATH; ?>/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_PATH; ?>/css/dropdownmenu/helper.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_PATH; ?>/css/dropdownmenu/dropdown.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_PATH; ?>/css/dropdownmenu/default.ultimate.css" media="screen" />
<link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/formee-structure.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>/css/formee-style.css" type="text/css" media="screen">
</head>

<body>
	<div class="topbar">
	  <a style="font-weight:bold;" class="left" href="#" title="Formee website">Example Application</a>
	</div>     
	
	<div class="formeebar">
	<div id="menunav" style="background:#EDECEB;">
		
          <ul id="nav" class="dropdown dropdown-horizontal">
            <li><a href="<?php echo HOSTNAME; ?>" title="Dashboard">Dashboard</a></li>
			
            <li><span class="dir">Master Data</span>
				<ul>
					<li><a href="<?php echo HOSTNAME; ?>/product.php" title="Data Product">Data Product</a></li>
					<li><a href="<?php echo HOSTNAME; ?>/supplier.php" title="Data Supplier">Data Supplier</a></li>
					<li><a href="<?php echo HOSTNAME; ?>/category.php" title="Data Category Product">Data Category Product</a></li>

					<li><span class="dir">Sample Sub Menu 3</span>
						<ul>
						<li><a href="#" title="Sample sub menu 1">Sample sub sub menu 2.1</a></li>
						<li><a href="#" title="Sample sub menu 2">Sample sub sub menu 2.2</a></li>
						</ul>
					</li>
				</ul>
			</li>
          </ul>
	</div>
	</div>
	
	<div class="container">
		<?php echo $flash_message; ?>
		<?php echo $content; ?>
	</div>

	<div class="footer">
		<div class="container">
		  <p><a href="http://www.formee.org/" title="Formee">Formee</a> was created and developed by <a class="twitter-anywhere-user" href="http://www.bernarddeluna.com/" title="bernard de luna">Bernard De Luna</a>, <a class="twitter-anywhere-user" href="http://www.dnlaraujo.com.br/" title="Daniel Araujo">Daniel Araujo</a>, <a class="twitter-anywhere-user" href="http://www.marcellomanso.com.br/" title="Marcello Manso">Marcello Manso</a></p>
		  <p>Licensed under <a rel="license" href="http://www.gnu.org/licenses/gpl.html" title="GPL">GPL</a> and <a rel="license" href="http://www.opensource.org/licenses/mit-license.php" title="MIT">MIT</a></p>
		</div>
	</div>
	
</body>
</html>