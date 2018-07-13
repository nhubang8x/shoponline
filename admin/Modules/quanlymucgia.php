<!-- functuon Danh sách mức giá tìm kiếm + Xóa mức giá tìm kiếm-->
<?php function mucgia_list(){ ?>
<?php
if(isset($_GET['mamucgia'])){
	$sql="delete from mucgia where mamucgia=".$_GET['mamucgia'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemmucgia';</script>";
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
                    <i class="fa fa-search"></i> Quản lý mức giá tìm kiếm
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">DANH SÁCH NHÓM MỨC GIÁ TÌM KIẾM</h1>
        <p> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themmucgia';"><span class="fa fa-plus"></span> Thêm mức giá tìm kiếm</button></p>
       <section class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã mức giá</th>
                        <th>Tên mức giá</th>
                        <th>Mức thấp</th>
                        <th>Mức cao</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from mucgia";
                    GLOBAL $connect;
                    $kq=$connect->query($sql) or die('err');
                    while($rowmucgia=mysqli_fetch_array($kq)){
                ?>
                    <tr>
                        <td><?=$rowmucgia['mamucgia']?></td>
                        <td><?=$rowmucgia['tenmucgia']?></td>
                        <td><?=number_format($rowmucgia['mucthap'],0,',','.')?> vnđ</td>
                        <td><?=number_format($rowmucgia['muccao'],0,',','.')?> vnđ</td>
                        <td><?php if($rowmucgia['trangthaimucgia']==1) echo"Mở"; else echo"Khóa";?></td>
                        <td>
                            <a href="?dieuhuong=suamucgia&mamucgia=<?=$rowmucgia['mamucgia']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                           <?php if($rowmucgia['trangthaimucgia']==0){ ?>
                            <a onClick="if(confirm('Bạn muốn xóa nhóm này?')) return true; else return false;" href="?dieuhuong=xemmucgia&mamucgia=<?=$rowmucgia['mamucgia']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
                             <a onClick="if(confirm('Bạn muốn xóa nhóm này?')) return true; else return false;" href="?dieuhuong=xemmucgia&mamucgia=<?=$rowmucgia['mamucgia']?>"><button type="button" class="btn btn-xs btn-primary" disabled><span class="fa fa-trash"></span> Xóa</button></a>
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

<!-- functuon Sửa mức giá tìm kiếm-->
<?php function mucgia_update(){?>
<?php
if(isset($_GET['mamucgia']))
	$mamucgia=addslashes($_GET['mamucgia']);
?>
<?php
if(isset($_POST['suamucgia'])){
	$tenmucgia=addslashes($_POST['tenmucgia']);
	$mucthap=addslashes($_POST['mucthap']);
	$muccao=addslashes($_POST['muccao']);
	$trangthaimucgia=addslashes($_POST['trangthaimucgia']);
  if($mucthap>$muccao){
    $UserError1 = "Mức giá thấp không được lớn hơn mức giá cao";
  }else{
  	$sql="select*from mucgia where tenmucgia='$tenmucgia' and mamucgia!='$mamucgia'";
  	GLOBAL $connect;
  	$kq=$connect->query($sql);
  	if(mysqli_num_rows($kq))
  		$UserError = "Tên mức giá tìm kiếm này đã có sẵn.";
  	else{
      $sql="select*from mucgia where mucthap='$mucthap' and muccao='$muccao' and mamucgia!='$mamucgia'";
      GLOBAL $connect;
      $kq1=$connect->query($sql);
      if(mysqli_num_rows($kq1))
        $UserError1 = "Mức cao và mức thấp này đã có sẵn.";
      else{
    		$sql="update mucgia set tenmucgia='$tenmucgia',mucthap='$mucthap',muccao='$muccao', trangthaimucgia='$trangthaimucgia' where mamucgia='$mamucgia'";
        GLOBAL $connect;
        $connect->query($sql);
    		echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemmucgia';</script>";
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
                    <i class="fa fa-search"></i> Quản lý mức giá tìm kiếm
                </li>
            </ol>
        </section>
	</section>
<?php
if(isset($_GET['mamucgia']))
	$mamucgia=addslashes($_GET['mamucgia']);
$sql="select*from mucgia where mamucgia='$mamucgia'";
GLOBAL $connect;
$kq=$connect->query($sql);
$rowmucgia=mysqli_fetch_array($kq);
?>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<h1 class="h1align">SỬA MỨC GIÁ TÌM KIẾM</h1>
	        <form method="post" id="suamg" class="form-horizontal">
	            <section class="form-group">
	              <label class="control-label col-md-2 col-sm-12" id="label1">Tên mức giá tìm kiếm: </label>
	              <section class="col-md-10 col-sm-12">
	              <input class="form-control" type="text" name="tenmucgia" id="tenmucgia" value="<?=$rowmucgia['tenmucgia']?>">
	              <em id="tenloai-error" class="error help-block"><?php if(isset($UserError)) echo $UserError ?></em>
	              </section>
	            </section>
				<section class="form-group">
	              <label class="control-label col-md-2 col-sm-12" id="label1">Mức giá thấp: </label>
	              <section class="col-md-10 col-sm-12">
	                 <input class="form-control" type="text" name="mucthap" id="mucthap" value="<?=$rowmucgia['mucthap']?>">
	              </section>
	         	</section>
				<section class="form-group">
		              <label class="control-label col-md-2 col-sm-12" id="label1">Mức giá cao: </label>
		              <section class="col-md-10 col-sm-12">
		              <input class="form-control" type="text" name="muccao" id="muccao" value="<?=$rowmucgia['muccao']?>">
		              </section>
	            </section>
	            <section class="form-group">
  	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái mức giá: </label>
  	            	<section class="col-md-5 col-sm-12">
	  	            	<select name="trangthaimucgia" class="form-control">
	  	            	<?php if($rowmucgia['trangthaimucgia']==1){?>
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
              			<em id="tenloai-error" class="error help-block"><?php if(isset($UserError1)) echo $UserError1 ?></em>
						<input type="button" onClick="location='?dieuhuong=xemmucgia';" class="btn btn-primary" value="Quay lại" id="input2">
        			<input type="submit" class="btn btn-primary" name="suamucgia" value="Sửa mức giá" id="input2">
        			</section>
       			 </section>
      		</form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#suamg" ).validate( {
			rules: {
				tenmucgia: "required",
        muccao: {
          required: true,
          digits: true,
        },
        mucthap: {
          required: true,
          digits: true,
				},
			},
			messages: {
				tenmucgia: "Tên mức giá không được để trống",
				mucthap: {
          required: "Mức giá thấp không được để trống",
					digits: "Mức giá thấp phải là một số dương"
				},
        muccao: {
          required: "Mức giá cao không được để trống",
					digits: "Mức giá cao phải là một số dương"
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

<!-- functuon Thêm nhóm-->
<?php function mucgia_insert(){?>
  <?php
  if(isset($_POST['suamucgia'])){
  	$tenmucgia=addslashes($_POST['tenmucgia']);
  	$mucthap=addslashes($_POST['mucthap']);
  	$muccao=addslashes($_POST['muccao']);
    if($mucthap>$muccao){
      $UserError1 = "Mức giá thấp không được lớn hơn mức giá cao";
    }else{
    	$sql="select*from mucgia where tenmucgia='$tenmucgia'";
    	GLOBAL $connect;
    	$kq=$connect->query($sql);
    	if(mysqli_num_rows($kq))
    		$UserError = "Tên mức giá tìm kiếm này đã có sẵn.";
    	else{
        $sql="select*from mucgia where mucthap='$mucthap' and muccao='$muccao'";
        GLOBAL $connect;
        $kq1=$connect->query($sql);
        if(mysqli_num_rows($kq1))
          $UserError1 = "Mức cao và mức thấp này đã có sẵn.";
        else{
      		$sql="insert mucgia (tenmucgia,mucthap,muccao) values('$tenmucgia','$mucthap','$muccao')";
          GLOBAL $connect;
          $connect->query($sql);
      		echo"<script>alert('Sửa thành công.'); location='?dieuhuong=xemmucgia';</script>";
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
                      <i class="fa fa-search"></i> Quản lý mức giá tìm kiếm
                  </li>
              </ol>
          </section>
  	</section>
  	<section class="row" id="row1">
  	    <section class="col-lg-12">
  	    	<h1 class="h1align">THÊM MỨC GIÁ TÌM KIẾM</h1>
  	        <form method="post" id="suamg" class="form-horizontal">
  	            <section class="form-group">
  	                <label class="control-label col-md-2 col-sm-12" id="label1">Tên mức giá tìm kiếm: </label>
  	                <section class="col-md-10 col-sm-12">
  	                <input class="form-control" type="text" name="tenmucgia" id="tenmucgia" value="<?php if(isset($tenmucgia)) echo $tenmucgia ?>">
  	                <em id="tenloai-error" class="error help-block"><?php if(isset($UserError)) echo $UserError ?></em>
  	                </section>
  	            </section>
  							<section class="form-group">
  	                <label class="control-label col-md-2 col-sm-12" id="label1">Mức giá thấp: </label>
  	                <section class="col-md-10 col-sm-12">
  	                   <input class="form-control" type="text" name="mucthap" id="mucthap" value="<?php if(isset($mucthap)) echo $mucthap ?>">
  	                </section>
  	            </section>
  							<section class="form-group">
  	                <label class="control-label col-md-2 col-sm-12" id="label1">Mức giá cao: </label>
  	                <section class="col-md-10 col-sm-12">
  	                <input class="form-control" type="text" name="muccao" id="muccao" value="<?php if(isset($muccao)) echo $muccao ?>">
  	                </section>
  	            </section>
   				<section class="form-group">
                  	<section class="col-md-12 col-sm-12" id="b-align">
                      <em id="tenloai-error" class="error help-block"><?php if(isset($UserError1)) echo $UserError1 ?></em>
  										<input type="button" onClick="location='?dieuhuong=xemmucgia';" class="btn btn-primary" value="Quay lại" id="input2">
  	            			<input type="submit" class="btn btn-primary" name="suamucgia" value="Sửa mức giá" id="input2">
  	            	</section>
  	            </section>
  	        </form>
  		</section>
  	</section>
  </section>
  <script type="text/javascript">
  	$( document ).ready( function () {
  		$( "#suamg" ).validate( {
  			rules: {
  				tenmucgia: "required",
          muccao: {
            required: true,
            digits: true,
          },
          mucthap: {
            required: true,
            digits: true,
  				},
  			},
  			messages: {
  				tenmucgia: "Tên mức giá không được để trống",
  				mucthap: {
            required: "Mức giá thấp không được để trống",
  					digits: "Mức giá thấp phải là một số dương"
  				},
          muccao: {
            required: "Mức giá cao không được để trống",
  					digits: "Mức giá cao phải là một số dương"
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
