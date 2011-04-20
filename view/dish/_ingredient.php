<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
		<tr>
			<td><input type="text" name="ingredientName[]" value="" /></td>
			<td><input type="text" name="ingredientPrice[]" value="" style="width: 40px;" /> €</td>
			<td><input type="text" name="ingredientUnitPrice[]" value=""  style="width: 50px;"/></td>
			<td>
				<select name="ingredientUnit[]">
					<option value="kg">kg</option>
					<option value="g">g</option>
					<option value="l">l</option>
					<option value="ml">ml</option>
					<option value="Stück">Stück</option>
				</select>
			</td>
			<td><input type="text" name="ingredientUnity[]" value="" style="width: 50px;"/>
				<span class="unit"> </span>
				<input type="hidden" name="database" value="false" />
			</td>
		</tr>