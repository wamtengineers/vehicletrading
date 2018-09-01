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
</script>  
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