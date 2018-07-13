<!-- functuon Danh sách nhóm + Xóa nhóm-->
<?php function nhom_list(){ ?>
<?php
if(isset($_GET['manhom'])){
	$sql="delete from nhomsp where manhom=".$_GET['manhom'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemnhom';</script>";
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
                    <i class="fa fa-gear"></i> Quản lý nhóm
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">DANH SÁCH NHÓM SẢN PHẨM</h1>
        <p> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themnhom';"><span class="fa fa-plus"></span> Thêm nhóm</button></p>
       <section class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã nhóm</th>
                        <th>Tên nhóm sản phẩm</th>
                        <th>Trạng thái nhóm</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from nhomsp";
                    GLOBAL $connect;
                    $kq=$connect->query($sql) or die('err');
                    while($rownhomsp=mysqli_fetch_array($kq)){
                ?>
                    <tr>
                        <td><?=$rownhomsp['manhom']?></td>
                        <td><?=$rownhomsp['tennhom']?></td>
                        <td><?php if($rownhomsp['trangthainhom']==1) echo"Mở"; else echo"Khóa";?></td>
                        <td>
                            <a href="?dieuhuong=suanhom&manhom=<?=$rownhomsp['manhom']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                            <?php
                                $sql="select*from loaisp where manhomsp=".$rownhomsp['manhom'];
                                $kq1=$connect->query($sql);
                                if(mysqli_num_rows($kq1)==0){
                            ?>
                            <a onClick="if(confirm('Bạn muốn xóa nhóm này?')) return true; else return false;" href="?dieuhuong=xemnhom&manhom=<?=$rownhomsp['manhom']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
                             <a onClick="if(confirm('Bạn muốn xóa nhóm này?')) return true; else return false;" href="?dieuhuong=xemnhom&manhom=<?=$rownhomsp['manhom']?>"><button type="button" class="btn btn-xs btn-primary" disabled><span class="fa fa-trash"></span> Xóa</button></a>
                             <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </section>
    </section>
</section>
<?php } ?>

<!-- functuon Sửa nhóm-->
<?php function nhom_update(){?>
<?php
if(isset($_GET['manhom']))
	$manhom=addslashes($_GET['manhom']);
?>
<?php
if(isset($_POST['Suanhom'])){
	$tennhom=addslashes($_POST['tennhom']);
	$trangthainhom=addslashes($_POST['trangthainhom']);
	$sql="select*from nhomsp where tennhom='$tennhom' and manhom!='$manhom'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq))
		$UserError = "Tên nhóm này đã có sẵn.";
	else{
		$sql="update nhomsp set tennhom='$tennhom', trangthainhom='$trangthainhom' where manhom='$manhom'";
		$connect->query($sql);
		echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemnhom';</script>";
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
if(isset($_GET['manhom']))
	$manhom=addslashes($_GET['manhom']);
$sql="select*from nhomsp where manhom='$manhom'";
GLOBAL $connect;
$kq=$connect->query($sql);
$rownhomsp=mysqli_fetch_array($kq);
?>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<h1 class="h1align">SỬA NHÓM SẢN PHẨM</h1>
	        <form method="post" id="suanhom" class="form-horizontal">
	            <section class="form-group" id="input1">
	                <label class="control-label col-md-2 col-sm-12" id="label1">Tên nhóm sản phẩm: </label>
	                <section class="col-md-10 col-sm-12">
	                <input class="form-control" type="text" name="tennhom" id="tennhom" value="<?=$rownhomsp['tennhom']?>">
	                <em id="tenloai-error" class="error help-block"><?php if(isset($UserError)) echo $UserError ?></em>
	                </section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái nhóm: </label>
	            	<section class="col-md-5 col-sm-12">
	            	<select name="trangthainhom" class="form-control">
	            	<?php if($rownhomsp['trangthainhom']==1){?>
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
										<input type="button" onClick="location='?dieuhuong=xemnhom';" class="btn btn-primary" value="Quay lại" id="input2">
	            			<input type="submit" class="btn btn-primary" name="Suanhom" value="Sửa nhóm sản phẩm" id="input2">
	            	</section>
	            </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
				$( document ).ready( function () {
					$( "#suanhom" ).validate( {
						rules: {
							tennhom: "required",
						},
						messages: {
							tennhom: "Tên nhóm không được để trống",
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

<!-- functuon Thêm nhóm-->
<?php function nhom_insert(){?>
<?php
if(isset($_POST['themnhom'])){
	$tennhom=addslashes($_POST['tennhom']);
	$sql="select*from nhomsp where tennhom='$tennhom'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq)>0)
		$UserError = "Tên nhóm này đã có sẵn.";
	else{
		$sql="insert nhomsp(tennhom) values('$tennhom')";
		$connect->query($sql);
		echo"<script>alert('Thêm thành công'); location='?dieuhuong=xemnhom';</script>";
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
                    <i class="fa fa-gear"></i> Quản lý nhóm
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
		    <section class="col-md-12 col-sm-12" >
		    		<h1 class="h1align">THÊM NHÓM SẢN PHẨM</h1>
	        </section>
	        <form method="post" id="formnhom">
	            <section class="form-horizontal">
	            <label class="control-label col-md-2 col-sm-12" id="label2">Tên nhóm sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" name="tennhom" id="tennhom">
		                <em id="tenloai-error" class="error help-block"><?php if(isset($UserError)) echo $UserError ?></em>
	                </section>
	            </section>
	            <section class="form-group">
	            	<section class="col-md-12 col-sm-12" id="b-align">
									<input type="button" onClick="location='?dieuhuong=xemnhom';" class="btn btn-primary" value="Quay lại" id="input2">
	            		<input type="submit" class="btn btn-primary" name="themnhom" value="Thêm nhóm sản phẩm" id="input2">
	            	</section>
	            </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#formnhom" ).validate( {
			rules: {
				tennhom: "required",
			},
			messages: {
				tennhom: "Tên nhóm không được để trống"
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
