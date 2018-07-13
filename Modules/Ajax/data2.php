<?php
	require("../connect.php");	
	$key=$_POST['id'];
	$sql="select * from thanhtoan where mathanhtoan='$key'";
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq)>0){
		while($rowloai=mysqli_fetch_array($kq)){
?>
	<?=$rowloai['ghichutt']?>
<?php
		}
	}
?>
