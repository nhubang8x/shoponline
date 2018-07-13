<!-- funtion Xem + Xóa loại sản phẩm-->
<?php  function loaisp_list(){?>
<?php
	if(isset($_GET['maloai'])){
	$sql="delete from loaisp where maloai=".$_GET['maloai'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemloaisp';</script>";
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
                    <i class="fa fa-gears"></i> Quản lý loại sản phẩm
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">DANH SÁCH LOẠI SẢN PHẨM</h1>
        <p> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themloaisp';"><span class="fa fa-plus"></span> Thêm loại sản phẩm</button></p>
		<section class="form-inline"  id="loc1">
			<section class="form-group input-group">
		        <span class="input-group-addon">Nhóm sản phẩm:</span>
	            <select class="form-control" name="nhom" onChange="location=this.options[this.selectedIndex].value;">
	        	<?php
	            	$sql="select*from nhomsp";
	            	GLOBAL $connect;
	            	$kq=$connect->query($sql) or die('err');
	            	if(isset($_GET['manhomsp'])){?>
	            		<option value="?dieuhuong=xemloaisp">Xem tất cả</option>
	            	<?php
	            		while($rownhomsp=mysqli_fetch_array($kq)){
	            			if($_GET['manhomsp']==$rownhomsp['manhom']){
	            	?>
	            		<option selected value="?dieuhuong=xemloaisp&manhomsp=<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
	            	<?php  	}else{?>
	            				<option value="?dieuhuong=xemloaisp&manhomsp=<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
	            	<?php   }
	            		}
	            	}else{?>
	            		<option selected value="?dieuhuong=xemloaisp">Xem tất cả</option>
	            	<?php
              			while($rownhomsp=mysqli_fetch_array($kq)){?>
            			<option value="?dieuhuong=xemloaisp&manhomsp=<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
            		<?php
	        			}
	        		}
	            ?>
	        	</select>
			</section>
			<section class="form-group input-group">
		        <span class="input-group-addon">Hiển thị:</span>
		            <select class="form-control" name="nhom" onChange="location=this.options[this.selectedIndex].value;">
		            <option value="" hidden="">-- Mời bạn chọn --</option>
		            <?php
		            	$url='dieuhuong=xemloaisp';
		            	if(isset($_GET['manhomsp'])){
							$url.='&manhomsp='.$_GET['manhomsp'];
						}
		            	if($_GET['soluong']==10){
		            ?>
		            	<option selected value="?<?=$url?>&soluong=10">10</option>
		            	<option value="?<?=$url?>&soluong=20">20</option>
		            	<option value="?<?=$url?>&soluong=50">50</option>
		            <?php }elseif ($_GET['soluong']==20) {?>
		            	<option value="?<?=$url?>&soluong=10">10</option>
		            	<option selected value="?<?=$url?>&soluong=20">20</option>
		            	<option value="?<?=$url?>&soluong=50">50</option>
		            <?php }elseif ($_GET['soluong']==50) {?>
		            	<option value="?<?=$url?>&soluong=10">10</option>
		            	<option value="?<?=$url?>&soluong=20">20</option>
		            	<option selected value="?<?=$url?>&soluong=50">50</option>
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
                        <th>Mã loại</th>
                        <th>Tên loại sản phẩm</th>
                        <th>Tên nhóm</th>
                        <th>Trạng thái loại</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from loaisp";
                    GLOBAL $connect;
                    if(isset($_GET['manhomsp'])){
						$manhomsp=addslashes($_GET['manhomsp']);
						$sql.=" where manhomsp='$manhomsp'";
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
					if(!isset($trangso) || $trangso>$tongsotrang || $trangso<0){
						$trangso=1;
					}
					$from=($trangso-1)*$spmt;
					$sql.=" limit $from,$spmt";
                    $kq1=$connect->query($sql);
                    while($rowloaisp=mysqli_fetch_array($kq1)){
                ?>
                    <tr>
                    	<td><?=$rowloaisp['maloai']?></td>
                        <td><?=$rowloaisp['tenloai']?></td>
                        <?php
                        	$sql="select*from nhomsp where manhom=".$rowloaisp['manhomsp'];
                        	GLOBAL $connect;
                        	$kq2=$connect->query($sql);
                        	$rownhomsp=mysqli_fetch_array($kq2)
                        ?>
                        <td><?=$rownhomsp['tennhom']?></td>
                        <td><?php if($rowloaisp['trangthailoai']==1) echo"Mở"; else echo"Khóa";?></td>
                        <td>
                            <a href="?dieuhuong=sualoaisp&maloai=<?=$rowloaisp['maloai']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                            <?php
                                $sql="select*from sanpham where maloaisp=".$rowloaisp['maloai'];
                                GLOBAL $connect;
                                $kq3=$connect->query($sql);
                                if(mysqli_num_rows($kq3)==0){
                            ?>
                            <a onClick="if(confirm('Bạn muốn xóa phân loại này?')) return true; else return false;" href="?dieuhuong=xemloaisp&maloai=<?=$rowloaisp['maloai']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
                            <a><button type="button" class="btn btn-xs btn-primary" disabled><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                	<tr>
                      <td colspan="5" id="sum-pro">Tổng số: <?php echo mysqli_num_rows($kq) ?> loại sản phẩm</td>
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
								if($i<=$trangso+3){
						?>
	                    		<li class=""><a href="?<?=$url?>&trangso=<?=$i?>"><?=$i?></a></li>
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

<!-- functuon Sửa loại sản phẩm-->
<?php function loaisp_update(){?>
<?php
if(isset($_GET['maloai']))
	$maloai=addslashes($_GET['maloai']);
?>
<?php
if(isset($_POST['sualoai'])){
	$tenloai=addslashes($_POST['tenloai']);
	$trangthailoai=addslashes($_POST['trangthailoai']);
	$manhomsp=addslashes($_POST['manhomsp']);
	$sql="select*from loaisp where tenloai='$tenloai' and maloai!='$maloai'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq))
		$UserError = "Tên loại này đã có sẵn.";
	else{
		$sql="update loaisp set tenloai='$tenloai', trangthailoai='$trangthailoai', manhomsp='$manhomsp' where maloai='$maloai'";
		GLOBAL $connect;
		$connect->query($sql);
		echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemloaisp';</script>";
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
                    <i class="fa fa-gear"></i> Quản lý loại sản phẩm
                </li>
            </ol>
        </section>
	</section>
	<?php
	if(isset($_GET['maloai']))
		$maloai=addslashes($_GET['maloai']);
		$sql="select*from loaisp where maloai='$maloai'";
		GLOBAL $connect;
		$kq=$connect->query($sql);
		$rowloaisp=mysqli_fetch_array($kq);
	?>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<h1 class="h1align">SỬA LOẠI SẢN PHẨM</h1>
	        <form method="post" class="form-horizontal" id="sualoai">
	            <section class="form-group" id="input1">
	                <label class="control-label col-md-2 col-sm-12" id="label1">Tên loại sản phẩm: </label>
	                <section class="col-md-10 col-sm-12">
	                <input class="form-control" type="text" name="tenloai" id="tenloai" value="<?=$rowloaisp['tenloai']?>">
	                <em id="tenloai-error" class="error help-block"><?php if(isset($UserError)) echo $UserError ?></em>
	                </section>
	            </section>
				<section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Tên nhóm: </label>
	            	<section class="col-md-5 col-sm-12">
						<select name="manhomsp" class="form-control">
						<?php
			            	$sql="select*from nhomsp";
							GLOBAL $connect;
							$kq1=$connect->query($sql);
							while ($rownhomsp=mysqli_fetch_array($kq1)){
								if($rownhomsp['manhom']==$rowloaisp['manhomsp']){?>
	            					<option selected value="<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
	            				<?php }else{ ?>
									<option value="<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
								<?php }
								} ?>
	            		</select>
	            	</section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái loại: </label>
	            	<section class="col-md-5 col-sm-12">
	            	<select name="trangthailoai" class="form-control">
	            	<?php if($rowloaisp['trangthailoai']==1){?>
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
										<input type="button" onClick="location='?dieuhuong=xemloaisp';" class="btn btn-primary" value="Quay lại" id="input2">
	            			<input type="submit" class="btn btn-primary" name="sualoai" value="Sửa loại sản phẩm" id="input2">
	            	</section>
	            </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#sualoai" ).validate( {
			rules: {
				tenloai: "required",
			},
			messages: {
				tenloai: "Tên loại không được để trống"
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

<!-- functuon Thêm loại sản phẩm-->
<?php function loaisp_insert(){?>
<?php
if(isset($_POST['themloaisp'])){
	$tenloai=addslashes($_POST['tenloai']);
	$manhomsp=addslashes($_POST['nhom']);
		$sql="select*from loaisp where tenloai='$tenloai'";
		GLOBAL $connect;
		$kq=$connect->query($sql);
		if(mysqli_num_rowS($kq)>0)
			$UserError1 = "Tên loại sản phẩm này đã có sẵn.";
		else{
			$sql="insert loaisp(tenloai,manhomsp) values ('$tenloai','$manhomsp')";
			GLOBAL $connect;
			$connect->query($sql);
			echo"<script>alert('Thêm thành công'); location='?dieuhuong=xemloaisp';</script>";
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
                    <i class="fa fa-gears"></i> Quản lý loại sản phẩm
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<h1 style="text-align:center">THÊM LOẠI SẢN PHẨM</h1>
	        <form method="post" class="form-horizontal" id="formloaisp">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Tên loại sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="tenloai" value="<?php if(isset($tenloai)) echo $tenloai ?>">
		                <em id="tenloai1-error" class="error help-block"><?php if(isset($UserError1)) echo $UserError1 ?></em>
	                </section>
	            </section>
				<section class="form-group">
                    <label class="control-label col-md-2 col-sm-12" id="label2">Loại sản phẩm:</label>
                    <section class="col-md-4 col-sm-12">
	                    <select class="form-control" name="nhom">
	                    <option value="" hidden="">--Mời bạn lựa chọn--</option>
		            	<?php
		                	$sql="select*from nhomsp";
		                	GLOBAL $connect;
		                	$kq=$connect->query($sql) or die('err');
		                	while($rownhomsp=mysqli_fetch_array($kq)){
	                	?>
	                    <option value="<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
		                <?php } ?>
	                	</select>
                	</section>
            	</section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" style="text-align:center">
										<input type="button" onClick="location='?dieuhuong=xemloaisp';" class="btn btn-primary" value="Quay lại" id="input2">
	            			<input type="submit" class="btn btn-primary" name="themloaisp" value="Thêm phân loại" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#formloaisp" ).validate( {
			rules: {
				tenloai: "required",
				nhom: "required",
			},
			messages: {
				tenloai: "Tên loại sản phẩm không được để trống",
				nhom: "Nhóm sản phẩm chưa được chọn"
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
