<!-- functuon contentadmin -->
<?php function contentadmin(){?>
<?php
	if(isset($_GET['dieuhuong']))
		switch($_GET['dieuhuong']){
			case"home": homeadmin();
				break;
			case"doimatkhau": matkhau_update();
				break;
			case"xemnhom": nhom_list();
				break;
			case"themnhom": nhom_insert();
				break;
			case"suanhom": nhom_update();
				break;
			case"xemloaisp": loaisp_list();
				break;
			case"themloaisp": loaisp_insert();
				break;
			case"sualoaisp": loaisp_update();
				break;
			case"xemsanpham": sanpham_list();
				break;
			case"themsanpham": sanpham_insert();
				break;
			case"suasanpham": sanpham_update();
				break;
			case"xemmucgia": mucgia_list();
				break;
			case"themmucgia": mucgia_insert();
				break;
			case"suamucgia": mucgia_update();
				break;
			case"xemvc": vc_list();
				break;
			case"themvc": vc_insert();
				break;
			case"suavc": vc_update();
				break;
			case"xemtt": tt_list();
				break;
			case"themtt": tt_insert();
				break;
			case"suatt": tt_update();
				break;
			case"xemmau": mau_list();
				break;
			case"themmau": mau_insert();
				break;
			case"xemsize": size_list();
				break;
			case"themsize": size_insert();
				break;
			case"xemhoadon": hoadon_list();
				break;
			case"chitiethoadon": hoadon_update();
				break;
			case"xembinhluan": binhluan_list();
				break;
			case"suabinhluan": binhluan_update();
				break;
			case"xemanh": anh_list();
				break;
			case"themanhslide": anhslide_insert();
				break;
			case"themanhmenu": anhmenu_insert();
				break;
			case"suaanh": anh_update();
				break;
			case"xemthanhvien": thanhvien_list();
				break;
			case"themthanhvien": thanhvien_insert();
				break;
			case"suathanhvien": thanhvien_update();
				break;
			case"xemadmin": admin_list();
				break;
			case"themadmin": admin_insert();
				break;
			case"suaadmin": admin_update();
				break;
			case"logout":
				unset($_SESSION['admin']);
				echo"<script>location='?';</script>";
				break;
		}
	else
		homeadmin()

?>
<?php } ?>

