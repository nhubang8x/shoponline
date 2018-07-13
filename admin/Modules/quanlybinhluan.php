<!--Function Xem & Xóa bình luận-->
<?php function binhluan_list(){?>
<?php
	if(isset($_GET['mabinhluan'])){
	$sql="delete from binhluan where mabinhluan=".$_GET['mabinhluan'];
	GLOBAL $connect;
	$connect->query($sql);
	echo"<script>alert('Xóa thành công'); location='?dieuhuong=xembinhluan';</script>";
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
                    <i class="fa fa-fw fa-comments"></i> Quản lý bình luận
            </ol>
        </section>
	</section>
    <!-- /.row -->
    <section class="col-lg-12">
        <h1 style="text-align: center;">DANH SÁCH BÌNH LUẬN</h1>
		<section class="form-inline" id="loc1">
			<section class="form-group input-group">
	      		<span class="input-group-addon">Trạng thái:</span>
	            <select class="form-control" name="trangthai" onChange="location=this.options[this.selectedIndex].value;">
	        	<?php
	            	if(isset($_GET['trangthai'])){?>
	            	<?php
	            		if($_GET['trangthai']==1){
	            	?>
	            		<option value="?dieuhuong=xembinhluan">Xem tất cả</option>
	            		<option selected value="?dieuhuong=xembinhluan&trangthai=1">Mở</option>
	            		<option value="?dieuhuong=xembinhluan&trangthai=0">Khóa</option>
	            	<?php }else{?>
        				<option value="?dieuhuong=xembinhluan">Xem tất cả</option>
        				<option value="?dieuhuong=xembinhluan&trangthai=1">Mở</option>
        				<option selected value="?dieuhuong=xembinhluan&trangthai=0">Khóa</option>
	            	<?php   }
	            	}else{?>
	            		<option selected value="?dieuhuong=xembinhluan">Xem tất cả</option>
	            		<option value="?dieuhuong=xembinhluan&trangthai=1">Mở</option>
	            		<option value="?dieuhuong=xembinhluan&trangthai=0">Khóa</option>
	        		<?php }?>
	        	</select>
			</section>
			<section class="form-group input-group">
		        <span class="input-group-addon">Hiển thị:</span>
		            <select class="form-control" name="hienthi" onChange="location=this.options[this.selectedIndex].value;">
		            <option value="" hidden="">-- Mời bạn chọn --</option>
		            <?php
		            	$url='dieuhuong=xembinhluan';
		            	if(isset($_GET['trangthai'])){
							$url='dieuhuong=xembinhluan&trangthai='.$_GET['trangthai'];
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
                        <th>Mã bình luận</th>
                        <th>Tên sản phẩm</th>
                        <th>Tên thành viên</th>
                        <th>Ngày gửi</th>
                        <th>Trạng thái</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql="select * from binhluan order by mabinhluan desc";
                    if(isset($_GET['trangthai'])){
						$trangthai=addslashes($_GET['trangthai']);
						$sql="select * from binhluan where trangthai='$trangthai' order by mabinhluan desc ";
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
                    while($rowbinhluan=mysqli_fetch_array($kq1)){
                ?>
                    <tr>
						<td><?=$rowbinhluan['mabinhluan']?></td>
						<?php
							$sql="select tensanpham from sanpham where masanpham=".$rowbinhluan['masp'];
							GLOBAL $connect;
                        	$kq2=$connect->query($sql);
                        	$rowsanpham=mysqli_fetch_array($kq2)
						?>
						<td><?=$rowsanpham['tensanpham']?></td>
						<?php
							$sql="select hoten from thanhvien where mathanhvien=".$rowbinhluan['mathanhvien'];
							GLOBAL $connect;
                        	$kq3=$connect->query($sql);
                        	$rowthanhvien=mysqli_fetch_array($kq3)
						?>
						<td><?=$rowthanhvien['hoten']?></td>
						<td><?php echo date("d/m/Y",strtotime($rowbinhluan['ngaygui']))?></td>
                        <td><?php if($rowbinhluan['trangthai']==1) echo"Mở"; else echo"Khóa";?></td>
                        <td>
                            <a href="?dieuhuong=suabinhluan&mabinhluan=<?=$rowbinhluan['mabinhluan']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-pencil"></span> Duyệt</button></a>
                            <a onClick="if(confirm('Bạn muốn xóa bình luận này?')) return true; else return false;" href="?dieuhuong=xembinhluan&mabinhluan=<?=$rowbinhluan['mabinhluan']?>"><button type="button" class="btn btn-xs btn-primary"><span class="fa fa-trash"></span> Xóa</button></a>
                        </td>
                    </tr>
                <?php }?>
                	<tr>
                    	<td colspan="11" id="sum-pro">Tổng số: <?php echo mysqli_num_rows($kq) ?> bình luận</td>
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

<!--Function Duyệt bình luận-->
<?php function binhluan_update(){?>
<?php
	if(isset($_GET['mabinhluan']))
		$mabinhluan=addslashes($_GET['mabinhluan']);
?>
<?php
	if(isset($_POST['suabinhluan'])){
		$noidung=addslashes($_POST['noidung']);
		$trangthai=addslashes($_POST['trangthai']);
		$sql="update binhluan set noidung='$noidung',trangthai='$trangthai' where mabinhluan='$mabinhluan'";
		GLOBAL $connect;
		$connect->query($sql) or die('Không thể cập nhật');
		echo "<script>alert('Duyệt bình luận thành công!'); location='?dieuhuong=ttthanhvien'</script>";
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
                	<i class="fa fa-fw fa-comments"></i> Quản lý bình luận
                </li>
                <li class="active">
                    Duyệt bình luận
                </li>
            </ol>
        </section>
	</section>
	<section class="row" id="row1">
	    <section class="col-lg-12">
	    	<section class="col-md-12 col-sm-12" style="padding-left: 0px;">
	            		<h1 class="h1align">DUYỆT BÌNH LUẬN</h1>
	      	</section>
	        <?php
			if(isset($_GET['mabinhluan']))
				$mabinhluan=addslashes($_GET['mabinhluan']);
				$sql="select*from binhluan where mabinhluan='$mabinhluan'";
				GLOBAL $connect;
				$kq=$connect->query($sql);
				$rowbinhluan=mysqli_fetch_array($kq);
			?>
			<?php
				$sql="select*from sanpham where masanpham=".$rowbinhluan['masp'];
				GLOBAL $connect;
				$kq1=$connect->query($sql);
				$rowsanpham=mysqli_fetch_array($kq1);
			?>
			<?php
				$sql="select*from thanhvien where mathanhvien=".$rowbinhluan['mathanhvien'];
				GLOBAL $connect;
				$kq2=$connect->query($sql);
				$rowthanhvien=mysqli_fetch_array($kq2);
			?>
	        <form method="post" class="form-horizontal" id="signupForm" enctype="multipart/form-data">
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Tên sản phẩm: </label>
	            	<section class="col-md-10 col-sm-12">
		                <input class="form-control" type="text" name="tensp" value="<?=$rowsanpham['tensanpham']?>" disabled>
	                </section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Thành viên bình luận: </label>
	            	<section class="col-md-10 col-sm-12">
		              	  <input class="form-control" type="text" name="tensp" value="<?=$rowthanhvien['hoten']?>" disabled>
                	</section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Ngày gửi: </label>
	            	<section class="col-md-10 col-sm-12">
		              	  <input class="form-control" type="text" name="tensp" value="<?php echo date('d/m/Y',strtotime($rowbinhluan['ngaygui']))?>" disabled>
                	</section>
	            </section>
	            <section class="form-group">
	                <label class="control-label col-md-2 col-sm-12" id="label2">Nội dung: </label>
	            	<section class="col-md-10 col-sm-12">
		                <textarea class="form-control" type="text" name="noidung" id="motasp"><?=$rowbinhluan['noidung']?></textarea>
	                </section>
	            </section>
	            <section class="form-group">
	            	<label class="control-label col-md-2 col-sm-12" id="label1">Trạng thái: </label>
	            	<section class="col-md-2 col-sm-12">
	            	<select name="trangthai" class="form-control">
	            	<?php if($rowbinhluan['trangthai']==1){?>
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
									<input type="button" onClick="location='?dieuhuong=xembinhluan';" class="btn btn-primary" value="Quay lại" id="input2">
	            		<input type="submit" class="btn btn-primary" name="suabinhluan" value="Duyệt bình luận" id="input2">
	            	</section>
		        	</section>
	        </form>
		</section>
	</section>
</section>
<?php } ?>
