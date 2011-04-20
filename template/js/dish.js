$(document).ready(function () {
	$('fieldset[name="ingredient"] > p > a[class="add"]').click(function() {
		var link=$(this).attr("href");
		$.ajax({
			url: link,
			success: function(data) {
				$(data).appendTo('fieldset[name="ingredient"] > table');
			},
			error: function(data) {
				alert("Leider ist ein Fehler aufgetreten!");
			}
		});
		return false;
	});
	
	$('input[name="ingredientName[]"]').autocomplete({
		delay: 10,
		source: "%LINK_MAIN%dish/searchIngredient/ajax",
		select: function(event, ui){
			var parent = $(this).parent().parent();
			$(this).val(ui.item.value);
			parent.find('input[name="ingredientPrice[]"]').val(ui.item.price).attr('readonly', true);
			parent.find('input[name="ingredientUnitPrice[]"]').val(ui.item.unitPrice).attr('readonly', true);
			parent.find('select[name="ingredientUnit[]"] > option[value="'+ui.item.unit+'"]').attr('selected', true);
			parent.find('select[name="ingredientUnit[]"]').attr('readonly', true);
			parent.find('span[class="unit"]').html('').html(ui.item.unit);
			parent.find('input[type="hidden"]').val("true");
		}
	});

	
	$('form[name="dish"]').submit(function() {
		var sendOk	= true;
		
		if($('input[name="dishName"]').val() == "" || $('input[name="dishPerson"]').val() == "")
		{
			sendOk	= false;
			alert("Bitte einen Namen und eine Personenanzahl für das Gericht eintragen!");
		}
		
		/*
		 * @TODO: Möglichkeit zum überprüfen ob Felder ausgefüllt sind, pro Zeile
		 var inputs = $(this).find('input');
		alert($(inputs).parent().html());
		$(inputs).each(function() {
			if($(this).find('input').val() == "")
			{
				sendOk = false;
			}
		});
			/*var inputs	= parents.find('input');
			if(inputs.is(":empty") == true)
			{
				alert("EMPTY");
			}
			else
			{
				sendOk = true;
			}
		});*/
		
		if(sendOk == true)
		{
			$.ajax({
				url: $(this).attr('action'),
				type: "post",
				data: $(this).serialize(),
				dataType: "json",
				success: function (data) {
					alert(data.status);
				}
			});
		}
		return false;
	});
});