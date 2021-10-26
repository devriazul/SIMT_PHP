// JavaScript Document
<script type="text/javascript">
            $(document).ready(function(){				   
                function loading_show(){
                    //$('#loading').hide().show().html("<img src='load.gif'/>").fadeOut();
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "GET",
                        url: "tobereturnDateWise.php",
                        data: "page="+page,
					  //  data:$("form").serialize(),
                        success: function(msg)
                        {
                            $("#container").
							 css({'box-shadow':'0px 0px 5px #888888','width':'750px','margin-left':'20px','padding':'5px'}).
							 ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
							
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
					//var catp=$("#catp").val();
                    loadData(page);
                    
                });           
            });
        </script>