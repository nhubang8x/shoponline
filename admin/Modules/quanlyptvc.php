<!--Function Xem & Xóa phương thức vận chuyển-->
<?php function vc_list(){?>
<?php
	if(isset($_GET['mavc'])){
	$sql="delete from vanchuyen where mavanchuyen=".$_GET['mavc'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemvc';</script>";
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
                    <i class="fa fa-fw fa-truck"></i> Quản lý phương thức vận chuyển
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 class="h1align">DANH SÁCH PHƯƠNG THỨC VẬN CHUYỂN</h1>
        <p> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themvc';"><span class="fa fa-plus"></span> Thêm hình thức vận chuyển</button></p>
       <section class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã vận chuyển</th>
                        <th>Hình thức vận chuyển</th>
                        <th>Giá cước</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select * from vanchuyen";
                    GLOBAL $connect;
                    $kq=$connect->query($sql) or die('err');
                    while($rowvanchuyen=mysqli_fetch_array($kq)){
                ?>
                    <tr>
          						<td><?=$rowvanchuyen['mavanchuyen']?></td>
          						<td><?=$rowvanchuyen['hinhthucvc']?></td>
          						<td><?=number_format($rowvanchuyen['giacuoc'],0,',','.')?> vnđ</td>
                      <td><?php if($rowvanchuyen['trangthai']==1) echo"Mở"; else echo"Khóa";?></td>
                      <td>
                          <a href="?dieuhuong=suavc&mavc=<?=$rowvanchuyen['mavanchuyen']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                          <?php
                            $sql="select*from hoadon where trangthaihoadon!=3 and mavanchuyen=".$rowvanchuyen['mavanchuyen'];
                            $kq1=$connect->query($sql);
                            if(mysqli_num_rows($kq1)==0){
                          ?>
                          <a onClick="if(confirm('Bạn muốn xóa phương thức vận chuyển này?')) return true; else return false;" href="?dieuhuong=xemvc&mavc=<?=$rowvanchuyen['mavanchuyen']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                          <?php
                            }else{
                          ?>
                          <a><button type="button" class="btn btn-xs btn-primary" disabled><span class="fa fa-trash"></span> Xóa</button></a>
                          <?php } ?>
                      </td>
                  </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    </section>
</section>
<?php } ?>

<!--Function sửa phương thức vận chuyển-->
<?php function vc_update(){?>
<?php
  if(isset($_GET['mavc']))
  	$mavc=addslashes($_GET['mavc']);
?>
<?php
	if(isset($_POST['suavc'])){
		$hinhthucvc=addslashes($_POST['hinhthucvc']);
		$giacuoc=addslashes($_POST['giacuoc']);
    $trangthai=addslashes($_POST['trangthai']);
    $sql="select*from vanchuyen where hinhthucvc='$hinhthucvc' and mavanchuyen!='$mavc'";
  	GLOBAL $connect;
  	$kq=$connect->query($sql);
  	if(mysqli_num_rows($kq))
  		$UserError = "Phương thức vận chuyển này đã có sẵn.";
  	else{
  		$sql="update vanchuyen set hinhthucvc='$hinhthucvc', giacuoc='$giacuoc', trangthai='$trangthai' where mavanchuyen='$mavc'";
  		GLOBAL $connect;
  		$connect->query($sql);
  		echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemvc';</script>";
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
                    <i class="fa fa-truck"></i> Quản lý phương thức vận chuyển
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">SỬA PHƯƠNG THỨC VẬN CHUYỂN</h1>
	      </section>
	        <?php
    			   if(isset($_GET['mavc']))
      				$mavc=addslashes($_GET['mavc']);
      				$sql="select*from vanchuyen where mavanchuyen='$mavc'";
      				GLOBAL $connect;
      				$kq=$connect->query($sql);
      				$rowvanchuyen=mysqli_fetch_array($kq);
    			?>
	        <form method="post" class="form-horizontal" id="updatevc" enctype="multipart/form-data">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Hình thức vận chuyển: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="hinhthucvc" value="<?=$rowvanchuyen['hinhthucvc']?>">
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Giá cước: </label>
	            	<section class="col-md-10 col-sm-12">
		              	  <input class="form-control" type="text" name="giacuoc" value="<?=$rowvanchuyen['giacuoc']?>">
                	</section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái: </label>
	            	<section class="col-md-5 col-sm-12">
	            	<select name="trangthai" class="form-control">
        	        <?php if($rowvanchuyen['trangthai']==1){?>
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
										<input type="button" onClick="location='?dieuhuong=xemvc';" class="btn btn-primary" value="Quay lại" id="input2">
	            			<input type="submit" class="btn btn-primary" name="suavc" value="Sửa phương thức vận chuyển" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#updatevc" ).validate( {
			rules: {
				hinhthucvc: "required",
        giacuoc: {
					required: true,
					digits: true,
				},
			},
			messages: {
				hinhthucvc: "Hình thức vận chuyển không được để trống",
        giacuoc: {
					required: "Giá cước không được để trống",
					digits: "Giá cước phải là một số dương"
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

<!-- functuon Thêm phương thức vận chuyển-->
<?php function vc_insert(){?>
<?php
  if(isset($_POST['themvc'])){
    $hinhthucvc=addslashes($_POST['hinhthucvc']);
    $giacuoc=addslashes($_POST['giacuoc']);
    $sql="select*from vanchuyen where hinhthucvc='$hinhthucvc'";
    GLOBAL $connect;
    $kq=$connect->query($sql);
    if(mysqli_num_rowS($kq)>0)
      $UserError = "Hình thức vận chuyển này đã có sẵn.";
    else{
      $sql="insert into vanchuyen(hinhthucvc,giacuoc) values('$hinhthucvc','$giacuoc')";
      GLOBAL $connect;
      $connect->query($sql) or die('Không thể thêm được');
      echo "<script>alert('Thêm thành công!'); location='?dieuhuong=xemvc'</script>";
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
                    <i class="fa fa-truck"></i> Quản lý phương thức vận chuyển
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<h1 class="h1align">THÊM HÌNH THỨC VẬN CHUYỂN</h1>
	        <form method="post" class="form-horizontal" id="addvc">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Hình thức vận chuyển: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="hinhthucvc">
		                <em id="tenloai-error" class="error help-block"><?php if(isset($UserError)) echo $UserError ?></em>
	                </section>
	            </section>
              <section class="form-group">
                  <label class="control-label col-md-2 col-sm-12" id="label2">Giá cước: </label>
                <section class="col-md-10 col-sm-12">
                    <input class="form-control" type="text" name="giacuoc">
                  </section>
              </section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" id="b-align">
										<input type="button" onClick="location='?dieuhuong=xemvc';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="themvc" value="Thêm phương thức vận chuyển" id="input2">
	                  <input type="reset" class="btn btn-primary" name="xoa" value="Làm lại" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#addvc" ).validate( {
			rules: {
				hinhthucvc: "required",
        giacuoc: {
					required: true,
					digits: true,
				},
			},
			messages: {
				hinhthucvc: "Hình thức vận chuyển không được để trống",
        giacuoc: {
					required: "Giá cước không được để trống",
					digits: "Giá cước phải là một số dương"
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
