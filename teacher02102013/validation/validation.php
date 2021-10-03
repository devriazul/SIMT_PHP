	<link rel="stylesheet" href="validation/css/validationEngine.jquery.css" type="text/css"/>
	<link rel="stylesheet" href="validation/css/template.css" type="text/css"/>
	<script src="validation/js/jquery-1.6.min.js" type="text/javascript">
	</script>
	<script src="validation/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="validation/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#formID").validationEngine();

			$("#formID").bind("jqv.form.validating", function(event){
				$("#hookError").html("")
			})

			$("#formID").bind("jqv.form.result", function(event , errorFound){
				if(errorFound) $("#hookError").append("There is some problems with your form");
			})
		});
	</script>