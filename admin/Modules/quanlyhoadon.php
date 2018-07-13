<!-- function Xem & Xoá hóa đơn-->
<?php  function hoadon_list(){?>
<?php
	if(isset($_GET['mahoadon'])){
		$mahoadon=$_GET['mahoadon'];
		$sql="delete from hoadon where mahoadon='$mahoadon'";
		GLOBAL $connect;
		$connect->query($sql);
		$sql="delete from chitiethoadon where mahoadon='$mahoadon'";
		GLOBAL $connect;
		$connect->query($sql);
		echo"<script>alert('Xóa thành công'); location='?dieuhuong=xemhoadon';</script>";
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
                    <i class="fa fa-shopping-cart"></i> Quản lý hóa đơn
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">
        <?php
        	if (isset($_GET['trangthaihoadon'])) {
        		switch($_GET['trangthaihoadon'])
							{
								case"1": echo"DANH SÁCH HÓA ĐƠN CHƯA XỬ LÝ"; break;
								case"2": echo"DANH SÁCH HÓA ĐƠN ĐANG XỬ LÝ"; break;
								case"3": echo"DANH SACH HÓA ĐƠN ĐÃ XỬ LÝ"; break;
								default: echo"DANH SACH HÓA ĐƠN BỊ HỦY"; break;

							}
        	}else{
        		echo "DANH SÁCH HÓA ĐƠN";
        	}
        ?>
		</h1>
		<form method="get" id="form_search">
		<section class="form-inline" id="loc1">
			<section class="form-group input-group">
		      		<span class="input-group-addon">Trạng thái hóa đơn:</span>
		            <select class="form-control" name="trangthaihoadon" onChange="location=this.options[this.selectedIndex].value;">
		        	<?php
		        		$url='dieuhuong=xemhoadon';
		        		if(isset($_GET['soluong'])){
							$url='dieuhuong=xemhoadon&soluong='.$_GET['soluong'];
						}
		        		if ($_GET['trangthaihoadon']==1) {?>
		            	<option selected value="?<?=$url?>&trangthaihoadon=1">Chưa xử lý</option>
		            	<option value="?<?=$url?>&trangthaihoadon=2">Đang xử lý</option>
		            	<option value="?<?=$url?>&trangthaihoadon=3">Đã xử lý</option>
									<option value="?<?=$url?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
									<option value="?<?=$url?>">Xem tất cả</option>
		            <?php }elseif ($_GET['trangthaihoadon']==2) {?>
		            	<option value="?<?=$url?>&trangthaihoadon=1">Chưa xử lý</option>
		            	<option selected value="?<?=$url?>&trangthaihoadon=2">Đang xử lý</option>
		            	<option value="?<?=$url?>&trangthaihoadon=3">Đã xử lý</option>
									<option value="?<?=$url?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
		            	<option value="?<?=$url?>">Xem tất cả</option>
		            <?php }elseif ($_GET['trangthaihoadon']==3) {?>
		            	<option value="?<?=$url?>&trangthaihoadon=1">Chưa xử lý</option>
		            	<option value="?<?=$url?>&trangthaihoadon=2">Đang xử lý</option>
		            	<option selected value="?<?=$url?>&trangthaihoadon=3">Đã xử lý</option>
									<option value="?<?=$url?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
		            	<option value="?<?=$url?>">Xem tất cả</option>
								<?php }elseif ($_GET['trangthaihoadon']==4) {?>
		            	<option value="?<?=$url?>&trangthaihoadon=1">Chưa xử lý</option>
		            	<option value="?<?=$url?>&trangthaihoadon=2">Đang xử lý</option>
		            	<option value="?<?=$url?>&trangthaihoadon=3">Đã xử lý</option>
									<option selected value="?<?=$url?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
		            	<option value="?<?=$url?>">Xem tất cả</option>
		            <?php }else{?>
			            <option value="?<?=$url?>&trangthaihoadon=1" >Chưa xử lý</option>
			            <option value="?<?=$url?>&trangthaihoadon=2">Đang xử lý</option>
			            <option value="?<?=$url?>&trangthaihoadon&trangthaihoadon=3">Đã xử lý</option>
									<option value="?<?=$url?>&trangthaihoadon=4">Hóa đơn bị hủy</option>
			            <option selected value="?<?=$url?>">Xem tất cả</option>
			        <?php }
		        	?>
		        	</select>
			</section>
			<section class="form-group input-group">
		        <span class="input-group-addon">Hiển thị:</span>
		            <select class="form-control" name="hienthi" onChange="location=this.options[this.selectedIndex].value;">
		            <option value="" hidden="">-- Mời bạn chọn --</option>
		            <?php
		            	if(isset($_GET['trangthaihoadon'])){
							$url='dieuhuong=xemhoadon&trangthaihoadon='.$_GET['trangthaihoadon'];
						}
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
                        <th>Mã Hóa đơn</th>
                        <th>Tên người đặt</th>
                        <th>Ngày tạo</th>
                        <th>Ngày sửa</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Xem/Sửa hóa đơn</th>
                        <th>Xóa hóa đơn</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select hoten,hoadon.mahoadon,hoadon.hotennn,hoadon.ngaytao,hoadon.trangthaihoadon,sum(soluong*gia) as tongtien,hoadon.ngaysua,vanchuyen.giacuoc from thanhvien,hoadon,chitiethoadon,vanchuyen where thanhvien.mathanhvien=hoadon.mathanhvien and hoadon.mahoadon=chitiethoadon.mahoadon and hoadon.mavanchuyen=vanchuyen.mavanchuyen group by hoadon.mahoadon ";
                    GLOBAL $connect;
                    if(isset($_GET['trangthaihoadon'])){
						$trangthaihoadon=addslashes($_GET['trangthaihoadon']);
						$sql="select hoten,hoadon.mahoadon,hoadon.hotennn,hoadon.ngaytao,hoadon.trangthaihoadon,sum(soluong*gia) as tongtien,hoadon.ngaysua,vanchuyen.giacuoc from thanhvien,hoadon,chitiethoadon,vanchuyen where thanhvien.mathanhvien=hoadon.mathanhvien and hoadon.mahoadon=chitiethoadon.mahoadon and hoadon.mavanchuyen=vanchuyen.mavanchuyen and trangthaihoadon='$trangthaihoadon' group by hoadon.mahoadon ";}
						if(isset($_GET['soluong'])){
							$spmt=$_GET['soluong'];
						}else{
							$spmt=10;
						}
						$sql.="order by mahoadon desc";
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
                    while($rowhoadon=mysqli_fetch_array($kq1)){
                ?>
                    <tr>
                    	<td><?=$rowhoadon['mahoadon']?></td>
                        <td><?=$rowhoadon['hoten']?></td>
                        <td><?php echo date("d-m-Y",strtotime($rowhoadon['ngaytao']))?></td>
                        <td><?php
                        	if($rowhoadon['ngaysua']=="0000-00-00"){
                        		echo date("d-m-Y",strtotime($rowhoadon['ngaytao']));
                        	}else{
                        		echo date("d-m-Y",strtotime($rowhoadon['ngaysua']));
                        	}
                        ?>
                        </td>
                        <?php  
                        	$tongtien1=$rowhoadon['tongtien']+$rowhoadon['giacuoc'];
                        ?>
                       	<td><?=number_format($tongtien1,0,',','.')?> vnđ</td>
                       	<td><?php if($rowhoadon['trangthaihoadon']==1) echo"Chưa xử lý";elseif($rowhoadon['trangthaihoadon']==2) echo"Đang xử lý";elseif($rowhoadon['trangthaihoadon']==3) echo"Đã xử lý"; else echo"Hóa đơn bị hủy";?></td>
                       	<td>
                       		 <a href="?dieuhuong=chitiethoadon&mahoadon=<?=$rowhoadon['mahoadon']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Xem - Sửa</button></a>
                       	</td>
                       	<td>
                       		<?php if($rowhoadon['trangthaihoadon']==1 || $rowhoadon['trangthaihoadon']==4){?>
                       		<a onClick="if(confirm('Bạn muốn xóa đơn hàng này?')) return true; else return false;" href="?<?=$url?>&mahoadon=<?=$rowhoadon['mahoadon']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php }else{?>
								<a><button type="button" class="btn btn-xs btn-primary" disabled><span class="fa fa-trash"></span> Xóa</button></a>
                            <?php } ?>
                       	</td>
                    </tr>
                    <?php }
                    	}else{?>
                    	<tr>
		        			<td colspan="8" id="search-pro">Không có hóa đơn nào</td>
		        		</tr>
                    <?php
                    	}
                    ?>
                </tbody>
            </table>
        </section>
        <section class="col-lg-12" style="text-align: center; ">
			<ul class="pagination" style="margin-top: 0px;">
					<?php if($tongsotrang>1){?>
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
                    <?php
                			}
                		}
                    ?>
                </ul>
        </section>
    </section>
