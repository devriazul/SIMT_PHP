$(document).ready(function(){
	//show loading bar
	function showLoader1(){
		$('.search-background1').fadeIn(200);
	}
	//hide loading bar
	function hideLoader1(){
		$('.search-background1').fadeOut(200);
	}	
	$("#pagesn .pages li").click(function(){
		//show the loading bar
		showLoader1();		
		$("#pagesn .pages li").css({'background-color' : ''});
		$(this).css({'background-color' : '#A5CDFA'});                
		$("#resn").load("maintab.php?page=" + this.className, hideLoader1);
	});
	
	// by default first time this will execute
	$(".1").css({'background-color' : '#A5CDFA'});
	showLoader1();
	$("#resn").load("maintab.php?page=1",hideLoader1);
        
       
});