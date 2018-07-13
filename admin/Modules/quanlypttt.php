<!--Function Xem & Xóa phương thức thanh toán-->
<?php function tt_list(){?>
<?php
	if(isset($_GET['matt'])){
	$sql="delete from thanhtoan where mathanhtoan=".$_GET['matt'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemtt';</script>";
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
                    <i class="fa fa-fw fa-credit-card"></i> Quản lý phương thức thanh toán
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 class="h1align">DANH SÁCH PHƯƠNG THỨC THANH TOÁN</h1>
        <p> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themtt';"><span class="fa fa-plus"></span> Thêm phương thức thanh toán</button></p>
       <section class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã thanh toán</th>
                        <th>Hình thức thanh toán</th>
                        <th>Ghi chú thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select * from thanhtoan";
                    GLOBAL $connect;
                    $kq=$connect->query($sql) or die('err');
                    while($rowthanhtoan=mysqli_fetch_array($kq)){
                ?>
                    <tr>
          						<td><?=$rowthanhtoan['mathanhtoan']?></td>
          						<td><?=$rowthanhtoan['hinhthuctt']?></td>
          						<td><?=$rowthanhtoan['ghichutt']?></td>
                      <td><?php if($rowthanhtoan['trangthai']==1) echo"Mở"; else echo"Khóa";?></td>
                      <td>
                          <a href="?dieuhuong=suatt&matt=<?=$rowthanhtoan['mathanhtoan']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                          <?php
                            $sql="select*from hoadon where trangthaihoadon!=3 and mathanhtoan=".$rowthanhtoan['mathanhtoan'];
                            $kq1=$connect->query($sql);
                            if(mysqli_num_rows($kq1)==0){
                          ?>
                          <a onClick="if(confirm('Bạn muốn xóa phương thức thanh toán này?')) return true; else return false;" href="?dieuhuong=xemtt&matt=<?=$rowthanhtoan['mathanhtoan']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
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

<!--Function sửa phương thức thanh toán-->
<?php function tt_update(){?>
<?php
  if(isset($_GET['matt']))
  	$matt=addslashes($_GET['matt']);
?>
<?php
	if(isset($_POST['suatt'])){
		$hinhthuctt=addslashes($_POST['hinhthuctt']);
		$ghichutt=addslashes($_POST['ghichutt']);
    $trangthai=addslashes($_POST['trangthai']);
    $sql="select*from thanhtoan where hinhthuctt='$hinhthuctt' and mathanhtoan!='$matt'";
  	GLOBAL $connect;
  	$kq=$connect->query($sql);
  	if(mysqli_num_rows($kq))
  		$UserError = "Phương thức thanh toán này đã có sẵn.";
  	else{
  		$sql="update thanhtoan set hinhthuctt='$hinhthuctt', ghichutt='$ghichutt', trangthai='$trangthai' where mathanhtoan='$matt'";
  		GLOBAL $connect;
  		$connect->query($sql);
  		echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemtt';</script>";
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
                    <i class="fa fa-credit-card"></i> Quản lý phương thức thanh toán
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">SỬA PHƯƠNG THỨC THANH TOÁN</h1>
	      </section>
	        <?php
    			   if(isset($_GET['maTT']))
      				$maTT=addslashes($_GET['maTT']);
      				$sql="select*from thanhtoan where mathanhtoan='$matt'";
      				GLOBAL $connect;
      				$kq=$connect->query($sql);
      				$rowthanhtoan=mysqli_fetch_array($kq);
    			?>
	        <form method="post" class="form-horizontal" id="updatett">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Hình thức thanh toán: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="hinhthuctt" value="<?=$rowthanhtoan['hinhthuctt']?>">
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Ghi chú thanh toán: </label>
	            	<section class="col-md-10 col-sm-12">
                  <textarea class="form-control" type="text" name="ghichutt" id="ghichutt"><?=$rowthanhtoan['ghichutt']?></textarea>
                  <script>CKEDITOR.replace('ghichutt');</script>
                </section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái: </label>
	            	<section class="col-md-5 col-sm-12">
	            	<select name="trangthai" class="form-control">
        	        <?php if($rowthanhtoan['trangthai']==1){?>
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
										<input type="button" onClick="location='?dieuhuong=xemtt';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="suatt" value="Sửa phương thức thanh toán" id="input2">
	                  <input type="reset" class="btn btn-primary" name="xoa" value="Làm lại" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#updatett" ).validate( {
			rules: {
				hinhthuctt: "required",
			},
			messages: {
				hinhthuctt: "Hình thức thanh toán không được để trống",
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

<!-- functuon Thêm phương thức thanh toán-->
<?php function tt_insert(){?>
<?php
  if(isset($_POST['themtt'])){
    $hinhthuctt=addslashes($_POST['hinhthuctt']);
    $sql="select*from thanhtoan where hinhthuctt='$hinhthuctt'";
    GLOBAL $connect;
    $kq=$connect->query($sql);
    if(mysqli_num_rowS($kq)>0)
      $UserError = "Hình thức thanh toán này đã có sẵn.";
    else{
      if(isset($_POST['ghichutt'])){
        $ghichutt=$_POST['ghichutt'];
        $sql="insert into thanhtoan(hinhthuctt,ghichutt) values('$hinhthuctt','$ghichutt')";
        GLOBAL $connect;
        $connect->query($sql) or die('Không thể thêm được');
      }else {
        $sql="insert into thanhtoan(hinhthuctt) values('$hinhthuctt')";
        GLOBAL $connect;
        $connect->query($sql) or die('Không thể thêm được');
      }
      echo "<script>alert('Thêm thành công!'); location='?dieuhuong=xemtt'</script>";
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
                    <i class="fa fa-credit-card"></i> Quản lý phương thức thanh toán
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<h1 class="h1align">THÊM HÌNH THỨC THANH TOÁN</h1>
	        <form method="post" class="form-horizontal" id="addtt">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Hình thức thanh toán: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="hinhthuctt">
		                <em id="tenloai-error" class="error help-block"><?php if(isset($UserError)) echo $UserError ?></em>
	                </section>
	            </section>
              <section class="form-group">
                  <label class="control-label col-md-2 col-sm-12" id="label2">Ghi chú thanh toán: </label>
                  <section class="col-md-10 col-sm-12">
                    <textarea class="form-control" type="text" name="ghichutt" id="ghichutt"><?php if(isset($_POST['ghichutt'])) echo $_POST['ghichutt']; ?></textarea>
                    <script>CKEDITOR.replace('ghichutt');</script>
                  </section>
              </section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" id="b-align">
										<input type="button" onClick="location='?dieuhuong=xemtt';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="themtt" value="Thêm phương thức thanh toán" id="input2">
	                  <input type="reset" class="btn btn-primary" name="xoa" value="Làm lại" id="input2">
	            	</section>
		        </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#addtt" ).validate( {
			rules: {
				hinhthuctt: "required",
			},
			messages: {
				hinhthuctt: "Hình thức thanh toán không được để trống",
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
