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
    { $recPerPage=10;
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
				var ev_x = e.pageX;
				var ev_y = e.pageY;
			     e.preventDefault();		
			       var name=$(this).attr('id');
		           var value=$(this).attr('class');
				   var fdate=$('#fdate').val();
				   var tdate=$('#tdate').val();
				   //$('#shwprt').show().fadeIn("slow");
  

		         $('#shwprt').css({'position':'fixed','box-shadow':'1px 1px 10px #333333','background-color':'#f7f7f7','color':'#FFFFFF'})
				 .load("issRtnRpt.php"+"?"+$(this).attr('id')+"="+value+"&fdate="+fdate+"&tdate="+tdate).fadeIn("slow");
			  });  


		    });
		  </script>
		 
<?php 	  
	  $deptsearch=!empty($_GET['deptsearch'])?$_GET['deptsearch']:'';
	  $fdate=!empty($_GET['fdate'])?$_GET['fdate']:'';
	  $tdate=!empty($_GET['tdate'])?$_GET['tdate']:'';
	  
	  $deptsearch=$pg->select("SELECT id FROM tbl_department WHERE name like'$_GET[deptsearch]%'");
	  $deptf=$pg->get_row($deptsearch,'MYSQL_ASSOC');
	  
	 ?>

	 <?php
		echo "<div class=\"data\">";
		if(!empty($fdate)&&!empty($tdate)&&empty($_GET['deptsearch'])){
		    $sql="select d.name,c.id courseid,c.coursename,s.stdid,s.stdname
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.issuedate between '$fdate' and '$tdate'
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
								where b.issuedate between '$fdate' and '$tdate'
								and b.irstatus<>'RETURN'
								
								LIMIT {$pg->getStart()}, {$pg->getPerPage()}";
		}else if(!empty($fdate)&&!empty($tdate)&&!empty($_GET['deptsearch'])){
		    $sql="select d.name,c.id courseid,c.coursename,s.stdid,s.stdname
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.issuedate between '$fdate' and '$tdate'
								and b.deptid='$deptf[id]'
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
								where b.issuedate between '$fdate' and '$tdate'
								and b.deptid='$deptf[id]'
								and b.irstatus<>'RETURN'
								LIMIT {$pg->getStart()}, {$pg->getPerPage()}";
		}else if(!empty($_GET['deptsearch'])){
		    $sql="select d.name,c.id courseid,c.coursename,s.stdid,s.stdname
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.deptid='$deptf[id]'
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
								where b.deptid='$deptf[id]'
								and b.irstatus<>'RETURN'
								LIMIT {$pg->getStart()}, {$pg->getPerPage()}";
		}else{
		    $sql="select d.name,c.id courseid,c.coursename,s.stdid,s.stdname
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_stdinfo s
								on s.stdid=b.stdid
								where b.irstatus<>'RETURN'
								UNION ALL
								select d.name,c.id courseid,c.coursename,s.facultyid stdid,s.name stdname
								from tbl_bookissue b
								inner join tbl_courses c
								on c.id=b.courseid
								inner join tbl_department d
								on d.id=b.deptid
								inner join tbl_faculty s
								on s.facultyid=b.stdid
								where b.irstatus<>'RETURN'
								
								LIMIT {$pg->getStart()}, {$pg->getPerPage()}";
		}						
			$prs->CurrentDateReturn($sql,'y');
	    	
?>	 
<?php 
			 /* --------------------------------------------- */
			if(!empty($fdate)&&!empty($tdate)){
				$query_pag_num = "select count(*) AS count
												from tbl_bookissue 
												where irstatus<>'RETURN'
												and issuedate between '$fdate' and '$tdate'";
			}else if(!empty($fdate)&&!empty($tdate)&&!empty($deptsearch)){
				$query_pag_num = "select count(*) AS count
												from tbl_bookissue 
												where irstatus<>'RETURN'
												and deptid='$deptf[id]'
												and issuedate between '$fdate' and '$tdate'";
			}else if(!empty($deptsearch)){
				$query_pag_num = "select count(*) AS count
												from tbl_bookissue 
												where irstatus<>'RETURN'
												and deptid='$deptf[id]'";
			
			}else{
				$query_pag_num = "select count(*) AS count
												from tbl_bookissue 
												where irstatus<>'RETURN'
												";
			}								
			 $pg->setPerPage($recPerPage);										
	         echo $pg->pageNumber($query_pag_num,$pg->getPerPage(),$_GET['page']);

?>	 
</div>

<?php    }

   }else{
     $msg="Sorry,you are not authorized to access this page";
	 header("Location:home.php?msg=$msg");
   }	 

}else{
  header("Location:index.php");
}
}