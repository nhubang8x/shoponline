<!-- funtion Xem + Xóa ảnh slide + Menu-->
<?php  function anh_list(){?>
<?php
	if(isset($_GET['maanh'])){
		$sql = "SELECT duongdananh FROM anh WHERE maanh =".$_GET['maanh'];
		GLOBAL $connect;
		$query = mysqli_query($connect,$sql) or die (mysqli_error());
		while ($row = mysqli_fetch_array($query)){
		    unlink($row['duongdananh']);
	}
	$sql="delete from anh where maanh=".$_GET['maanh'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemanh';</script>";
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
                    <i class="fa fa-picture-o"></i> Quản lý ảnh Slide - Menu
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">DANH SÁCH ẢNH SILDE - MENU</h1>
        <p> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themanhmenu';"><span class="fa fa-plus"></span> Thêm ảnh Menu</button> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themanhslide';"><span class="fa fa-plus"></span> Thêm ảnh Slide</button></p>
		<section class="form-inline"  id="loc1">
			<section class="form-group input-group">
		        <span class="input-group-addon">Hiển thị:</span>
		            <select class="form-control" name="nhom" onChange="location=this.options[this.selectedIndex].value;">
		            <option value="" hidden="">-- Mời bạn chọn --</option>
		            <?php
		            	$url='dieuhuong=xemanh';
		            if ($_GET['soluong']==20) {?>
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
                        <th>Mã ảnh</th>
                        <th>Hình ảnh</th>
                        <th>Vị trí</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from anh";
                    GLOBAL $connect;
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
                    while($rowanh=mysqli_fetch_array($kq1)){
                ?>
                    <tr>
                    	<td><?=$rowanh['maanh']?></td>
                        <td><img src="<?=$rowanh['duongdananh']?>" class="img-responsive" width="80px">
                        </td>
                        <td><?=$rowanh['tenvitri']?></td>
                       	<td>
                       		<?php if($rowanh['trangthai']==1) echo"Mở"; else echo"Khóa";?>
                       	</td>
                        <td>
                            <a href="?dieuhuong=suaanh&maanh=<?=$rowanh['maanh']?>&vitri=<?=$rowanh['vitri']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                            <?php if($rowanh['trangthai']==0){ ?>
                            <a onClick="if(confirm('Bạn muốn xóa ảnh này?')) return true; else return false;" href="?dieuhuong=xemanh&maanh=<?=$rowanh['maanh']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
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

<!--function Thêm ảnh Menu mới-->
<?php function anhmenu_insert(){?>
<?php
	if(isset($_POST['themanh'])){
		$vitri=addslashes($_POST['vitri']);
		$sql="select*from nhomsp where trangthainhom=1 and manhom='$vitri'";
		GLOBAL $connect;
		$kq=$connect->query($sql);
		if($vitri==0){
			$tenvitri='SLIDE';
		}else{
			$rownhomsp=mysqli_fetch_array($kq);
			$tenvitri='MENU - '.$rownhomsp['tennhom'];
		}
		$file_name=time().'_';
		if(($_FILES['anh']['type']!="image/gif") && ($_FILES['anh']['type']!="image/png") && ($_FILES['anh']['type']!="image/jpeg") && ($_FILES['anh']['type']!="image/jpg")){
			$message="File không đúng định dạng";
		}elseif($_FILES['anh']['size']>10*1024*1024) {
			$message="Kích thước phải nhỏ hơn 10MB";
		}else{
			$anh=addslashes($file_name.$_FILES['anh']['name']);
			$duongdan=addslashes('../images/AnhMenu/'.$anh);
			move_uploaded_file($_FILES['anh']['tmp_name'],"../images/AnhMenu/".$anh);
		}
		$sql="insert anh(duongdananh,vitri,tenvitri) values('$duongdan','$vitri','$tenvitri')";
		GLOBAL $connect;
		$connect->query($sql) or die('Không thể insert');
		echo "<script>alert('Thêm ảnh thành công!'); location='?dieuhuong=xemanh'</script>";
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
                	<i class="fa fa-picture-o"></i> Quản lý ảnh Slide - Menu
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">THÊM ẢNH MENU</h1>
	        </section>
	        <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
                <section class="form-group">
		    		<label class="control-label col-md-1 col-sm-12" id="label2">Ảnh: </label>
		    		<section class="col-md-11 col-sm-12">
		    			<input type="file" class="form-control" name="anh">
		    			<span id="UserError1"><?php if(isset($message))  echo $message?></span>
		    		</section>
		  		</section>
		  		<section class="form-group">
	                <label class="control-label col-md-1 col-sm-12" id="label2">Vị trí: </label>
	            	<section class="col-md-10 col-sm-12">
	                    <select class="form-control" id="vitri" name="vitri">
	                    <option value="" hidden="">--Mời bạn lựa chọn--</option>
	                    <?php
	                    	$sql="select*from nhomsp where trangthainhom=1";
							GLOBAL $connect;
							$kq=$connect->query($sql);
	                    	while($rownhomsp=mysqli_fetch_array($kq)){?>
	                    	<option value="<?=$rownhomsp['manhom']?>">MENU - <?=$rownhomsp['tennhom']?></option>
	                    <?php } ?>
	                	</select>
                	</section>
                </section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" id="b-align">
							<input type="button" onClick="location='?dieuhuong=xemanh';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="themanh" value="Thêm ảnh Menu" id="input2">
		            		<input type="reset" class="btn btn-primary" name="xoa" value="Làm lại" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#signupForm" ).validate( {
			rules: {
				anh: "required",
				vitri: "required",
			},
			messages: {
				anh: "Ảnh không được để trống",
				vitri: "Vị trí chưa được chọn",
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

<!--function Thêm ảnh Slide mới-->
<?php function anhslide_insert(){?>
<?php
	if(isset($_POST['themanh'])){
		$file_name=time().'_';
		if(($_FILES['anhto']['type']!="image/gif") && ($_FILES['anhto']['type']!="image/png") && ($_FILES['anhto']['type']!="image/jpeg") && ($_FILES['anhto']['type']!="image/jpg")){
			$message1="File không đúng định dạng";
		}elseif($_FILES['anhto']['size']>10*1024*1024) {
			$message1="Kích thước phải nhỏ hơn 10MB";
		}else{
			$anhto=addslashes($file_name.$_FILES['anhto']['name']);
			$duongdan1=addslashes('../images/AnhMenu/'.$anhto);
			move_uploaded_file($_FILES['anhto']['tmp_name'],"../images/AnhMenu/".$anhto);
		}
		$sql="insert anh(duongdananh,vitri,tenvitri) values('$duongdan1','5','Slide to')";
		GLOBAL $connect;
		$connect->query($sql) or die('Không thể insert');
		if(($_FILES['anhnho']['type']!="image/gif") && ($_FILES['anhnho']['type']!="image/png") && ($_FILES['anhnho']['type']!="image/jpeg") && ($_FILES['anhnho']['type']!="image/jpg")){
			$message2	="File không đúng định dạng";
		}elseif($_FILES['anhnho']['size']>10*1024*1024) {
			$message2="Kích thước phải nhỏ hơn 10MB";
		}else{
			$anhnho=addslashes($file_name.$_FILES['anhnho']['name']);
			$duongdan2=addslashes('../images/AnhMenu/'.$anhnho);
			move_uploaded_file($_FILES['anhnho']['tmp_name'],"../images/AnhMenu/".$anhnho);
		}
		$sql="insert anh(duongdananh,vitri,tenvitri) values('$duongdan2','6','Slide nhỏ')";
		GLOBAL $connect;
		$connect->query($sql) or die('Không thể insert');
		echo "<script>alert('Thêm ảnh thành công!'); location='?dieuhuong=xemanh'</script>";
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
                	<i class="fa fa-picture-o"></i> Quản lý ảnh Slide - Menu
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-offset-2 col-sm-12" style="padding-left: 0px;">
	            		<h1>THÊM ẢNH SLIDE</h1>
	        </section>
	        <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
          <section class="form-group">
		    		<label class="control-label col-md-2 col-sm-12" id="label2">Ảnh slide to: </label>
		    		<section class="col-md-10 col-sm-12">
		    			<input type="file" class="form-control" name="anhto">
							<em id="tenloai-error" class="error help-block"><?php if(isset($message1)) echo $message1 ?></em>
		    		</section>
		  		</section>
					<section class="form-group">
		    		<label class="control-label col-md-2 col-sm-12" id="label2">Ảnh slide nhỏ: </label>
		    		<section class="col-md-10 col-sm-12">
		    			<input type="file" class="form-control" name="anhnho">
							<em id="tenloai-error" class="error help-block"><?php if(isset($message2)) echo $message2 ?></em>
		    		</section>
		  		</section>
          <section class="form-group">
            <section class="col-md-offset-2 col-sm-12">
							<input type="button" onClick="location='?dieuhuong=xemanh';" class="btn btn-primary" value="Quay lại" id="input2">
          		<input type="submit" class="btn btn-primary" name="themanh" value="Thêm ảnh Slide" id="input2">
          		<input type="reset" class="btn btn-primary" name="xoa" value="Làm lại" id="input2">
          	</section>
        	</section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#signupForm" ).validate( {
			rules: {
				anhto: "required",
				anhnho: "required"
			},
			messages: {
				anhto: "Ảnh to không được để trống",
				anhnho: "Ảnh nhỏ không được để trống",
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

<?php function anh_update(){ ?>
<?php 
	if(isset($_GET['maanh']))
		$maanh=$_GET['maanh'];
	if(isset($_GET['vitri']))
		$vitri=$_GET['vitri'];
?>
<?php 
	if(isset($_POST['suaanh'])){
		$trangthaianh=$_POST['trangthaianh'];
		if($vitri=='5'){
			$sql="update anh set trangthai='$trangthaianh' where maanh='$maanh'";
			GLOBAL $connect;
			$connect->query($sql);
			$maanhnho=$maanh+1;
			$sql="update anh set trangthai='$trangthaianh' where maanh='$maanhnho'";
			GLOBAL $connect;
			$connect->query($sql);
		}elseif($vitri=='6') {
			$sql="update anh set trangthai='$trangthaianh' where maanh='$maanh'";
			GLOBAL $connect;
			$connect->query($sql);
			$maanhnho=$maanh-1;
			$sql="update anh set trangthai='$trangthaianh' where maanh='$maanhnho'";
			GLOBAL $connect;
			$connect->query($sql);
		} else {
			$sql="update anh set trangthai='$trangthaianh' where maanh='$maanh'";
			GLOBAL $connect;
			$connect->query($sql);
		}
		echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemanh';</script>";
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
                	<i class="fa fa-picture-o"></i>Quản lý ảnh menu - Slide
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">SỬA ẢNH MENU - SLIDE</h1>
	        </section>
	        <?php  
	        	$sql="select*from anh where maanh='$maanh'";
	        	GLOBAL $connect;
	        	$kq=$connect->query($sql);
	        	$rowanh=mysqli_fetch_array($kq);
	        ?>
	        <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
	            <section class="form-group">
		    		<label class="control-label col-md-2 col-sm-12" >Ảnh đại diện: </label>
		    		<section class="col-md-10 col-sm-12">
		    			<img class="img-responsive" src="<?=$rowanh['duongdananh']?>">
		    		</section>
		  		</section>
		  		<section class="form-group">
		    		<label class="control-label col-md-2 col-sm-12" >Tên vị trí: </label>
		    		<section class="col-md-10 col-sm-12">
		    			<input type="text" class="form-control" name="tenvitri" value="<?=$rowanh['tenvitri']?>" disabled>
		    		</section>
		  		</section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12">Trạng thái: </label>
	            	<section class="col-md-2 col-sm-12">
	            	<select name="trangthaianh" class="form-control">
	            	<?php if($rowanh['trangthai']==1){?>
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
							<input type="button" onClick="location='?dieuhuong=xemanh';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="suaanh" value="Sửa ảnh" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<?php } ?>