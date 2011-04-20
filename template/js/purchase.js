$(document).ready(function () {
		$('#dishes li').live('click', function() {
			$(this).appendTo('#purchase ul').show('highlight', 'slow');
			$(this).find('input').attr('name', 'dishes[]');
			getTable();
			return false;
		});
		
		$('#purchase li').live('click', function() {
			$(this).appendTo('#dishes ul').show('slide', 'slow');
			$(this).find('input').attr('name', 'dishes_draft[]');
			getTable();
			return false;
		});
		
		$('input[name="person"]').change(function() {
			getTable();
		});
		
		$('form[name="purchase"]').submit(function() {
			if($('form[name="purchase"]').find('input[name="person"]').val() == "")
			{
				alert("Bitte eine Anzahl an Personen eingeben");
				return false;
			}
			if($('#purchase ul').has('li').size() <= 0)
			{
				alert("Es müssen Rezepte ausgewählt sein!");
				return false;
			}
		});
		
		function getTable() {
			$('tbody').children('tr').remove();
			if($('#purchase ul').has('li').size() <= 0)
			{
				return false;
			}
			
			if($('form[name="purchase"]').find('input[name="person"]').val() == "")
			{
				alert("Bitte eine Anzahl an Personen eingeben");
				return false;
			}
			$.ajax({
				url: '%LINK_MAIN%purchase/getPurchase',
				type: "post",
				data: $('form[name="purchase"]').find('input[name="person"]').serialize()+'&'+$('#purchase').find('input[name="dishes[]"]').serialize(),
				dataType: "html",
				success: function (data) {
					$('table > tbody').append(data);
				}
			});
			return false;
		};
});