<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<form class="yform" name="dish" action="{LINK_MAIN}dish/insertDish" method="post">
<fieldset>
	<legend>Gericht Infos</legend>
	
	<label for="dishName">Name des Gerichtes</label>
	<input type="text" name="dishName" value="" />
	
	<label for="dishPerson">Anzahl der Personen: </label>
	<input type="text" name="dishPerson" value="" />
</fieldset>

<fieldset name="ingredient">
	<legend>Zutaten</legend>
	<table style="width: 100%">
		<tr>
			<th>Name</th>
			<th style="width: 50px;">Preis</th>
			<th style="width: 100px;">Preis pro</th>
			<th>Einheit</th>
			<th>Benötigte Menge</th>
		</tr>
		{ingredient}
	</table>
	<p class="float_right">
		<a href="{LINK_MAIN}dish/addIngredientInput" class="add">Weitere Zutat hinzufügen</a>
	</p>
</fieldset>

<fieldset>
	<legend>Absenden</legend>
	<input type="submit" name="submit" value="Eintragen" />
</fieldset>
</form>