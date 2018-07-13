$(document).ready(function(){
	$(".vanchuyen").change(function(){
		var id= $(".vanchuyen").val();
		$.post("Modules/Ajax/data1.php",{id: id},function(data){
			$(".giavc").html(data);
		})
	})
})
$(document).ready(function(){
	$(".thanhtoan").change(function(){
		var id= $(".thanhtoan").val();
		$.post("Modules/Ajax/data2.php",{id: id},function(data){
			$(".htthanhtoan").html(data);
		})
	})
})

