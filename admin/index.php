<?php session_start(); include"../Modules/connect.php"; include"../admin/Modules/functionadmin.php";include"../admin/Modules/quanlynhomsp.php";include"../admin/Modules/quanlyloaisp.php";include"../admin/Modules/quanlysanpham.php";include"../admin/Modules/quanlyhoadon.php";include"../admin/Modules/quanlybinhluan.php";include"../admin/Modules/quanlyptvc.php";include"../admin/Modules/quanlypttt.php";include"../admin/Modules/quanlyanh.php";include"../admin/Modules/quanlythanhvien.php";include"../admin/Modules/quanlyadmin.php";include"../admin/Modules/quanlymucgia.php";?>
<!doctype html>
<html>
	<head>
		<title>TRANG QUẢN TRỊ SHOP ONLINE</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Bootstrap Core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="css/sb-admin.css" rel="stylesheet">
		<!-- Custom Fonts -->
		<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- js -->
		<script type="text/javascript" src="../js/jquery-1.12.0.min.js"></script>
		<!-- //js -->
        <!-- Validate -->
        <script src="../js/jquery.validate.min.js"></script>
		<!-- Ckeditor -->
        <script src="../ckeditor/ckeditor.js"></script>
        <!-- Ajax -->
        <script type="text/javascript" src="js/ajax.js"></script>
	</head>
	<body>
	<?php
		if(isset($_SESSION['admin']))
			include"controllpanel.php";
		else
			loginadmin();
	?>
	<!-- Bootstrap Core JavaScript -->
	<script src="../js/bootstrap.min.js"></script>
	</body>
</html>
