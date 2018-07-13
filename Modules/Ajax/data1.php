<?php
	require("../connect.php");
	$key=$_POST['id'];
	$sql="select * from vanchuyen where mavanchuyen='$key'";
	$kq=$connect->query($sql);
	if(mysqli_num_rows($kq)>0){
		while($rowloai=mysqli_fetch_array($kq)){
?>
		<p style="font-family: verdana,geneva,sans-serif;">Giá cước: <?=number_format($rowloai['giacuoc'],0,',','.')?> VNĐ </p>
<?php
		}
	}
?>
