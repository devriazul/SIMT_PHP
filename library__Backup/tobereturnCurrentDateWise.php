<?php ob_start();
session_start();
include("../config.php");
require_once('class/ReturnStatus.class.php');
require_once('class/PagingPage.class.php');

if($myDb->connectDefaultServer())
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if(($car['ins']=="y")||($_SESSION['userid']=="administrator")){
  $prs=new ReturnStatus();
  $pg=new PagingPage();
    if(isset($_GET['page']))
    { $recPerPage=20;
	  $pg->pageSetup($_GET['page'],$recPerPage);
	  $pg->setPerPage($recPerPage);		
	  $pg->setStart($pg->getPage(),$pg->getPerPage());
	  $pg->getStart();
?>
		  <script type='text/javascript' src='jquery.js'></script>
		  <script language=javascript>
		  $(document).ready(function(){
		       $('a[name=prt]').unbind().click(function(e){
			   // Event coordinates.
				var $ev_x = e.pageX;
				var $ev_y = e.pageY;
			     e.preventDefault();		
			       var name=$(this).attr('id');
		           var value=$(this).attr('class');
				   //$('#shwprt').show().fadeIn("slow");
  

		         $('#shwprt').css({'position':'absolute','box-shadow':'1px 1px 10px #333333','background-color':'#f7f7f7','color':'#FFFFFF'})
				 .load("issRtnRpt.php"+"?"+$(this).attr('id')+"="+value).fadeIn("slow");
			  });  


		    });
		  </script>

<?php	  
		
		echo "<div class=\"data\">";

		    $sql="select d.name,c.id courseid,c.coursename,s.stdid,s.stdname
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.returndate=curdate()
								and b.irstatus<>'RETURN'
								
								UNION ALL
								select d.name,c.id courseid,c.coursename,s.facultyid stdid,s.name stdname
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.returndate=curdate()
								and b.irstatus<>'RETURN'
								LIMIT {$pg->getStart()}, {$pg->getPerPage()}";
			$prs->CurrentDateReturn($sql,'y');
			                   
			
			


?> 

<?php 
			 /* --------------------------------------------- */
			$query_pag_num = "select count(*) AS count
											from tbl_bookissue b
											inner join tbl_courses c
											on c.id=b.courseid
											inner join tbl_department d
											on d.id=b.deptid
											inner join tbl_stdinfo s
											on s.stdid=b.stdid
											where b.returndate=curdate()
											and b.irstatus<>'RETURN'
											order by s.stdid
											
							";
			 $pg->setPerPage($recPerPage);										
	         echo $pg->pageNumber($query_pag_num,$pg->getPerPage(),$_GET['page']);

   }
?>	 
</div>


<?php 
   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}