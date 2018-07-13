<!-- function Xem & Xoá sản phẩm-->
<?php  function sanpham_list(){?>
<?php
	if(isset($_GET['masanpham'])){
		$masanpham=$_GET['masanpham'];
		$sql = "SELECT duongdan FROM anhsp WHERE masp = '$masanpham'";
		GLOBAL $connect;
		$query = mysqli_query($connect,$sql) or die (mysqli_error());
		while ($row = mysqli_fetch_object($query)){
		    unlink($row->duongdan);
		}
		$sql = "DELETE FROM anhsp WHERE masp = '$masanpham'";
		GLOBAL $connect;
		$query = mysqli_query($connect,$sql) or die (mysqli_error());
		$sql="select*from sanpham where masanpham='$masanpham'";
		GLOBAL $connect;
		$kq1=$connect->query($sql);
		$rowsanpham=mysqli_fetch_array($kq1);
		unlink($rowsanpham['anhdaidien']);
		$sql="delete from sizesp where masp='$masanpham'";
		GLOBAL $connect;
		$connect->query($sql);
		$sql="delete from mausp where masp='$masanpham'";
		GLOBAL $connect;
		$connect->query($sql);
		$sql="delete from sanpham where masanpham=".$_GET['masanpham'];
		GLOBAL $connect;
		$connect->query($sql);
		echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemsanpham';</script>";
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
                    <i class="fa fa-table"></i> Quản lý sản phẩm
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">DANH SÁCH SẢN PHẨM</h1>
        <section class="col-md-6 col-sm-12" id="input3">
        	<button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themsanpham';"><span class="fa fa-plus"></span> Thêm sản phẩm</button></section>
        <section class="col-md-6 col-sm-12" id="input3">
		   	<section class="search-box">
			    <form class="search-form" name="frmtimkiem" method="post" action="">
			    	<input class="form-control" name="search" id="search" placeholder="Tìm kiếm theo tên sản phẩm" type="text" required="" value="<?php if(isset($_REQUEST['search'])) echo $_REQUEST['search'];?>">
			     	<button class="btn btn-link search-btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			    </form>
		  	 </section>
		</section>
		<form method="get" id="form_search">
		<section class="form-inline" id="loc1">
			<section class="form-group input-group">
		      		<span class="input-group-addon">Nhóm sản phẩm:</span>
		            <select class="form-control" name="nhom" onChange="location=this.options[this.selectedIndex].value;">
		        	<?php
		            	$sql="select*from nhomsp";
		            	GLOBAL $connect;
		            	$kq=$connect->query($sql) or die('err');
		            	if(isset($_GET['manhomsp'])){?>
		            		<option value="?dieuhuong=xemsanpham">Xem tất cả</option>
		            	<?php
		            		while($rownhomsp=mysqli_fetch_array($kq)){
		            			if($_GET['manhomsp']==$rownhomsp['manhom']){
		            	?>
		            		<option selected value="?dieuhuong=xemsanpham&manhomsp=<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
		            	<?php  	}else{?>
		            				<option value="?dieuhuong=xemsanpham&manhomsp=<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
		            	<?php   }
		            		}
		            	}else{?>
		            		<option selected value="?dieuhuong=xemsanpham">Xem tất cả</option>
		            	<?php
	              			while($rownhomsp=mysqli_fetch_array($kq)){?>
	            			<option value="?dieuhuong=xemsanpham&manhomsp=<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
	            		<?php
		        			}
		        		}
		            ?>
		        	</select>
			</section>
			<section class="form-group input-group">
		        	<span class="input-group-addon">Loại sản phẩm:</span>
		            <select class="form-control" name="loai" onChange="location=this.options[this.selectedIndex].value;">
		        	<?php
		            	$sql="select*from loaisp";
		            	GLOBAL $connect;
		            	$kq=$connect->query($sql) or die('err');
		            	if(isset($_GET['maloai'])){?>
		            		<option value="?dieuhuong=xemsanpham">Xem tất cả</option>
		            	<?php
		            		while($rowloaisp=mysqli_fetch_array($kq)){
		            			if($_GET['maloai']==$rowloaisp['maloai']){
		            	?>
		            		<option selected value="?dieuhuong=xemsanpham&maloai=<?=$rowloaisp['maloai']?>"><?=$rowloaisp['tenloai']?></option>
		            	<?php  	}else{?>
		            				<option value="?dieuhuong=xemsanpham&maloai=<?=$rowloaisp['maloai']?>"><?=$rowloaisp['tenloai']?></option>
		            	<?php   }
		            		}
		            	}else{?>
		            		<option selected value="?dieuhuong=xemsanpham">Xem tất cả</option>
		            	<?php
	              			while($rowloaisp=mysqli_fetch_array($kq)){?>
	            			<option value="?dieuhuong=xemsanpham&maloai=<?=$rowloaisp['maloai']?>"><?=$rowloaisp['tenloai']?></option>
	            		<?php
		        			}
		        		}
		            ?>
		        	</select>
			</section>
			<section class="form-group input-group">
		        <span class="input-group-addon">Hiển thị:</span>
		            <select class="form-control" name="hienthi" onChange="location=this.options[this.selectedIndex].value;">
		            <option value="" hidden="">-- Mời bạn chọn --</option>
		            <?php
		            	$url='dieuhuong=xemsanpham';
		            	if(isset($_GET['manhomsp'])){
							$url='dieuhuong=xemsanpham&manhomsp='.$_GET['manhomsp'];
						}
						if(isset($_GET['maloai'])){
							$url='dieuhuong=xemsanpham&maloai='.$_GET['maloai'];
						}
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
            <table class="table table-bordered table-hover" style="font-size: 12px">
                <thead>
                    <tr>
                        <th>Mã SP</th>
                        <th>Ảnh đại diện</th>
                        <th>Tên sản phẩm</th>
                        <th>Nhóm SP</th>
                        <th>Loại SP</th>
                        <th>Ngày nhập</th>
                        <th>Giá</th>
                        <th>KM</th>
                        <th>SL</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from sanpham ";
                    GLOBAL $connect;
                    if(isset($_GET['manhomsp'])){
						$manhomsp=addslashes($_GET['manhomsp']);
						$sql="select*from sanpham where manhomsp='$manhomsp' ";
					}
					if(isset($_GET['maloai'])){
						$maloai=addslashes($_GET['maloai']);
						$sql="select*from sanpham where maloaisp='$maloai' ";
					}
					if(isset($_REQUEST['search'])){
						$search=$_REQUEST['search'];
						$sql="select*from sanpham where tensanpham like '%$search%' ";
					}
					if(isset($_GET['soluong'])){
						$spmt=$_GET['soluong'];
					}else{
						$spmt=10;
					}
					$sql.="order by masanpham desc";
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
                    $kq1=$connect->query($sql);
                    if(mysqli_num_rows($kq)>0){
                    while($rowsanpham=mysqli_fetch_array($kq1)){
                ?>
                    <tr>
                    	<td><?=$rowsanpham['masanpham']?></td>
                        <td><section align="center"><img src="<?=$rowsanpham['anhdaidien']?>" width="40px" height="50px" class="img-responsive"></section></td>
                        <td><?=$rowsanpham['tensanpham']?></td>
                        <?php
                        	$sql="select*from nhomsp where manhom=".$rowsanpham['manhomsp'];
                        	GLOBAL $connect;
                        	$kq2=$connect->query($sql);
                        	$rownhomsp=mysqli_fetch_array($kq2)
                        ?>
                        <td><?=$rownhomsp['tennhom']?></td>
                        <?php
                        	$sql="select*from loaisp where maloai=".$rowsanpham['maloaisp'];
                        	GLOBAL $connect;
                        	$kq3=$connect->query($sql);
                        	$rowloaisp=mysqli_fetch_array($kq3)
                        ?>
                        <td><?=$rowloaisp['tenloai']?></td>
                        <td><?php echo date("d/m/Y",strtotime($rowsanpham['ngaynhap']))?></td>
                        <td><?=number_format($rowsanpham['gia'],0,',','.')?></td>
                        <td><?=$rowsanpham['khuyenmai']?> %</td>
                        <td><?=$rowsanpham['soluong']?></td>
                        <td><?php if($rowsanpham['trangthaisp']==1) echo"Đang bán"; else echo"Tạm ngừng";?></td>
                        <td>
                            <a href="?dieuhuong=suasanpham&masanpham=<?=$rowsanpham['masanpham']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Sửa</button></a>
                            <?php
                            	$sql="select * from chitiethoadon,chitietsanpham where chitiethoadon.machitietsp=chitietsanpham.machitiet and chitietsanpham.masp=".$rowsanpham['masanpham'];
                                GLOBAL $connect;
                                $kq4=$connect->query($sql);
                                if(mysqli_num_rows($kq4)==0){
                            ?>
                            <a onClick="if(confirm('Bạn muốn xóa sản phẩm này?')) return true; else return false;" href="?dieuhuong=xemsanpham&masanpham=<?=$rowsanpham['masanpham']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
								<a><button type="button" class="btn btn-xs btn-primary" disabled><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                	<tr>
                      <td colspan="11" id="sum-pro">Tổng số: <?php echo mysqli_num_rows($kq) ?> sản phẩm</td>
                    </tr>
                <?php }else{ ?>
		        	<tr>
		        		<td colspan="11" id="search-pro">Không tìm thấy sản phẩm nào phù hợp yêu cầu</td>
		        	</tr>
		        <?php } ?>

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

<!--function Thêm sản phẩm mới-->
<?php function sanpham_insert(){?>
<?php
	if(isset($_POST['themsanpham'])){
		$tensp=addslashes($_POST['tensp']);
		$nhom=addslashes($_POST['nhom']);
		$loai=addslashes($_POST['loai']);
		$giasp=addslashes($_POST['giasp']);
		$khuyenmai=addslashes($_POST['khuyenmai']);
		$soluong=addslashes($_POST['soluong']);
		$motasp=addslashes($_POST['motasp']);
		$file_name=time().'_';
		if(($_FILES['anhdaidien']['type']!="image/gif") && ($_FILES['anhdaidien']['type']!="image/png") && ($_FILES['anhdaidien']['type']!="image/jpeg") && ($_FILES['anhdaidien']['type']!="image/jpg")){
			$message="File không đúng định dạng";
		}elseif($_FILES['anhdaidien']['size']>10*1024*1024) {
			$message="Kích thước phải nhỏ hơn 10MB";
		}else{
			$anhdaidien=addslashes($file_name.$_FILES['anhdaidien']['name']);
			$duongdan=addslashes('../images/AnhDaiDien/'.$anhdaidien);
			move_uploaded_file($_FILES['anhdaidien']['tmp_name'],"../images/AnhDaiDien/".$anhdaidien);
		}
		$sql="select * from sanpham where tensanpham='$tensp'";
		GLOBAL $connect;
		$kq=$connect->query($sql);
		if(mysqli_num_rows($kq)>0){
			$UserError="Tên sản phẩm này đã có sẵn";
		}else{
			$sql="select * from loaisp where manhomsp='$nhom' and maloai='$loai'";
			GLOBAL $connect;
			$kq1=$connect->query($sql);
			if(mysqli_num_rows($kq1)==0){
				$UserError1="Bạn chọn loại sản phẩm không nằm trong nhóm sản phẩm bạn đã chọn";
			}else{
				$sql="insert sanpham(anhdaidien,gia,khuyenmai,maloaisp,manhomsp,motasp,ngaynhap,soluong,tensanpham)
						values('$duongdan','$giasp','$khuyenmai','$loai','$nhom','$motasp',now(),'$soluong','$tensp')";
				GLOBAL $connect;
				$connect->query($sql) or die('Không thể insert');
				$masanpham= mysqli_insert_id($connect);
				foreach ($_FILES['anhsanpham']['tmp_name'] as $key => $tmp_name) {
					$myFiles =$_FILES['anhsanpham'];
		        	if(($myFiles['type'][$key]!="image/gif") && ($myFiles['type'][$key]!="image/png") && ($myFiles['type'][$key]!="image/jpeg") && ($myFiles['type'][$key]!="image/jpg")){
						$messager="File không đúng định dạng";
					}elseif($myFiles['size'][$key]>10*1024*1024) {
						$messager="Kích thước phải nhỏ hơn 10MB";
					}else{
						$anhsanpham=addslashes($file_name.$myFiles['name'][$key]);
						$duongdans=addslashes('../images/AnhSanPham/'.$anhsanpham);
						move_uploaded_file($myFiles['tmp_name'][$key],"../images/AnhSanPham/".$anhsanpham);
					}
					$sql="insert into anhsp(masp,tenanh,duongdan) values('$masanpham','$anhsanpham','$duongdans')";
					GLOBAL $connect;
					$connect->query($sql) or die('Không thể insert');
		        }
		        $mau=$_POST['mau'];
		        $size=$_POST['size'];
		        $smau = count($_POST['mau']);
   				$ssize = count($_POST['size']);
   				for ($i=0; $i < $smau ; $i++) {
   					for ($j=0; $j < $ssize; $j++) {
   						$sql= "insert into  chitietsanpham(mamau, masize,masp) values('$mau[$i]', '$size[$j]','$masanpham')";
						GLOBAL $connect;
						$connect->query($sql) or die('Không thể insert');
   					}
   				}
				echo "<script>alert('Thêm sản phẩm thành công!'); location='?dieuhuong=xemsanpham'</script>";
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
                <li>
                	<i class="fa fa-gears"></i> Quản lý sản phẩm
                </li>
                <li class="active">
                    Thêm sản phẩm
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">THÊM SẢN PHẨM</h1>
	        </section>
	        <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
	            <section class="form-group" style="margin-bottom: 0px">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Tên sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="tensp" value="<?php if(isset($tensp)) echo $tensp?>">
		                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Nhóm sản phẩm: </label>
	            	<section class="col-md-4 col-sm-12">
	                    <select class="form-control" id="nhom" name="nhom">
		                    <option value="" hidden="">--Mời bạn lựa chọn--</option>
			            	<?php
			                	$sql="select*from nhomsp where trangthainhom=1";
			                	GLOBAL $connect;
			                	$kq=$connect->query($sql) or die('err');
			                	while($rownhomsp=mysqli_fetch_array($kq)){
			                		 if($rownhomsp['manhom']==$nhom){
		                	?>
		                    <option value="<?=$rownhomsp['manhom']?>" selected="selected"><?=$rownhomsp['tennhom']?></option>
			                <?php }else{?>
			                <option value="<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
			                <?php }
			                	}?>
	                	</select>
                	</section>
	            </section>
				<section class="form-group" style="margin-bottom: 0px">
                    <label class="control-label col-md-2 col-sm-12" id="label2">Loại sản phẩm:</label>
                    <section class="col-md-4 col-sm-12">
	                    <select class="form-control" name="loai" id="loaisp">
	                    	<option value="" hidden="">--Mời bạn lựa chọn--</option>
								<?php
				                	$sql="select*from loaisp where trangthailoai=1";
				                	GLOBAL $connect;
				                	$kq1=$connect->query($sql) or die('err');
				                	while($rowloaisp=mysqli_fetch_array($kq1)){
				                		 if($rowloaisp['maloai']==$loai){
			                	?>
			                    <option value="<?=$rowloaisp['maloai']?>" selected="selected"><?=$rowloaisp['tenloai']?></option>
				                <?php }else{?>
				                	<option value="<?=$rowloaisp['maloai']?>"><?=$rowloaisp['tenloai']?></option>
				                <?php }
				                	}?>
	                	</select>
	                	<span id="UserError"><?php if(isset($UserError1))  echo $UserError1?></span>
                	</section>
                </section>
                <section class="form-group">
		    		<label class="control-label col-md-2 col-sm-12" id="label2">Ảnh đại diện: </label>
		    		<section class="col-md-10 col-sm-12">
		    			<input type="file" class="form-control" name="anhdaidien">
		    			<span id="UserError1"><?php if(isset($message))  echo $message?></span>
		    		</section>
		  		</section>
		  		<section class="form-group">
		    		<label class="control-label col-md-2 col-sm-12" id="label2">Ảnh sản phẩm: </label>
		    		<section class="col-md-10 col-sm-12">
		    			<input type="file" class="form-control" name="anhsanpham[]" multiple>
		    			<span id="UserError1"><?php if(isset($messager))  echo $messager?></span>
		    		</section>
		  		</section>
		  		<section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Số lượng: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="soluong" value="<?php if(isset($soluong)) echo $soluong?>">
	                </section>
	            </section>
	            <section class="form-group">
                    <label class="control-label col-md-2 col-sm-12" id="label2">Màu:</label>
                    <section class="col-md-10 col-sm-12">
                        <?php
	                        $sql="select*from mau";
	                        GLOBAL $connect;
	                        $kq=$connect->query($sql) or die('err');
	                        while($rowmau=mysqli_fetch_array($kq)){?>
		                        <section class="col-md-2  col-xs-4">
			                				<label class="checkbox-inline">
		                            	<input type="checkbox" name="mau[]" value="<?=$rowmau['mamau']?>"><?=$rowmau['tenmau']?>
		                        	</label>
		                        </section>
                        <?php } ?>
                	</section>
                </section>
                <section class="form-group">
                    <label class="control-label col-md-2 col-sm-12" id="label2">Size:</label>
                    <section class="col-md-10 col-sm-12">
                        <?php
	                        $sql="select*from size";
	                        GLOBAL $connect;
	                        $kq=$connect->query($sql) or die('err');
	                        while($rowsize=mysqli_fetch_array($kq)){?>
	                        	<section class="col-md-2 col-xs-4">
		                        	<label class="checkbox-inline">
		                            	<input type="checkbox" name="size[]" value="<?=$rowsize['masize']?>"><?=$rowsize['tensize']?>
		                        	</label>
		                        </section>
                        <?php } ?>
                	</section>
                </section>
		  		<section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Giá sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="giasp" value="<?php if(isset($giasp)) echo $giasp?>">
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Khuyến mại: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="khuyenmai" value="<?php if(isset($khuyenmai)) echo $khuyenmai;?>">
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Mô tả sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <textarea class="form-control" type="text" name="motasp" id="motasp"><?php if(isset($motasp)) echo $motasp?></textarea>
		                <script>CKEDITOR.replace('motasp');</script>
	                </section>
	            </section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" id="b-align">
							<input type="button" onClick="location='?dieuhuong=xemsanpham';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="themsanpham" value="Thêm sản phẩm" id="input2">
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
				tensp: "required",
				nhom: "required",
				loai: "required",
				giasp: {
					required: true,
					digits: true,
				},
				anhdaidien: "required",
				"anhsanpham[]": "required",
				"mau[]": "required",
				"size[]": "required",
				khuyenmai: {
					required: true,
					digits: true,
				},
				motasp: "required",
				soluong: {
					required: true,
					digits: true,
				},
			},
			messages: {
				tensp: "Tên sản phẩm không được để trống",
				nhom: "Nhóm sản phẩm chưa được chọn",
				loai: "Loại sản phẩm chưa được chọn",
				giasp: {
					required: "Giá sản phẩm không được để trống",
					digits: "Giá sản phẩm phải là một số dương"
				},
				anhdaidien: "Ảnh đại diện không được để trống",
				"anhsanpham[]": "Ảnh mô tả không được để trống",
				"mau[]": "Màu không được để trống",
				"size[]": "Size không được để trống",
				khuyenmai:  {
					required: "Giá khuyến mại không được để trống",
					digits: "Giá khuyến mại phải là một số dương"
				},
				motasp: "Mô tả sản phẩm không được để trống",
				soluong:  {
					required: "Số lượng không được để trống",
					digits: "Số lượng phải là một số dương"
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

<!--function Sửa sản phẩm-->
<?php function sanpham_update(){?>
<?php
	if(isset($_GET['masanpham']))
		$masanpham=addslashes($_GET['masanpham']);
?>
<?php
	if(isset($_POST['suasanpham'])){
		$tensp=addslashes($_POST['tensp']);
		$nhom=addslashes($_POST['nhom']);
		$loai=addslashes($_POST['loai']);
		$giasp=addslashes($_POST['giasp']);
		$khuyenmai=addslashes($_POST['khuyenmai']);
		$soluong=addslashes($_POST['soluong']);
		$motasp=addslashes($_POST['motasp']);
		$trangthaisp=addslashes($_POST['trangthaisp']);
		$trangthaichitiet=$_POST['trangthaichitiet'];
		$file_name=time().'_';
		$sql="select * from sanpham where tensanpham='$tensp' and masanpham!='$masanpham'";
		GLOBAL $connect;
		$kq=$connect->query($sql);
		if(mysqli_num_rows($kq)>0){
			$UserError="Tên sản phẩm này đã có sẵn";
		}else{
			$sql="select * from loaisp where manhomsp='$nhom' and maloai='$loai'";
			GLOBAL $connect;
			$kq1=$connect->query($sql);
			if(mysqli_num_rows($kq1)==0){
				$UserError1="Bạn chọn loại sản phẩm không nằm trong nhóm sản phẩm bạn đã chọn";
			}else{
				if($_FILES['suaanhdaidien']['name'] != NULL){
					if(($_FILES['suaanhdaidien']['type']!="image/gif") && ($_FILES['suaanhdaidien']['type']!="image/png") && ($_FILES['suaanhdaidien']['type']!="image/jpeg") && ($_FILES['suaanhdaidien']['type']!="image/jpg")){
						$message="File không đúng định dạng";
					}elseif($_FILES['suaanhdaidien']['size']>10*1024*1024) {
						$message="Kích thước phải nhỏ hơn 10MB";
					}else{
						$suaanhdaidien=addslashes($file_name.$_FILES['suaanhdaidien']['name']);
						$suaduongdan=addslashes('../images/AnhDaiDien/'.$suaanhdaidien);
						move_uploaded_file($_FILES['suaanhdaidien']['tmp_name'],"../images/AnhDaiDien/".$suaanhdaidien);
					}
					$sql="select*from sanpham where masanpham='$masanpham'";
					GLOBAL $connect;
					$kq2=$connect->query($sql);
					$rowsanpham=mysqli_fetch_array($kq2);
					unlink($rowsanpham['anhdaidien']);
					$sql="update sanpham set anhdaidien='$suaduongdan', gia='$giasp', khuyenmai='$khuyenmai', maloaisp='$loai',manhomsp='$nhom',motasp='$motasp',soluong='$soluong',tensanpham='$tensp',trangthaisp='$trangthaisp' where masanpham='$masanpham'";
					GLOBAL $connect;
					$connect->query($sql) or die('Không thể cập nhật');
				}else{
					$sql="update sanpham set gia='$giasp', khuyenmai='$khuyenmai', maloaisp='$loai',manhomsp='$nhom',motasp='$motasp',soluong='$soluong',tensanpham='$tensp',trangthaisp='$trangthaisp' where masanpham='$masanpham'";
					GLOBAL $connect;
					$connect->query($sql) or die('Không thể cập nhật2');
				}
				if(isset($_POST['suaanhsanpham'])){
					echo "test";
					$sql = "SELECT duongdan FROM anhsp WHERE masp = '$masanpham'";
					GLOBAL $connect;
					$query = mysqli_query($connect,$sql) or die (mysqli_error());
					while ($rowanhsanpham = mysqli_fetch_object($query)){
					    unlink($rowanhsanpham->duongdan);
					}
					$sql = "DELETE FROM anhsp WHERE masp = '$masanpham'";
					GLOBAL $connect;
					$query = mysqli_query($connect,$sql) or die (mysqli_error());
					foreach ($_FILES['suaanhsanpham']['tmp_name'] as $key => $tmp_name) {
						$myFiles =$_FILES['suaanhsanpham'];
			        	if(($myFiles['type'][$key]!="image/gif") && ($myFiles['type'][$key]!="image/png") && ($myFiles['type'][$key]!="image/jpeg") && ($myFiles['type'][$key]!="image/jpg")){
							$messager="File không đúng định dạng";
						}elseif($myFiles['size'][$key]>10*1024*1024) {
							$messager="Kích thước phải nhỏ hơn 10MB";
						}else{
							$suaanhsanpham=addslashes($file_name.$myFiles['name'][$key]);
							$suaduongdans=addslashes('../images/AnhSanPham/'.$suaanhsanpham);
							move_uploaded_file($myFiles['tmp_name'][$key],"../images/AnhSanPham/".$suaanhsanpham);
						}
						$sql="insert into anhsp(masp,tenanh,duongdan) values('$masanpham','$suaanhsanpham','$suaduongdans')";
						GLOBAL $connect;
						$connect->query($sql) or die('Không thể insert');
			        }
		    	}
		    	$sql="select * from chitietsanpham where masp='$masanpham'";
				GLOBAL $connect;
				$ketqua=$connect->query($sql);
				$i=0;
				while($rowchitietsp=mysqli_fetch_array($ketqua))
				{
					$sql="update chitietsanpham set trangthai='".$trangthaichitiet[$i]."' where machitiet=".$rowchitietsp['machitiet'];
					GLOBAL $connect;
					$connect->query($sql) or die('Không thể cập nhật4');
					$i++;
				}
				echo "<script>alert('Sửa sản phẩm thành công!'); location='?dieuhuong=xemsanpham'</script>";
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
                <li>
                	<i class="fa fa-gears"></i> Quản lý sản phẩm
                </li>
                <li class="active">
                    Sửa sản phẩm
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">SỬA SẢN PHẨM</h1>
	        </section>
	        <?php
			if(isset($_GET['masanpham']))
				$masanpham=addslashes($_GET['masanpham']);
				$sql="select*from sanpham where masanpham='$masanpham'";
				GLOBAL $connect;
				$kq=$connect->query($sql);
				$rowsanpham=mysqli_fetch_array($kq);
			?>
	        <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
	            <section class="form-group" style="margin-bottom: 0px">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Tên sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="tensp" value="<?=$rowsanpham['tensanpham']?>">
		                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Nhóm sản phẩm: </label>
	            	<section class="col-md-4 col-sm-12">
	                    <select class="form-control" id="nhom" name="nhom">
		            	<?php
		                	$sql="select*from nhomsp where trangthainhom=1";
		                	GLOBAL $connect;
		                	$kq=$connect->query($sql) or die('err');
		                	while($rownhomsp=mysqli_fetch_array($kq)){
		                		 if($rownhomsp['manhom']==$rowsanpham['manhomsp']){
	                	?>
	                    <option value="<?=$rownhomsp['manhom']?>" selected="selected"><?=$rownhomsp['tennhom']?></option>
		                <?php }else{?>
		                <option value="<?=$rownhomsp['manhom']?>"><?=$rownhomsp['tennhom']?></option>
		                <?php }
		                	}?>
	                	</select>
                	</section>
	            </section>
				<section class="form-group" style="margin-bottom: 0px">
                    <label class="control-label col-md-2 col-sm-12" id="label2">Loại sản phẩm:</label>
                    <section class="col-md-4 col-sm-12">
	                    <select class="form-control" name="loai" id="loaisp">
		            	<?php
		                	$sql="select*from loaisp where trangthailoai=1";
		                	GLOBAL $connect;
		                	$kq=$connect->query($sql) or die('err');
		                	while($rowloaisp=mysqli_fetch_array($kq)){
		                		if($rowloaisp['maloai']==$rowsanpham['maloaisp']){
	                	?>
	                    	<option value="<?=$rowloaisp['maloai']?>" selected><?=$rowloaisp['tenloai']?></option>
		                <?php }else{ ?>
							<option value="<?=$rowloaisp['maloai']?>"><?=$rowloaisp['tenloai']?></option>
						<?php }
						} ?>
	                	</select>
	                	<span id="UserError"><?php if(isset($UserError1))  echo $UserError1?></span>
                	</section>
                </section>
                <section class="form-group">
		    		<label class="control-label col-md-2 col-sm-12" id="label2">Ảnh đại diện: </label>
		    		<section class="col-md-10 col-sm-12">
		    			<input type="file" class="form-control" name="suaanhdaidien">
		    			<span id="UserError1"><?php if(isset($message))  echo $message?></span>
		    		</section>
		  		</section>
		  		<section class="form-group">
		    		<section class="col-md-offset-2 col-sm-12">
	                	<section class="col-md-3 col-sm-12">
	                		<img class="img-responsive" src="<?=$rowsanpham['anhdaidien']?>">
			    		</section>
		    		</section>
		  		</section>
		  		<section class="form-group">
		    		<label class="control-label col-md-2 col-sm-12" id="label2">Ảnh sản phẩm: </label>
		    		<section class="col-md-10 col-sm-12">
		    			<input type="file" class="form-control" name="suaanhsanpham[]" multiple>
		    			<span id="UserError1"><?php if(isset($messager))  echo $messager?></span>
		    		</section>
		  		</section>
		  		<section class="form-group">
		    		<section class="col-md-offset-2 col-sm-12">
		    			<?php
	                	$sql="select*from anhsp where masp='$masanpham'";
	                	GLOBAL $connect;
	                	$kq=$connect->query($sql) or die('err');
	                	while($rowanhsanpham=mysqli_fetch_array($kq)){?>
		                	<section class="col-md-3 col-sm-12">
		                		<img class="img-responsive" src="<?=$rowanhsanpham['duongdan']?>">
				    		</section>
	                	<?php } ?>
		    		</section>
		  		</section>
		  		<section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Số lượng: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="soluong" value="<?=$rowsanpham['soluong']?>">
	                </section>
	            </section>
	            <section class="form-group">
                    <label class="control-label col-md-2 col-sm-12" id="label2">Chi tiết sản phẩm:</label>
                    <section class="col-md-10 col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã chi tiết</th>
                                        <th>Màu</th>
                                        <th>Size</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                	$sql="select*from chitietsanpham,mau,size where chitietsanpham.mamau=mau.mamau and chitietsanpham.masize=size.masize and masp='$masanpham'";
                                	GLOBAL $connect;
                                	$kq1=$connect->query($sql);
                                	while($chitietsp=mysqli_fetch_array($kq1)) {
                                ?>
                                    <tr>
                                        <td><?=$chitietsp['machitiet']?></td>
                                        <td><?=$chitietsp['tenmau']?></td>
                                        <td><?=$chitietsp['tensize']?></td>
                                        <td>
                                        	<select name="trangthaichitiet[]" class="form-control">
							            	<?php if($chitietsp['trangthai']==1){?>
												<option value="1" selected>Mở</option>
												<option value="0">Khóa</option>
											<?php }else{ ?>
												<option value="1">Mở</option>
												<option value="0" selected>Khóa</option>
											<?php }?>
							            	</select>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                	</section>
                </section>
		  		<section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Giá sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="giasp" value="<?=$rowsanpham['gia']?>">
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Khuyến mại: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="khuyenmai" value="<?=$rowsanpham['khuyenmai']?>">
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Mô tả sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <textarea class="form-control" type="text" name="motasp" id="motasp"><?=$rowsanpham['motasp']?></textarea>
		                <script>CKEDITOR.replace('motasp');</script>
	                </section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái: </label>
	            	<section class="col-md-2 col-sm-12">
		            	<select name="trangthaisp" class="form-control">
		            	<?php if($rowsanpham['trangthaisp']==1){?>
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
										<input type="button" onClick="location='?dieuhuong=xemsanpham';" class="btn btn-primary" value="Quay lại" id="input2">
		            		<input type="submit" class="btn btn-primary" name="suasanpham" value="Sửa sản phẩm" id="input2">
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
				tensp: "required",
				nhom: "required",
				loai: "required",
				giasp: {
					required: true,
					digits: true,
				},
				"mau[]": "required",
				"size[]": "required",
				khuyenmai: {
					required: true,
					digits: true,
				},
				motasp: "required",
				soluong: {
					required: true,
					digits: true,
				},
			},
			messages: {
				tensp: "Tên sản phẩm không được để trống",
				nhom: "Nhóm sản phẩm chưa được chọn",
				loai: "Loại sản phẩm chưa được chọn",
				giasp: {
					required: "Giá sản phẩm không được để trống",
					digits: "Giá sản phẩm phải là một số dương"
				},
				"mau[]": "Màu không được để trống",
				"size[]": "Size không được để trống",
				khuyenmai:  {
					required: "Giá khuyến mại không được để trống",
					digits: "Giá khuyến mại phải là một số dương"
				},
				motasp: "Mô tả sản phẩm không được để trống",
				soluong:  {
					required: "Số lượng không được để trống",
					digits: "Số lượng phải là một số dương"
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

<!--Function Xem và xóa danh sách bảng màu-->
<?php function mau_list(){?>
<?php
if(isset($_GET['mamau'])){
	$sql="delete from mau where mamau=".$_GET['mamau'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemmau';</script>";
}
?>
<section class="container-fluid">
    <!-- Page Heading -->
    <section class="row" >
        <section class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>  <a href="?dieuhuong=home">Trang chủ</a>
                </li>
                <li>
                    <i class="fa fa-table"></i> Quản lý sản phẩm
                </li>
                <li class="active">
                    Quản lý bảng màu
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-md-6 col-sm-12">
        <h1 style="text-align: center;">DANH SÁCH BẢNG MÀU</h1>
        <p> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themmau';"><span class="fa fa-plus"></span> Thêm màu</button></p>
       <section class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã màu</th>
                        <th>Màu</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from mau";
                    GLOBAL $connect;
                    $kq=$connect->query($sql) or die('err');
                    while($rowmau=mysqli_fetch_array($kq)){
                ?>
                    <tr>
                        <td><?=$rowmau['mamau']?></td>
                        <td><?=$rowmau['tenmau']?></td>
                        <td>
                            <?php
                                $sql="select*from chitietsanpham where mamau=".$rowmau['mamau'] ;
                                $kq1=$connect->query($sql);
                                if(mysqli_num_rows($kq1)==0){
                            ?>
                            <a onClick="if(confirm('Bạn muốn xóa màu này?')) return true; else return false;" href="?dieuhuong=xemmau&mamau=<?=$rowmau['mamau']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
                            <a><button type="button" class="btn btn-xs btn-primary" disabled=""><span class="fa fa-trash"></span> Xóa</button></a>
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

<!-- Function Thêm màu mới-->
<?php function mau_insert(){?>
<?php
if(isset($_POST['themmau'])){
	$tenmau=addslashes($_POST['tenmau']);
	$sql="select*from mau where tenmau='$tenmau'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq)>0)
		$UserError = "Tên màu này đã có sẵn.";
	else{
		$sql="insert mau(tenmau) values('$tenmau')";
		$connect->query($sql);
		echo"<script>alert('Thêm thành công'); location='?dieuhuong=xemmau';</script>";
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
                <li>
                	<i class="fa fa-table"></i> Quản lý sản phẩm
                </li>
                <li class="active">
                    Quản lý bảng màu
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" >
	    		<h1 class="h1align">THÊM MÀU MỚI</h1>
	        </section>
	        <form method="post" id="formnhommau">
	            <section class="form-horizontal">
	            <label class="control-label col-md-1 col-sm-12" id="label2">Tên màu: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control"name="tenmau" id="tenmau">
		                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
	                </section>
	            </section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" id="b-align">
										<input type="button" onClick="location='?dieuhuong=xemmau';" class="btn btn-primary" value="Quay lại" id="input2">
	            			<input type="submit" class="btn btn-primary" name="themmau" value="Thêm màu" id="input2">
	            	</section>
	            </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#formnhommau" ).validate( {
			rules: {
				tenmau: "required",
			},
			messages: {
				tenmau: "Tên màu không được để trống"
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

<!--Function Xem và xóa danh sách bảng Size-->
<?php function size_list(){?>
<?php
if(isset($_GET['masize'])){
	$sql="delete from size where masize=".$_GET['masize'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemsize';</script>";
}
?>
<section class="container-fluid">
    <!-- Page Heading -->
    <section class="row" >
        <section class="col-lg-12">
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>  <a href="?dieuhuong=home">Trang chủ</a>
                </li>
                <li>
                    <i class="fa fa-table"></i> Quản lý sản phẩm
                </li>
                <li class="active">
                    Quản lý bảng Size
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-md-6 col-sm-12">
        <h1 style="text-align: center;">DANH SÁCH SIZE</h1>
        <p> <button type="button" class="btn btn-primary" onClick="location='?dieuhuong=themsize';"><span class="fa fa-plus"></span> Thêm Size</button></p>
       <section class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã size</th>
                        <th>Size</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select*from size";
                    GLOBAL $connect;
                    $kq=$connect->query($sql) or die('err');
                    while($rowsize=mysqli_fetch_array($kq)){
                ?>
                    <tr>
                        <td><?=$rowsize['masize']?></td>
                        <td><?=$rowsize['tensize']?></td>
                        <td>
                            <?php
                                $sql="select*from chitietsanpham where masize=".$rowsize['masize'] ;
                                $kq1=$connect->query($sql);
                                if(mysqli_num_rows($kq1)==0){
                            ?>
                            <a onClick="if(confirm('Bạn muốn xóa size này?')) return true; else return false;" href="?dieuhuong=xemsize&masize=<?=$rowsize['masize']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
                            <a><button type="button" class="btn btn-xs btn-primary" disabled=""><span class="fa fa-trash"></span> Xóa</button></a>
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

<!-- Function Thêm size mới-->
<?php function size_insert(){?>
<?php
if(isset($_POST['themsize'])){
	$tensize=addslashes($_POST['tensize']);
	$sql="select*from size where tensize='$tensize'";
	GLOBAL $connect;
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq)>0)
		$UserError = "Size này đã có sẵn.";
	else{
		$sql="insert size(tensize) values('$tensize')";
		$connect->query($sql);
		echo"<script>alert('Thêm thành công'); location='?dieuhuong=xemsize';</script>";
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
                <li>
                	<i class="fa fa-table"></i> Quản lý sản phẩm
                </li>
                <li class="active">
                    Quản lý bảng Size
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" >
	    		<h1 class="h1align">THÊM SIZE</h1>
	        </section>
	        <form method="post" id="formnhomsize">
	            <section class="form-horizontal">
	            <label class="control-label col-md-1 col-sm-12" id="label2">Size: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" name="tensize" id="tensize">
		                <span id="UserError"><?php if(isset($UserError))  echo $UserError?></span>
	                </section>
	            </section>
	            <section class="form-group">
                	<section class="col-md-12 col-sm-12" id="b-align">
										<input type="button" onClick="location='?dieuhuong=xemsize';" class="btn btn-primary" value="Quay lại" id="input2">
	            			<input type="submit" class="btn btn-primary" name="themsize" value="Thêm Size" id="input2">
	            	</section>
	            </section>
	        </form>
		</section>
	</section>
</section>
<script type="text/javascript">
	$( document ).ready( function () {
		$( "#formnhomsize" ).validate( {
			rules: {
				tensize: "required",
			},
			messages: {
				tensize: "Size không được để trống"
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
