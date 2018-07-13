$("#dangkythanhvien").attr('disabled', 'disabled');
function loadquan(id)
{
	var dataString = "pid=" + id +"&action=loadquan";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
			var getData = $.parseJSON(response);
			$('#cboquan').html(getData.cboquan);
            $('#sTinh').val(getData.sTinh);
			
		}
	});
}
function checkemail(id)
{
	var dataString = "pid=" + id +"&action=checkemail";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
			$('#statusemail').html(response);
			checksubmit();
		}
	});
}
function checkcode(id)
{
	var dataString = "pid=" + id + "&action=checkcode";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString,
		success: function(response)
		{
			$('#statuscode').html(response);
			checksubmit();
		}
	});
}
function checksubmit()
{
	var dataString = "action=checksubmit";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString,
		success: function(response)
		{
			if(response=='YES')
			{
				$("#dangkythanhvien").removeAttr('disabled');
				$("#dangkythanhvien").css({
					"cursor": "pointer",
					"background": "#008040",
					"color": "#fff"
				});
			}
			else
			{	
				$("#dangkythanhvien").attr('disabled', 'disabled');
				$("#dangkythanhvien").css({
					"cursor": "default",
					"background": "#ccc",
					"color": "#666"
				});
			}
		}
	});
}

function setNhieugia(str)
{
	var array = str.split('-');
	//alert(array[1]);
	if(array[2]!=0)
		var phantram = '<span class="phantram"><img src="images/giamgia.png" alt="Giảm giá"/>'+ array[2] +' %</span>';
	else
		var phantram = '';
	var giaban='<span class="giaban">'+ array[1] +'</span><span class="giacty">'+ array[0] + '</span>'+phantram;
	$('#setPrice').html(giaban);
	$('#Giaban').val(array[3]);
}

function saveinput(dk,str)
{
	var dataString = "dk=" + dk + "&str=" + str +"&action=saveinput";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
			$('#dta').val(response);
		}
	});
}

