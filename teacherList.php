		<script src="_lib/jquery-1.7.min.js"></script>

		<script src = "_lib/jquery.mousewheel.js"></script>
		
		<!-- iosSlider plugin -->
		<script src = "_src/jquery.iosslider-vertical.min.js"></script>

		<style type="text/css">
		body, h1, h2, h3, h4, h5, h6, .heading{font-family:"Segoe UI", "Roboto", "Helvetica Neue", Arial, sans-serif;}
			.iosslider-vertical {
				position: relative;
				top: 0;
				left: 0;
				overflow: hidden;
				
				width: 220px;
				height: 680px;
				background: #eee;
			}
			
			.iosslider-vertical .slider {
				width: 100%;
				height: 100%;
			}
			
			.iosslider-vertical .slider .item {
				float: left;
				
				padding: 10px 30px 10px 30px;
				border-bottom: 1px solid #ddd;
			}
			
			.iosslider-vertical .slider .item.first {}
			
			.iosslider-vertical .slider .item.last {
				border-bottom: 0;
			}
			
			.iosslider-vertical .slider .item .copy {
			  clear:both;
			  margin:10px 0 10px 0;
			}
			.iosslider-vertical .slider .item img {
				/*float: left; */
				width: 98%;
			}
			
			.iosslider-vertical .slider .item h3 {
				  margin:10px 0 20px 0;
				font-size: 90%;
			}
			
			.iosslider-vertical .slider .item p {
				margin: 5px 0 0 0;
				font-size: 85%;
			}
			
			.iosslider-vertical .scrollbar {
				width: 12px;
				background: #aaa;
				position: absolute;
				top: 0;
				bottom: 26px;
				right: 0;
			}
			
			.iosslider-vertical .prev {
				width: 12px;
				height: 12px;
				background: #666 url(_resources/paging.png) no-repeat 0 0;
				position: absolute;
				bottom: 13px;
				right: 0;
				cursor: pointer;
			}
			
			.iosslider-vertical .next {
				width: 12px;
				height: 12px;
				background: #666 url(_resources/paging.png) no-repeat 0 -12px;
				position: absolute;
				bottom: 0;
				right: 0;
				cursor: pointer;
			}
			
			.iosslider-vertical .prev:hover,
			.iosslider-vertical .next:hover {
				background-color: #505050;
			}
		</style>
		
		<!-- jQuery library -->
		
		<script type="text/javascript">
			$(document).ready(function() {
			
				$('.iosslider-vertical').iosSliderVertical({
					scrollbarMargin: 0,
					scrollbarWidth: 12,
					scrollbarBorderRadius: 0,
					scrollbarContainer: '.scrollbar',
					snapToChildren: true,
					infiniteSlider: true,
					desktopClickDrag: true
				});
				
			});
		</script>
		<?php 
		mysql_connect("localhost","root","dtbd13adm1n");
		mysql_select_db("simtdb");
		//echo "select f.*, d.name as designation, dpt.name as departmentname from tbl_faculty f inner join tbl_designation d on f.designationid=d.id inner join tbl_department dpt on f.deptid=dpt.id where f.storedstatus<>'D' Order by id ASC";
		?>
		<div class = 'iosslider-vertical'>
		
			<div class = 'slider'>
			
				<?php 
				$tlq = mysql_query("select f.*, d.name as designation, dpt.name as departmentname from tbl_faculty f inner join tbl_designation d on f.designationid=d.id inner join tbl_department dpt on f.deptid=dpt.id where f.storedstatus<>'D' Order by d.torder ASC");
				$i=0;
				while($tlqf = mysql_fetch_array($tlq)){
				?>
				<div class = 'item'>
				
					<?php if($tlqf['img']<>""){?>
					<img class = 'left' src = "facultyphoto/<?php echo $tlqf['img']; ?>" height="177" />
					<?php }else if($tlqf['img'] == ""){ ?>
					<img class = 'left' src = "facultyphoto/<?php if($tlqf['sex']=="Male"){ ?>male.jpg<?php }else if($tlqf['sex'=="Female"]){?>female.jpg<?php }?>" height="177" />
					<?php } ?>
					
					<div class = 'copy'>
					
						<h3><?php echo $tlqf['name']; ?></h3>
					
						<p><?php echo $tlqf['designation'].' ('.$tlqf['departmentname'].')';?>
						<br/>
						<?php echo $tlqf['eduqualification'];?>
						<br/>
						<?php echo $tlqf['contactno'];?>
						</p>
						
					</div>
				
				</div>
				<?php } ?>
				
			</div>
			
			<!--<div class = 'scrollbar'></div> -->
			<div class = 'prev' onclick = "$('.iosslider-vertical').iosSliderVertical('prevPage');"></div>
			<div class = 'next' onclick = "$('.iosslider-vertical').iosSliderVertical('nextPage');"></div>
		
		</div>
          <!-- ################################################################################################ --> 
