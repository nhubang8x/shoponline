<!-- functuon Danh sách + Xóa Admin-->
<?php function admin_list(){ ?>
<?php
if(isset($_GET['IDadmin'])){
	$sql="delete from admin where IDadmin=".$_GET['IDadmin'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemadmin';</script>";
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
                    <i class="fa fa-fw fa-user"></i> Quản lý admin
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">DANH SÁCH ADMIN</h1>
        <section class="col-md-6 col-sm-12" id="input3">
        	<button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themadmin';"><span class="fa fa-plus"></span> Thêm Admin</button></section>
        <section class="col-md-6 col-sm-12" id="input3">
		   	<section class="search-box">
			    <form class="search-form">
			    	<input class="form-control" name="search" id="search" placeholder="Tìm kiếm" type="text">
			     	<button class="btn btn-link search-btn"><i class="glyphicon glyphicon-search"></i>
			     </button>
			    </form>
		  	 </section>
		</section>
		<section class="form-inline" id="loc1">
			<section class="form-group input-group">
		        <span class="input-group-addon">Hiển thị:</span>
		            <select class="form-control" name="hienthi" onChange="location=this.options[this.selectedIndex].value;">
		            <option value="" hidden="">-- Mời bạn chọn --</option>
		            <?php
		            	$url='dieuhuong=xemadmin';
		            	if ($_GET['soluong']==20) {?>
		            	<option value="?<?=$url?>&soluong=10">10</option>
		            	<option selected value="?<?=$url?>&soluong=20">20</option>
		            	<option value="?<?=$url?>&soluong=50">50</option>
		            <?php }elseif ($_GET['soluong']==50) {?>
		            	<option value="?<?=$url?>&soluong=10">10</option>
		            	<option value="?<?=$url?>=20">20</option>
		            	<option selected value="?<?=$url?>=50">50</option>
		            <?php }else{?>
			            <option value="?<?=$url?>&soluong=10" selected>10</option>
			            <option value="?<?=$url?>&soluong=20">20</option>
			            <option value="?<?=$url?>&soluong=50">50</option>
			        <?php } ?>
		        	</select>
			</section>
		</section>
      	<section class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Ngày tạo</th>
                        <th>Phân quyền</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from admin";
                    GLOBAL $connect;
					if(isset($_GET['search'])){
						$search=$_GET['search'];
						$sql="select*from admin where tendangnhap like '%$search%' ";
					}
					if(isset($_GET['soluong'])){
						$spmt=$_GET['soluong'];
					}else{
						$spmt=10;
					}
					GLOBAL $connect;
					$kq=$connect->query($sql);
					$tongsotrang=ceil(mysqli_num_rows($kq)/$spmt);
					if(isset($_GET['trangso']))
					$trangso=$_GET['trangso'];
					if(!isset($trangso) || $trangso>$tongsotrang || $trangso<=0){
						$trangso=1;
					}
					$from=($trangso-1)*$spmt;
					$sql.=" limit $from,$spmt";
                    GLOBAL $connect;
                    $kq1=$connect->query($sql) or die('err');
                    while($rowadmin=mysqli_fetch_array($kq1)){
                ?>
                    <tr>
						<td><?=$rowadmin['IDadmin']?></td>
						<td><?=$rowadmin['hoten']?></td>
						<td><?=$rowadmin['tendangnhap']?></td>
						<td><?php echo date("d/m/Y",strtotime($rowadmin['ngaytao']))?></td>
						<td><?php if($rowadmin['phanquyen']==1) echo"SuperAdmin"; else echo"Admin";?></td>
                        <td><?php if($rowadmin['trangthaiadmin']==1) echo"Mở"; else echo"Khóa";?></td>
                        <td>
                            <a href="?dieuhuong=suaadmin&maadmin=<?=$rowadmin['IDadmin']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                            <?php
                                if($rowadmin['phanquyen']!=1){
                            ?>
                            <a onClick="if(confirm('Bạn muốn xóa Admin này?')) return true; else return false;" href="?dieuhuong=xemadmin&maadmin=<?=$rowadmin['IDadmin']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
                             <a><button type="button" class="btn btn-xs btn-primary" disabled><span class="fa fa-trash"></span> Xóa</button></a>
                             <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </section>
        <section class="col-lg-12" style="text-align: center; ">
			<ul class="pagination" style="margin-top: 0px;">
				<?php
					if($tongsotrang>1){
						if(isset($_GET['soluong'])){
						$url.='&soluong='.$_GET['soluong'];
						}?>
						<?php if($trangso>1){?>
							<li ><a href="?<?=$url?>&trangso=1">Đầu</a></li>
							<li ><a href="?<?=$url?>&trangso=<?=$trangso-1?>">Trước</a></li>
						<?php } ?>
						<?php
							for($i=$trangso; $i<=$tongsotrang; $i++){
								if($i<=$trangso+2){
						?>
	                    		<li ><a href="?<?=$url?>&trangso=<?=$i?>"><?=$i?></a></li>
	                    <?php
                    		}
                    	}
                   		?>
                    <?php if($trangso<$tongsotrang){?>
                    		<li ><a  href="?<?=$url?>&trangso=<?=$trangso+1?>">Sau</a></li>
                    		<li ><a href="?<?=$url?>&trangso=<?=$tongsotrang?>">Cuối</a></li>
                <?php }} ?>
            </ul>
        </section>
    </section>
</section>
<?php } ?>

<!-- functuon Sửa Admin-->
<?php function admin_update(){?>
<?php
if(isset($_GET['maadmin']))
	$maadmin=addslashes($_GET['maadmin']);
?>
<?php
if(isset($_POST['suaadmin'])){
	$tendangnhap=addslashes($_POST['tendangnhap']);
	$matkhau=addslashes($_POST['matkhau']);
	$hoten=addslashes($_POST['hoten']);
	$phanquyen=addslashes($_POST['phanquyen']);
	$trangthaiadmin=addslashes($_POST['trangthaiadmin']);
	$sql="select*from admin where tendangnhap='$tendangnhap' and IDadmin!='$maadmin'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq))
		$UserError = "Tên đăng nhập này đã có sẵn.";
	else{
		if($matkhau==''){
			$sql="update admin set tendangnhap='$tendangnhap', hoten='$hoten', trangthaiadmin='$trangthaiadmin', phanquyen='$phanquyen' where IDadmin='$maadmin'";
			GLOBAL $connect;
			$connect->query($sql);
			echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemadmin';</script>";
		}else{
			$matkhau=md5($matkhau);
			$sql="update admin set tendangnhap='$tendangnhap', matkhau='$matkhau', hoten='$hoten', phanquyen='$phanquyen', trangthaiadmin='$trangthaiadmin' where IDadmin='$maadmin'";
			GLOBAL $connect;
			$connect->query($sql);
			echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemadmin';</script>";
		}
	}
}
?>
<section class="container-fluid">
    <!-- Page Heading -->
    <section class="row">
        <section class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i> <a href="?dieuhuong=home">Trang chủ</a>
                </li>
                <li class="active">
                    <i class="fa fa-gear"></i> Quản lý admin
                </li>
            </ol>
        </section>
	</section>
	<?php
	if(isset($_GET['maadmin']))
		$maadmin=addslashes($_GET['maadmin']);
	$sql="select*from admin where IDadmin='$maadmin'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	$rowadmin=mysqli_fetch_array($kq);
	?>
	<section class="row" id="row1">
	    <section class="col-lg-12">
		    <section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">SỬA ADMIN</h1>
	        </section>
	        <form method="post" class="form-horizontal" id="signupForm2" enctype="multipart/form-data">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Họ tên: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="hoten" id="hoten" value="<?=$rowadmin['hoten']?>">
	                </section>
	            </section>
	           	<section class="form-group" style="margin-bottom: 0px">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Tên đăng nhập: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="tendangnhap" id="tendangnhap" value="<?=$rowadmin['tendangnhap']?>">
		                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Mật khẩu: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="password" name="matkhau" id="matkhau">
	                </section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Phân quyền: </label>
	            	<section class="col-md-5 col-sm-12">
	            	<select name="phanquyen" class="form-control">
	            	<?php if($rowadmin['phanquyen']==1){?>
						<option value="1" selected>SuperAdmin</option>
						<option value="0">Admin</option>
					<?php }else{ ?>
						<option value="1">SuperAdmin</option>
						<option value="0" selected>Admin</option>
					<?php }?>
	            	</select>
	            	</section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái: </label>
	            	<section class="col-md-5 col-sm-12">
	            	<select name="trangthaiadmin" class="form-control">
	            	<?php if($rowadmin['trangthaiadmin']==1){?>
									<option value="1" selected>Mở</option>
									<option value="0">Khóa</option>
								<?php }else{ ?>
									<option value="1">Mở</option>
									<option value="0" selected>Khóa</option>
								<?php }?>
	            	</select>
	            	</section>
	            </section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" id="b-align">
										<input type="button" onClick="location='?dieuhuong=xemadmin';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="suaadmin" value="Sửa" id="input2">
		            		<input type="reset" class="btn btn-primary" name="xoa" value="Làm lại" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#signupForm2" ).validate( {
			rules: {
					tendangnhap: {
						required: true,
						rangelength: [4,16]
					},
					hoten: "required",
				},
				messages: {
					tendangnhap: {
						required: "Tên đăng nhập không được để trống",
						rangelength: "Tên đăng nhập phải từ 4 đến 16 ký tự"
					},
					hoten: "Họ tên không được để trống"
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

<!-- functuon Thêm Admin-->
<?php function admin_insert(){?>
<?php
if(isset($_POST['themadmin'])){
	$tendangnhap=addslashes($_POST['tendangnhap']);
	$matkhau=addslashes($_POST['matkhau']);
	$hoten=addslashes($_POST['hoten']);
	$phanquyen=addslashes($_POST['phanquyen']);
	$sql="select*from admin where tendangnhap='$tendangnhap'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq)>0){
		$UserError = "Tên đăng nhập đã tồn tại";
	}else{
		$matkhau=md5($matkhau);
		$sql="insert admin(tendangnhap,matkhau,hoten,ngaytao,phanquyen) values('$tendangnhap','$matkhau','$hoten',now(),'$phanquyen')";
		GLOBAL $connect;
		$connect->query($sql) or die("Không chèn được");
		echo"<script>alert('Thêm thành công.'); location='?dieuhuong=xemadmin';</script>";
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
                    <i class="fa fa-fw fa-user"></i> Quản lý Admin
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
		    <section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">THÊM ADMIN</h1>
	        </section>
	        <form method="post" class="form-horizontal" id="signupForm1" enctype="multipart/form-data">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Họ tên: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="hoten" id="hoten" value="<?php if(isset($hoten)) echo $hoten?>" placeholder="Mời nhập họ tên">
	                </section>
	            </section>
	           	<section class="form-group" style="margin-bottom: 0px">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Tên đăng nhập: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="tendangnhap" id="tendangnhap" value="<?php if(isset($tendangnhap)) echo $tendangnhap?>" placeholder="Mời nhập tên đăng nhập">
		                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Mật khẩu: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="password" name="matkhau" id="matkhau" value="<?php if(isset($matkhau)) echo $matkhau?>" placeholder="Mời nhập mật khẩu">
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Nhập lại mật khẩu: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="password" name="rematkhau" id="rematkhau" value="<?php if(isset($rematkhau)) echo $rematkhau?>" placeholder="Mời nhập lại mật khẩu">
	                </section>
	            </section>
		  		 <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label2">Phân quyền: </label>
	            	<section class="col-md-5 col-sm-12">
	            	<select name="phanquyen" class="form-control">
	            		<option value="" hidden="">--Mời bạn lựa chọn--</option>}
									<option value="1">SuperAdmin</option>
									<option value="0">Admin</option>
	            	</select>
	            	</section>
	            </section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" id="b-align">
										<input type="button" onClick="location='?dieuhuong=xemadmin';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="themadmin" value="Thêm Admin" id="input2">
		            		<input type="reset" class="btn btn-primary" name="xoa" value="Làm lại" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#signupForm1" ).validate( {
			rules: {
					tendangnhap: {
						required: true,
						rangelength: [4,16]
					},
					matkhau: {
						required: true,
						minlength: 6,
					},
					rematkhau: {
						required: true,
						minlength: 6,
						equalTo: "#matkhau"
					},
					hoten: "required",
					phanquyen: "required"
				},
				messages: {
					tendangnhap: {
						required: "Tên đăng nhập không được để trống",
						rangelength: "Tên đăng nhập phải từ 4 đến 16 ký tự"
					},
					matkhau: {
						required: "Mật khẩu không được để trống",
						minlength: "Mật khẩu phải có ít nhất 6 ký tự"
					},
					rematkhau: {
						required: "Nhập lại mật khẩu không được để trống",
						minlength: "Nhập lại mật khẩu phải có ít nhất 6 ký tự",
						equalTo: "Nhập lại mật khẩu và mật khẩu không khớp nhau"
					},
					hoten: "Họ tên không được để trống",
					phanquyen: "Phân quyền chưa được chọn",
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
