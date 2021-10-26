$(document).ready(function() {


	
	$('.remove').live('click', function() {
		
		var trigger = $(this);
		var id = $(this).attr('rel');
		
	   $('#accname').focus(function(){
	      $.get('remaning_value.php', function(result) {
              $('#amountdr').val(result);
          });
	   });   

		
		$.getJSON('mod/remove.php?id='+id, function(data) {
			
			var rows = $('.tbl_repeat tr').length;
			$('#sum').load("unique_valid.php");

			if (rows > 2) {
				trigger.closest('tr').fadeOut(300, function() {
					$(this).remove();			
					

					$('#accname').focus();
				});
			} else {
				$('.tbl_repeat').fadeOut(300, function() {
					var msg = '<p>There are currently no records available.</p>';
					$('#table_wrapper').hide().html(msg).fadeIn(300);
				});
			}
		});
		
		return false;
		
	});
	


	
	$('.add_new').click(function() {
		
		var arr = $(this).closest('form').serializeArray();
		var tbl = $('.tbl_repeat').length;
		var tblrep = $('.tbl_rep').length;
        var accname = $("#accname").val(); 
		var vouchertype=$("#vouchertype").val();
		var paytype=$("#paytype").val();
		var acctype=$("#acctype").val();
        var datastring = 'pname'+accname;
		$('.tbl_rep').remove();
		
		if((accname=="")){
			alert('Account Name cant not left empty');
			$('#accname').focus();
		}else if(vouchertype==""){
			alert('Voucher Type can not left empty');
			$('#vouchertype').focus();
		}else if(paytype==""){
			alert('Payment Type can not left empty');
			$('#paytype').focus();
		}else if(acctype==""){
			alert('Account Type can not left empty');
			$('#acctype').focus();
		}else{
		
		
		
				$.post('mod/row.php?tbl='+tbl, arr, function(data) {
					if (tbl === 0) {
						$('#table_wrapper').html(
							$(data.row).hide().fadeIn(300)
							
						);
					} else {
						
						$('.tbl_repeat tr:last').after(
													   
							$(data.row).hide().fadeIn(300)
								.css('display', 'table-row')
								
								   
		
						); 
					}
					//$('#form_products')[0].reset();
					 //$("input:text:visible:first").focus();
					 if(vouchertype=="J"){
						 $('#accname').focus();
						 $('#accname').val('');
					 }else{
						 $('#accname_m').focus();
						 $('#accname').val('');
						 $('#accname_m').val('');
					 }
				}, 'json');
				return false;
				
		} 
	});
	
    
});