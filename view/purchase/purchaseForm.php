<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<form class="yform" name="purchase" action="{LINK_MAIN}purchase/getList/pdf" method="post" enctype="application/pdf">
<fieldset>
	<legend>Allgmeien Infos</legend>
	
	<label for="person">Anzahl der Personen</label>
	<input type="text" name="person" value="" />
</fieldset>

<fieldset>
	<legend>Gerichte</legend>
	
	<div id="dishes">
		<h2>Rezepte</h2>
		<ul>
			{dishes}
		</ul>
	</div>
	
	<div id="purchase" class="clearfix">
		<h2>Essenplan</h2>
		<ul>
		</ul>
	</div>
</fieldset>

<fieldset>
	<legend>Einkaufsliste</legend>
	
	<table width="100%">
		<thead>
			<tr>
				<th width="300px">
					Zutat
				</th>
				<th width="150px">
					Stückpreis
				</th>
				<th width="150px">
					Menge
				</th>
				<th width="150px">
					Gesamtpreis
				</th>
			</tr>
		</thead>
		<tbody>
		
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend>Einkaufsliste drucken</legend>
	<input type="submit" name="submit" value="Liste erstellen" />
</fieldset>
</form>