function setphivanchuyen(id)
{
	var dataString = "pid=" + id +"&action=phivanchuyen";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
			var getData = $.parseJSON(response);
			$('#phivanchuyen').val(getData.phivanchuyen);
            $('span#tongthanhtien').html(getData.spantongthanhtien);
			$('input#tongthanhtien').val(getData.inputtongthanhtien);
			$('#sQuan').val(getData.sQuan);
			location.reload(true);
		}
	});
}
function updownqty(str)
{
	var qty = document.Order.quantity.value;
	if(str=='up') { qty++; }
	if(str=='down') { if(qty>1) { qty--; } }
	$('#qty').val(qty);
	
}
function updownincart(str,id)
{
	var qty=document.getElementById("qty"+id).value;
	if(str=='up') { qty++; }
	if(str=='down') { if(qty>1) { qty--; } }
	var dataString = "pid=" + id + "&qty=" + qty +"&action=capnhatsoluong";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
			var getData = $.parseJSON(response);
			$('#qty'+id).val(getData.soluong);
            $('#thanhtien'+id).html(getData.thanhtien);
			$('span#tongtien').html(getData.tongtien1);
			$('input#tongtien').val(getData.tongtien2);
			$('span#tongthanhtien').html(getData.tongthanhtien1);
			$('input#tongthanhtien').val(getData.tongthanhtien2);
			location.reload(true);
		}
	});
	
	
}
function checkphone(str)
{
	var rephone=/^\d{6,13}$/;
	if(!rephone.test(str) || str=='')
	{
		alert('Số điện thoại chưa nhập hoặc không hợp lệ!');
		return false;
	}
}
function kiemtraemai(str)
{
	reemail = /^\w+(\.\w+)*@\w+(\.\w+){1,3}$/;
	if(!reemail.test(str))
	{
		alert('Địa chỉ email không hợp lệ');
		return false;
	}
}
function checkname(str)
{
	if(str.length<3)
	{
		alert('Tên quá ngắn');
		return false;
	
	}
}
function checkdiachi(str)
{
	if(str.length<3)
	{
		alert('Địa chỉ quá ngắn');
		return false;
	
	}
}
function checkdangky()
{
	if(document.Dtaform.sTen.value.length < 3)
	{
		alert('Vui lòng nhập đầy đủ họ tên!');
		document.Dtaform.sTen.focus();
		return false;
	}
	if(document.Dtaform.sPass.value.length < 6)
	{
		alert('Mật khẩu phải từ 6 ký tự');
		document.Dtaform.sPass.focus();
		return false;
	}
	
	if(document.Dtaform.sPass.value!=document.Dtaform.sRepass.value)
	{
		alert('Xác nhận mật khẩu không đúng!');
		document.Dtaform.sRepass.focus();
		return false;
	}
}
function checkletter()
{
	reemail = /^\w+(\.\w+)*@\w+(\.\w+){1,3}$/;
	if(!reemail.test(document.Letterform.sEmail.value))
	{
		alert('Địa chỉ email không hợp lệ');
		document.Letterform.sEmail.focus();
		return false;
	}
}
function checkbooking()
{
	if(document.Bookingform.sTen.value.length < 3)
	{
		alert('Vui lòng nhập đầy đủ họ tên!');
		document.Bookingform.sTen.focus();
		return false;
	}
	var rephone=/^\d{6,13}$/;
	if(document.Bookingform.sDienthoai.value=='')
	{
		alert('Bạn chưa nhập số điện thoại liên hệ!');
		document.Bookingform.sDienthoai.focus();
		return false;
	}
	reemail = /^\w+(\.\w+)*@\w+(\.\w+){1,3}$/;
	if(!reemail.test(document.Bookingform.sEmail.value))
	{
		alert('Địa chỉ email không hợp lệ');
		document.Bookingform.sEmail.focus();
		return false;
	}
}
function checkform()
{
	reemail = /^\w+(\.\w+)*@\w+(\.\w+){1,3}$/;
	if(!reemail.test(document.Dtaform.sEmail.value))
	{
		alert('Địa chỉ email không hợp lệ');
		document.Dtaform.sEmail.focus();
		return false;
	}
	if(document.Dtaform.sTen.value.length < 3)
	{
		alert('Vui lòng nhập đầy đủ họ tên!');
		document.Dtaform.sTen.focus();
		return false;
	}
	var rephone=/^\d{6,13}$/;
	if(!rephone.test(document.sDienthoai.sEmail.value) || document.Dtaform.sDienthoai.value=='')
	{
		alert('Số điện thoại không hợp lệ!');
		document.Dtaform.sDienthoai.focus();
		return false;
	}
}
function checkformcontact()
{
	reemail = /^\w+(\.\w+)*@\w+(\.\w+){1,3}$/;
	if(!reemail.test(document.Dtaform.sEmail.value))
	{
		alert('Địa chỉ email không hợp lệ');
		document.Dtaform.sEmail.focus();
		return false;
	}
	if(document.Dtaform.sTen.value.length < 3)
	{
		alert('Vui lòng nhập đầy đủ họ tên!');
		document.Dtaform.sTen.focus();
		return false;
	}
	var rephone=/^\d{6,13}$/;
	if(!rephone.test(document.Dtaform.sDienthoai.value) || document.Dtaform.sDienthoai.value=='')
	{
		alert('Số điện thoại không hợp lệ!');
		document.Dtaform.sDienthoai.focus();
		return false;
	}
	if(document.Dtaform.sDiachi.value.length < 3)
	{
		alert('Địa chỉ quá ngắn!');
		document.Dtaform.sDiachi.focus();
		return false;
	}
	if(document.Dtaform.sChude.value.length < 3)
	{
		alert('Tiêu đề quá ngắn!');
		document.Dtaform.sChude.focus();
		return false;
	}
}
function checkformhoidap()
{
	reemail = /^\w+(\.\w+)*@\w+(\.\w+){1,3}$/;
	if(!reemail.test(document.Dtaform.sEmail.value))
	{
		alert('Địa chỉ email không hợp lệ');
		document.Dtaform.sEmail.focus();
		return false;
	}
	if(document.Dtaform.sTen.value.length < 3)
	{
		alert('Vui lòng nhập đầy đủ họ tên!');
		document.Dtaform.sTen.focus();
		return false;
	}
	var rephone=/^\d{6,13}$/;
	if(!rephone.test(document.Dtaform.sDienthoai.value) || document.Dtaform.sDienthoai.value=='')
	{
		alert('Số điện thoại không hợp lệ!');
		document.Dtaform.sDienthoai.focus();
		return false;
	}
	
	if(document.Dtaform.sNoidung.value.length < 3)
	{
		alert('Nội dung quá ngắn!');
		document.Dtaform.sNoidung.focus();
		return false;
	}
}