<!-- functuon navadmin -->
<?php function navadmin(){?>
<?php
	$sql="select*from admin where tendangnhap='".$_SESSION['admin']."'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	$rowadmin=mysqli_fetch_array($kq);
?>
	<section class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	    </button>
	    <a class="navbar-brand" href=".">Shop Online Admin</a>
	</section>
	<!-- Top Menu Items -->
	<ul class="nav navbar-right top-nav">
	    <li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>Xin chào: <?=$rowadmin['hoten']?><b class="caret"></b></a>
	        <ul class="dropdown-menu">
	            <li>
	                <a href="?dieuhuong=doimatkhau"><i class="fa fa-fw fa-user"></i>Đổi mật khẩu</a>
	            </li>
	            <li class="sectionider"></li>
	            <li>
	                <a href="?dieuhuong=logout"><i class="fa fa-fw fa-power-off"></i> Thoát</a>
	            </li>
	        </ul>
	    </li>
	</ul>
	<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
	<section class="collapse navbar-collapse navbar-ex1-collapse" id="menu">
	    <ul class="nav navbar-nav side-nav">
	        <li class="<?php if($_GET['dieuhuong']=='home'|| $_GET['dieuhuong']==''){echo "active";} ?>">
	            <a href="?dieuhuong=home"><i class="fa fa-fw fa-home"></i> Trang chủ</a>
	        </li>
	        <li class="<?php if($_GET['dieuhuong']=='xemnhom'||$_GET['dieuhuong']=='suanhom'||$_GET['dieuhuong']=='themnhom'){echo "active";} ?>">
	        	<a href="?dieuhuong=xemnhom"><i class="fa fa-fw fa-gear"></i> Quản lý nhóm</a>
	        </li>
	        <li class="<?php if($_GET['dieuhuong']=='xemloaisp'||$_GET['dieuhuong']=='sualoaisp'||$_GET['dieuhuong']=='themloaisp'){echo "active";} ?>">
	            <a href="?dieuhuong=xemloaisp"><i class="fa fa-fw fa-gears"></i> Quản lý loại sản phẩm</a>
	        </li>
	        <li>
	            <a data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-table"></i> Quản lý sản phẩm <i class="fa fa-fw fa-caret-down"></i></a>
	            <ul id="demo" class="collapse">
	                <li>
	                    <a href="?dieuhuong=xemsanpham">Danh sách sản phẩm</a>
	                </li>
	                <li>
	                    <a href="?dieuhuong=themsanpham">Thêm sản phẩm</a>
	                </li>
	                <li>
	                    <a href="?dieuhuong=xemmau">Danh sách bảng màu</a>
	                </li>
	                <li>
	                    <a href="?dieuhuong=xemsize">Danh sách size</a>
	                </li>
	            </ul>
	        </li>
	        <li class="<?php if($_GET['dieuhuong']=='xemmucgia'||$_GET['dieuhuong']=='suamucgia'||$_GET['dieuhuong']=='themmucgia'){echo "active";} ?>">
					<a href="?dieuhuong=xemmucgia"><i class="fa fa-fw fa-search"></i> Quản lý mức giá tìm kiếm</a>
			</li>
			<li class="<?php if($_GET['dieuhuong']=='xemvc'||$_GET['dieuhuong']=='suavc'||$_GET['dieuhuong']=='themvc'){echo "active";} ?>">
					<a href="?dieuhuong=xemvc"><i class="fa fa-fw fa-truck"></i> Quản lý p.thức vận chuyển</a>
			</li>
			<li class="<?php if($_GET['dieuhuong']=='xemtt'||$_GET['dieuhuong']=='suatt'||$_GET['dieuhuong']=='themtt'){echo "active";} ?>">
					<a href="?dieuhuong=xemtt"><i class="fa fa-fw fa-credit-card"></i> Quản lý p.thức thanh toán</a>
			</li>
	        <li class="<?php if($_GET['dieuhuong']=='xemhoadon'||$_GET['dieuhuong']=='suahoadon'){echo "active";} ?>">
	            <a href="?dieuhuong=xemhoadon"><i class="fa fa-fw fa-shopping-cart"></i> Quản lý hóa đơn</a>
	        </li>
	        <li class="<?php if($_GET['dieuhuong']=='xembinhluan'||$_GET['dieuhuong']=='suabinhluan'){echo "active";} ?>">
	            <a href="?dieuhuong=xembinhluan"><i class="fa fa-fw fa-comments"></i> Quản lý bình luận</a>
	        </li>
	        <li class="<?php if($_GET['dieuhuong']=='xemanh'||$_GET['dieuhuong']=='suaanh'){echo "active";} ?>">
	            <a href="?dieuhuong=xemanh"><i class="fa fa-fw fa-picture-o"></i> Quản lý ảnh slide - Menu</a>
	        </li>
	        <li class="<?php if($_GET['dieuhuong']=='xemthanhvien'||$_GET['dieuhuong']=='themthanhvien'||$_GET['dieuhuong']=='suathanhvien'){echo "active";} ?>">
	            <a href="?dieuhuong=xemthanhvien"><i class="fa fa-fw fa-user"></i> Quản lý thành viên</a>
	        </li>
	        <?php if($rowadmin['phanquyen']==1){?>
			<li class="<?php if($_GET['dieuhuong']=='xemadmin'||$_GET['dieuhuong']=='themadmin'||$_GET['dieuhuong']=='suaadmin'){echo "active";} ?>">
	            <a href="?dieuhuong=xemadmin"><i class="fa fa-fw fa-user"></i> Quản lý Admin</a>
	        </li>
	        <?php } ?>
	    </ul>
	</section>
	<!-- /.navbar-collapse -->
<?php }?>

