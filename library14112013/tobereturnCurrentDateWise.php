<?php ob_start();
session_start();
require_once('dbClass.php');
include("config.php");
require_once('class/ReturnStatus.class.php');
require_once('class/PagingPage.class.php');

if($myDb->connect($host,$user,$pwd,$db,true))
{ 
  if($_SESSION['userid']){
  $chka="SELECT*FROM  tbl_accdtl WHERE flname='book_entry.php' AND userid='$_SESSION[userid]'";
  $caq=$myDb->select($chka);
  $car=$myDb->get_row($caq,'MYSQL_ASSOC');
  if($car['ins']=="y"){
  $prs=new ReturnStatus();
  $pg=new PagingPage();
    if(isset($_GET['page']))
    { $recPerPage=50;
	  $pg->pageSetup($_GET['page'],$recPerPage);
	  $pg->setPerPage($recPerPage);		
	  $pg->setStart($pg->getPage(),$pg->getPerPage());
	  $pg->getStart();
		
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
								order by d.name,c.coursename
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
  header("Location:login.php");
}
}  
?>
