<?php session_start();ob_start(); include"Modules/connect.php";include"Modules/function.php";?>
<!DOCTYPE html>
<html>
<head>
<title>Shop Online</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- pignose css -->
<link href="css/pignose.layerslider.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<!-- //pignose css -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<!-- //js -->
<!-- single -->
<script src="js/imagezoom.js"></script>
<script src="js/jquery.flexslider.js"></script>
<!-- single -->
 <!-- Validate -->
<script src="js/jquery.validate.min.js"></script>
<!-- for bootstrap working -->
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<!-- //for bootstrap working -->
<link rel="stylesheet" type="text/css" href="fonts/Lato.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="fonts/Montserrat.css" rel='stylesheet' type='text/css'>
<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<script src="js/jquery.easing.min.js"></script>
</head>
<body>
<header class="header-bot"><?php headerhome();?></header>
<nav class="ban-top"><?php navhome();?></nav>
<?php dieuhuong();?>
<section class="coupons"><?php coupons();?></section>
<!-- footer -->

<footer class="footer"><?php footer();?></footer>
<!-- //footer -->
<?php ob_flush();?>
<script type="text/javascript">
jQuery(document).ready(function($){
if($(".btn-top").length > 0){
	$(window).scroll(function () {
		var e = $(window).scrollTop();
		if (e > 300) {
			$(".btn-top").show()
		} else {
			$(".btn-top").hide()
		}
	});
	$(".btn-top").click(function () {
		$('body,html').animate({
			scrollTop: 0
		})
	})
}
});
</script>
</body>
</html>