<!-- functuon homeadmin -->
<?php function homeadmin(){?>
	<section class="container-fluid">
	    <!-- Page Heading -->
	    <section class="row">
	        <section class="col-lg-12">
	            <ol class="breadcrumb">
	                <li class="active">
	                    <i class="fa fa-home"></i> Trang chủ
	                </li>
	            </ol>
	        </section>
	    </section>
	    <!-- /.row -->
	    <section class="row">
	        <section class="col-lg-3 col-md-6">
	            <section class="panel panel-primary">
	                <section class="panel-heading">
	                    <section class="row">
	                        <section class="col-xs-3">
	                            <i class="fa fa-comments fa-5x"></i>
	                        </section>
													<?php
														$sql="select*from binhluan where trangthai=0";
														GLOBAL $connect;
														$kq1=$connect->query($sql);
														$binhluanmoi=mysqli_num_rows($kq1);
													?>
	                        <section class="col-xs-9 text-right">
	                            <section class="huge"><?=$binhluanmoi?></section>
	                            <section>Bình luận chưa duyệt!</section>
	                        </section>
	                    </section>
	                </section>
	                <a href="?dieuhuong=xembinhluan">
	                    <section class="panel-footer">
	                        <span class="pull-left">Xem chi tiết</span>
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <section class="clearfix"></section>
	                    </section>
	                </a>
	            </section>
	        </section>
	        <section class="col-lg-3 col-md-6">
	            <section class="panel panel-green">
	                <section class="panel-heading">
	                    <section class="row">
	                        <section class="col-xs-3">
	                            <i class="fa fa-user fa-5x"></i>
	                        </section>
													<?php
														$sql="select*from thanhvien where trangthai='1'";
														GLOBAL $connect;
														$kq2=$connect->query($sql);
														$thanhvien=mysqli_num_rows($kq2);
													?>
	                        <section class="col-xs-9 text-right">
	                            <section class="huge"><?=$thanhvien?></section>
	                            <section>Thành viên</section>
	                        </section>
	                    </section>
	                </section>
	                <a href="?dieuhuong=xemthanhvien">
	                    <section class="panel-footer">
	                        <span class="pull-left">Xem chi tiết</span>
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <section class="clearfix"></section>
	                    </section>
	                </a>
	            </section>
	        </section>
	        <section class="col-lg-3 col-md-6">
	            <section class="panel panel-yellow">
	                <section class="panel-heading">
	                    <section class="row">
	                        <section class="col-xs-3">
	                            <i class="fa fa-shopping-cart fa-5x"></i>
	                        </section>
													<?php
														$sql="select*from hoadon where trangthaihoadon='1'";
														GLOBAL $connect;
														$kq3=$connect->query($sql);
														$hoadon=mysqli_num_rows($kq3);
													?>
	                        <section class="col-xs-9 text-right">
	                            <section class="huge"><?=$hoadon?></section>
	                            <section>Đơn hàng chưa xử lý!</section>
	                        </section>
	                    </section>
	                </section>
	                <a href="?dieuhuong=xemhoadon">
	                    <section class="panel-footer">
	                        <span class="pull-left">Xem chi tiết</span>
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <section class="clearfix"></section>
	                    </section>
	                </a>
	            </section>
	        </section>
          <section class="col-lg-3 col-md-6">
	            <section class="panel panel-red">
	                <section class="panel-heading">
	                    <section class="row">
	                        <section class="col-xs-3">
	                            <i class="fa fa-support fa-5x"></i>
	                        </section>
                          <?php
                            $sql="select*from sanpham where trangthaisp='1'";
                            GLOBAL $connect;
                            $kq4=$connect->query($sql);
                            $sanpham=mysqli_num_rows($kq4);
                          ?>
	                        <section class="col-xs-9 text-right">
	                            <section class="huge"><?=$sanpham?></section>
	                            <section>Tổng số sản phẩm!</section>
	                        </section>
	                    </section>
	                </section>
	                <a href="?dieuhuong=xemsanpham">
	                    <section class="panel-footer">
	                        <span class="pull-left">Xem chi tiết</span>
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <section class="clearfix"></section>
	                    </section>
	                </a>
	            </section>
	        </section>
	    <!-- /.row -->
	    </section>
	</section>
	<!-- /.container-fluid -->
<?php } ?>

<!-- functuon loginadmin -->
<?php function loginadmin(){?>
<?php
if(isset($_POST['loginadmin'])){
    $tendangnhap=addslashes($_POST['tendangnhap']);
    $matkhau=md5(addslashes($_POST['matkhau']));
    $sql="select*from admin where tendangnhap='$tendangnhap' and matkhau='$matkhau'";
    GLOBAL $connect;
    $kq=$connect->query($sql);
    if(mysqli_num_rows($kq)==0)
    	$errors="Sai tên đăng nhập hoặc mật khẩu!";
    else{
        $rowkhach=mysqli_fetch_array($kq);
        if($rowkhach['trangthaiadmin']==0)
            echo"<script>alert('Tài khoản của bạn đang bị tạm khóa. Xin liên hệ với Admin!');</script>";
        else{
            $_SESSION['admin']=$tendangnhap;
            header("Location: .");
        }
    }
}
?>
<section id="login">
    <section class="container">
      <form class="form-signin" id="loginad" method="post">
        <h1 class="form-signin-heading text-center">Đăng nhập Admin</h1>
        <section></section>
        <label>Tên đăng nhập:</label>
        <input type="text" class="form-control" name="tendangnhap" placeholder="Tên đăng nhập">
        <label>Mật khẩu:</label>
        <input type="password" class="form-control" name="matkhau" placeholder="Mật khẩu">
        <em id="tenloai-error" class="error help-block"><?php if(isset($errors)) echo $errors ?></em>
        <input class="btn btn-large btn-primary btn-block" name="loginadmin" type="submit" value="Đăng nhập">
      </form>
    </section> <!-- /container -->
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#loginad" ).validate( {
			rules: {
				tendangnhap: "required",
				matkhau: "required",
			},
			messages: {
				tendangnhap: "Tên đăng nhập không được để trống",
				matkhau: "Mật khẩu không được để trống"
			},
			errorElement: "em",
			errorPlacement: function ( error, element ) {
				// Add the `help-block` class to the error element
				error.addClass( "help-block" );

				if ( element.prop( "type" ) === "checkbox" ) {
					error.insertAfter( element.parent( "label" ) );
				} else {
					error.insertAfter( element );
				}
			},
			highlight: function ( element, errorClass, validClass ) {
				$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
			},
			unhighlight: function (element, errorClass, validClass) {
				$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
			}
		} );
	} );