function checkformcart()
{
	if(document.Dtaform.cboTinh.value == 0)
	{
		alert('Bạn chưa chọn tỉnh thành!');
		document.Dtaform.cboTinh.focus();
		return false;
	}
	if(document.Dtaform.sTen.value.length < 3)
	{
		alert('Vui lòng nhập đầy đủ họ tên!');
		document.Dtaform.sTen.focus();
		return false;
	}
	var rephone=/^\d{6,13}$/;
	if(!rephone.test(document.Dtaform.sDienthoai.value) || document.Dtaform.sDienthoai.value=='')
	{
		alert('Bạn chưa nhập số điện thoại liên hệ!');
		document.Dtaform.sDienthoai.focus();
		return false;
	}
	if(document.Dtaform.sDiachi.value.length < 3)
	{
		alert('Vui lòng nhập địa chỉ!');
		document.Dtaform.sDiachi.focus();
		return false;
	}
	
	
}
function remove_this_item(pid)
{
	//window.location.reload(true);
	//alert(pid);
	var dataString = "pid=" + pid + "&action=remove_this_item";
		$.ajax({  
			type: "POST",  
			url: "action.php",  
			data: dataString,
			success: function(response)
			{
				$("#response").html(response);
			}
		});
	return false;
	
}
function xoagiohang(pid)
{
	//window.location.reload(true);
	//alert(so);
	var dataString = "pid=" + pid + "&action=xoagiohang";
		$.ajax({  
			type: "POST",  
			url: "action.php",  
			data: dataString,
			success: function(response)
			{
				$("#response").html(response);
			}
		});
	return false;
	
}
function capnhatsoluong(pid)
{
	//window.location.reload(true);
	
	var qty=$("#quantity"+pid).val();
	var dataString = "pid=" + pid + "&qty=" + qty + "&action=capnhatsoluong";
		$.ajax({  
			type: "POST",  
			url: "action.php",  
			data: dataString,
			success: function(response)
			{
				$("#response").html(response);
			}
		});
	return false;
	
}
function checkbinhluan()
{
	if(document.formBinhluan.sTen.value.length<4)
	{
		alert('Vui lòng nhập đầy đủ họ tên');
		document.formBinhluan.sTen.focus();
		return false;
	}
	reemail = /^\w+(\.\w+)*@\w+(\.\w+){1,3}$/;
	if(document.formBinhluan.sEmail.value.length<4)
	{
		alert('Địa chỉ Email quá ngắn');
		document.formBinhluan.sEmail.focus();
		return false;
	}
	else
	{
		if(!reemail.test(document.formBinhluan.sEmail.value))
		{
			alert('Địa chỉ email không hợp lệ');
			document.formBinhluan.sEmail.focus();
			return false;
		}
	}
}
function setthuoctinh(str,num)
{
	$("#rad"+str).attr('value', num);
}
	
$(document).ready(function() {
	var link = "action.php";
	var bienmausac; 
	var bientonkho;
	$(".mausac").click(function(){
		bienmausac=$(this).attr("src");
		bientonkho=$(this).attr("value");
		var dataString = "id=" + bientonkho;
		$.ajax({  
			type: "POST",  
			url: "tonkho.php",  
			data: dataString, 
			success: function(response)
			{
				$('#loadtonkho').html(response);
			}
		});
    });
	
    $(".muangay").click(function(){
		$("form#product").submit(function() {
			var id = $(this).find('input[name=product_id]').val();
			var qty = $(this).find('input[name=quantity]').val();
			var kichthuoc = $(this).find('input[name=radKichthuoc]').val();
			var chatlieu = $(this).find('input[name=radChatlieu]').val();
			var mausac = bienmausac;
			if(!mausac)
			{
				alert('Bạn vui lòng chọn màu sắc !');
				return false;	
			}
			if(kichthuoc=='')
			{
				alert('Bạn vui lòng chọn kích thước !');
				return false;	
			}
			//var mausac = $(this).find('input[name=radMausac]').val();
			var giaban = $(this).find('input[name=giaban]').val();
			var dataString = "pid=" + id + "&qty=" + qty + "&kichthuoc=" + kichthuoc + "&chatlieu=" + chatlieu + "&mausac=" + mausac + "&giaban=" + giaban + "&action=addcart";
				$.ajax({  
					type: "POST",  
					url: "action.php",  
					data: dataString, 
					success: function(response)
					{
						window.location.href="cart";
					}
				});
			return false;
			
		});
	});
	
	$(".themvaogio").click(function(){
		$("form#product").submit(function() {
			var id = $(this).find('input[name=product_id]').val();
			var qty = $(this).find('input[name=quantity]').val();
			var kichthuoc = $(this).find('input[name=radKichthuoc]').val();
			var chatlieu = $(this).find('input[name=radChatlieu]').val();
			var mausac = bienmausac;
			if(!mausac)
			{
				alert('Bạn vui lòng chọn màu sắc !');
				return false;	
			}
			if(kichthuoc=='')
			{
				alert('Bạn vui lòng chọn kích thước !');
				return false;	
			}
			else{
			//var mausac = $(this).find('input[name=radMausac]').val();
			var giaban = $(this).find('input[name=giaban]').val();
			var dataString = "pid=" + id + "&qty=" + qty + "&kichthuoc=" + kichthuoc + "&chatlieu=" + chatlieu + "&mausac=" + mausac + "&giaban=" + giaban + "&action=addcart";
				$.ajax({  
					type: "POST",  
					url: "action.php",  
					data: dataString, 
					success: function(response)
					{
						alert('Đã thêm vào giỏ hàng'); location.reload(true);
					}
				});
			return false;
			}
		});
	});
 
});
function getfirst(id)
{
	var dataString = "id=" + id;
	$.ajax({  
		type: "POST",  
		url: "getfirst.php",  
		data: dataString,
		success: function(response)
		{
			$('#getfirst').html(response);
		}
	});
}
function getpagecomment(pid,id)
{
	var dataString = "id=" + id + "&pid=" + pid;
	$.ajax({  
		type: "POST",  
		url: "getpagecomment.php",  
		data: dataString,
		success: function(response)
		{
			$('#reloadcomment').html(response);
		}
	});
}
// Thống kê
var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,3140173,4,605,110,55,00011001']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('template/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();

