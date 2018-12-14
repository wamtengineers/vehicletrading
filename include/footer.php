<div id="footer" class="bottom_round_corners">
	<div id="footer_content">
    	<address>&copy; <?php echo date("Y");?> - <?php echo $site_title; ?> Admin Panel</address>
    </div>
</div>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox.min.js"></script>
<link href="js/fancybox/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/moment/moment.min.js"></script>
<script type="text/javascript" src="js/full-calendar/fullcalendar.js"></script>
<link href="js/chosen/chosen.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/chosen/chosen.jquery.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/date-range-picker/daterangepicker.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){
	$('.date-picker').daterangepicker({ singleDatePicker: true, format: 'DD/MM/YYYY'});
	$('.fancybox_iframe').fancybox({
		type: 'iframe',
		fitToView : true,
		autoScale : false
	});
	$('.fancybox-btn a, .fancyboxinline').fancybox({type: 'inline'});
	if(window.location != window.parent.location){
		$("body").addClass("popup-content");
	}
	$(".fancybox.inline").fancybox({
		type: "inline",
	});
	$('.date-timepicker').datetimepicker({
		"format": 'DD/MM/YYYY hh:mm A'
	});
	$('.date-picker2').datetimepicker({
		"format": 'DD/MM/YYYY'
	});
	$(".angular-datetimepicker").on("dp.change", function(){
		dp = $(this);
		angular.element($("#"+dp.data( 'controllerid' ))).scope().updateDate();
	});
	$("select.multiple_select").chosen({width: "100%"});
});
function select_customer( id, controller ) {
	angular.element($("#"+controller)).scope().selectCustomer( id );
	$.fancybox.close();
}
</script>
<?php include("include/upload_center.php");?> 
<script>
$(document).ready(function() {    
	$(".sorting").hover(function(){
	  $icon=$(this).find(".sort-icon i");
	  $icon.removeClass("fa-angle-"+$icon.data("hover_out")).addClass("fa-angle-"+$icon.data("hover_in"))
	},function(){
	  $icon=$(this).find(".sort-icon i");
	  $icon.addClass("fa-angle-"+$icon.data("hover_out")).removeClass("fa-angle-"+$icon.data("hover_in"))
	});
	$(".reset_search").click(function(){
		$form = $(this).parents("form");
		$form.find('input[type=text], select, textarea').val('');
		$form.submit();
	});
}); 
$(document).ready(function() { 
	$( ".manage_sortable" ).sortable({
    	revert: true,
		update: function( event, ui ){
			
		}
    });
	var is_sortable_adding = false;
	$( "#add_new_record_sortable" ).click(function(){
		if( !is_sortable_adding ) {
			is_sortable_adding = true;
			$.post( '', {tab: 'add'}, function( row ){
				$( ".manage_sortable" ).append( row );
				init_sortable();
				is_sortable_adding = false;
			});
		}
	});
	init_sortable();
});
function init_sortable(){
	$( ".manage_sortable" ).sortable( "refresh" );
	$( ".delete_record_sortable" ).unbind( 'click' ).click(function( e ){
		e.preventDefault();
		$d = $(this);
		if( confirm('Are you sure you want to delete') ){
			$.get( $d.attr( 'href' ), function(){
				$d.parents( 'tr' ).fadeOut(function(){
					$d.parents( 'tr' ).remove();
				});
			});
		}
	});
	$( ".change_status_sortable" ).unbind( 'click' ).click(function( e ){
		e.preventDefault();
		$d = $(this);
		$.get( $d.attr( 'href' ), function( response ){
			response = response.split( '##' );
			$d.attr( 'href', response[0] );
			$d.html( response[1] );
		});
	});
	$( ".save_record_sortable" ).unbind( 'click' ).click(function( e ){
		e.preventDefault();
		$d = $(this);
		var data = {tab: 'edit', id: $d.parents("tr").data( "id" )};
		$d.parents("tr").find( ".record_field_sortable" ).each(function(){
			data[ $(this).attr( 'name' ) ] = $(this).val();
		});
		$.post( '', data, function( response ){
			$d.parents("tr").addClass( 'success' )
			setTimeout(function(){
				$d.parents("tr").removeClass( 'success' );
			}, 300 );
		});
	});	
}
</script>  
<script src="js/cropit.js"></script>
<script>
$(function() {
	$('.image-editor').each(function(){
		var image_editor = $(this);
		image_editor.cropit({
			imageState: {
				src: image_editor.data( 'src' ),
			},
		});
	});
	$('.rotate-cw').click(function() {
		var image_editor = $(this).parents( '.image-editor' );
		image_editor.cropit('rotateCW');
	});
	$('.rotate-ccw').click(function() {
		var image_editor = $(this).parents( '.image-editor' );
		image_editor.cropit('rotateCCW');
	});
	$('.image-editor-done').click(function() {
		var image_editor = $(this).parents( '.image-editor' );
		image_editor.find( 'input[type=file]' ).val( '' );
		var imageData = image_editor.cropit('export');
		var data = image_editor.data( "extra_fields" );
		data.img = imageData;
		$.post( image_editor.data( "url" ), data, function(){
			
		});
		$( "#"+image_editor.data( "img" ) ).attr( "src", imageData );
		$.fancybox.close();
	});
});
</script>
<style>
a.image-editor-src {
	position: relative;
	display: block;
	max-width: 70px;
	width: 38px;
}

a.image-editor-src:before {
	display: block;
	content: "";
	padding-top: 100%;
}

.image-editor-src > img {
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
	object-fit: cover;
	display: block;
	margin: 0;
}
.cropit-preview {
	background-color: #f8f8f8;
	background-size: cover;
	border: 1px solid #ccc;
	border-radius: 3px;
	margin-top: 7px;
	width: 250px;
	height: 250px;
  }
  .cropit-preview-image-container {
	cursor: move;
  }
  .image-size-label {
	margin-top: 10px;
  }
  .image-editor button {
	margin-top: 10px;
  }
</style>
<script type="text/javascript" src="js/angular.min.js"></script>
<script type="text/javascript" src="js/angular-animate.js"></script>
<script src="js/angular-moment.min.js"></script>
<script type="text/javascript" src="js/angular-chosen.js"></script>
<script type="text/javascript" src="js/ui-bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/angularjs-datetime-picker.css" />
<script type="text/javascript" src="js/datetimepicker.js"></script>
<script type="text/javascript" src="js/vehicle.angular.js"></script>
<!-- EXTERNAL SCRIPTS FOR CALLMENICK.COM, PLEASE DO NOT INCLUDE -->
</body>
</html>