</script>
<?php } ?>

<?php function matkhau_update(){?>
<?php
	if(isset($_POST['suamatkhau'])){
		$matkhaucu=md5($_POST['passcu']);
		$matkhaumoi=md5($_POST['passmoi']);
		$sql="select*from admin where matkhau='$matkhaucu' and tendangnhap='".$_SESSION['admin']."'";
		GLOBAL $connect;
		$kq=$connect->query($sql);
		if(mysqli_num_rows($kq)==0){
				$UserError="Mật khẩu cũ không chính xác";
		}else{
			$sql="update admin set matkhau='$matkhaumoi' where tendangnhap='".$_SESSION['admin']."'";
			$connect->query($sql);
			echo"<script>alert('Sửa thành công.'); location='?dieuhuong=home';</script>";
		}
	}
?>
<section class="container-fluid">
    <!-- Page Heading -->
	<section class="row">
    <section class="col-lg-12">
      <ol class="breadcrumb">
        <li>
            <i class="fa fa-home"></i>  <a href="?dieuhuong=home">Trang chủ</a>
        </li>
        <li class="active">
            <i class="fa fa-user"></i> Đổi mật khẩu admin
        </li>
      </ol>
    </section>
	</section>
	<section class="row" id="row1">
  <section class="col-lg-12">
    <section class="col-md-12 col-sm-12" >
    		<h1 class="h1align">SỬA MẬT KHẨU ADMIN</h1>
    </section>
    <form method="post" id="passadmin" class="form-horizontal">
	      <section class="form-group">
	      <label class="control-label col-md-2 col-sm-12" id="label2">Mật khẩu cũ: </label>
	      	<section class="col-md-10 col-sm-12">
	            <input class="form-control" type="password" name="passcu" id="passcu">
	            <em id="tenloai-error" class="error help-block"><?php if(isset($UserError)) echo $UserError ?></em>
	          </section>
	      </section>
				<section class="form-group">
	      	<label class="control-label col-md-2 col-sm-12" id="label2">Mật khẩu mới: </label>
	      	<section class="col-md-10 col-sm-12">
	            <input class="form-control" type="password" name="passmoi" id="passmoi">
	        </section>
	      </section>
				<section class="form-group">
	      <label class="control-label col-md-2 col-sm-12" id="label2">Nhập lại mật khẩu mới: </label>
	      	<section class="col-md-10 col-sm-12">
	            <input class="form-control" type="password" name="repassmoi" id="repassmoi">
	          </section>
	      </section>
	      <section class="form-group">
	      	<section class="col-md-12 col-sm-12" id="b-align">
						<input type="button" onClick="location='?dieuhuong=home';" class="btn btn-primary" value="Quay lại" id="input2">
	      		<input type="submit" class="btn btn-primary" name="suamatkhau" value="Sửa mật khẩu" id="input2">
	      	</section>
	      </section>
  		</form>
		</section>
	</section>
</section>
	<script type="text/javascript">
		$( document ).ready( function () {
			$( "#passadmin" ).validate( {
				rules: {
					passcu: "required",
					passmoi: {
						required: true,
						minlength: 6,
					},
					repassmoi: {
						required: true,
						minlength: 6,
						equalTo: "#passmoi"
					},
				},
				messages: {
					passcu: "Mật khẩu cũ không được để trống",
					passmoi: {
						required: "Mật khẩu mới không được để trống",
						minlength: "Mật khẩu mới phải có ít nhất 6 ký tự"
					},
					repassmoi: {
						required: "Nhập lại mật khẩu mới không được để trống",
						minlength: "Nhập lại mật khẩu mới phải có ít nhất 6 ký tự",
						equalTo: "Nhập lại mật khẩu mới và mật khẩu mới không khớp nhau"
					},
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
			} );
		} );
	</script>
<?php } ?>