/* Rating */
$(document).ready(function(){$('#rating_panel>img').click(function(e){var imgindex=$(this).index()+1;var ratingpanel=$(this).closest('div');var pollid=ratingpanel.attr('data-pollid');var israted=ratingpanel.attr('data-rated');if(israted==1){return false;}else{ratingpanel.attr('data-rated',1);}
$('#starloader').show();for(i=0;i<imgindex;i++){var imgobj=$("#rating_panel>img:eq( "+i+" )");var img='images/full.png';imgobj.attr('src',img);}
var dataString = 'action=rating&rated='+imgindex+'&pid='+pollid; $.ajax({url:'action.php',type:'POST',data: dataString,success:function(response)
{$('#kqrating').html(response);}});});});

$(document).ready(function(){$('#rating_panel_bottom>img').click(function(e){var imgindex=$(this).index()+1;var ratingpanel=$(this).closest('span');var pollid=ratingpanel.attr('data-pollid');var israted=ratingpanel.attr('data-rated');if(israted==1){return false;}else{ratingpanel.attr('data-rated',1);}
$('#starloader').show();for(i=0;i<imgindex;i++){var imgobj=$("#rating_panel_bottom>img:eq( "+i+" )");var img='images/full.png';imgobj.attr('src',img);}
var dataString = 'action=rating&rated='+imgindex+'&pid='+pollid; $.ajax({url:'action.php',type:'POST',data: dataString,success:function(response)
{$('#kqrating_bottom').html(response);}});});});

function thich(id)
{
	var dataString = "pid=" + id +"&action=thich";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
            $('#thich').val(response);
		}
	});
}
function daxem(id)
{
	var dataString = "pid=" + id +"&action=xem";
	$.ajax({  
		type: "POST",  
		url: "action.php",  
		data: dataString, 
		success: function(response)
		{
		}
	});
}
$(document).ready(function(){
	
	//Bật tắt comment Facebook
	$("input#cmf").click(function(){
			$("div.cmf").slideToggle();
	
	});
});

/* Responsive Menu flaunt.js */
;(function($){$(function(){$('.nav').append($('<div class="nav-mobile"></div>'));$('.nav-item').has('ul').prepend('<span class="nav-click"><i class="nav-arrow"></i></span>');$('.nav-mobile').click(function(){$('.nav-list').toggle();});$('.nav-list').on('click','.nav-click',function(){$(this).siblings('.nav-submenu').toggle();$(this).children('.nav-arrow').toggleClass('nav-rotate');});});})(jQuery);
/* Flash write */
function Flashwrite(url,w,h,id,bg,vars){var flashStr="<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='"+w+"' height='"+h+"' id='"+id+"' align='middle'>"+"<param name='allowScriptAccess' value='always' />"+"<param name='movie' value='"+url+"' />"+"<param name='FlashVars' value='"+vars+"' />"+"<param name='wmode' value='transparent' />"+"<param name='menu' value='false' />"+"<param name='quality' value='high' />"+"<embed src='"+url+"' FlashVars='"+vars+"' wmode='transparent' menu='false' quality='high' width='"+w+"' height='"+h+"' allowScriptAccess='always' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />"+"</object>";document.write(flashStr);}
