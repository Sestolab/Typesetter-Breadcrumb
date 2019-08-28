$(document).ready(function(){
	if($('#breadcrumb-style option:selected').val() != 'Simple')
		$('#breadcrumb-separator').hide();

	$('#breadcrumb-style').change(function(){
		if($("#breadcrumb-style").val() == 'Simple')
			$('#breadcrumb-separator').show();
		else
			$('#breadcrumb-separator').hide();
	});
});