</section>
<?php } ?>

<!-- function Chi tiết hóa đơn-->
<?php  function hoadon_update(){?>
<?php
	if(isset($_GET['mahoadon']))
		$mahoadon=addslashes($_GET['mahoadon']);
?>
<?php
	if(isset($_POST['suahoadon'])){
		$trangthai=addslashes($_POST['trangthai']);
		$sql="update hoadon set trangthaihoadon='$trangthai',ngaysua=now() where mahoadon='$mahoadon'";
		GLOBAL $connect;
		$connect->query($sql) or die('Không thể cập nhật');
		$soluong=$_POST['soluong'];
		$sql="select * from chitiethoadon where mahoadon='$mahoadon'";
		GLOBAL $connect;
		$ketqua=$connect->query($sql);
		$i=0;
		while($rowchitiet=mysqli_fetch_array($ketqua))
		{
			$sql="update chitiethoadon set soluong='".$soluong[$i]."' where mahoadon='$mahoadon' and machitietsp=".$rowchitiet['machitietsp'];
			GLOBAL $connect;
			$connect->query($sql) or die('Không thể cập nhật');
			$i++;
		}
		echo "<script>alert('Cập nhật hóa đơn thành công!'); location='?dieuhuong=xemhoadon'</script>";
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
                    <i class="fa fa-shopping-cart"></i> Quản lý hóa đơn
                </li>
            </ol>
        </section>
	</section>
    <!-- /.row -->
		<?php
			$sql="select * from hoadon,thanhvien,vanchuyen,thanhtoan where hoadon.mathanhvien=thanhvien.mathanhvien and hoadon.mavanchuyen=vanchuyen.mavanchuyen and hoadon.mathanhtoan=thanhtoan.mathanhtoan and hoadon.mahoadon='$mahoadon'";
			GLOBAL $connect;
			$kq=$connect->query($sql);
			$rowhoadon=mysqli_fetch_array($kq);
		?>
	<form method="post" id="form_search">
    <section class="col-lg-12">
        <h1 style="text-align: center;">CHI TIẾT HÓA ĐƠN SỐ : <?php echo $_GET['mahoadon'] ?></h1>
		<section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Thông tin người đặt</h3>
			<section class="form-group-inline">
              <label>Họ tên người đặt:</label>
              <p class="form-control-static"><?=$rowhoadon['hoten']?></p>
          	</section>
			<section class="form-group-inline">
              <label>Điện thoại người đặt:</label>
              <p class="form-control-static"><?=$rowhoadon['dienthoai']?></p>
          	</section>
			<section class="form-group-inline">
	            <label>Email người đặt:</label>
	            <p class="form-control-static"><?=$rowhoadon['email']?></p>
            </section>
			<section class="form-group-inline">
              <label>Địa chỉ người đặt:</label>
              <p class="form-control-static"><?=$rowhoadon['diachi']?></p>
	        </section>
		</section>
		<section class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Thông tin người nhận</h3>
			<section class="form-group-inline">
	            <label>Họ tên người nhận:</label>
	            <p class="form-control-static"><?=$rowhoadon['hotennn']?></p>
	        </section>
			<section class="form-group-inline">
                <label>Điện thoại người nhận:</label>
                <p class="form-control-static"><?=$rowhoadon['dienthoainn']?></p>
            </section>
			<section class="form-group-inline">
                <label>Email người nhận:</label>
                <p class="form-control-static"><?=$rowhoadon['emailnn']?></p>
            </section>
			<section class="form-group-inline">
              	<label>Địa chỉ người nhận:</label>
              	<p class="form-control-static"><?=$rowhoadon['diachinn']?></p>
          	</section>
				<?php
					if($rowhoadon['ghichu']!=NULL){
				?>
					<section class="form-group-inline">
			            <label>Ghi chú:</label>
			            <p class="form-control-static"><?=$rowhoadon['ghichu']?></p>
			        </section>
				<?php } ?>
		</section>
		<section class="col-lg-6 col-sm-6 col-xs-12">
			<h3>Phương thức thanh toán</h3>
			<section class="form-group-inline">
                <label>Hình thức thanh toán:</label>
                <p class="form-control-static"><?=$rowhoadon['hinhthuctt']?></p>
          	</section>
		</section>
		<section class="col-lg-6 col-sm-6 col-xs-12">
			<h3>Phương thức vận chuyển</h3>
			<section class="form-group-inline">
					<label>Hình thức vận chuyển:</label>
					<p class="form-control-static"><?=$rowhoadon['hinhthucvc']?></p>
			</section>
		</section>
		<section class="col-lg-12">
			<h3 class="h3align">Sản phẩm đặt mua</h3>
			<section class="table-responsive">
	          	<table class="table table-bordered table-hover">
	              	<thead>
	                  <tr>
	                    <th>STT</th>
	                    <th>Ảnh sản phẩm</th>
	                    <th>Tên sản phẩm</th>
						<th>Màu</th>
						<th>Size</th>
						<th>Đơn giá</th>
	                    <th>Số lượng</th>
	                    <th>Tổng</th>
	                  </tr>
	                </thead>
	                <tbody>
						<?php
							$stt=0;
							$sql="select sanpham.anhdaidien,sanpham.tensanpham,mau.tenmau,size.tensize,chitiethoadon.gia,chitiethoadon.soluong from chitiethoadon,mau,size,chitietsanpham,sanpham where chitiethoadon.machitietsp=chitietsanpham.machitiet and chitietsanpham.masp=sanpham.masanpham and chitietsanpham.mamau=mau.mamau and chitietsanpham.masize=size.masize and chitiethoadon.mahoadon='$mahoadon'";
							GLOBAL $connect;
							$kq1=$connect->query($sql);
							while($rowchitiet=mysqli_fetch_array($kq1)){
						?>
							<tr>
		                		<td><?=++$stt;?></td>
			                    <td><img src="<?=$rowchitiet['anhdaidien']?>" width="40px" height="50px" class="img-responsive"></td>
			                    <td><?=$rowchitiet['tensanpham']?></td>
			                    <td><?=$rowchitiet['tenmau']?></td>
													<td><?=$rowchitiet['tensize']?></td>
			                   	<td><?=number_format($rowchitiet['gia'],0,',','.')?> vnđ</td>
			                   	<td>
			                   	<?php if ($rowhoadon['trangthaihoadon']==1) {?>
			                   		<input name="soluong[]" value="<?=number_format($rowchitiet['soluong'],0,",",".")?>" size="3" maxlength="2" style="text-align:right" />
			                   	<?php }else{ ?>
			                      	<input name="soluong[]" value="<?=number_format($rowchitiet['soluong'],0,",",".")?>" size="3" maxlength="2" style="text-align:right" disabled/>
			                    <?php } ?>
			                    </td>
								<?php
									$tongtien=0;
									$tong=$rowchitiet['gia']*$rowchitiet['soluong'];
									$tongtien+=$tong;
								?>
									<td><?=number_format($tong,0,',','.')?> vnđ</td>
							</tr>
						<?php } ?>
             		</tbody>
          		</table>
	      	</section>
	    </section>
	    <section class="col-lg-12">
                        <ul class="list-group" style="text-align: right; font-weight: bolder;">
                            <li class="list-group-item">Tổng tiền hàng: <?=number_format($tongtien,0,',','.')?> vnđ</li>
                            <li class="list-group-item">Tiền vận chuyển: <?=number_format($rowhoadon['giacuoc'],0,',','.')?> vnđ</li>
                            <li class="list-group-item" id="ttttoan">Tổng tiền cần thanh toán: <?=number_format($rowhoadon['giacuoc']+$tongtien,0,',','.')?> vnđ</li>
                        </ul>
	    </section>
	    <section class="col-lg-12">
			<section class="form-group">
				<label class="control-label col-md-2 col-sm-12">Trạng thái hóa đơn: </label>
				<section class="col-md-5 col-sm-12">
					<?php if($rowhoadon['trangthaihoadon']==1){?>
						<select name="trangthai" class="form-control">
							<option value="1" selected>Chưa xử lý</option>
							<option value="2">Đang xử lý</option>
							<option value="3">Đã xử lý</option>
							<option value="4">Hóa đơn bị hủy</option>
						</select>
					<?php }elseif($rowhoadon['trangthaihoadon']==2){ ?>
						<select name="trangthai" class="form-control">
							<option value="1" disabled="">Chưa xử lý</option>
							<option value="2" selected>Đang xử lý</option>
							<option value="3">Đã xử lý</option>
							<option value="4">Hóa đơn bị hủy</option>
						</select>
						<?php }elseif($rowhoadon['trangthaihoadon']==3){ ?>
							<select name="trangthai" class="form-control" disabled="">
								<option value="1">Chưa xử lý</option>
								<option value="2">Đang xử lý</option>
								<option value="3" selected>Đã xử lý</option>
								<option value="4">Hóa đơn bị hủy</option>
							</select>
					<?php }else{ ?>
						<select name="trangthai" class="form-control" disabled="">
							<option value="1">Chưa xử lý</option>
							<option value="2">Đang xử lý</option>
							<option value="3">Đã xử lý</option>
							<option value="4" selected>Hóa đơn bị hủy</option>
						</select>
					<?php } ?>
	    		</section>
  			</section>
		</section>
		<section class="col-md-12 col-sm-12" id="b-align" style="margin-top: 15px">
			<section class="form-group">
				<input type="button" onClick="location='?dieuhuong=xemhoadon';" class="btn btn-primary" name="suabinhluan" value="Quay lại" id="input2">
				<?php
					if($rowhoadon['trangthaihoadon']==3 || $rowhoadon['trangthaihoadon']==4){
				?>
					<input type="submit" class="btn btn-primary" name="suabinhluan" value="Cập nhật hóa đơn" id="input2" disabled="">
				<?php }else{ ?>
					<input type="submit" class="btn btn-primary" name="suahoadon" value="Cập nhật hóa đơn" id="input2">
				<?php } ?>
			</section>
		</section>
    </section>
    </form>
</section>
<?php } ?>
