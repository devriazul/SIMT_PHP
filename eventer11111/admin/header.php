<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Eventer - Admin Panel</title>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/jquery.swfupload.js"></script>
<script type="text/javascript" src="js/colorpicker.js"></script>

<script language="javascript" type="text/javascript">
	function confirmDelete(element) {
		if(confirm("Do you really want to delete " + element + "?")) {
			return true;
		}
		else {
			return false;
		}
	}
</script>

<script type="text/javascript">
	$(document).ready(function(e) {
		var loading = false;
		var targetRow;
		
		 $('#date_box_bg_color, #today_date_box_bg_color').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
		});
		
        $('td a.view-details-btn').click(function(e) {
			e.preventDefault();
			
			targetRow = $(this).closest( "tr" );
			if (!loading) {
				loading = true;
				$.get('event-get.php', {eventID:$(this).attr('id')}, function (result) {
					
					if (result.status == 'success') {
						var eventHTML = '<tr><td colspan="4"><table>';
						
						eventHTML += '<tr><td>Start Date</td><td>' + result.eventData.start_date + '</td></tr>';
						eventHTML += '<tr><td>End Date</td><td>' + result.eventData.end_date + '</td></tr>';
						eventHTML += '<tr><td>Start Time</td><td>' + result.eventData.start_time + '</td></tr>';
						eventHTML += '<tr><td>End Time</td><td>' + result.eventData.end_time + '</td></tr>';
						eventHTML += '<tr><td>Venue</td><td>' + result.eventData.venue + '</td></tr>';
						eventHTML += '<tr><td>Link</td><td>' + result.eventData.link + '</td></tr>';
						eventHTML += '<tr><td>Description</td><td>' + result.eventData.description + '</td></tr>';
						eventHTML += '<tr><td>Status</td><td>' + result.eventData.status + '</td></tr>';
						
						eventHTML += '</table></td></tr>';
						
						$(targetRow).after(eventHTML);
					}
					
					loading = false;
				}, 'json');
			}
		
		//$(this).closest( "tr" ).after('<tr><td colspan="4"><table></table></td></tr>');
        });
		
		
		$('#swfupload-control').swfupload({
			upload_url: "image-uploader.php",
			file_post_name: 'uploadfile',
			file_size_limit : "2048",
			file_types : "*.jpg;*.png;*.gif",
			file_types_description : "Image files",
			file_upload_limit : 10,
			flash_url : "js/swfupload/swfupload.swf",
			button_image_url : 'js/swfupload/XPButtonUploadText_61x22.png',
			button_width : 61,
			button_height : 22,
			button_placeholder : $('#button')[0],
			debug: false
		})
		.bind('fileQueued', function(event, file){
			var listitem='<li id="'+file.id+'" >'+
				'File: <em>'+file.name+'</em> ('+Math.round(file.size/1024)+' KB) <span class="progressvalue" ></span>'+
				'<div class="progressbar" ><div class="progress" ></div></div>'+
				'<p class="status" >Pending</p>'+
				'<span class="cancel" >&nbsp;</span>'+
				'</li>';
			$('#log').append(listitem);
			$('li#'+file.id+' .cancel').bind('click', function(){ //Remove from queue on cancel click
				var swfu = $.swfupload.getInstance('#swfupload-control');
				swfu.cancelUpload(file.id);
				$('li#'+file.id).slideUp('fast');
			});
			// start the upload since it's queued
			$(this).swfupload('startUpload');
		})
		.bind('fileQueueError', function(event, file, errorCode, message){
			alert('Size of the file '+file.name+' is greater than limit');
		})
		.bind('fileDialogComplete', function(event, numFilesSelected, numFilesQueued){
			$('#queuestatus').text('Files Selected: '+numFilesSelected+' / Queued Files: '+numFilesQueued);
		})
		.bind('uploadStart', function(event, file){
			$('#log li#'+file.id).find('p.status').text('Uploading...');
			$('#log li#'+file.id).find('span.progressvalue').text('0%');
			$('#log li#'+file.id).find('span.cancel').hide();
		})
		.bind('uploadProgress', function(event, file, bytesLoaded){
			//Show Progress
			var percentage=Math.round((bytesLoaded/file.size)*100);
			$('#log li#'+file.id).find('div.progress').css('width', percentage+'%');
			$('#log li#'+file.id).find('span.progressvalue').text(percentage+'%');
		})
		.bind('uploadSuccess', function(event, file, serverData){
			var item=$('#log li#'+file.id);
			item.find('div.progress').css('width', '100%');
			item.find('span.progressvalue').text('100%');
			var pathtofile='<a href="../images/'+file.name+'" target="_blank" >view &raquo;</a>';
			item.addClass('success').find('p.status').html('Done!!! | '+pathtofile);
		})
		.bind('uploadComplete', function(event, file){
			// upload has completed, try the next one in the queue
			$(this).swfupload('startUpload');
		})
		
		
    });
	
	function ConfirmDelete() {
		if(confirm("Do you really want to delete event(s)?")) {
			return true;
		}
		else {
			return false;
		}
	}
</script>

<script type="text/javascript" src="js/datepickercontrol.js"></script>
<script language="JavaScript">
 if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	document.write('<link type="text/css" rel="stylesheet" href="css/datepickercontrol_lnx.css">');
 }
 else{
	document.write('<link type="text/css" rel="stylesheet" href="css/datepickercontrol.css">');
 }
</script>

<!-- TinyMCE -->
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		cleanup : true,
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		//content_css : "../css/content.css",
		
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

<style>
	textarea.tinymce {
		width:630px !important;
	}
</style>

</head>

<body>

<div id="container">
	
    <div id="header">
    	<img src="images/eventer_admin_panel.png" width="245" height="41" alt="" style="margin:30px 0 0 0;"/>
    	<!--<h1 id="product-title">Eventer - PHP jQuery Interactive Events Calendar</h1>-->
    	<a href="#"><img src="" /></a>
        <div class="login">welcome <strong><?php echo $_SESSION['username']; ?></strong> | <a href="logout.php" class="logout">logout</a></div>
    </div>