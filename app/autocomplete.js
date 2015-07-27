var MIN_LENGTH = 2;
$( document ).ready(function() {
	
	$("#keywords_input").autocomplete({
	source:autocomplete.php, 
	minLength:2,
	focus : function(event, ui) {
		
		var data = $("#keywords_input").val;
		$("#keywords_input").val(data + ui.item.label);
		
	},
	select : function(event, ui){
		var data = $("#keywords_input").val;
		$("#keywords_input").val(data + ui.item.label);
	}
    });
});

