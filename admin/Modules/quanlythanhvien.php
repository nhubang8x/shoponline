<!-- functuon Danh sách + Xóa Thành viên-->
<?php function thanhvien_list(){ ?>
<?php
if(isset($_GET['mathanhvien'])){
	$sql="delete from thanhvien where mathanhvien=".$_GET['mathanhvien'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemthanhvien';</script>";
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
                    <i class="fa fa-fw fa-user"></i>Quản lý thành viên
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">DANH SÁCH THÀNH VIÊN</h1>
        <section class="col-md-6 col-sm-12" id="input3">
        	<button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themthanhvien';"><span class="fa fa-plus"></span> Thêm thành viên</button></section>
        <section class="col-md-6 col-sm-12" id="input3">
		   	<section class="search-box">
			    <form class="search-form" name="frmtimkiem" method="post" action="">
			    	<input class="form-control" name="search" id="search" placeholder="Tìm kiếm" type="text" required="" value="<?php if(isset($_REQUEST['search'])) echo $_REQUEST['search'];?>">
			     	<button class="btn btn-link search-btn"><i class="glyphicon glyphicon-search"></i>
			     </button>
			    </form>
		  	 </section>
		</section>
		<section class="form-inline" id="loc1">
			<section class="form-group input-group">
	      		<span class="input-group-addon">Trạng thái:</span>
	            <select class="form-control" name="trangthai" onChange="location=this.options[this.selectedIndex].value;">
	        	<?php
	            	if(isset($_GET['trangthai'])){?>
	            	<?php
	            		if($_GET['trangthai']==1){
	            	?>
	            		<option value="?dieuhuong=xemthanhvien">Xem tất cả</option>
	            		<option selected value="?dieuhuong=xemthanhvien&trangthai=1">Mở</option>
	            		<option value="?dieuhuong=xemthanhvien&trangthai=0">Khóa</option>
	            	<?php }else{?>
        				<option value="?dieuhuong=xemthanhvien">Xem tất cả</option>
        				<option value="?dieuhuong=xemthanhvien&trangthai=1">Mở</option>
        				<option selected value="?dieuhuong=xemthanhvien&trangthai=0">Khóa</option>
	            	<?php   }
	            	}else{?>
	            		<option selected value="?dieuhuong=xemthanhvien">Xem tất cả</option>
	            		<option value="?dieuhuong=xemthanhvien&trangthai=1">Mở</option>
	            		<option value="?dieuhuong=xemthanhvien&trangthai=0">Khóa</option>
	        		<?php }?>
	        	</select>
			</section>
			<section class="form-group input-group">
		        <span class="input-group-addon">Hiển thị:</span>
		            <select class="form-control" name="hienthi" onChange="location=this.options[this.selectedIndex].value;">
		            <option value="" hidden="">-- Mời bạn chọn --</option>
		            <?php
		            	$url='dieuhuong=xemthanhvien';
		            	if(isset($_GET['trangthai'])){
							$url='dieuhuong=xemthanhvien&trangthai='.$_GET['trangthai'];
						}
		            	if ($_GET['soluong']==20){
		            ?>
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
                        <th>Tên thành viên</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from thanhvien";
                    GLOBAL $connect;
                    if(isset($_GET['trangthai'])){
						$trangthai=addslashes($_GET['trangthai']);
						$sql="select*from thanhvien where trangthai='$trangthai' ";
					}
					if(isset($_REQUEST['search'])){
						$search=$_GET['search'];
						$sql="select*from thanhvien where tendangnhap like '%$search%' ";
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
                    while($rowthanhvien=mysqli_fetch_array($kq1)){
                ?>
                    <tr>
						<td><?=$rowthanhvien['mathanhvien']?></td>
						<td><?=$rowthanhvien['hoten']?></td>
						<td><?=$rowthanhvien['tendangnhap']?></td>
						<td><?=$rowthanhvien['email']?></td>
						<td><?=$rowthanhvien['dienthoai']?></td>
						<td><?php echo date("d/m/Y",strtotime($rowthanhvien['ngaytao']))?></td>
                        <td><?php if($rowthanhvien['trangthai']==1) echo"Mở"; else echo"Khóa";?></td>
                        <td>
                            <a href="?dieuhuong=suathanhvien&mathanhvien=<?=$rowthanhvien['mathanhvien']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                            <?php
                                $sql="select*from hoadon where trangthaihoadon!=3 and mathanhvien=".$rowthanhvien['mathanhvien'];
                                GLOBAL $connect;
                                $kq2=$connect->query($sql);
                                if(mysqli_num_rows($kq2)==0){
                            ?>
                            <a onClick="if(confirm('Bạn muốn xóa thành viên này?')) return true; else return false;" href="?dieuhuong=xemthanhvien&mathanhvien=<?=$rowthanhvien['mathanhvien']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
                             <a><button type="button" class="btn btn-xs btn-primary" disabled><span class="fa fa-trash"></span> Xóa</button></a>
                             <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                	<tr>
                    	<td colspan="11" id="sum-pro">Tổng số: <?php echo mysqli_num_rows($kq) ?> thành viên</td>
                    </tr>
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

<!-- functuon Sửa Thành Viên-->
<?php function thanhvien_update(){?>
<?php
if(isset($_GET['mathanhvien']))
	$mathanhvien=addslashes($_GET['mathanhvien']);
?>
<?php
if(isset($_POST['suathanhvien'])){
	$tendangnhap=addslashes($_POST['tendangnhap']);
	$matkhau=addslashes($_POST['matkhau']);
	$hoten=addslashes($_POST['hoten']);
	$diachi=addslashes($_POST['diachi']);
	$dienthoai=addslashes($_POST['phone']);
	$email=addslashes($_POST['email']);
	$trangthai=addslashes($_POST['trangthai']);
	$sql="select*from thanhvien where tendangnhap='$tendangnhap' and mathanhvien!='$mathanhvien'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq))
		$UserError = "Tên đăng nhập này đã có sẵn.";
	else{
		$sql="select*from thanhvien where dienthoai='$dienthoai' and mathanhvien!='$mathanhvien'";
		GLOBAL $connect;
		$kq1=$connect->query($sql);
		if(mysqli_num_rows($kq1))
			$UserError = "Số điện thoại này đã có sẵn.";
		else{
			$sql="select*from thanhvien where email='$email' and mathanhvien!='$mathanhvien'";
			GLOBAL $connect;
			$kq2=$connect->query($sql);
			if(mysqli_num_rows($kq2))
				$UserError = "Email này đã có sẵn.";
			else{
				if($matkhau==''){
					$sql="update thanhvien set tendangnhap='$tendangnhap', hoten='$hoten', diachi='$diachi', dienthoai='$dienthoai', email='$email', trangthai='$trangthai' where mathanhvien='$mathanhvien'";
					GLOBAL $connect;
					$connect->query($sql);
					echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemthanhvien';</script>";
				}else{
					$matkhau=md5($matkhau);
					$sql="update thanhvien set tendangnhap='$tendangnhap', matkhau='$matkhau', hoten='$hoten', diachi='$diachi', dienthoai='$dienthoai', email='$email', trangthai='$trangthai' where mathanhvien='$mathanhvien'";
					GLOBAL $connect;
					$connect->query($sql);
					echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemthanhvien';</script>";
				}
			}
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
                    <i class="fa fa-gear"></i> Quản lý nhóm sản phẩm
                </li>
            </ol>
        </section>
	</section>
	<?php
	if(isset($_GET['mathanhvien']))
		$mathanhvien=addslashes($_GET['mathanhvien']);
	$sql="select*from thanhvien where mathanhvien='$mathanhvien'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	$rowthanhvien=mysqli_fetch_array($kq);
	?>
	<section class="row" id="row1">
	    <section class="col-lg-12">
		    <section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">SỬA THÀNH VIÊN</h1>
	        </section>
	        <form method="post" class="form-horizontal" id="signupForm2" enctype="multipart/form-data">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Họ tên: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="hoten" id="hoten" value="<?=$rowthanhvien['hoten']?>">
	                </section>
	            </section>
	           	<section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Tên đăng nhập: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="tendangnhap" id="tendangnhap" value="<?=$rowthanhvien['tendangnhap']?>">
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
	                <label class="control-label col-md-2 col-sm-12" id="label2">Email: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="email" name="email" id="email" value="<?=$rowthanhvien['email']?>">
		                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Điện thoại: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="tel" name="phone" id="phone" value="<?=$rowthanhvien['dienthoai']?>">
		                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Địa chỉ: </label>
	            	<section class="col-md-10 col-sm-12">
	            		<textarea name="diachi" rows="2" cols="23" id="diachi" class="form-control textboxlogin"><?=$rowthanhvien['diachi']?></textarea>
	                </section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái: </label>
	            	<section class="col-md-3 col-sm-12">
	            	<select name="trangthai" class="form-control">
	            	<?php if($rowthanhvien['trangthai']==1){?>
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
										<input type="button" onClick="location='?dieuhuong=xemthanhvien';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="suathanhvien" value="Sửa" id="input2">
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
					phone: {
						required: true,
						minlength: 9,
						maxlength: 11,
					},
					email: {
						required: true,
						email: true
					},
					diachi: {
						required: true,
						minlength: 6
					}
				},
				messages: {
					tendangnhap: {
						required: "Tên đăng nhập không được để trống",
						rangelength: "Tên đăng nhập phải từ 4 đến 16 ký tự"
					},
					hoten: "Họ tên không được để trống",
					phone: {
						required: "Điện thoại không được để trống",
						minlength: "Điện thoại có ít nhất 9 số",
						maxlength: "Điện thoại có nhiều nhất 11 số",
					},
					email: {
						required: "Email không được để trống",
						email: "Email không đúng định dạng"
					},
					diachi: {
						required: "Địa chỉ không được để trống",
						minlength: "Địa chỉ quá ngắn"
					}
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

<!-- functuon Thêm Thành viên-->
<?php function thanhvien_insert(){?>
<?php
if(isset($_POST['themthanhvien'])){
	$tendangnhap=addslashes($_POST['tendangnhap']);
	$matkhau=addslashes($_POST['matkhau']);
	$hoten=addslashes($_POST['hoten']);
	$diachi=addslashes($_POST['diachi']);
	$dienthoai=addslashes($_POST['phone']);
	$email=addslashes($_POST['email']);
	$sql="select*from thanhvien where tendangnhap='$tendangnhap'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq)>0){
		$UserError = "Tên đăng nhập đã tồn tại";
	}else{
		$sql="select*from thanhvien where email='$email'";
		GLOBAL $connect;
		$kq=$connect->query($sql);
		if(mysqli_num_rows($kq)>0){
			$EmailrError = "Email đã tồn tại";
		}else{
			$sql="select*from thanhvien where dienthoai='$dienthoai'";
			GLOBAL $connect;
			$kq=$connect->query($sql);
			if(mysqli_num_rows($kq)>0){
				$DienThoaiError = "Số điện thoại đã được đăng ký";
			}else{
				$matkhau=md5($matkhau);
				$sql="insert thanhvien(tendangnhap,matkhau,hoten,dienthoai,diachi,email,ngaytao) values('$tendangnhap','$matkhau','$hoten','$dienthoai','$diachi','$email',now())";
				GLOBAL $connect;
				$connect->query($sql) or die("Không chèn được");
				echo"<script>alert('Thêm thành công.'); location='?dieuhuong=xemthanhvien';</script>";
			}
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
                    <i class="fa fa-home"></i>  <a href="?dieuhuong=home">Trang chủ</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-user"></i> Quản lý thành viên
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	  <section class="col-lg-12">
		  <section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	  		<h1 class="h1align">THÊM THÀNH VIÊN</h1>
	      <form method="post" class="form-horizontal" id="signupForm1" enctype="multipart/form-data">
	        <section class="form-group">
	            <label class="control-label col-md-2 col-sm-12" id="label2">Họ tên: </label>
	        	<section class="col-md-10 col-sm-12">
	              <input class="form-control" type="text" name="hoten" id="hoten" value="<?php if(isset($hoten)) echo $hoten?>" placeholder="Mời nhập họ tên">
	            </section>
	        </section>
	       	<section class="form-group">
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
	        	<label class="control-label col-md-2 col-sm-12" id="label2">Email: </label>
          	<section class="col-md-10 col-sm-12">
                <input class="form-control" type="email" name="email" id="email" value="<?php if(isset($email)) echo $email?>" placeholder="Mời nhập email">
                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
            </section>
          </section>
          <section class="form-group">
            <label class="control-label col-md-2 col-sm-12" id="label2">Điện thoại: </label>
          	<section class="col-md-10 col-sm-12">
                <input class="form-control" type="tel" name="phone" id="phone" value="<?php if(isset($phone)) echo $phone?>" placeholder="Mời nhập điện thoại">
                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
              </section>
          </section>
          <section class="form-group">
            <label class="control-label col-md-2 col-sm-12" id="label2">Địa chỉ: </label>
          	<section class="col-md-10 col-sm-12">
          		<textarea name="diachi" rows="2" cols="23" id="diachi" class="form-control textboxlogin" value="<?php if(isset($phone)) echo $phone?>" placeholder="Mời nhập địa chỉ"></textarea>
            </section>
          </section>
          <section class="form-group">
          	<section class="col-md-12 col-sm-12" id="b-align">
							<input type="button" onClick="location='?dieuhuong=xemthanhvien';" class="btn btn-primary" value="Quay lại" id="input2">
          		<input type="submit" class="btn btn-primary" name="themthanhvien" value="Thêm thành viên" id="input2">
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
						rangelength: [4,13]
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
					phone: {
						required: true,
						minlength: 9,
						maxlength: 11,
					},
					email: {
						required: true,
						email: true
					},
					diachi: {
						required: true,
						minlength: 6
					}
				},
				messages: {
					tendangnhap: {
						required: "Tên đăng nhập không được để trống",
						rangelength: "Tên đăng nhập phải từ 4 đến 13 ký tự"
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
					phone: {
						required: "Điện thoại không được để trống",
						minlength: "Điện thoại có ít nhất 9 số",
						maxlength: "Điện thoại có nhiều nhất 11 số",
					},
					email: {
						required: "Email không được để trống",
						email: "Email không đúng định dạng"
					},
					diachi: {
						required: "Địa chỉ không được để trống",
						minlength: "Địa chỉ quá ngắn"
					}
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
